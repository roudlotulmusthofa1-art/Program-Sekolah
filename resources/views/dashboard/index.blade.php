@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .action-card {
            transition: all 0.2s ease;
        }

        .action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            transition: width 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.5s ease forwards;
        }

        .fade-in-1 {
            animation-delay: 0.05s;
            opacity: 0;
        }

        .fade-in-2 {
            animation-delay: 0.10s;
            opacity: 0;
        }

        .fade-in-3 {
            animation-delay: 0.15s;
            opacity: 0;
        }

        .fade-in-4 {
            animation-delay: 0.20s;
            opacity: 0;
        }

        .fade-in-5 {
            animation-delay: 0.25s;
            opacity: 0;
        }

        .fade-in-6 {
            animation-delay: 0.30s;
            opacity: 0;
        }
    </style>
@endpush

@section('content')
    <div class="mx-4 md:mx-10 lg:mx-20 xl:mx-60">
        {{-- ── Greeting Banner ─────────────────────────────────────────────── --}}
        <div class="relative rounded-2xl overflow-hidden   mb-8 mt-4 h-40  "
            style="background: linear-gradient(135deg, #1a6b5a 0%, #134d40 60%, #0d3529 100%);">
            <div class="px-8 py-6">
                <h1 class="text-2xl font-bold text-white mb-1">
                    Assalamu'alaikum, {{ auth()->user()->name ?? 'Abdul Kadir Habsyi' }}
                </h1>
                <p class="text-white/70 text-sm mt-2">Dashboard Super Admin - Ribath Masjid Riyadh</p>
            </div>
            {{-- Dekoratif Arabic --}}
            <div class="absolute right-8 bottom-4 text-white text-2xl font-arabic select-none" dir="rtl">
                بسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ
            </div>
            {{-- Blob dekoratif --}}
            <div class="absolute -top-6 -right-6 w-36 h-36 bg-white/5 rounded-full"></div>
            <div class="absolute top-2 right-16 w-16 h-16 bg-white/5 rounded-full"></div>
        </div>

        {{-- ── Statistik Utama ─────────────────────────────────────────────── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6 ">

            {{-- Total Santri --}}
            <div class="stat-card bg-blue-50 rounded-xl p-5 border border-gray-100  ">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="users" class="w-5 h-5 text-blue-500"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($totalSantri) }}</p>
                <p class="text-sm font-medium text-gray-600 mt-0.5">Total Santri</p>
                <p class="text-xs text-gray-400 mt-1">Santri Aktif</p>
            </div>

            {{-- Total Ustadz --}}
            <div class="stat-card bg-amber-50 rounded-xl p-5 border border-gray-100  ">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="user-check" class="w-5 h-5 text-amber-500"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($totalUstadz) }}</p>
                <p class="text-sm font-medium text-gray-600 mt-0.5">Total Ustadz</p>
                <p class="text-xs text-gray-400 mt-1">Pengajar</p>
            </div>

            {{-- Santri Baru --}}
            <div class="stat-card bg-teal-50 rounded-xl p-5 border border-gray-100  ">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 bg-teal-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="user-plus" class="w-5 h-5 text-teal-500"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($santriBaruBulanIni) }}</p>
                <p class="text-sm font-medium text-gray-600 mt-0.5">Santri Baru</p>
                <p class="text-xs text-gray-400 mt-1">Bulan Ini</p>
            </div>

            {{-- Tagihan Pending --}}
            <div class="stat-card bg-orange-50 rounded-xl p-5 border border-gray-100 ">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-orange-500"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($tagihanPending) }}</p>
                <p class="text-sm font-medium text-gray-600 mt-0.5">Tagihan Pending</p>
                <p class="text-xs text-gray-400 mt-1">Perlu Review</p>
            </div>
        </div>

        {{-- ── Input Bulanan ───────────────────────────────────────────────── --}}
        <div class="mb-6  bg-white rounded-xl border border-gray-200 p-5  ">
            <h2 class="text-base font-bold text-gray-700 mb-3">Input Bulanan</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Input Nilai --}}
                <a href="{{ route('akademik.nilai') }}"
                    class="action-card bg-emerald-50 rounded-xl p-5 border border-green-300 flex flex-col items-center gap-2 group">
                    <div
                        class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center group-hover:bg-teal-100 transition-colors">
                        <i data-lucide="trending-up" class="w-6 h-6 text-teal-600"></i>
                    </div>
                    <span class="text-sm font-semibold text-teal-600">Input Nilai</span>
                </a>

                {{-- Rekap Absensi --}}
                <a href="{{ route('akademik.absensi') }}"
                    class="action-card bg-blue-50 rounded-xl p-5 border-2 border-blue-300 flex flex-col items-center gap-2 group">
                    <div
                        class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-teal-100 transition-colors">
                        <i data-lucide="clipboard-list" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <span class="text-sm font-semibold text-blue-600">Rekap Absensi</span>
                </a>

                {{-- Input Tahfidz --}}
                <a href="{{ route('akademik.tahfidz') }}"
                    class="action-card bg-amber-50 rounded-xl p-5 border border-amber-300 flex flex-col items-center gap-2 group">
                    <div
                        class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                        <i data-lucide="sparkles" class="w-6 h-6 text-amber-600"></i>
                    </div>
                    <span class="text-sm font-semibold text-amber-600">Input Tahfidz</span>
                </a>

                {{-- Tagihan --}}
                <a href="{{ route('keuangan.tagihan') }}"
                    class="action-card bg-cyan-50 rounded-xl p-5 border border-cyan-300 flex flex-col items-center gap-2 group">
                    <div
                        class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center group-hover:bg-green-100 transition-colors">
                        <i data-lucide="dollar-sign" class="w-6 h-6 text-cyan-600"></i>
                    </div>
                    <span class="text-sm font-semibold text-cyan-600">Tagihan</span>
                </a>
            </div>
        </div>

        {{-- ── Row: Waktu Sholat + Kalender ───────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

            {{-- Waktu Sholat --}}
            <div class="bg-emerald-50 rounded-xl border border-green-300 p-5  h-56">
                <div class="flex items-center justify-between mb-1">
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-ribath-primary"></i>
                        <h3 class="font-bold text-gray-800">Waktu Sholat</h3>
                    </div>
                    <div class="flex items-center gap-1 text-xs text-gray-500">
                        <i data-lucide="map-pin" class="w-3 h-3"></i>
                        {{ $waktuSholat['lokasi'] }}
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-4">{{ $waktuSholat['tanggal'] }}</p>

                <div class="grid grid-cols-5 gap-2">
                    @foreach ([['label' => 'Subuh', 'time' => $waktuSholat['subuh'], 'active' => false], ['label' => 'Dzuhur', 'time' => $waktuSholat['dzuhur'], 'active' => false], ['label' => 'Ashar', 'time' => $waktuSholat['ashar'], 'active' => true], ['label' => 'Maghrib', 'time' => $waktuSholat['maghrib'], 'active' => false], ['label' => 'Isya', 'time' => $waktuSholat['isya'], 'active' => false]] as $sholat)
                        <div class="text-center py-2 rounded-lg bg-green-100">
                            <p class="text-xs text-gray-500 mb-1">{{ $sholat['label'] }}</p>
                            <p class="font-bold text-gray-800">
                                {{ $sholat['time'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Kalender --}}
            <div class="bg-white rounded-xl border border-gray-300 p-5  ">
                <h3 class="font-bold text-gray-800 mb-4">Kalender</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Masehi</p>
                        <p class="font-semibold text-gray-800">{{ $kalender['masehi'] }}</p>
                    </div>
                    <div class="border-t border-gray-100 pt-3">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Hijriyah</p>
                        <p class="font-semibold text-gray-800">{{ $kalender['hijriyah'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Row: Progress Akademik + Status Keuangan ───────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

            {{-- Progress Akademik Per Kelas --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 ">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800">Progress Akademik Per Kelas</h3>
                    <i data-lucide="trending-up" class="w-5 h-5 text-ribath-primary"></i>
                </div>

                <div class="space-y-3">
                    @forelse($kelasList as $kelas)
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm text-gray-700">{{ $kelas['nama'] }} ({{ $kelas['jumlah_santri'] }}
                                    santri)</span>
                                <span class="text-xs font-semibold text-ribath-primary">{{ $kelas['progress'] }}%</span>
                            </div>
                            <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="progress-bar h-full bg-ribath-primary rounded-full"
                                    style="width: {{ $kelas['progress'] }}%"></div>
                            </div>
                        </div>
                    @empty
                        @foreach (['Kelas 1 (0 santri)', 'Kelas 2 (0 santri)', 'Kelas 3 (0 santri)', 'Kelas 4 (0 santri)'] as $k)
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm text-gray-500">{{ $k }}</span>
                                    <span class="text-xs text-gray-400">-</span>
                                </div>
                                <div class="h-1.5 bg-gray-100 rounded-full"></div>
                            </div>
                        @endforeach
                    @endforelse
                </div>
            </div>

            {{-- Status Keuangan --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 ">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800">Status Keuangan</h3>
                    <i data-lucide="bar-chart-2" class="w-5 h-5 text-ribath-primary"></i>
                </div>

                <div class="space-y-3">
                    <div
                        class="flex items-center justify-between py-3 border-b border-gray-50 bg-amber-50 rounded-lg px-4">
                        <span class="text-sm text-gray-700">Pembayaran Bulan Ini</span>
                        <span class="font-bold text-green-600">
                            Rp {{ number_format($pembayaranBulanIni, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b border-gray-50 bg-teal-50 rounded-lg px-4">
                        <span class="text-sm text-gray-700">Tunggakan</span>
                        <span class="font-bold {{ $tunggakan > 0 ? 'text-red-500' : 'text-green-600' }}">
                            Rp {{ number_format($tunggakan, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between py-3 bg-blue-50 rounded-lg px-4">
                        <span class="text-sm text-gray-700">Tagihan Pending</span>
                        <span class="font-bold text-amber-500">{{ $tagihanPending }}</span>
                    </div>
                </div>

                <a href="{{ route('laporan.keuangan') }}"
                    class="mt-4 flex items-center justify-center gap-2 text-sm text-ribath-primary font-semibold hover:underline">
                    Lihat Laporan Lengkap
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

        <div class="mt-6 mx-auto space-y-6">

            <!-- Aktivitas Terbaru -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-slate-800">Aktivitas Terbaru</h2>
                    <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors"
                        aria-label="Muat ulang aktivitas">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                            <path d="M3 3v5h5" />
                            <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                            <path d="M16 16h5v5" />
                        </svg>
                    </button>
                </div>

                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <svg class="w-12 h-12 text-slate-300 mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 2v4" />
                        <path d="M16 2v4" />
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M3 10h18" />
                    </svg>
                    <p class="text-slate-400 text-sm">Belum ada aktivitas terbaru</p>
                </div>
            </div>

            <!-- Menu Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- Data Santri -->
                <button type="button"
                    class="bg-teal-100 border border-teal-300 rounded-2xl p-3 h-28 flex flex-col items-center gap-3 hover:shadow-md transition-shadow">
                    <div class="bg-white rounded-xl p-3 shadow-sm">
                        <svg class="w-5 h-5 text-teal-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <span class="font-semibold text-sm text-teal-700">Data Santri</span>
                </button>

                <!-- Data Ustadz -->
                <button type="button"
                    class="bg-amber-50 border border-amber-300 rounded-2xl p-3 h-28 flex flex-col items-center gap-3 hover:shadow-md transition-shadow">
                    <div class="bg-white rounded-xl p-3 shadow-sm">
                        <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <polyline points="16 11 18 13 22 9" />
                        </svg>
                    </div>
                    <span class="font-semibold text-sm text-amber-700">Data Ustadz</span>
                </button>

                <!-- Jadwal -->
                <button type="button"
                    class="bg-blue-100 border border-blue-300 rounded-2xl p-3 h-28 flex flex-col items-center gap-3 hover:shadow-md transition-shadow">
                    <div class="bg-white rounded-xl p-3 shadow-sm">
                        <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 2v4" />
                            <path d="M16 2v4" />
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M3 10h18" />
                        </svg>
                    </div>
                    <span class="font-semibold text-sm text-blue-700">Jadwal</span>
                </button>

                <!-- Laporan -->
                <button type="button"
                    class="bg-emerald-50 border border-emerald-300 rounded-2xl p-3 h-28 flex flex-col items-center gap-3 hover:shadow-md transition-shadow">
                    <div class="bg-white rounded-xl p-3 shadow-sm">
                        <svg class="w-5 h-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                            <path d="M14 2v6h6" />
                            <path d="M16 13H8" />
                            <path d="M16 17H8" />
                            <path d="M10 9H8" />
                        </svg>
                    </div>
                    <span class="font-semibold text-sm text-emerald-700">Laporan</span>
                </button>

            </div>

            <!-- Kelola Akun -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-slate-800">Kelola Akun</h2>
                    <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors"
                        aria-label="Bantuan">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 7v14" />
                            <path
                                d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Buat Akun Wali Santri -->
                    <button type="button"
                        class="flex items-start gap-4 border border-slate-200 rounded-xl p-4 text-left hover:bg-teal-50 hover:border-teal-300 transition-colors">
                        <div class="bg-teal-50 rounded-lg p-2 mt-0.5">
                            <svg class="w-5 h-5 text-teal-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
                                <circle cx="8" cy="7" r="4" />
                                <path d="M19 8v6" />
                                <path d="M22 11h-6" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Buat Akun Wali Santri</p>
                            <p class="text-sm text-slate-500 mt-0.5">Buat akun baru untuk wali santri</p>
                        </div>
                    </button>

                    <!-- PSB Online -->
                    <button type="button"
                        class="flex items-start gap-4 border border-slate-200 rounded-xl p-4 text-left hover:bg-orange-50 hover:border-orange-300 transition-colors">
                        <div class="bg-orange-50 rounded-lg p-2 mt-0.5">
                            <svg class="w-5 h-5 text-orange-500" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                                <path d="M14 2v6h6" />
                                <path d="M16 13H8" />
                                <path d="M16 17H8" />
                                <path d="M10 9H8" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">PSB Online</p>
                            <p class="text-sm text-slate-500 mt-0.5">Kelola pendaftaran santri baru</p>
                        </div>
                    </button>

                </div>
            </div>

        </div>

    </div>

    </div>

@endsection



@push('scripts')
    <script>
        // Re-init icons setelah Alpine merender
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            // Animasi progress bar setelah halaman dimuat
            setTimeout(() => {
                document.querySelectorAll('.progress-bar').forEach(el => {
                    const w = el.style.width;
                    el.style.width = '0%';
                    requestAnimationFrame(() => {
                        el.style.width = w;
                    });
                });
            }, 300);
        });
    </script>
@endpush
