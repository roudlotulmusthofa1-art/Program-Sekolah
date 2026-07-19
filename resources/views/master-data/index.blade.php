@extends('layouts.app')

@section('title', 'Master Data')

@push('styles')
    <style>
        .tab-btn {
            @apply px-5 py-2 rounded-lg text-sm font-medium transition-all duration-200;
        }

        .tab-btn.active {
            @apply bg-white text-teal-700 shadow-sm font-semibold;
        }

        .tab-btn:not(.active) {
            @apply text-gray-500 hover:text-gray-700 hover:bg-white/60;
        }

        .drag-handle {
            cursor: grab;
            color: #cbd5e1;
            transition: color 0.1s;
        }

        .drag-handle:hover {
            color: #64748b;
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        .sortable-ghost {
            opacity: .4;
            background: #f0fdf4;
            border: 2px dashed #14b8a6;
            border-radius: .5rem;
        }

        .sortable-chosen {
            box-shadow: 0 4px 20px rgba(0, 0, 0, .12);
        }

        /* Badge kategori kelas */
        .badge-kategori {
            @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
        }

        .badge-Akademik {
            @apply bg-blue-100 text-blue-700;
        }

        .badge-Tahfidz {
            @apply bg-teal-100 text-teal-700;
        }

        .badge-Takhassus {
            @apply bg-purple-100 text-purple-700;
        }

        .badge-Lainnya {
            @apply bg-gray-100 text-gray-600;
        }

        /* Badge jenis waktu */
        .badge-sholat {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-jam_tetap {
            background: #f1f5f9;
            color: #475569;
        }

        /* Toggle switch */
        .toggle-sw {
            width: 36px;
            height: 20px;
            border-radius: 9999px;
            position: relative;
            cursor: pointer;
            transition: background .2s;
            border: none;
            outline: none;
            flex-shrink: 0;
        }

        .toggle-sw::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 14px;
            height: 14px;
            border-radius: 9999px;
            background: white;
            transition: transform .2s;
        }

        .toggle-sw.on {
            background: #14b8a6;
        }

        .toggle-sw.off {
            background: #cbd5e1;
        }

        .toggle-sw.on::after {
            transform: translateX(16px);
        }

        .toggle-sw.off::after {
            transform: translateX(0);
        }

        .modal-backdrop {
            backdrop-filter: blur(3px);
            background: rgba(0, 0, 0, .35);
        }

        .data-row:hover {
            background-color: #f8fafc;
        }
    </style>
@endpush

@section('content')

    {{-- PAGE HEADER --}}
    <div class="mb-6">
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4 ml-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-1 hover:text-teal-700 transition-colors">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                Beranda
            </a>
            <span class="text-gray-300">/</span>
            <span class="text-gray-800 font-medium">Master Data</span>
        </nav>
        <div class="mx-4 md:mx-10 lg:mx-20 xl:mx-60 mt-8 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center">
                <i data-lucide="database" class="w-6 h-6 text-teal-600"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Master Data</h1>
                <p class="text-sm text-gray-500">Kelola data referensi dan kategori sistem</p>
            </div>
        </div>
    </div>

    {{-- Flash --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="mx-4 md:mx-10 lg:mx-20 xl:mx-60 mb-4 flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="mb-4 flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
            <svg class="mx-4 md:mx-10 lg:mx-20 xl:mx-60 w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- TAB NAV --}}
    {{-- TAB NAV --}}
    {{-- <div class="bg-gray-300 rounded-xl p-1 grid grid-cols-4 gap-2 mb-6">
    @php
        $tabs = [
            'bidang-ilmu'     => 'Bidang Ilmu',
            'waktu-pelajaran' => 'Waktu Pelajaran',
            'kelas'           => 'Kelas',
            'kategori-berita' => 'Kategori Berita',
        ];
    @endphp
    @foreach ($tabs as $key => $label)
        <a href="{{ route('master-data.index', ['tab' => $key]) }}"
           class="tab-btn {{ $tab === $key ? 'active' : '' }}">
            {{ $label }}
        </a>
    @endforeach
</div> --}}

    <div x-data="{ activeTab: '{{ $tab }}' }"
        class="mx-4 md:mx-10 lg:mx-20 xl:mx-60 bg-gray-100 rounded-xl py-1 grid grid-cols-2 md:grid-cols-4 mb-6 shadow-sm border border-gray-200 w-fit ">
        @php
            $tabs = [
                'bidang-ilmu' => 'Bidang Ilmu',
                'waktu-pelajaran' => 'Waktu Pelajaran',
                'kelas' => 'Kelas',
                'kategori-berita' => 'Kategori Berita',
            ];
        @endphp

        @foreach ($tabs as $key => $label)
            <a href="{{ route('master-data.index', ['tab' => $key]) }}" @click="activeTab = '{{ $key }}'"
                :class="activeTab === '{{ $key }}'
                    ?
                    'bg-white text-ribath-primary shadow-md scale-[1.02]' :
                    'text-gray-600 hover:text-gray-800 hover:bg-white/60'"
                class="relative px-16 py-2 rounded-lg mx-2 text-sm font-semibold text-center transition-all duration-300 ease-in-out items-center justify-center">
                {{ $label }}
            </a>
        @endforeach
    </div>


    {{-- ════════════════════════════════════════
    TAB: BIDANG ILMU
════════════════════════════════════════ --}}
    @if ($tab === 'bidang-ilmu')
        <div x-data="genericManager('bidang-ilmu')" x-init="init()">

            <div class="flex items-start justify-between mb-4 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Kategori Bidang Ilmu</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola kategori bidang ilmu (fann) untuk kurikulum kitab. Seret
                        baris untuk mengubah urutan.</p>
                </div>
                <button @click="openModal('create')"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kategori
                </button>
            </div>

            <div
                class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm ">
                        <thead>
                            <tr class="border-b border-gray-200 bg-gray-100/60 h-14">
                                <th class="w-8 px-3 py-3"></th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                    Urutan</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-80">
                                    Warna</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-64">
                                    Deskripsi</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                    Kitab</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                    Status</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-bidang-ilmu">
                            @forelse ($bidangIlmu as $item)
                                <tr class="data-row border-b border-gray-100 transition-colors"
                                    data-id="{{ $item->id }}">
                                    <td class="px-3 py-3">
                                        <div class="drag-handle flex items-center justify-center w-6 h-6"
                                            title="Seret untuk di urutkan">
                                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M7 4a1 1 0 100-2 1 1 0 000 2zM13 4a1 1 0 100-2 1 1 0 000 2zM7 8a1 1 0 100-2 1 1 0 000 2zM13 8a1 1 0 100-2 1 1 0 000 2zM7 12a1 1 0 100-2 1 1 0 000 2zM13 12a1 1 0 100-2 1 1 0 000 2z" />
                                            </svg>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $item->urutan }}</td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold text-gray-800">{{ $item->nama }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">#{{ $item->kode ?? $item->id }} •
                                            {{ $item->slug }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-7 h-7 rounded shrink-0 border border-gray-100"
                                                style="background:{{ $item->warna }}"></span>
                                            <span class="text-xs text-gray-500">{{ $item->warna }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-400 text-xs">{{ $item->deskripsi ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold bg-amber-400 text-white">0</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button class="toggle-sw {{ $item->is_active ? 'on' : 'off' }}"
                                            data-url="{{ route('master-data.bidang-ilmu.toggle', $item) }}"
                                            @click="toggleStatus($event.currentTarget)">
                                        </button>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button
                                                @click="openModal('edit', {
                                id: {{ $item->id }},
                                nama: '{{ addslashes($item->nama) }}',
                                kode: '{{ $item->kode }}',
                                deskripsi: '{{ addslashes($item->deskripsi ?? '') }}',
                                warna: '{{ $item->warna }}'
                            })"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg text-teal-500 hover:bg-teal-50 transition-colors" title="edit">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button
                                                @click="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama) }}')"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50 transition-colors" title="hapus">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-12 text-center text-gray-400 text-sm">Belum ada bidang
                                        ilmu.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Bidang Ilmu --}}
            <div x-show="modal.open" x-cloak
                class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4"
                @keydown.escape.window="closeModal()">
                <div x-show="modal.open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-sm" @click.stop>
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <h3 class="font-bold text-xl text-gray-800"
                            x-text="modal.mode==='create' ? 'Tambah Bidang Ilmu' : 'Edit Bidang Ilmu'"></h3>
                        <button @click="closeModal()"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100"><svg
                                class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg></button>
                    </div>
                    {{-- Form CREATE --}}
                    <form x-show="modal.mode==='create'" action="{{ route('master-data.bidang-ilmu.store') }}"
                        method="POST" class="px-6 py-5 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Nama Bidang Ilmu <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                placeholder="contoh: Fiqih, Nahwu, Shorof . . .">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Kode</label>
                            <input type="text" name="kode"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                placeholder="contoh: FQH, NHW">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Warna</label>
                            <input type="color" name="warna" value="#3b82f6"
                                class="w-full max-w-64 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Deskripsi</label>
                            <textarea name="deskripsi" rows="2"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 resize-none"
                                placeholder="Opsional…"></textarea>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="closeModal()"
                                class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold">Simpan</button>
                        </div>
                    </form>
                    {{-- Form EDIT --}}
                    <form x-show="modal.mode==='edit'" :action="`{{ url('master-data/bidang-ilmu') }}/${modal.data?.id}`"
                        method="POST" class="px-6 py-5 space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Nama Bidang Ilmu <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama" :value="modal.data?.nama ?? ''" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                placeholder="contoh: Fiqih, Nahwu, Shorof . . .">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Kode</label>
                            <input type="text" name="kode" :value="modal.data?.kode ?? ''"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                placeholder="contoh: FQH, NHW">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Warna</label>
                            <input type="color" name="warna" :value="modal.data?.warna ?? '#3b82f6'"
                                class="w-full max-w-64 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Deskripsi</label>
                            <textarea name="deskripsi" rows="2"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 resize-none"
                                placeholder="Opsional…" x-text="modal.data?.deskripsi??''"></textarea>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="closeModal()"
                                class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Hapus Bidang Ilmu --}}
            <div x-show="deleteModal.open" x-cloak
                class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4">
                <div x-show="deleteModal.open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
                    <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Hapus Bidang Ilmu</h3>
                    <p class="text-sm text-gray-500 mb-5">Apakah Anda yakin ingin menghapus kategori
                        "<strong x-text="deleteModal.name"></strong>" ? Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <div class="flex gap-3">
                        <button @click="deleteModal.open=false"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                        <form :action="`{{ url('master-data/bidang-ilmu') }}/${deleteModal.id}`" method="POST"
                            class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold">Ya,
                                Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ════════════════════════════════════════
    TAB: WAKTU PELAJARAN
