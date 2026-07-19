<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Guardian;
use App\Models\PendaftaranSiswa;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Semua kelas untuk dropdown filter
        $classes = SchoolClass::active()
            ->withCount(['students as total_aktif' => fn($q) => $q->where('status', 'aktif')])
            ->orderBy('nama_kelas')
            ->get();

        // Hitung siswa yang belum punya skema biaya
        $studentsWithoutFee = Student::aktif()->where('has_fee_scheme', false)->count();

        // Kelas yang dipilih via URL ?class=tamhidi
        $selectedClass = null;
        if ($request->filled('class')) {
            $selectedClass = SchoolClass::where('slug', $request->class)->first();
        }

        // Query utama
        $query = Student::with(['schoolClass', 'guardian', 'pendaftaran']);

        // Filter kelas
        if ($selectedClass) {
            $query->where('school_class_id', $selectedClass->id);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter tanggal masuk
        if ($request->filled('date_from')) {
            $query->whereDate('entry_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('entry_date', '<=', $request->date_to);
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $students = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('students.index', compact('classes', 'studentsWithoutFee', 'selectedClass', 'students'));
    }

    // controler detail pendaftaran siswa
    public function show($pendaftaranId)
    {
        $student = Student::with('pendaftaran')->where('pendaftaran_id', $pendaftaranId)->firstOrFail();

        return view('students.show', compact('student'));
    }

    // ── Store: Simpan siswa baru ───────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'nis' => 'nullable|string|unique:students,nis',
            'name' => 'required|string|max:255',
            'birth_place' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:L,P',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
            'entry_date' => 'nullable|date',
            'status' => 'required|in:aktif,lulus,pindah,keluar/alumni',
            'guardian_id' => 'nullable|exists:guardians,id',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos/students', 'public');
        }

        $student = Student::create($validated);

        return redirect()
            ->route('students.index', ['class' => $student->schoolClass->slug])
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // ── Quick Store: Tambah cepat via modal ───────────────────────────────
    public function quickStore(Request $request)
    {
        $validated = $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'entry_date' => 'nullable|date',
        ]);

        $validated['status'] = 'aktif';
        $validated['entry_date'] = $validated['entry_date'] ?? now()->toDateString();

        $student = Student::create($validated);
        $schoolClass = SchoolClass::find($validated['school_class_id']);

        return redirect()
            ->route('students.index', ['class' => $schoolClass->slug])
            ->with('success', 'Data siswa berhasil ditambahkan (mode cepat).');
    }

    // ── Edit: Form edit siswa ─────────────────────────────────────────────
    public function edit(Student $student)
    {
        $classes = SchoolClass::active()->get();
        $guardians = Guardian::orderBy('name')->get();
        return view('students.edit', compact('student', 'classes', 'guardians'));
    }

    // ── Update: Simpan perubahan data siswa ───────────────────────────────
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'nis' => 'nullable|string|unique:students,nis,' . $student->id,
            'name' => 'required|string|max:255',
            'birth_place' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:L,P',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
            'entry_date' => 'nullable|date',
            'status' => 'required|in:aktif,lulus,pindah,keluar/alumni',
            'guardian_id' => 'nullable|exists:guardians,id',
        ]);

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($student->photo);
            $validated['photo'] = $request->file('photo')->store('photos/students', 'public');
        }

        $student->update($validated);

        return redirect()->route('students.show', $student)->with('success', 'Data siswa berhasil diperbarui.');
    }

    // ── Destroy: Hapus satu siswa (soft delete) ───────────────────────────
    public function destroy(Student $student)
    {
        $slug = $student->schoolClass?->slug;
        $student->delete();

        return redirect()
            ->route('students.index', ['class' => $slug])
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    // ── Bulk Destroy: Hapus banyak siswa sekaligus ────────────────────────
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:students,id',
        ]);

        Student::whereIn('id', $request->ids)->delete();

        return back()->with('success', count($request->ids) . ' data siswa berhasil dihapus.');
    }

    // public function updateStatus(Request $request, PendaftaranSiswa $pendaftaran)
    // {
    //     $pendaftaran->update([
    //         'status' => $request->status,
    //     ]);

        
    //     if ($request->status === 'diterima') {
    //         Student::create([
    //             'registration_code' => $pendaftaran->kode_akses,
    //             'pendaftaran_id' => $pendaftaran->id,
    //             'guardian_id' => $pendaftaran->guardian_id,
    //             'name' => $pendaftaran->nama_lengkap,
    //             'birth_place' => $pendaftaran->tempat_lahir,
    //             'birth_date' => $pendaftaran->tanggal_lahir,
    //             'gender' => $pendaftaran->jenis_kelamin,
    //             'address' => $pendaftaran->alamat,
    //             'phone' => $pendaftaran->no_hp,
    //             'photo' => $pendaftaran->photo,
    //             'entry_date' => now(),
    //             'status' => 'aktif',
    //             'has_fee_scheme' => false,
    //         ]);
    //     }

    //     return back();
    // }
}
