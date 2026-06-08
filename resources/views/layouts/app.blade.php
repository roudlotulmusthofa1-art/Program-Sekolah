{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <title>Document</title>
</head>

<body class="antialiased">
    <section class="bg-[url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1920&auto=format&fit=crop')] bg-no-repeat bg-cover bg-center bg-fixed min-h-screen">
        
        <div class="fixed inset-0 bg-emerald-900/40 z-0"></div>

        <div class="relative z-10 flex flex-col min-h-screen">
            
            @yield('content')
            
        </div>
    </section>
</body>

</html> --}}


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
                            primary:   '#1a6b5a',
                            dark:      '#134d40',
                            light:     '#e8f5f1',
                            accent:    '#f59e0b',
                            blue:      '#3b82f6',
                            orange:    '#f97316',
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Alpine.js untuk interaktivitas --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link.active { background-color: #f59e0b; color: #fff; }
        /* .sidebar-link:not(.active):hover { background-color: rgba(255,255,255,0.1); } */
        [x-cloak] { display: none !important; }
        .scrollbar-thin::-webkit-scrollbar { width: 4px; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800" x-data="{ sidebarOpen: true, mobileSidebarOpen: false }">

{{-- ════════════════════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════════════════ --}}
<aside
    :class="sidebarOpen ? 'w-64' : 'w-16'"
    class="fixed inset-y-0 left-0 z-30 flex flex-col bg-teal-800 transition-all duration-300 overflow-hidden">

    {{-- Logo / Nama Pesantren --}}
    <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10">
        <div class="shrink-0 w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <div x-show="sidebarOpen" x-cloak class="text-white leading-tight">
            <p class="font-bold text-sm">Ribath</p>
            <p class="text-xs text-white/70">Riyadh Solo</p>
        </div>
        {{-- Toggle --}}
        <button @click="sidebarOpen = !sidebarOpen"
                class="ml-auto text-white/70 hover:text-white transition-colors">
            <i data-lucide="chevron-left" class="w-4 h-4 transition-transform" :class="sidebarOpen ? '' : 'rotate-180'"></i>
        </button>
    </div>

    {{-- Lihat Website --}}
    <a href="{{ url('/') }}" target="_blank"
       class="flex items-center gap-3 px-4 py-3 text-white/70 hover:text-white hover:bg-white/10 transition-colors text-sm border-b border-white/10">
        <i data-lucide="globe" class="w-4 h-4 shrink-0"></i>
        <span x-show="sidebarOpen" x-cloak>Lihat Website</span>
        <i data-lucide="external-link" class="w-3 h-3 ml-auto" x-show="sidebarOpen" x-cloak></i>
    </a>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto scrollbar-thin py-2">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-base text-white mx-2 rounded-lg mb-1 {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
            <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0"></i>
            <span x-show="sidebarOpen" x-cloak>Dashboard</span>
        </a>

        @php
            $navGroups = [
                ['label' => 'MANAJEMEN DATA', 'icon' => 'database', 'route' => 'manajemen-data', 'children' => [
                    ['name' => 'Data Santri',  'route' => 'manajemen-data.santri'],
                    ['name' => 'Data Ustadz',  'route' => 'manajemen-data.ustadz'],
                    ['name' => 'Data Kelas',   'route' => 'manajemen-data.kelas'],
                ]],
                ['label' => 'AKADEMIK', 'icon' => 'book-open', 'route' => 'akademik', 'children' => [
                    ['name' => 'Input Nilai',    'route' => 'akademik.nilai'],
                    ['name' => 'Rekap Absensi',  'route' => 'akademik.absensi'],
                    ['name' => 'Input Tahfidz',  'route' => 'akademik.tahfidz'],
                ]],
                ['label' => 'KEUANGAN', 'icon' => 'wallet', 'route' => 'keuangan', 'children' => [
                    ['name' => 'Tagihan',     'route' => 'keuangan.tagihan'],
                    ['name' => 'Pembayaran',  'route' => 'keuangan.pembayaran'],
                    ['name' => 'Tunggakan',   'route' => 'keuangan.tunggakan'],
                ]],
                ['label' => 'LAPORAN', 'icon' => 'bar-chart-2', 'route' => 'laporan', 'children' => [
                    ['name' => 'Akademik',   'route' => 'laporan.akademik'],
                    ['name' => 'Keuangan',   'route' => 'laporan.keuangan'],
                    ['name' => 'Kehadiran',  'route' => 'laporan.kehadiran'],
                ]],
                ['label' => 'PSB', 'icon' => 'user-plus', 'route' => 'psb', 'children' => [
                    ['name' => 'Pendaftar',  'route' => 'psb.pendaftar'],
                    ['name' => 'Seleksi',    'route' => 'psb.seleksi'],
                ]],
                ['label' => 'LANDING PAGE', 'icon' => 'monitor', 'route' => 'landing-page', 'children' => []],
                ['label' => 'SISTEM', 'icon' => 'settings', 'route' => 'sistem', 'children' => [
                    ['name' => 'Pengaturan', 'route' => 'sistem.pengaturan'],
                    ['name' => 'Pengguna',   'route' => 'sistem.pengguna'],
                ]],
            ];
        @endphp

        @foreach($navGroups as $group)
            <div x-data="{ open: {{ request()->routeIs($group['route'].'*') ? 'true' : 'false' }} }" class="mb-0.5">
                @if(count($group['children']) > 0)
                    <button @click="open = !open"
                            class="sidebar-link w-full flex items-center gap-3 px-4 py-5 text-sm text-teal-200 hover:text-white mx-2 rounded-lg {{ request()->routeIs($group['route'].'*') ? 'bg-white/10' : '' }}"
                            style="width: calc(100% - 1rem);">
                        <i data-lucide="{{ $group['icon'] }}" class="w-4 h-4 shrink-0"></i>
                        <span x-show="sidebarOpen" x-cloak class="flex-1 text-left font-semibold text-sm tracking-wider">
                            {{ $group['label'] }}
                        </span>
                        <i data-lucide="chevron-right" class="w-3 h-3 transition-transform shrink-0"
                           x-show="sidebarOpen" x-cloak
                           :class="open ? 'rotate-90' : ''"></i>
                    </button>
                    <div x-show="open && sidebarOpen" x-cloak class="ml-8 mt-0.5 space-y-0.5">
                        @foreach($group['children'] as $child)
                            <a href="{{ route($child['route']) }}"
                               class="block px-4 py-2 text-base text-white hover:text-white hover:bg-white/10 rounded-lg transition-colors {{ request()->routeIs($child['route']) ? 'text-white bg-white/10' : '' }}">
                                {{ $child['name'] }}
                            </a>
                        @endforeach
                    </div>
                @else
                    <a href="{{ route($group['route']) }}"
                       class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-sm text-white/80 hover:text-white mx-2 rounded-lg {{ request()->routeIs($group['route'].'*') ? 'bg-white/10' : '' }}">
                        <i data-lucide="{{ $group['icon'] }}" class="w-4 h-4 shrink-0"></i>
                        <span x-show="sidebarOpen" x-cloak class="font-semibold text-xs tracking-wider">{{ $group['label'] }}</span>
                    </a>
                @endif
            </div>
        @endforeach
    </nav>

    {{-- User Info (bawah sidebar) --}}
    <div class="border-t border-white/10 px-4 py-3 flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center shrink-0">
            <span class="text-xs font-bold text-white">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
        </div>
        <div x-show="sidebarOpen" x-cloak class="flex-1 min-w-0">
            <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Abdul Kadir Habsyi' }}</p>
            <p class="text-white/60 text-xs truncate">{{ auth()->user()->role ?? 'Super Admin' }}</p>
        </div>
    </div>
</aside>

{{-- ════════════════════════════════════════════════════════
     MAIN WRAPPER
════════════════════════════════════════════════════════ --}}
<div :class="sidebarOpen ? 'ml-56' : 'ml-16'" class="transition-all duration-300 min-h-screen flex flex-col">

    {{-- ── TOPBAR ── --}}
    <header class="sticky top-0 z-20 bg-white border-b border-gray-100 flex items-center px-6 h-14 gap-4">
        {{-- Search --}}
        <div class="relative flex-1 max-w-sm">
            <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
            <input type="text" placeholder="Cari..."
                   class="w-full pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-ribath-primary/30 focus:border-ribath-primary transition-all">
        </div>

        <div class="flex items-center gap-3 ml-auto">
            {{-- Theme Toggle --}}
            <button class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                <i data-lucide="sun" class="w-4 h-4"></i>
            </button>

            {{-- Notifikasi --}}
            <button class="relative w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                <i data-lucide="bell" class="w-4 h-4"></i>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>

            {{-- User --}}
            <div class="flex items-center gap-2 pl-3 border-l border-gray-200">
                <div class="w-8 h-8 rounded-full bg-ribath-primary flex items-center justify-center">
                    <span class="text-xs font-bold text-white">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                </div>
                <div class="hidden sm:block">
                    <p class="text-xs font-semibold text-gray-800">{{ auth()->user()->name ?? 'Abdul Kadir Habsyi' }}</p>
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