════════════════════════════════════════ --}}
    @elseif ($tab === 'waktu-pelajaran')
        <div x-data="genericManager('waktu-pelajaran')" x-init="init()">

            <div class="flex items-start justify-between mb-4 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Waktu Pelajaran</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola slot waktu untuk jadwal pelajaran. Seret baris untuk
                        mengubah urutan.</p>
                </div>
                <button @click="openModal('create')"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Waktu
                </button>
            </div>

            <div
                class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 bg-gray-100/60 h-14">
                                <th class="w-8 px-3 py-3"></th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                    Urutan</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Label</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-80">
                                    Jenis</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-80">
                                    Waktu</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                    Jadwal</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                    Status</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-waktu-pelajaran">
                            @forelse ($waktuPelajaran as $item)
                                <tr class="data-row border-b border-gray-50 transition-colors"
                                    data-id="{{ $item->id }}">
                                    <td class="px-3 py-3">
                                        <div class="drag-handle flex items-center justify-center w-6 h-6"
                                            title="Seret untuk di urutkan">
                                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M7 4a1 1 0 100-2 1 1 0 000 2zM13 4a1 1 0 100-2 1 1 0 000 2zM7 8a1 1 0 100-2 1 1 0 000 2zM13 8a1 1 0 100-2 1 1 0 000 2zM7 12a1 1 0 100-2 1 1 0 000 2zM13 12a1 1 0 100-2 1 1 0 000 2z" />
                                            </svg>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $item->urutan }}</td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold text-gray-800">{{ $item->nama }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            {{ $item->kode ?? str_replace(':', '', $item->jam_mulai) . '-' . str_replace(':', '', $item->jam_selesai) }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($item->jenis === 'sholat')
                                            <span
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium badge-sholat">
                                                <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Sholat
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium badge-jam_tetap">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Jam Tetap
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-mono text-base text-gray-600">{{ $item->jam_mulai }} -
                                        {{ $item->jam_selesai }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold bg-amber-400 text-white">0</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button class="toggle-sw {{ $item->is_active ? 'on' : 'off' }}"
                                            data-url="{{ route('master-data.waktu-pelajaran.toggle', $item) }}"
                                            @click="toggleStatus($event.currentTarget)">
                                        </button>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button
                                                @click="openModal('edit', {
                                id: {{ $item->id }},
                                nama: '{{ addslashes($item->nama) }}',
                                kode: '{{ $item->kode }}',
                                jenis: '{{ $item->jenis }}',
                                jam_mulai: '{{ $item->jam_mulai }}',
                                jam_selesai: '{{ $item->jam_selesai }}'
                            })"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg text-teal-500 hover:bg-teal-50 transition-colors" title="edit">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button
                                                @click="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama) }}')"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50 transition-colors" title="hapus">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-12 text-center text-gray-400 text-sm">Belum ada waktu
                                        pelajaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Waktu --}}
            <div x-show="modal.open" x-cloak
                class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4"
                @keydown.escape.window="closeModal()">
                <div x-show="modal.open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-sm" @click.stop>
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <h3 class="font-bold text-xl text-gray-800"
                            x-text="modal.mode==='create' ? 'Tambah Waktu Pelajaran' : 'Edit Waktu Pelajaran'"></h3>
                        <button @click="closeModal()"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100"><svg
                                class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg></button>
                    </div>
                    {{-- Form CREATE --}}
                    <form x-show="modal.mode==='create'" action="{{ route('master-data.waktu-pelajaran.store') }}"
                        method="POST" class="px-6 py-5 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Jenis <span
                                    class="text-red-500">*</span></label>
                            <select name="jenis" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                                <option value="sholat">☀ Sholat</option>
                                <option value="jam_tetap" selected>⏱ Jam Tetap</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Nama / Label <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                placeholder="cth: Ba'da Subuh, Pelajaran ke-1">
                        </div>
                        
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Kode</label>
                                <input type="text" name="kode"
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                    placeholder="cth: after_fajr">
                            </div>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Jam Mulai <span
                                        class="text-red-500">*</span></label>
                                <input type="time" name="jam_mulai" required
                                    class="w-full max-w-36 px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Jam Selesai <span
                                        class="text-red-500">*</span></label>
                                <input type="time" name="jam_selesai" required
                                    class="w-full max-w-36 px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                            </div>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="closeModal()"
                                class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold">Simpan</button>
                        </div>
                    </form>
                    {{-- Form EDIT --}}
                    <form x-show="modal.mode==='edit'"
                        :action="`{{ url('master-data/waktu-pelajaran') }}/${modal.data?.id}`" method="POST"
                        class="px-6 py-5 space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Jenis <span
                                    class="text-red-500">*</span></label>
                            <select name="jenis" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                                <option value="sholat" :selected="modal.data?.jenis === 'sholat'">☀ Sholat</option>
                                <option value="jam_tetap" :selected="modal.data?.jenis !== 'sholat'">⏱ Jam Tetap
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Nama / Label <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama" :value="modal.data?.nama ?? ''" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                placeholder="cth: Ba'da Subuh, Pelajaran ke-1">
                        </div>
                        
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Kode</label>
                                <input type="text" name="kode" :value="modal.data?.kode ?? ''"
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                    placeholder="cth: after_fajr">
                            </div>
                       
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Jam Mulai <span
                                        class="text-red-500">*</span></label>
                                <input type="time" name="jam_mulai" :value="modal.data?.jam_mulai ?? ''" required
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Jam Selesai <span
                                        class="text-red-500">*</span></label>
                                <input type="time" name="jam_selesai" :value="modal.data?.jam_selesai ?? ''" required
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                            </div>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="closeModal()"
                                class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Hapus Waktu --}}
            <div x-show="deleteModal.open" x-cloak
                class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4">
                <div x-show="deleteModal.open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
                    <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                        <svg
                            class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1">Hapus Waktu Pelajaran</h3>
                    <p class="text-sm text-gray-500 mb-5">Anda yakin akan menghapus lebel "<strong x-text="deleteModal.name"></strong>" secara permanen ?</p>
                    <div class="flex gap-3">
                        <button @click="deleteModal.open=false"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                        <form :action="`{{ url('master-data/waktu-pelajaran') }}/${deleteModal.id}`" method="POST"
                            class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold">Ya,
                                Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ════════════════════════════════════════
    TAB: KELAS
