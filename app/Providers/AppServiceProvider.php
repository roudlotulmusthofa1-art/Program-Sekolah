<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view::share('navGroups',  [
        [
            'label' => 'MANAJEMEN DATA',
            'icon' => 'database',
            'route' => 'manajemen-data',
            'children' => [
                ['name' => 'Data Santri', 'route' => 'manajemen-data.santri', 'icon' => 'GraduationCap'],
                ['name' => 'Data Ustadz', 'route' => 'ustadz.index', 'icon' => 'UserCheck'],
                ['name' => 'Data Kelas', 'route' => 'manajemen-data.kelas', 'icon' => 'School'],
            ],
        ],
        [
            'label' => 'AKADEMIK',
            'icon' => 'book-open',
            'route' => 'akademik',
            'children' => [
                ['name' => 'Tahun Ajaran', 'route' => 'tahun-ajaran.index', 'icon' => 'Calendar'],
                ['name' => 'Kurikulum & Kitab', 'route' => 'kurikulum.index', 'icon' => 'book'],
                ['name' => 'Jadwal Mengajar', 'route' => 'coming-soon', 'icon' => 'calendar-clock'],
                ['name' => 'Biaya Pendidikan', 'route' => 'biaya-pendidikan.index', 'icon' => 'wallet'],
                ['name' => 'Input Nilai Bulanan', 'route' => 'coming-soon', 'icon' => 'clipboard-check'],
                ['name' => 'Rekap Absensi Bulanan', 'route' => 'coming-soon', 'icon' => 'clipboard-list'],
                ['name' => 'Tahfidz Bulanan', 'route' => 'coming-soon', 'icon' => 'BookOpen'],
            ],
        ],
        [
            'label' => 'KEUANGAN',
            'icon' => 'wallet',
            'route' => 'keuangan',
            'children' => [
                ['name' => 'Tagihan', 'route' => 'coming-soon', 'icon' => 'CreditCard'],
                ['name' => 'Pembayaran', 'route' => 'coming-soon', 'icon' => 'CreditCard'],
                ['name' => 'Tunggakan', 'route' => 'coming-soon', 'icon' => 'CreditCard'],
            ],
        ],
        [
            'label' => 'LAPORAN',
            'icon' => 'bar-chart-2',
            'route' => 'laporan',
            'children' => [
                ['name' => 'Akademik', 'route' => 'coming-soon', 'icon' => 'book-open'],
                ['name' => 'Keuangan', 'route' => 'coming-soon', 'icon' => 'bar-chart-2'],
                ['name' => 'Kehadiran', 'route' => 'coming-soon', 'icon' => 'calendar'],
            ],
        ],
        [
            'label' => 'PSB',
            'icon' => 'user-plus',
            'route' => 'psb',
            'children' => [
                ['name' => 'Pendaftaran Masuk', 'route' => 'psb.pendaftaran.index', 'icon' => 'clipboard-list'],
                ['name' => 'Priode Psb', 'route' => 'psb.seleksi', 'icon' => 'check-circle'],
            ],
        ],
        [
            'label' => 'LANDING PAGE',
            'icon' => 'monitor',
            'route' => 'landing-page',
            'children' => [
                ['name' => 'Berita', 'route' => 'landing-page.berita', 'icon' => 'file-text'],
                ['name' => 'FAQ', 'route' => 'landing-page.faq', 'icon' => 'help-circle'],
                ['name' => 'Galeri', 'route' => 'landing-page.galeri', 'icon' => 'image'],
                ['name' => 'Testimoni', 'route' => 'landing-page.testimoni', 'icon' => 'message-square'],
                ['name' => 'Prestasi', 'route' => 'landing-page.prestasi', 'icon' => 'trophy'],
            ],
        ],
        [
            'label' => 'SISTEM',
            'icon' => 'settings',
            'route' => 'sistem',
            'children' => [
                ['name' => 'Kelola Permission', 'route' => 'coming-soon', 'icon' => 'shield'],
                ['name' => 'User per Role', 'route' => 'coming-soon', 'icon' => 'user-round'],
                ['name' => 'Master Data', 'route' => 'master-data.index', 'icon' => 'database'],
                ['name' => 'pengaturan', 'route' => 'coming-soon', 'icon' => 'settings'],
            ],
        ],
    ]);
    }
}
