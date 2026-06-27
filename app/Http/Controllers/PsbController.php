<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranSiswa;
use Illuminate\Http\Request;

class PsbController extends Controller
{
    // ─── Form publik pendaftaran santri ──────────────────────────
    public function formDaftar()
    {
        return view('psb.daftar');
    }

    // ─── Simpan pendaftaran dari form publik ──────────────────────
    public function simpanDaftar(Request $request)
    {
        $validated = $request->validate([
            'nama_santri'    => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date|before:today',
            'tempat_lahir'   => 'required|string|max:100',
            'jenis_kelamin'  => 'required|in:L,P',
            'asal_sekolah'   => 'nullable|string|max:150',
            'alamat'         => 'required|string|max:500',
            'nama_wali'      => 'required|string|max:100',
            'whatsapp'       => 'required|string|max:20',
            'email_wali'     => 'nullable|email|max:150',
            'program'        => 'required|in:Program Regular,Program Tahfidz',
        ]);

        $pendaftaran = PendaftaranSiswa::create(array_merge($validated, [
            'status'      => 'pending',
            'periode_psb' => 'PSB ' . now()->year,
        ]));

        return redirect()->route('psb.sukses', $pendaftaran->no_pendaftaran);
    }

    // ─── Halaman sukses pendaftaran ───────────────────────────────
    public function sukses($noPendaftaran)
    {
        $pendaftaran = PendaftaranSiswa::where('no_pendaftaran', $noPendaftaran)->firstOrFail();
        return view('psb.sukses', compact('pendaftaran'));
    }

    // ─── Cek status pendaftaran (publik) ─────────────────────────
    public function cekStatus(Request $request)
    {
        $pendaftaran = null;

        if ($request->filled('no_pendaftaran')) {
            $pendaftaran = PendaftaranSiswa::where('no_pendaftaran', $request->no_pendaftaran)
                ->orWhere('whatsapp', $request->no_pendaftaran)
                ->first();
        }

        return view('psb.cek-status', compact('pendaftaran'));
    }
}