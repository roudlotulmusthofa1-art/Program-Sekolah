<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         $user = auth()->user();

//         if ($user->hasRole('super_admin')) {
//             return view('dashboard.super_admin');
//         }

//         if ($user->hasRole('bendahara')) {
//             return view('dashboard.bendahara');
//         }

//         if ($user->hasRole('guru')) {
//             return view('dashboard.guru');
//         }

//         return view('dashboard.user');
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Santri;
// use App\Models\Ustadz;
// use App\Models\Tagihan;
// use App\Models\Kelas;
// use App\Models\Pembayaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard utama.
     */
    // public function index()
    // {
    //     // ── Statistik Utama ──────────────────────────────────────────────
    //     $totalSantri    = Santri::where('status', 'aktif')->count();
    //     $totalUstadz    = Ustadz::where('status', 'aktif')->count();

    //     $santriBaruBulanIni = Santri::whereMonth('created_at', Carbon::now()->month)
    //                                 ->whereYear('created_at', Carbon::now()->year)
    //                                 ->count();

    //     $tagihanPending = Tagihan::where('status', 'pending')->count();

    //     // ── Progress Akademik Per Kelas ──────────────────────────────────
    //     $kelasList = Kelas::withCount('santri')
    //                       ->with(['nilaiRataRata'])
    //                       ->orderBy('nama_kelas')
    //                       ->get()
    //                       ->map(function ($kelas) {
    //                           return [
    //                               'nama'         => $kelas->nama_kelas,
    //                               'jumlah_santri'=> $kelas->santri_count,
    //                               'progress'     => $kelas->progress_akademik ?? 0,
    //                           ];
    //                       });

    //     // ── Status Keuangan ──────────────────────────────────────────────
    //     $bulanIni = Carbon::now();

    //     $pembayaranBulanIni = Pembayaran::whereMonth('tanggal_bayar', $bulanIni->month)
    //                                     ->whereYear('tanggal_bayar', $bulanIni->year)
    //                                     ->sum('jumlah');

    //     $tunggakan = Tagihan::where('status', 'belum_bayar')
    //                         ->where('jatuh_tempo', '<', Carbon::now())
    //                         ->sum('jumlah');

    //     // ── Waktu Sholat (data statis / bisa diganti dengan API Aladhan) ─
    //     $waktuSholat = $this->getWaktuSholat();

    //     // ── Kalender ────────────────────────────────────────────────────
    //     $kalender = [
    //         'masehi'   => Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY'),
    //         'hijriyah' => $this->getHijriyah(),
    //     ];

    //     // ── Data untuk grafik (opsional) ─────────────────────────────────
    //     $chartData = $this->getChartData();

    //     return view('dashboard.index', compact(
    //         'totalSantri',
    //         'totalUstadz',
    //         'santriBaruBulanIni',
    //         'tagihanPending',
    //         'kelasList',
    //         'pembayaranBulanIni',
    //         'tunggakan',
    //         'waktuSholat',
    //         'kalender',
    //         'chartData'
    //     ));
    // }

    public function index()
    {
        $kalender = [
            'masehi' => Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY'),
            'hijriyah' => $this->getHijriyah(),
        ];

        $waktuSholat = [
            'subuh' => '04:21',
            'dzuhur' => '11:35',
            'ashar' => '14:56',
            'maghrib' => '17:26',
            'isya' => '18:41',
            'lokasi' => 'probolinggo, Indonesia',
            'tanggal' => Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') . ' | ' . $this->getHijriyah(),
        ];

        return view('dashboard.index', compact('kalender', 'waktuSholat'));
    }

    // ── Helper: Waktu Sholat ─────────────────────────────────────────────
    private function getWaktuSholat(): array
    {
        // Integrasi dengan Aladhan API atau database lokal.
        // Nilai di bawah adalah contoh statis; ganti dengan logika nyata.
        return [
            'subuh' => '04:21',
            'dzuhur' => '11:35',
            'ashar' => '14:56',
            'maghrib' => '17:26',
            'isya' => '18:41',
            'lokasi' => 'Surakarta, Indonesia',
            'tanggal' => Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY'),
        ];
    }

    // ── Helper: Konversi Hijriyah ────────────────────────────────────────
    private function getHijriyah(): string
    {
        // Gunakan package islamicnetwork/quran-php atau hitung manual.
        // Nilai di bawah adalah contoh statis.
        return '18 Dhu al-Hijjah 1447 AH';
    }

    // ── Helper: Data Chart Keuangan ──────────────────────────────────────
    private function getChartData(): array
    {
        $bulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $tgl = Carbon::now()->subMonths($i);
            $bulan[] = [
                'label' => $tgl->locale('id')->isoFormat('MMM'),
                'pemasukan' => Pembayaran::whereMonth('tanggal_bayar', $tgl->month)->whereYear('tanggal_bayar', $tgl->year)->sum('jumlah'),
            ];
        }
        return $bulan;
    }
}
