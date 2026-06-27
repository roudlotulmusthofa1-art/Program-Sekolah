<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SchoolClass;
use App\Models\BidangIlmu;
use App\Models\WaktuPelajaran;
use App\Models\KategoriBerita;

class MasterDataController extends Controller
{
    // ═══════════════════════════════════════════════════════════════
    // INDEX — Halaman utama dengan tab aktif
    // ═══════════════════════════════════════════════════════════════

    public function index(Request $request)
    {
        $tab = $request->get('tab', 'kelas');

        return view('master-data.index', [
            'tab'           => $tab,
            'kelas'         => SchoolClass::withCount('students')->orderBy('order')->get(),
            'bidangIlmu'    => BidangIlmu::orderBy('urutan')->get(),
            'waktuPelajaran'=> WaktuPelajaran::orderBy('urutan')->get(),
            'kategoriBeritas'=> KategoriBerita::orderBy('urutan')->get(),
            'daftarKategori'=> SchoolClass::daftarKategori(),
        ]);
    }

    // ═══════════════════════════════════════════════════════════════
    // KELAS (SchoolClass)
    // ═══════════════════════════════════════════════════════════════

    public function storeKelas(Request $request)
    {
        $data = $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'kategori'   => 'required|string|max:50',
            'color'      => 'nullable|string|max:20',
        ]);

        $data['slug']      = Str::slug($data['nama_kelas']);
        $data['color']     = $data['color'] ?? '#3b82f6';
        $data['order']     = SchoolClass::max('order') + 1;
        $data['is_active'] = true;

        SchoolClass::create($data);

        return redirect()
            ->route('master-data.index', ['tab' => 'kelas'])
            ->with('success', "Kelas \"{$data['nama_kelas']}\" berhasil ditambahkan.");
    }

    public function updateKelas(Request $request, SchoolClass $kelas)
    {
        $data = $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'kategori'   => 'required|string|max:50',
            'color'      => 'nullable|string|max:20',
        ]);

        $data['slug'] = Str::slug($data['nama_kelas']);

        $kelas->update($data);

        return redirect()
            ->route('master-data.index', ['tab' => 'kelas'])
            ->with('success', "Kelas \"{$kelas->nama_kelas}\" berhasil diperbarui.");
    }

    public function destroyKelas(SchoolClass $kelas)
    {
        // Cek apakah ada santri di kelas ini
        if ($kelas->students()->count() > 0) {
            return redirect()
                ->route('master-data.index', ['tab' => 'kelas'])
                ->with('error', "Kelas \"{$kelas->nama_kelas}\" tidak bisa dihapus karena masih ada santri.");
        }

        $nama = $kelas->nama_kelas;
        $kelas->delete();

        return redirect()
            ->route('master-data.index', ['tab' => 'kelas'])
            ->with('success', "Kelas \"{$nama}\" berhasil dihapus.");
    }

    public function toggleKelas(SchoolClass $kelas)
    {
        $kelas->update(['is_active' => ! $kelas->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $kelas->is_active,
        ]);
    }

    /**
     * Drag-drop reorder — menerima array JSON [{id, order}, ...]
     */
    public function reorderKelas(Request $request)
    {
        $request->validate([
            'items'         => 'required|array',
            'items.*.id'    => 'required|integer|exists:school_classes,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            SchoolClass::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    // ═══════════════════════════════════════════════════════════════
    // BIDANG ILMU
    // ═══════════════════════════════════════════════════════════════

    public function storeBidangIlmu(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:100',
            'kode'      => 'nullable|string|max:20',
            'deskripsi' => 'nullable|string',
            'warna'     => 'nullable|string|max:20',
        ]);

        $data['slug']      = Str::slug($data['nama']);
        $data['urutan']    = BidangIlmu::max('urutan') + 1;
        $data['is_active'] = true;

        BidangIlmu::create($data);

        return redirect()
            ->route('master-data.index', ['tab' => 'bidang-ilmu'])
            ->with('success', "Bidang ilmu \"{$data['nama']}\" berhasil ditambahkan.");
    }

    public function updateBidangIlmu(Request $request, BidangIlmu $bidangIlmu)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:100',
            'kode'      => 'nullable|string|max:20',
            'deskripsi' => 'nullable|string',
            'warna'     => 'nullable|string|max:20',
        ]);

        $data['slug'] = Str::slug($data['nama']);
        $bidangIlmu->update($data);

        return redirect()
            ->route('master-data.index', ['tab' => 'bidang-ilmu'])
            ->with('success', "Bidang ilmu \"{$bidangIlmu->nama}\" berhasil diperbarui.");
    }

    public function destroyBidangIlmu(BidangIlmu $bidangIlmu)
    {
        $nama = $bidangIlmu->nama;
        $bidangIlmu->delete();

        return redirect()
            ->route('master-data.index', ['tab' => 'bidang-ilmu'])
            ->with('success', "Bidang ilmu \"{$nama}\" berhasil dihapus.");
    }

    public function toggleBidangIlmu(BidangIlmu $bidangIlmu)
    {
        $bidangIlmu->update(['is_active' => ! $bidangIlmu->is_active]);

        return response()->json(['success' => true, 'is_active' => $bidangIlmu->is_active]);
    }

    public function reorderBidangIlmu(Request $request)
    {
        $request->validate([
            'items'           => 'required|array',
            'items.*.id'      => 'required|integer|exists:bidang_ilmu,id',
            'items.*.urutan'  => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            BidangIlmu::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return response()->json(['success' => true]);
    }

    // ═══════════════════════════════════════════════════════════════
    // WAKTU PELAJARAN
    // ═══════════════════════════════════════════════════════════════

    public function storeWaktuPelajaran(Request $request)
    {
        $data = $request->validate([
            'nama'        => 'required|string|max:100',
            'kode'        => 'nullable|string|max:20',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $data['urutan']    = WaktuPelajaran::max('urutan') + 1;
        $data['is_active'] = true;

        WaktuPelajaran::create($data);

        return redirect()
            ->route('master-data.index', ['tab' => 'waktu-pelajaran'])
            ->with('success', "Waktu pelajaran \"{$data['nama']}\" berhasil ditambahkan.");
    }

    public function updateWaktuPelajaran(Request $request, WaktuPelajaran $waktuPelajaran)
    {
        $data = $request->validate([
            'nama'        => 'required|string|max:100',
            'kode'        => 'nullable|string|max:20',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $waktuPelajaran->update($data);

        return redirect()
            ->route('master-data.index', ['tab' => 'waktu-pelajaran'])
            ->with('success', "Waktu pelajaran \"{$waktuPelajaran->nama}\" berhasil diperbarui.");
    }

    public function destroyWaktuPelajaran(WaktuPelajaran $waktuPelajaran)
    {
        $nama = $waktuPelajaran->nama;
        $waktuPelajaran->delete();

        return redirect()
            ->route('master-data.index', ['tab' => 'waktu-pelajaran'])
            ->with('success', "Waktu pelajaran \"{$nama}\" berhasil dihapus.");
    }

    public function toggleWaktuPelajaran(WaktuPelajaran $waktuPelajaran)
    {
        $waktuPelajaran->update(['is_active' => ! $waktuPelajaran->is_active]);

        return response()->json(['success' => true, 'is_active' => $waktuPelajaran->is_active]);
    }

    public function reorderWaktuPelajaran(Request $request)
    {
        $request->validate([
            'items'          => 'required|array',
            'items.*.id'     => 'required|integer|exists:waktu_pelajaran,id',
            'items.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            WaktuPelajaran::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return response()->json(['success' => true]);
    }

    // ═══════════════════════════════════════════════════════════════
    // KATEGORI BERITA
    // ═══════════════════════════════════════════════════════════════

    public function storeKategoriBerita(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'warna'     => 'nullable|string|max:20',
        ]);

        $data['slug']      = Str::slug($data['nama']);
        $data['urutan']    = KategoriBerita::max('urutan') + 1;
        $data['is_active'] = true;

        KategoriBerita::create($data);

        return redirect()
            ->route('master-data.index', ['tab' => 'kategori-berita'])
            ->with('success', "Kategori berita \"{$data['nama']}\" berhasil ditambahkan.");
    }

    public function updateKategoriBerita(Request $request, KategoriBerita $kategoriBerita)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'warna'     => 'nullable|string|max:20',
        ]);

        $data['slug'] = Str::slug($data['nama']);
        $kategoriBerita->update($data);

        return redirect()
            ->route('master-data.index', ['tab' => 'kategori-berita'])
            ->with('success', "Kategori berita \"{$kategoriBerita->nama}\" berhasil diperbarui.");
    }

    public function destroyKategoriBerita(KategoriBerita $kategoriBerita)
    {
        $nama = $kategoriBerita->nama;
        $kategoriBerita->delete();

        return redirect()
            ->route('master-data.index', ['tab' => 'kategori-berita'])
            ->with('success', "Kategori berita \"{$nama}\" berhasil dihapus.");
    }

    public function toggleKategoriBerita(KategoriBerita $kategoriBerita)
    {
        $kategoriBerita->update(['is_active' => ! $kategoriBerita->is_active]);

        return response()->json(['success' => true, 'is_active' => $kategoriBerita->is_active]);
    }

    public function reorderKategoriBerita(Request $request)
    {
        $request->validate([
            'items'          => 'required|array',
            'items.*.id'     => 'required|integer|exists:kategori_berita,id',
            'items.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            KategoriBerita::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return response()->json(['success' => true]);
    }
}