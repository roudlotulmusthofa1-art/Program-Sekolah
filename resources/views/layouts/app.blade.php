<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Ribath Masjid Riyadh</title>

    {{-- Tailwind CSS via CDN (ganti dengan npm build di production) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ribath: {
                            primary: '#1a6b5a',
                            dark: '#134d40',
                            light: '#e8f5f1',
                            accent: '#f59e0b',
                            blue: '#3b82f6',
                            orange: '#f97316',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Alpine.js untuk interaktivitas --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .sidebar-link.active {
            background-color: #f59e0b;
            color: #fff;
        }

        /* .sidebar-link:not(.active):hover { background-color: rgba(255,255,255,0.1); } */
        [x-cloak] {
            display: none !important;
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }
    </style>

    @stack('styles')
</head>
@php
    $navGroups = [
        [
            'label' => 'MANAJEMEN DATA',
            'icon' => 'database',
            'route' => 'manajemen-data',
            'children' => [
                ['name' => 'Data Santri', 'route' => 'manajemen-data.santri', 'icon' => 'GraduationCap'],
                ['name' => 'Data Ustadz', 'route' => 'manajemen-data.ustadz', 'icon' => 'UserCheck'],
                ['name' => 'Data Kelas', 'route' => 'manajemen-data.kelas', 'icon' => 'School'],
            ],
        ],
        [
            'label' => 'AKADEMIK',
            'icon' => 'book-open',
            'route' => 'akademik',
            'children' => [
                ['name' => 'Input Nilai', 'route' => 'akademik.nilai', 'icon' => 'Edit'],
                ['name' => 'Rekap Absensi', 'route' => 'akademik.absensi', 'icon' => 'Calendar'],
                ['name' => 'Input Tahfidz', 'route' => 'akademik.tahfidz', 'icon' => 'BookOpen'],
            ],
        ],
        [
            'label' => 'KEUANGAN',
            'icon' => 'wallet',
            'route' => 'keuangan',
            'children' => [
                ['name' => 'Tagihan', 'route' => 'keuangan.tagihan', 'icon' => 'CreditCard'],
                ['name' => 'Pembayaran', 'route' => 'keuangan.pembayaran', 'icon' => 'CreditCard'],
                ['name' => 'Tunggakan', 'route' => 'keuangan.tunggakan', 'icon' => 'CreditCard'],
            ],
        ],
        [
            'label' => 'LAPORAN',
            'icon' => 'bar-chart-2',
            'route' => 'laporan',
            'children' => [
                ['name' => 'Akademik', 'route' => 'laporan.akademik', 'icon' => 'book-open'],
                ['name' => 'Keuangan', 'route' => 'laporan.keuangan', 'icon' => 'bar-chart-2'],
                ['name' => 'Kehadiran', 'route' => 'laporan.kehadiran', 'icon' => 'calendar'],
            ],
        ],
        [
            'label' => 'PSB',
            'icon' => 'user-plus',
            'route' => 'psb',
            'children' => [
                ['name' => 'Pendaftar', 'route' => 'psb.pendaftar', 'icon' => 'user'],
                ['name' => 'Seleksi', 'route' => 'psb.seleksi', 'icon' => 'check-circle'],
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
                ['name' => 'Pengaturan', 'route' => 'sistem.pengaturan', 'icon' => 'settings'],
                ['name' => 'Pengguna', 'route' => 'sistem.pengguna', 'icon' => 'user'],
            ],
        ],
    ];
@endphp

<body class="bg-gray-50 text-gray-800" x-data="{
    sidebarOpen: localStorage.getItem('sidebarOpen') === 'false' ? false : true,
    mobileSidebarOpen: false
}">

    {{-- Mobile Sidebar --}}
    <div x-show="mobileSidebarOpen" x-cloak @click.self="mobileSidebarOpen = false"
        class="fixed inset-0 bg-black/50 z-40 md:hidden">

        <div class="w-60 h-screen overflow-y-auto bg-teal-800 p-4">

            {{-- Logo / Nama Pesantren --}}
            <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10">
                <div class="shrink-0 w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>
                <div class="text-white leading-tight">
                    <p class="font-bold text-sm">Ribath</p>
                    <p class="text-xs text-white/70">Riyadh Solo</p>
                </div>

            </div>

            {{-- Lihat Website --}}
            <div class="flex items-center w-full h-16 border-b border-white/10">
                <a href="{{ url('/') }}" target="_blank"
                    class="flex items-center gap-1 w-52 h-12 px-4 py-3 rounded-lg text-white/70 hover:text-white hover:bg-white/20 transition-colors text-sm ">

                    <i data-lucide="globe" class="w-8 h-4 shrink-0"></i>
                    <span>Lihat Website</span>
                    <i data-lucide="external-link" class="w-3 h-3 ml-auto" x-show="sidebarOpen" x-cloak></i>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto scrollbar-thin py-2">

                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-sm text-white mx-2 rounded-lg mb-1 {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0"></i>
                    <span>Dashboard</span>
                </a>

                @foreach ($navGroups as $group)
                    <div x-data="{ open: {{ request()->routeIs($group['route'] . '*') ? 'true' : 'false' }} }" class="mb-1">

                        {{-- Parent Menu --}}
                        <button @click="open = !open"
                            class="w-full flex items-center gap-3 px-4 py-3 text-white hover:bg-white/10 rounded-lg">

                            <i data-lucide="{{ $group['icon'] }}" class="w-4 h-4"></i>

                            <span class="flex-1 text-xs text-left">
                                {{ $group['label'] }}
                            </span>

                            <i data-lucide="chevron-right" class="w-4 h-4 transition-transform"
                                :class="open ? 'rotate-90' : ''">
                            </i>

                        </button>

                        {{-- Child Menu --}}
                        <div x-show="open" x-transition class="ml-8 mt-2 space-y-1">

                            @foreach ($group['children'] as $child)
                                <a href="{{ route($child['route']) }}"
                                    class="block px-3 py-2 rounded-lg text-sm text-white hover:bg-white/10
                        {{ request()->routeIs($child['route']) ? 'bg-amber-500 text-white' : '' }}">

                                    {{ $child['name'] }}

                                </a>
                            @endforeach

                        </div>

                    </div>
                @endforeach

        </div>

    </div>

    
    {{-- ════════════════════════════════════════════════════════
     SIDEBAR tampilan desktop
════════════════════════════════════════════════════════ --}}
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
        class="hidden md:flex fixed left-0 top-0 h-screen  bg-teal-800 shadow-lg transition-all duration-300 overflow-hidden flex-col">

        {{-- Logo / Nama Pesantren --}}
        <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10 ">
            <div class="shrink-0 w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
            </div>
            <div x-show="sidebarOpen" x-cloak class="text-white leading-tight">
                <p class="font-bold text-sm">Ribath</p>
                <p class="text-xs text-white/70">Riyadh Solo</p>
            </div>
            {{-- Toggle --}}
            <button
                @click="
        sidebarOpen = !sidebarOpen;
        localStorage.setItem('sidebarOpen', sidebarOpen);"
                class="ml-auto text-white/70 hover:text-white transition-colors">
                <i data-lucide="chevron-left" class="w-4 h-4 transition-transform"
                    :class="sidebarOpen ? '' : 'rotate-180'"></i>
            </button>
        </div>

        {{-- Lihat Website --}}
        <div class="flex items-center w-full h-16 border-b border-white/10">
            <a href="{{ url('/') }}" target="_blank"
                class="flex items-center gap-1  w-52 h-12 px-4 py-3 rounded-lg text-white/70 hover:text-white hover:bg-white/20 transition-colors text-sm ">

                <i data-lucide="globe" class="w-8 h-4 shrink-0"></i>
                <span x-show="sidebarOpen" x-cloak>Lihat Website</span>
                <i data-lucide="external-link" class="w-3 h-3 ml-auto" x-show="sidebarOpen" x-cloak></i>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto scrollbar-thin py-2">

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
                class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-base hover:bg-white/10 text-white mx-2 rounded-lg mb-1 {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0"></i>
                <span x-show="sidebarOpen" x-cloak>Dashboard</span>
            </a>



            @foreach ($navGroups as $group)
                <div x-data="{ open: {{ request()->routeIs($group['route'] . '*') ? 'true' : 'false' }} }" class="mb-0.5">
                    @if (count($group['children']) > 0)
                        <button x-show="sidebarOpen" @click="open = !open"
                            class="sidebar-link w-full flex items-center gap-3 px-4 py-5 text-sm text-teal-200 hover:text-white mx-2 rounded-lg {{ request()->routeIs($group['route'] . '*') ? 'bg-white/10' : '' }}"
                            style="width: calc(100% - 1rem);">
                            <i data-lucide="{{ $group['icon'] }}" class="w-4 h-4 shrink-0"></i>
                            <span x-show="sidebarOpen" x-cloak
                                class="flex-1 text-left font-semibold text-sm tracking-wider">
                                {{ $group['label'] }}
                            </span>
                            <i data-lucide="chevron-right" class="w-3 h-3 transition-transform shrink-0"
                                x-show="sidebarOpen" x-cloak :class="open ? 'rotate-90' : ''"></i>
                        </button>
                        <div x-show="open && sidebarOpen" x-cloak class="ml-8 mt-0.5 space-y-0.5 mr-3">
                            @foreach ($group['children'] as $child)
                                <a href="{{ route($child['route']) }}"
                                    class="block px-4 py-2 text-base text-white hover:text-white hover:bg-white/10 rounded-lg transition-colors {{ request()->routeIs($child['route']) ? 'text-white bg-amber-500' : '' }}">
                                    {{ $child['name'] }}
                                </a>
                            @endforeach

                        </div>
                        {{-- menu ketika sidebar tidak terbuka --}}

                        <div x-show="!sidebarOpen" class="flex flex-col items-center mt-2 gap-2  mr-2">
                            @foreach ($group['children'] as $child)
                                <a href="{{ route($child['route']) }}"
                                    class="p-2 rounded-lg text-white hover:bg-white/10">
                                    <i data-lucide="{{ $child['icon'] }}" class="w-4 h-4"></i>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <a href="{{ route($group['route']) }}"
                            class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-sm text-white/80 hover:text-white mx-2 rounded-lg {{ request()->routeIs($group['route'] . '*') ? 'bg-white/10' : '' }}">
                            <i data-lucide="{{ $group['icon'] }}" class="w-4 h-4 shrink-0"></i>
                            <span x-show="sidebarOpen" x-cloak
                                class="font-semibold text-xs tracking-wider">{{ $group['label'] }}</span>
                        </a>
                    @endif
                </div>
            @endforeach
        </nav>

        {{-- User Info (bawah sidebar) --}}
        <div class="mt-auto border-t border-white/10 px-4 py-3 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center shrink-0">
                <span class="text-xs font-bold text-white">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
            </div>
            <div x-show="sidebarOpen" x-cloak class="flex-1 min-w-0">
                <p class="text-white text-xs font-semibold truncate">
                    {{ auth()->user()->name ?? 'Abdul Kadir Habsyi' }}
                </p>
                <p class="text-white/60 text-xs truncate">{{ auth()->user()->role ?? 'Super Admin' }}</p>
            </div>
        </div>
    </aside>

    {{-- ════════════════════════════════════════════════════════
     MAIN WRAPPER
════════════════════════════════════════════════════════ --}}
    <div  :class="{
        'md:ml-60': sidebarOpen,
        'md:ml-20': !sidebarOpen
    }" class="transition-all duration-300 min-h-screen flex flex-col">

        {{-- ── TOPBAR ── --}}
        <header :class="sidebarOpen ? 'md:ml-4' : 'md:ml-0'"
            class="ml-8 sticky top-0 z-20 bg-white border-b border-gray-100 flex items-center px-6 h-20 gap-4">
            {{-- menu button for mobile --}}
            <button @click="mobileSidebarOpen = true" class="md:hidden">

                <i data-lucide="menu" class="w-6 h-6"></i>

            </button>
            {{-- Search --}}
            <div class="relative flex-1 max-w-sm ">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                <input type="text" placeholder="Cari..."
                    class="w-full pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-ribath-primary/30 focus:border-ribath-primary transition-all">
            </div>

            <div class="flex items-center gap-3 ml-auto">
                {{-- Theme Toggle --}}
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                    <i data-lucide="sun" class="w-4 h-4"></i>
                </button>

                {{-- Notifikasi --}}
                <button
                    class="relative w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                {{-- User --}}
                <div class="flex items-center gap-2 pl-3 border-l border-gray-200">
                    <div class="w-8 h-8 rounded-full bg-ribath-primary flex items-center justify-center">
                        <span
                            class="text-xs font-bold text-white">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-xs font-semibold text-gray-800">
                            {{ auth()->user()->name ?? 'Abdul Kadir Habsyi' }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->role ?? 'Super Admin' }}</p>
                    </div>
                </div>
            </div>
        </header>

        {{-- ── PAGE CONTENT ── --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

    {{-- Inisialisasi Lucide Icons --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
        document.addEventListener('alpine:initialized', () => {
            setTimeout(() => lucide.createIcons(), 100);
        });
    </script>

    @stack('scripts')
</body>

</html>
