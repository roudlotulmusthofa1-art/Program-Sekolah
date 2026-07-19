<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BidangIlmu;
use App\Models\Kitab;
use App\Models\SchoolClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminKitabController extends Controller
{
    public function index(Request $request): View
    {
        $bidangIlmus = BidangIlmu::active()->withCount('kitabs')->get();

        $kitabsQuery = Kitab::query()
            ->with(['bidangIlmu', 'schoolClasses'])
            ->active();

        if ($request->filled('bidang_ilmu_id')) {
            $kitabsQuery->bidang($request->bidang_ilmu_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $kitabsQuery->where(function ($q) use ($search) {
                $q->where('nama_kitab', 'like', "%{$search}%")->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Dikelompokkan per bidang ilmu, urut sesuai urutan bidang ilmu
        $kitabs = $kitabsQuery->get()->groupBy(fn(Kitab $kitab) => $kitab->bidangIlmu->nama ?? 'Lainnya');

        $totalKitab = Kitab::active()->count();

        $totalJamPerMinggu = (int) DB::table('kitab_school_class')->sum('frekuensi_per_minggu');

        // Kartu statistik kelas dibentuk otomatis dari data school_classes
        // yang sesungguhnya (bukan nama yang di-hardcode), jadi kalau nama
        // atau jumlah kelasnya berubah di database, kartu ikut menyesuaikan.
        $kelasStatGroups = $this->buildKelasStatGroups();

        $bidangIlmuOptions = BidangIlmu::active()->get();
        $schoolClasses = SchoolClass::active()->get();

        return view('admin.kurikulum.index', compact('bidangIlmus', 'kitabs', 'totalKitab', 'totalJamPerMinggu', 'kelasStatGroups', 'bidangIlmuOptions', 'schoolClasses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        // Kalau kitab dengan nama & bidang ilmu yang sama sudah ada, pakai
        // baris yang sudah ada itu — supaya menambahkan kelas/semester baru
        // untuk kitab yang sama tidak membuat kartu duplikat di dashboard.
        $kitab = Kitab::firstOrNew([
            'nama_kitab' => $validated['nama_kitab'],
            'bidang_ilmu_id' => $validated['bidang_ilmu_id'],
        ]);
        $kitab->deskripsi = $validated['deskripsi'] ?? $kitab->deskripsi;
        $kitab->save();

        $this->attachOrUpdatePivot($kitab, $validated);

        return redirect()
            ->route('kurikulum.index')
            ->with('success', "Kitab \"{$kitab->nama_kitab}\" berhasil ditambahkan.");
    }

    public function update(Request $request, Kitab $kitab): RedirectResponse
    {
        $validated = $this->validatedData($request);

        $kitab->update([
            'nama_kitab' => $validated['nama_kitab'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'bidang_ilmu_id' => $validated['bidang_ilmu_id'],
        ]);

        // Hanya lepas pivot untuk semester yang sedang diedit, supaya
        // penempatan kitab ini di semester lain tidak ikut terhapus.
        $kitab->schoolClasses()->wherePivotIn('semester', $validated['semesters'])->detach();

        $this->attachOrUpdatePivot($kitab, $validated);

        return redirect()
            ->route('kurikulum.index')
            ->with('success', "Kitab \"{$kitab->nama_kitab}\" berhasil diperbarui.");
    }

    public function destroy(Kitab $kitab): RedirectResponse
    {
        $nama = $kitab->nama_kitab;

        $kitab->schoolClasses()->detach();
        $kitab->delete();

        return back()->with('success', "Kitab \"{$nama}\" berhasil dihapus.");
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama_kitab' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'bidang_ilmu_id' => 'required|exists:bidang_ilmu,id',
            'kelas_ids' => 'required|array|min:1',
            'kelas_ids.*' => 'exists:school_classes,id',
            'semesters' => 'required|array|min:1',
            'semesters.*' => 'in:1,2',
            'frekuensi_per_minggu' => 'nullable|integer|min:1|max:20',
        ]);
    }

    /**
     * Simpan penempatan kitab ke tiap kelas terpilih. Pakai updateOrInsert
     * (bukan attach polos) supaya kalau kombinasi kitab+kelas+semester yang
     * sama sudah ada, frekuensinya di-update saja — tidak bikin baris pivot
     * duplikat atau bentrok dengan unique constraint di database.
     */
    private function attachOrUpdatePivot(Kitab $kitab, array $validated): void
    {
        $frekuensi = $validated['frekuensi_per_minggu'] ?? 1;

        foreach ($validated['kelas_ids'] as $kelasId) {
            foreach ($validated['semesters'] as $semester) {
                DB::table('kitab_school_class')->updateOrInsert(
                    [
                        'kitab_id' => $kitab->id,
                        'school_class_id' => $kelasId,
                        'semester' => $semester,
                    ],
                    [
                        'frekuensi_per_minggu' => $frekuensi,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ],
                );
            }
        }
    }

    /**
     * Kelompokkan school_classes berdasarkan nama dasarnya (angka di
     * belakang dibuang), lalu hitung berapa banyak penempatan kitab
     * (baris kitab_school_class) untuk tiap kelompok. Semua data di sini
     * datang langsung dari relasi Kitab <-> SchoolClass, tidak ada nama
     * kelas yang di-hardcode.
     *
     * Contoh: "Ibtida 1" & "Ibtida 2" -> dikelompokkan jadi "Ibtida".
     */
    private function buildKelasStatGroups()
    {
        $classes = SchoolClass::active()->get();

        return $classes
            ->groupBy(fn(SchoolClass $kelas) => $this->kelasBaseName($kelas->nama_kelas))
            ->map(function ($group, $baseName) {
                $classIds = $group->pluck('id');

                $jumlahPenempatan = DB::table('kitab_school_class')->whereIn('school_class_id', $classIds)->count();

                $jumlahKitab = DB::table('kitab_school_class')->whereIn('school_class_id', $classIds)->distinct('kitab_id')->count('kitab_id');

                return [
                    'label' => $baseName,
                    'jumlah_kelas' => $group->count(),
                    'jumlah_penempatan' => $jumlahPenempatan,
                    'jumlah_kitab' => $jumlahKitab,
                ];
            })
            ->values();
    }

    private function kelasBaseName(string $namaKelas): string
    {
        // "Ibtida 1" -> "Ibtida", "Tsanawiyah 2" -> "Tsanawiyah", "Tamhidi" -> "Tamhidi"
        return trim(preg_replace('/\s*\d+$/', '', $namaKelas));
    }
}
