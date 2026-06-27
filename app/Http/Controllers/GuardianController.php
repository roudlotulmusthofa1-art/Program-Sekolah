<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\PendaftaranSiswa;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class GuardianController extends Controller
{
    // ─── Form daftar akun wali (input kode akses) ────────────────
    public function registerForm()
    {
        return view('auth.guardian.register');
    }

    public function create()
    {
        return view('guardians.create');
    }

    // ─── Verifikasi kode dan isi data wali ───────────────────────
    public function verifyKode(Request $request)
    {
        $request->validate([
            'kode_akses' => 'required|string',
        ]);

        $pendaftaran = PendaftaranSiswa::where('kode_akses', strtoupper($request->kode_akses))
            ->where('status', 'diterima')
            ->with('student')
            ->first();

        if (!$pendaftaran) {
            return back()->withErrors(['kode_akses' => 'Kode akses tidak valid atau pendaftaran belum diterima.']);
        }

        session(['psb_kode' => $pendaftaran->kode_akses, 'psb_id' => $pendaftaran->id]);

        return redirect()->route('guardian.form-data');
    }

    // ─── Form isian data akun wali ────────────────────────────────
    public function formData()
    {
        if (!session('psb_kode')) {
            return redirect()->route('guardian.register')->with('error', 'Silakan masukkan kode akses terlebih dahulu.');
        }

        $pendaftaran = PendaftaranSiswa::find(session('psb_id'));
        return view('auth.guardian.form-data', compact('pendaftaran'));
    }

    // ─── Simpan akun wali + Guardian record ──────────────────────
    public function simpanData(Request $request)
    {
        if (!session('psb_kode')) {
            return redirect()->route('guardian.register');
        }

        $pendaftaran = PendaftaranSiswa::find(session('psb_id'));
        if (!$pendaftaran) {
            return redirect()->route('guardian.register')->with('error', 'Sesi tidak valid.');
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nik'          => 'nullable|string|max:20',
            'pekerjaan'    => 'nullable|string|max:100',
            'alamat'       => 'nullable|string|max:500',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8|confirmed',
            'no_hp'        => 'required|string|max:20',
        ]);

        // ── 1. Buat user account ──────────────────────────────────
        $user = User::create([
            'name'     => $validated['nama_lengkap'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'guardian',
        ]);

        // ── 2. Buat Guardian record (selalu baru untuk user baru) ─
        // PERBAIKAN: tidak pakai updateOrCreate dengan id=null
        // karena guardian_id di pendaftaran masih null saat pertama daftar
        $guardian = Guardian::create([
            'user_id'      => $user->id,
            'guardian_name'=> $validated['nama_lengkap'],
            'nik'          => $validated['nik'] ?? null,
            'pekerjaan'    => $validated['pekerjaan'] ?? null,
            'alamat'       => $validated['alamat'] ?? null,
            'whatsapp'     => $validated['no_hp'],
            'email'        => $validated['email'],
            'password'     => Hash::make($validated['password']),
        ]);

        // ── 3. Cari student berdasarkan pendaftaran_id ────────────
        // PERBAIKAN: hapus dd() yang menghentikan eksekusi
        $student = Student::where('pendaftaran_id', $pendaftaran->id)->first();

        if (!$student) {
            // Rollback user & guardian yang sudah dibuat
            $user->delete();
            $guardian->delete();

            return back()->withErrors([
                'student' => 'Data santri tidak ditemukan untuk pendaftaran ini. Hubungi admin.',
            ]);
        }

        // ── 4. Simpan guardian_id ke pendaftaran & student ────────
        $pendaftaran->guardian_id = $guardian->id;
        $pendaftaran->save();

        // PERBAIKAN: guardian_id harus ada di $fillable Student
        // (lihat catatan di bawah), gunakan update() agar fillable dihormati
        $student->update(['guardian_id' => $guardian->id]);

        // ── 5. Bersihkan session ──────────────────────────────────
        session()->forget(['psb_kode', 'psb_id']);

        Auth::login($user);

        return redirect()->route('guardian.dashboard')->with('success', 'Akun wali berhasil dibuat! Selamat datang.');
    }

    // ─── Login wali ───────────────────────────────────────────────
    public function loginForm()
    {
        return view('auth.guardian.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('guardian.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // ─── Dashboard wali ───────────────────────────────────────────
    public function dashboard()
    {
        $user = Auth::user();

        // Load guardian beserta students → pendaftaran (untuk nama, tgl lahir, dll)
        // dan guardian (untuk tempat lahir, whatsapp, email wali)
        $guardian = Guardian::where('user_id', $user->id)
            ->with(['students.pendaftaran', 'students.schoolClass'])
            ->first();

        return view('guardians.index', compact('guardian'));
    }

    // ─── CRUD lainnya ─────────────────────────────────────────────
    public function index()
    {
        $guardians = Guardian::latest()->get();
        return view('guardians.index', compact('guardians'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guardian_name'     => 'required',
            'whatsapp'          => 'required',
            'password'          => 'required|min:8|confirmed',
            'registration_code' => 'required|string',
        ]);

        $student = Student::where('registration_code', $request->registration_code)->first();

        if (!$student) {
            return back()
                ->withErrors(['registration_code' => 'Kode registrasi tidak ditemukan.'])
                ->withInput();
        }

        Guardian::create([
            'guardian_name'      => $request->guardian_name,
            'whatsapp'           => $request->whatsapp,
            'email'              => $request->email,
            'password'           => Hash::make($request->password),
            'information_source' => $request->information_source,
        ]);

        return redirect()->route('guardians.index')->with('success', 'Data wali berhasil ditambahkan');
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}