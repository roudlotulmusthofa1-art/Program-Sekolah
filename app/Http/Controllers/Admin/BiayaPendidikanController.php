<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BiayaPendidikan;
use App\Models\JenisBiaya;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BiayaPendidikanController extends Controller
{
    public function index(Request $request)
    {
                        // untuk filter
        $query = BiayaPendidikan::with(['tahunAjaran', 'jenisBiaya']);

        if ($request->filled('tahun_ajaran_id')) {
            $query->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        }

        if ($request->filled('jenis_biaya_id')) {
            $query->where('jenis_biaya_id', $request->jenis_biaya_id);
        }

        $biayaPendidikan = $query->latest()->paginate(10)->withQueryString();

        $tahunAjaran = TahunAjaran::orderByDesc('id')->get();
        $jenisBiaya = JenisBiaya::aktif()->orderBy('nama')->get();

        return view('admin.biaya-pendidikan.index', compact(
            'biayaPendidikan',
            'tahunAjaran',
            'jenisBiaya'
        ));
    }

    // menambah data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_ajaran_id' => [
                'required',
                'exists:tahun_ajarans,id',
                Rule::unique('biaya_pendidikans')->where(
                    fn($q) => $q->where('jenis_biaya_id', $request->jenis_biaya_id)
                ),
            ],
            'jenis_biaya_id' => [
                'required', 
                'exists:jenis_biayas,id'
                ],
            'nominal' => [
                'required', 
                'numeric', 
                'min:0'
                ],
            'frekuensi' => [
                'required', 
                Rule::in([
                    'sekali',
                    'harian',
                    'mingguan',
                    'bulanan',
                    'semester',
                    'tahunan'
                    ])],
        ],
        $this->pesanValidasi(), 
        $this->namafield()
        );

        BiayaPendidikan::create($validated);

        return redirect()
            ->route('biaya-pendidikan.index')
            ->with('success', 'Biaya pendidikan berhasil ditambahkan.');
    }

    // update data baru
    public function update(Request $request, BiayaPendidikan $biayaPendidikan)
    {
        $validated = $request->validate([
            'tahun_ajaran_id' => [
                'required',
                'exists:tahun_ajarans,id',
                Rule::unique('biaya_pendidikans')
                    ->where(fn($q) => $q->where('jenis_biaya_id', $request->jenis_biaya_id))
                    ->ignore($biayaPendidikan->id),
            ],
            'jenis_biaya_id' => [
                'required', 
                'exists:jenis_biayas,id'],
            'nominal' => ['required', 
            'numeric', 
            'min:0'],
            'frekuensi' => ['required', 
            Rule::in([
                    'sekali',
                    'harian',
                    'mingguan',
                    'bulanan',
                    'semester',
                    'tahunan'
            ])],
        ],
            $this->pesanValidasi(),
            $this->namafield()
            );

        $biayaPendidikan->update($validated);

        return redirect()
            ->route('biaya-pendidikan.index')
            ->with('success', 'Biaya pendidikan berhasil diperbarui.');
    }


    public function destroy(BiayaPendidikan $biayaPendidikan)
    {
        $biayaPendidikan->delete();

        return redirect()
            ->route('biaya-pendidikan.index')
            ->with('success', 'Biaya pendidikan berhasil dihapus.');
    }

    private function pesanValidasi(): array
    {
    return [

    ];
    }

    private function namaField(): array
    {
   return [

   ];
    }
}
