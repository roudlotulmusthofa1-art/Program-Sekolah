<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Event\ViewEvent;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');

Route::get('/berita', function () {
    return view('berita');
})->name('berita');

Route::get('/login', function () {
    return View('login');
});

use Illuminate\Http\Request;

Route::post('/login', function (Request $request) {
    // sementara (dummy)
    return 'Login diproses';
})->name('login');

use App\Http\Controllers\AuthController;

// halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// proses login
Route::post('/login', [AuthController::class, 'login']);

// ================= REGISTER =================

// halaman register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// proses register
Route::post('/register', [AuthController::class, 'register']);

// dashboard (setelah login)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })
//     ->middleware('auth')
//     ->name('dashboard');

// // logout
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// reset password
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

// Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

// Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

// Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

// Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// Middleware Role
Route::middleware(['role:super_admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Halaman Super Admin';
    });
});

// Route Dashboard
use App\Http\Controllers\DashboardController;

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });



// Formulir
use App\Http\Controllers\RegistrationController;

Route::get('/formulir', [RegistrationController::class, 'create']);
Route::post('/formulir', [RegistrationController::class, 'store']);

// VIEW INPUT USER
use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);

// VIEW INPUT GURU
use App\Http\Controllers\TeacherController;
Route::prefix('register')->group(function () {
    Route::resource('teachers', TeacherController::class);
});

// VIEW INPUT WALI MURID
use App\Http\Controllers\GuardianController;

Route::prefix('register')->group(function () {
    Route::resource('guardians', GuardianController::class);
});
// Route::get('/pendaftaran', [GuardianController::class, 'create'])->name('guardians.create');
// Route::post('/pendaftaran', [GuardianController::class, 'store'])->name('guardians.store');

// Route::get('/data-pendaftaran', [GuardianController::class, 'index'])->name('guardians.index');

// Route::get('/register', [GuardianController::class, 'create'])->name('guardians.create');
// Route::post('/register', [GuardianController::class, 'store'])->name('guardians.store');

// input kelas
use App\Http\Controllers\SchoolClassController;

// Route::resource('classes', SchoolClassController::class);

// pendaftaran siswa
use App\Http\Controllers\StudentController;

Route::prefix('pendaftaransiswa')->group(function () {
    Route::get('/step1', [StudentController::class, 'create'])->name('pendaftaransiswa.step1');
    Route::post('/step1', [StudentController::class, 'storeStep1'])->name('pendaftaransiswa.storeStep1');

    Route::get('/step2', [StudentController::class, 'step2'])->name('pendaftaransiswa.step2');
    Route::post('/step2', [StudentController::class, 'storeStep2'])->name('pendaftaransiswa.storeStep2');

    Route::get('/step3', [StudentController::class, 'step3'])->name('pendaftaransiswa.step3');
    Route::post('/step3', [StudentController::class, 'storeStep3'])->name('pendaftaransiswa.storeStep3');

    Route::get('/step4', [StudentController::class, 'step4'])->name('pendaftaransiswa.step4');
    Route::post('/step4', [StudentController::class, 'storeStep4'])->name('pendaftaransiswa.storeStep4');

    Route::get('/step5', [StudentController::class, 'step5'])->name('pendaftaransiswa.step5');
    Route::post('/step5', [StudentController::class, 'storeStep5'])->name('pendaftaransiswa.storeStep5');

    Route::get('/step6', [StudentController::class, 'step6'])->name('pendaftaransiswa.step6');
    Route::post('/step6', [StudentController::class, 'storeStep6'])->name('pendaftaransiswa.storeStep6');

    Route::get('/step7', [StudentController::class, 'step7'])->name('pendaftaransiswa.step7');
    Route::post('/step7', [StudentController::class, 'storeStep7'])->name('pendaftaransiswa.storeStep7');

    Route::get('/step8', [StudentController::class, 'step8'])->name('pendaftaransiswa.step8');
    Route::post('/step8', [StudentController::class, 'storeStep8'])->name('pendaftaransiswa.storeStep8');

    Route::get('/step9', [StudentController::class, 'step9'])->name('pendaftaransiswa.step9');
    Route::post('/step9', [StudentController::class, 'storeStep9'])->name('pendaftaransiswa.storeStep9');

    //  success page
    Route::get('/success', [StudentController::class, 'success'])->name('pendaftaransiswa.success');

    Route::get('/{id}', [StudentController::class, 'show'])->name('pendaftaransiswa.show');

    
});
// data pnerimaan siswa
Route::get('/students', [StudentController::class, 'index'])->name('students.index');

