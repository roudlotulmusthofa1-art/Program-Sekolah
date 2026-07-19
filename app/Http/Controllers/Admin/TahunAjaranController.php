<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjarans = TahunAjaran::orderByDesc('tanggal_mulai')->get();

        return view('admin.tahun-ajaran.index', compact('tahunAjarans'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($validated['is_aktif'] ?? false) {
            TahunAjaran::query()->update(['is_aktif' => false]);
        }

        TahunAjaran::create($validated);

        return back()->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $validated = $this->validated($request, $tahunAjaran->id);

        if ($validated['is_aktif'] ?? false) {
            TahunAjaran::query()->where('id', '!=', $tahunAjaran->id)->update(['is_aktif' => false]);
        }

        $tahunAjaran->update($validated);

        return back()->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        $tahunAjaran->delete();

        return back()->with('success', 'Tahun ajaran berhasil dihapus.');
    }

    // Tombol Aktif / Nonaktif di setiap card
    public function toggleStatus(TahunAjaran $tahunAjaran)
    {
        if ($tahunAjaran->is_aktif) {
            $tahunAjaran->update(['is_aktif' => false]);

            return back()->with('success', 'Tahun ajaran dinonaktifkan.');
        }

        TahunAjaran::query()->update(['is_aktif' => false]);
        $tahunAjaran->update(['is_aktif' => true]);

        return back()->with('success', 'Tahun ajaran diaktifkan sebagai tahun ajaran utama.');
    }

    private function validated(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'nama' => 'required|string|max:20',
            'semester' => 'required|in:ganjil,genap',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_aktif' => 'nullable|boolean',
        ]);
    }
}