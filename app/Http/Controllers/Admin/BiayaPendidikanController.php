<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BiayaPendidikanController extends Controller
{
    public function index()
    {
        // $biayaPendidikan = BiayaPendidikan::all();
        $biayaPendidikan = [
            [
                'id' => 1,
                'tahun_ajaran' => '2025/2026',
                'jenis_biaya' => 'SPP',
                'nominal' => 500000,
                'frekuensi_tagihan' => 'Bulanan',
            ],
            [
                'id' => 2,
                'tahun_ajaran' => '2025/2026',
                'jenis_biaya' => 'Seragam',
                'nominal' => 1000000,
                'frekuensi_tagihan' => 'Tahunan',
            ],
        ];
        $tahunAjaran = [
            [
                'id' => 1,
                'nama' => '2024/2025',
            ],
            [
                'id' => 2,
                'nama' => '2025/2026',
            ],
            [
                'id' => 3,
                'nama' => '2026/2027',
            ],
        ];
        $jenisBiaya = [
            [
                'id' => 1,
                'nama' => 'Spp Bulanan',
            ],
            [
                'id' => 2,
                'nama' => 'Pendaftaran',
            ],
            
        ];

        return view('admin.biaya-pendidikan.index', compact('biayaPendidikan', 'tahunAjaran', 'jenisBiaya'));
    }

    public function store(Request $request)
    {
        
    }
}