// detail pendaftaran siswa
Route::get('/students/{pendaftaranId}', [StudentController::class, 'show']);


// dashboard

use App\Http\Controllers\ManajemenDataController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PSBController;

/*
|--------------------------------------------------------------------------
| routes dashboard
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth'])->group(function () {

    // Dashboard Utama
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Manajemen Data
    Route::prefix('manajemen-data')->name('manajemen-data.')->group(function () {
        Route::get('/santri', [StudentController::class, 'index'])->name('santri');
        Route::get('/ustadz', [ManajemenDataController::class, 'ustadz'])->name('ustadz');
        Route::get('/kelas', [ManajemenDataController::class, 'kelas'])->name('kelas');
    });

    // Akademik
    Route::prefix('akademik')->name('akademik.')->group(function () {
        Route::get('/nilai', [AkademikController::class, 'nilai'])->name('nilai');
        Route::post('/nilai/input', [AkademikController::class, 'inputNilai'])->name('nilai.input');
        Route::get('/absensi', [AkademikController::class, 'absensi'])->name('absensi');
        Route::post('/absensi/rekap', [AkademikController::class, 'rekapAbsensi'])->name('absensi.rekap');
        Route::get('/tahfidz', [AkademikController::class, 'tahfidz'])->name('tahfidz');
        Route::post('/tahfidz/input', [AkademikController::class, 'inputTahfidz'])->name('tahfidz.input');
    });

    // Keuangan
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/tagihan', [KeuanganController::class, 'tagihan'])->name('tagihan');
        Route::get('/pembayaran', [KeuanganController::class, 'pembayaran'])->name('pembayaran');
        Route::get('/tunggakan', [KeuanganController::class, 'tunggakan'])->name('tunggakan');
    });

    // Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/akademik', [LaporanController::class, 'akademik'])->name('akademik');
        Route::get('/keuangan', [LaporanController::class, 'keuangan'])->name('keuangan');
        Route::get('/kehadiran', [LaporanController::class, 'kehadiran'])->name('kehadiran');
    });

    // PSB (Penerimaan Santri Baru)
    Route::prefix('psb')->name('psb.')->group(function () {
        Route::get('/', [PSBController::class, 'index'])->name('index');
        Route::get('/pendaftar', [PSBController::class, 'pendaftar'])->name('pendaftar');
        Route::get('/seleksi', [PSBController::class, 'seleksi'])->name('seleksi');
    });

    // Landing Page
     Route::prefix('landing.page')->name('landing-page.')->group(function () {
        Route::get('/berita', [LandingPageController::class, 'berita'])->name('berita');
        Route::get('/faq', [LandingPageController::class, 'faq'])->name('faq');
        Route::get('/galeri', [LandingPageController::class, 'galeri'])->name('galeri');
        Route::get('/testimoni', [LandingPageController::class, 'testimoni'])->name('testimoni');
        Route::get('/prestasi', [LandingPageController::class, 'prestasi'])->name('prestasi');
    });

    // Sistem
    Route::prefix('sistem')->name('sistem.')->group(function () {
        Route::get('/pengaturan', function () {
            return view('sistem.pengaturan');
        })->name('pengaturan');
        Route::get('/pengguna', function () {
            return view('sistem.pengguna');
        })->name('pengguna');
    });

// });

// Auth Routes (jika tidak menggunakan Laravel Breeze/Jetstream)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
// Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');



/*
|--------------------------------------------------------------------------
| Routes – Manajemen Data Santri
|--------------------------------------------------------------------------
| Tambahkan baris-baris ini ke dalam group middleware(['auth']) di web.php
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth'])->group(function () {

    // ── Tambahan (harus di atas resource) ────────────────────────────────
    Route::post('santri/quick-store',  [StudentController::class, 'quickStore'])->name('students.quickStore');
    Route::post('santri/bulk-destroy', [StudentController::class, 'bulkDestroy'])->name('students.bulkDestroy');

    // ── Resource → URL tetap /santri, route name pakai students.* ────────
    Route::resource('santri', StudentController::class)->names([
        'index'   => 'students.index',
        'create'  => 'students.create',
        'store'   => 'students.store',
        'show'    => 'students.show',
        'edit'    => 'students.edit',
        'update'  => 'students.update',
        'destroy' => 'students.destroy',
    ]);

// });