════════════════════════════════════════ --}}
    @elseif ($tab === 'kelas')
        <div x-data="kelasManager()" x-init="init()">

            <div class="flex items-start justify-between mb-4 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Kelas / Tingkatan</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola kelas dan tingkatan santri. Seret baris untuk mengubah
                        urutan.</p>
                </div>
                <button @click="openModal('create')"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kelas
                </button>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-100/60 h-14">
                            <th class="w-8 px-3 py-3"></th>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                Urutan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Label</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Kategori</th>
                            <th
                                class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                Santri</th>
                            <th
                                class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                Status</th>
                            <th
                                class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-kelas">
                        @forelse ($kelas as $item)
                            <tr class="data-row border-b border-gray-50 hover:bg-gray-50 transition-colors" data-id="{{ $item->id }}">
                                <td class="px-3 py-3">
                                    <div class="drag-handle flex items-center justify-center w-6 h-6" title="Seret untuk di urutkan">
                                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M7 4a1 1 0 100-2 1 1 0 000 2zM13 4a1 1 0 100-2 1 1 0 000 2zM7 8a1 1 0 100-2 1 1 0 000 2zM13 8a1 1 0 100-2 1 1 0 000 2zM7 12a1 1 0 100-2 1 1 0 000 2zM13 12a1 1 0 100-2 1 1 0 000 2z" />
                                        </svg>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-400 font-mono text-xs order-num">{{ $item->order }}</td>
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-gray-800">{{ $item->nama_kelas }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $item->slug }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge-kategori badge-{{ $item->kategori }} text-white px-2 py-1 rounded-xl"
                                        style="background-color: {{ $item->color }}"
                                        >{{ $item->kategori }}</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold
                            {{ $item->students_count > 0 ? 'bg-amber-400 text-white' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $item->students_count }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button class="toggle-sw {{ $item->is_active ? 'on' : 'off' }}"
                                        data-url="{{ route('master-data.kelas.toggle', $item) }}"
                                        @click="toggleStatus($event.currentTarget)">
                                    </button>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button
                                            @click="openModal('edit', {
                                id: {{ $item->id }},
                                nama_kelas: '{{ addslashes($item->nama_kelas) }}',
                                kategori: '{{ $item->kategori }}',
                                color: '{{ $item->color }}'
                            })"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg text-teal-500 hover:bg-teal-50 transition-colors" title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button
                                            @click="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama_kelas) }}')"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50 transition-colors" title="Hapus">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-gray-400 text-sm">Belum ada kelas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>

            {{-- Modal Kelas --}}
            <div x-show="modal.open" x-cloak
                class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4"
                @keydown.escape.window="closeModal()">
                <div x-show="modal.open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-sm" @click.stop>
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <h3 class="font-bold text-gray-800 text-xl"
                            x-text="modal.mode==='create' ? 'Tambah Kelas Baru' : 'Edit Kelas'"></h3>
                        <button @click="closeModal()"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100">
                            <svg
                                class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg></button>
                    </div>
                    {{-- Create --}}
                    <form x-show="modal.mode==='create'" action="{{ route('master-data.kelas.store') }}" method="POST"
                        class="px-6 py-5 space-y-4">
                        @csrf
                        @include('master-data._form-kelas')
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="closeModal()"
                                class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold">Simpan
                                Kelas</button>
                        </div>
                    </form>
                    {{-- Edit --}}
                    <template x-if="modal.mode==='edit' && modal.data">
                        <form :action="`{{ url('master-data/kelas') }}/${modal.data.id}`" method="POST"
                            class="px-6 py-5 space-y-4">
                            @csrf @method('PUT')
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Nama Kelas <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nama_kelas" :value="modal.data.nama_kelas" required
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Kategori <span
                                        class="text-red-500">*</span></label>
                                <select name="kategori" required
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                                    @foreach ($daftarKategori as $kat)
                                        <option value="{{ $kat }}"
                                            :selected="modal.data.kategori === '{{ $kat }}'">{{ $kat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Warna Label</label>
                                <div class="flex items-center gap-3">
                                    <input type="color" name="color" :value="modal.data.color"
                                        class="w-16 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                                    <span class="text-sm text-gray-400">Pilih warna identitas kelas</span>
                                </div>
                            </div>
                            <div class="flex gap-3 pt-2">
                                <button type="button" @click="closeModal()"
                                    class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                                <button type="submit"
                                    class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold">Perbarui
                                    Kelas</button>
                            </div>
                        </form>
                    </template>
                </div>
            </div>
            {{-- Hapus Kelas --}}
            <div x-show="deleteModal.open" x-cloak
                class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4">
                <div x-show="deleteModal.open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
                    <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4"><svg
                            class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg></div>
                    <h3 class="font-bold text-gray-800 mb-1">Hapus Kelas</h3>
                    <p class="text-sm text-gray-500 mb-5">Anda yakin akan menghapus kelas "<strong x-text="deleteModal.name"></strong>" 
                        secara permanen ?</p>
                    <div class="flex gap-3">
                        <button @click="deleteModal.open=false"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                        <form :action="`{{ url('master-data/kelas') }}/${deleteModal.id}`" method="POST"
                            class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold">Ya,
                                Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ════════════════════════════════════════
    TAB: KATEGORI BERITA
════════════════════════════════════════ --}}
    @elseif ($tab === 'kategori-berita')
        <div x-data="genericManager('kategori-berita')" x-init="init()">

            <div class="flex items-start justify-between mb-4 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Kategori Berita</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola kategori untuk artikel berita. Seret baris untuk
                        mengubah urutan.</p>
                </div>
                <button @click="openModal('create')"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kategori
                </button>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-100/60 h-14">
                            <th class="w-8 px-3 py-3"></th>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                Urutan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-32">
                                Slug</th>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-36">
                                Warna</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Deskripsi</th>
                            <th
                                class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                Artikel</th>
                            <th
                                class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                                Status</th>
                            <th
                                class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-kategori-berita">
                        @forelse ($kategoriBeritas as $item)
                            <tr class="data-row border-b border-gray-50 hover:bg-gray-50 transition-colors" data-id="{{ $item->id }}">
                                <td class="px-3 py-3">
                                    <div class="drag-handle flex items-center justify-center w-6 h-6" title="Seret untuk di urutkan">
                                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M7 4a1 1 0 100-2 1 1 0 000 2zM13 4a1 1 0 100-2 1 1 0 000 2zM7 8a1 1 0 100-2 1 1 0 000 2zM13 8a1 1 0 100-2 1 1 0 000 2zM7 12a1 1 0 100-2 1 1 0 000 2zM13 12a1 1 0 100-2 1 1 0 000 2z" />
                                        </svg>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $item->urutan }}</td>
                                <td class="px-4 py-3 font-semibold text-gray-800">{{ $item->nama }}</td>
                                <td class="px-4 py-3">
                                    <span class="font-mono text-xs text-gray-400">{{ $item->slug }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <span class="w-6 h-6 rounded shrink-0 border border-gray-200"
                                            style="background:{{ $item->warna }}"></span>
                                        <span class="text-xs text-gray-500">{{ $item->warna }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-400 text-xs">{{ $item->deskripsi ?? '-' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold bg-amber-400 text-white">0</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button class="toggle-sw {{ $item->is_active ? 'on' : 'off' }}"
                                        data-url="{{ route('master-data.kategori-berita.toggle', $item) }}"
                                        @click="toggleStatus($event.currentTarget)">
                                    </button>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button
                                            @click="openModal('edit', {
                                id: {{ $item->id }},
                                nama: '{{ addslashes($item->nama) }}',
                                deskripsi: '{{ addslashes($item->deskripsi ?? '') }}',
                                warna: '{{ $item->warna }}'
                            })"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg text-teal-500 hover:bg-teal-50 transition-colors" title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button
                                            @click="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama) }}')"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50 transition-colors" title="Hapus">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-12 text-center text-gray-400 text-sm">Belum ada kategori
                                    berita.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>

            {{-- Modal Kategori Berita --}}
            <div x-show="modal.open" x-cloak
                class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4"
                @keydown.escape.window="closeModal()">
                <div x-show="modal.open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-sm" @click.stop>
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <h3 class="font-bold text-gray-800 text-xl"
                            x-text="modal.mode==='create' ? 'Tambah Kategori Berita' : 'Edit Kategori Berita'"></h3>
                        <button @click="closeModal()"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100">
                            <svg
                                class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg></button>
                    </div>
                    {{-- Form CREATE --}}
                    <form x-show="modal.mode==='create'" action="{{ route('master-data.kategori-berita.store') }}"
                        method="POST" class="px-6 py-5 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Nama Kategori <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                placeholder="contoh: Pengumuman, Prestasi, Kegiatan">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Warna</label>
                            <input type="color" name="warna" value="#3b82f6"
                                class="w-16 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Deskripsi</label>
                            <textarea name="deskripsi" rows="2"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 resize-none"
                                placeholder="Opsional…"></textarea>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="closeModal()"
                                class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold">Simpan</button>
                        </div>
                    </form>
                    {{-- Form EDIT --}}
                    <form x-show="modal.mode==='edit'"
                        :action="`{{ url('master-data/kategori-berita') }}/${modal.data?.id}`" method="POST"
                        class="px-6 py-5 space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Nama Kategori <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama" :value="modal.data?.nama ?? ''" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                placeholder="contoh: Pengumuman, Prestasi, Kegiatan">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Warna</label>
                            <input type="color" name="warna" :value="modal.data?.warna ?? '#3b82f6'"
                                class="w-16 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">Deskripsi</label>
                            <textarea name="deskripsi" rows="2"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 resize-none"
                                placeholder="Opsional…" x-text="modal.data?.deskripsi??''"></textarea>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="closeModal()"
                                class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Hapus Kategori Berita --}}
            <div x-show="deleteModal.open" x-cloak
                class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4">
                <div x-show="deleteModal.open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
                    <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4"><svg
                            class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg></div>
                    <h3 class="font-bold text-gray-800 mb-1">Hapus Kategori</h3>
                    <p class="text-sm text-gray-500 mb-5">Anda yakin akan menghapus kategori berita "<strong x-text="deleteModal.name"></strong>" secara permanen ?</p>
                    <div class="flex gap-3">
                        <button @click="deleteModal.open=false"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                        <form :action="`{{ url('master-data/kategori-berita') }}/${deleteModal.id}`" method="POST"
                            class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold">Ya,
                                Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script>
        // ── kelasManager ──────────────────────────────────────────────────
        function kelasManager() {
            return {
                modal: {
                    open: false,
                    mode: 'create',
                    data: null
                },
                deleteModal: {
                    open: false,
                    id: null,
                    name: ''
                },
                openModal(mode, data = null) {
                    this.modal = {
                        open: true,
                        mode,
                        data
                    };
                },
                closeModal() {
                    this.modal.open = false;
                },
                confirmDelete(id, name) {
                    this.deleteModal = {
                        open: true,
                        id,
                        name
                    };
                },
                async toggleStatus(btn) {
                    const url = btn.dataset.url,
                        isOn = btn.classList.contains('on');
                    btn.classList.toggle('on', !isOn);
                    btn.classList.toggle('off', isOn);
                    try {
                        const res = await fetch(url, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'Accept': 'application/json'
                            }
                        });
                        if (!res.ok) throw new Error();
                    } catch {
                        btn.classList.toggle('on', isOn);
                        btn.classList.toggle('off', !isOn);
                        alert('Gagal mengubah status.');
                    }
                },
                init() {
                    const el = document.getElementById('sortable-kelas');
                    if (!el) return;
                    Sortable.create(el, {
                        handle: '.drag-handle',
                        animation: 150,
                        ghostClass: 'sortable-ghost',
                        chosenClass: 'sortable-chosen',
                        onEnd: async () => {
                            const rows = el.querySelectorAll('tr[data-id]');
                            const items = [...rows].map((r, i) => ({
                                id: parseInt(r.dataset.id),
                                order: i + 1
                            }));
                            rows.forEach((r, i) => {
                                const c = r.querySelector('.order-num');
                                if (c) c.textContent = i + 1;
                            });
                            try {
                                await fetch('{{ route('master-data.kelas.reorder') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')
                                            .content,
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        items
                                    })
                                });
                            } catch {
                                console.error('Gagal reorder.');
                            }
                        }
                    });
                }
            }
        }

        // ── genericManager ────────────────────────────────────────────────
        function genericManager(tabKey) {
            const endpointMap = {
                'bidang-ilmu': '{{ route('master-data.bidang-ilmu.reorder') }}',
                'waktu-pelajaran': '{{ route('master-data.waktu-pelajaran.reorder') }}',
                'kategori-berita': '{{ route('master-data.kategori-berita.reorder') }}',
            };
            return {
                modal: {
                    open: false,
                    mode: 'create',
                    data: null
                },
                deleteModal: {
                    open: false,
                    id: null,
                    name: ''
                },
                openModal(mode, data = null) {
                    this.modal = {
                        open: true,
                        mode,
                        data
                    };
                },
                closeModal() {
                    this.modal.open = false;
                },
                confirmDelete(id, name) {
                    this.deleteModal = {
                        open: true,
                        id,
                        name
                    };
                },
                async toggleStatus(btn) {
                    const url = btn.dataset.url,
                        isOn = btn.classList.contains('on');
                    btn.classList.toggle('on', !isOn);
                    btn.classList.toggle('off', isOn);
                    try {
                        const res = await fetch(url, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'Accept': 'application/json'
                            }
                        });
                        if (!res.ok) throw new Error();
                    } catch {
                        btn.classList.toggle('on', isOn);
                        btn.classList.toggle('off', !isOn);
                        alert('Gagal mengubah status.');
                    }
                },
                init() {
                    const el = document.getElementById(`sortable-${tabKey}`);
                    if (!el || !endpointMap[tabKey]) return;
                    Sortable.create(el, {
                        handle: '.drag-handle',
                        animation: 150,
                        ghostClass: 'sortable-ghost',
                        chosenClass: 'sortable-chosen',
                        onEnd: async () => {
                            const rows = el.querySelectorAll('tr[data-id]');
                            const items = [...rows].map((r, i) => ({
                                id: parseInt(r.dataset.id),
                                urutan: i + 1
                            }));
                            try {
                                await fetch(endpointMap[tabKey], {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')
                                            .content,
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        items
                                    })
                                });
                            } catch {
                                console.error('Gagal reorder.');
                            }
                        }
                    });
                }
            }
        }
    </script>
@endpush
