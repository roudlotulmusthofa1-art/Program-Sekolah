<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSiswa;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class PendaftaranController extends Controller
{
    // ─── Index ────────────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = PendaftaranSiswa::with(['student', 'student.schoolClass'])
            ->when(!$request->boolean('arsip'), fn($q) => $q->active())
            ->when($request->boolean('arsip'),  fn($q) => $q->archived());

        // Filter status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Search — pakai field yang ada di migration: nama_lengkap, no_pendaftaran, no_telepon
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_lengkap',    'like', "%$s%")
                  ->orWhere('no_pendaftaran', 'like', "%$s%")
                  ->orWhere('no_telepon',     'like', "%$s%")
                  ->orWhere('father_name',    'like', "%$s%")
                  ->orWhere('mother_name',    'like', "%$s%");
            });
        }

        $pendaftarans = $query->latest()->paginate(15)->withQueryString();

        // Stats
        $stats = [
            'total'        => PendaftaranSiswa::active()->count(),
            'follow_up'    => PendaftaranSiswa::active()->status('follow_up')->count(),
            'dihubungi'    => PendaftaranSiswa::active()->status('dihubungi')->count(),
            'dalam_proses' => PendaftaranSiswa::active()->status('dalam_proses')->count(),
            'diterima'     => PendaftaranSiswa::active()->status('diterima')->count(),
            'ditolak'      => PendaftaranSiswa::active()->status('ditolak')->count(),
        ];

        $schoolClasses = SchoolClass::active()->get();

        return view('psb.pendaftaran.index', compact('pendaftarans', 'stats', 'schoolClasses'));
    }

    // ─── Show ─────────────────────────────────────────────────────
    public function show(PendaftaranSiswa $pendaftaran)
    {
        $pendaftaran->load(['student', 'student.schoolClass', 'guardian']);
        $schoolClasses = SchoolClass::active()->get();
        return view('psb.pendaftaran.show', compact('pendaftaran', 'schoolClasses'));
    }

    // ─── Update Status ────────────────────────────────────────────
    public function updateStatus(Request $request, PendaftaranSiswa $pendaftaran )
    {
    $request->validate([
        'status' => 'required|in:draft,review,diterima,ditolak'
    ]);

    // Update status pendaftaran
    $pendaftaran->update([
        'status' => $request->status
    ]);

    // Kalau diterima → buat student
    if ($request->status === 'diterima') {

        // Cek apakah sudah pernah dibuat
        $student = Student::where('pendaftaran_id', $pendaftaran->id)->first();

        if (!$student) {
            Student::create([
                'registration_code' => $pendaftaran->registration_code,
                'pendaftaran_id'    => $pendaftaran->id,
                'guardian_id'       => $pendaftaran->guardian_id ?? null,
                'nis'               => null,
                'name'              => $pendaftaran->nama_lengkap,
                'birth_place'       => $pendaftaran->tempat_lahir,
                'birth_date'        => $pendaftaran->tanggal_lahir,
                'gender'            => $pendaftaran->jenis_kelamin,
                'address'           => $pendaftaran->alamat,
                'phone'             => $pendaftaran->no_hp,
                'photo'             => $pendaftaran->photo,
                'entry_date'        => now(),
                'status'            => 'aktif',
                'has_fee_scheme'    => false,
            ]);
        }
    }

    return back()->with('success', 'Status berhasil diperbarui');
    }

    // ─── Terima → buat Student ────────────────────────────────────
    public function terima(Request $request, PendaftaranSiswa $pendaftaran)
    {
        $request->validate([
            'school_class_id' => 'nullable|exists:school_classes,id',
        ]);

        if ($pendaftaran->status === 'diterima') {
            return back()->with('error', 'Pendaftaran sudah diterima sebelumnya.');
        }

        DB::transaction(function () use ($request, $pendaftaran) {
            $pendaftaran->terima($request->school_class_id);
        });

        $kode = $pendaftaran->fresh()->kode_akses;

        return back()->with('success',
            "✅ {$pendaftaran->nama_lengkap} berhasil diterima! Kode akses wali: <strong>{$kode}</strong>"
        );
    }

    // ─── Tolak ────────────────────────────────────────────────────
    public function tolak(Request $request, PendaftaranSiswa $pendaftaran)
    {
        $request->validate(['catatan' => 'nullable|string|max:1000']);

        $pendaftaran->update([
            'status'        => 'ditolak',
            'catatan_admin' => $request->catatan,
        ]);

        return back()->with('success', "Pendaftaran {$pendaftaran->nama_lengkap} telah ditolak.");
    }

    // ─── Arsip ────────────────────────────────────────────────────
    public function archive(PendaftaranSiswa $pendaftaran)
    {
        $pendaftaran->update(['is_archived' => !$pendaftaran->is_archived]);
        $msg = $pendaftaran->fresh()->is_archived ? 'diarsipkan' : 'dipulihkan dari arsip';
        return back()->with('success', "Pendaftaran berhasil $msg.");
    }

    // ─── Hapus ────────────────────────────────────────────────────
    public function destroy(PendaftaranSiswa $pendaftaran)
    {
        $pendaftaran->delete();
        return redirect()->route('psb.pendaftaran.index')
            ->with('success', 'Data pendaftaran dihapus.');
    }

    // ─── Kirim Kode via WhatsApp ──────────────────────────────────
    public function kirimKode(PendaftaranSiswa $pendaftaran)
    {
        if (!$pendaftaran->kode_akses) {
            return back()->with('error', 'Kode akses belum ada. Pastikan status sudah Diterima.');
        }

        // Ambil nomor WA dari orang tua
        $wa = $pendaftaran->father_phone ?? $pendaftaran->mother_phone ?? $pendaftaran->no_telepon;
        $wa = preg_replace('/[^0-9]/', '', $wa);
        if (str_starts_with($wa, '0')) {
            $wa = '62' . substr($wa, 1);
        }

        $namaWali  = $pendaftaran->father_name ?? $pendaftaran->mother_name ?? 'Bapak/Ibu';
        $linkDaftar = route('guardian.register');

        $pesan = urlencode(
            "Assalamu'alaikum {$namaWali},\n\n" .
            "Putra/putri Anda *{$pendaftaran->nama_lengkap}* telah *DITERIMA* di Ribath Masjid Riyadh Solo.\n\n" .
            "Gunakan kode berikut untuk membuat akun wali:\n" .
            "🔑 *KODE AKSES: {$pendaftaran->kode_akses}*\n\n" .
            "Daftar di: {$linkDaftar}\n\n" .
            "Jazakumullahu khairan. 🌿"
        );

        return redirect("https://wa.me/{$wa}?text={$pesan}");
    }

    // PendaftaranController.php

   public function bulkTerima(Request $request)
{
    $ids = array_filter(explode(',', $request->input('ids', '')));

    if (empty($ids)) {
        return back()->with('error', 'Tidak ada data yang dipilih.');
    }

    $count = 0;
    foreach ($ids as $id) {
        $pendaftaran = PendaftaranSiswa::find($id);
        if ($pendaftaran && !in_array($pendaftaran->status, ['diterima', 'ditolak'])) {
            $pendaftaran->terima(); // ← panggil method terima() dari model
            $count++;
        }
    }

    return back()->with('success', $count . ' pendaftaran berhasil diterima dan kode akses telah dibuat.');
}

public function bulkTolak(Request $request)
{
    $ids = array_filter(explode(',', $request->input('ids', '')));

    if (empty($ids)) {
        return back()->with('error', 'Tidak ada data yang dipilih.');
    }

    $count = PendaftaranSiswa::whereIn('id', $ids)
        ->whereNotIn('status', ['diterima', 'ditolak'])
        ->update(['status' => 'ditolak']);

    return back()->with('success', $count . ' pendaftaran berhasil ditolak.');
}
public function bulkDestroy(Request $request)
{
    $ids = array_filter(explode(',', $request->input('ids', '')));

    if (empty($ids)) {
        return back()->with('error', 'Tidak ada data yang dipilih.');
    }

    $count = PendaftaranSiswa::whereIn('id', $ids)->count();
    PendaftaranSiswa::whereIn('id', $ids)->delete();

    return back()->with('success', $count . ' data pendaftaran berhasil dihapus.');
}
}