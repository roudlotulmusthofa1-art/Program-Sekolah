@extends('layouts.app')

@section('title', 'Master Data')

@push('styles')
<style>
    /* ── Tab Pills ── */
    .tab-btn {
        @apply px-5 py-2 rounded-lg text-sm font-medium transition-all duration-200;
    }
    .tab-btn.active {
        @apply bg-white text-teal-700 shadow-sm font-semibold;
    }
    .tab-btn:not(.active) {
        @apply text-gray-500 hover:text-gray-700 hover:bg-white/60;
    }

    /* ── Drag Handle ── */
    .drag-handle {
        cursor: grab;
        color: #cbd5e1;
        transition: color .15s;
    }
    .drag-handle:hover { color: #64748b; }
    .drag-handle:active { cursor: grabbing; }

    /* ── Sortable ghost ── */
    .sortable-ghost {
        opacity: .4;
        background: #f0fdf4;
        border: 2px dashed #14b8a6;
        border-radius: 0.5rem;
    }
    .sortable-chosen { box-shadow: 0 4px 20px rgba(0,0,0,.12); }

    /* ── Badge kategori ── */
    .badge-kategori {
        @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
    }
    .badge-Akademik    { @apply bg-blue-100   text-blue-700; }
    .badge-Tahfidz     { @apply bg-teal-100   text-teal-700; }
    .badge-Takhassus   { @apply bg-purple-100 text-purple-700; }
    .badge-Lainnya     { @apply bg-gray-100   text-gray-600; }

    /* ── Toggle Switch ── */
    .toggle-switch {
        width: 36px; height: 20px;
        border-radius: 9999px;
        position: relative;
        cursor: pointer;
        transition: background .2s;
        border: none; outline: none;
        flex-shrink: 0;
    }
    .toggle-switch::after {
        content: '';
        position: absolute;
        top: 3px; left: 3px;
        width: 14px; height: 14px;
        border-radius: 9999px;
        background: white;
        transition: transform .2s;
    }
    .toggle-switch.on  { background: #14b8a6; }
    .toggle-switch.off { background: #cbd5e1; }
    .toggle-switch.on::after  { transform: translateX(16px); }
    .toggle-switch.off::after { transform: translateX(0); }

    /* ── Modal Backdrop ── */
    .modal-backdrop {
        backdrop-filter: blur(3px);
        background: rgba(0,0,0,.35);
    }

    /* ── Row hover ── */
    .data-row:hover { background-color: #f8fafc; }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════════════════════════════
    PAGE HEADER
══════════════════════════════════════════════════════════════ --}}
<div class="mb-6">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-1.5 text-sm text-gray-500 mb-3">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-700 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            </svg>
        </a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-700 font-medium">Master Data</span>
    </nav>

    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center">
            <svg class="w-5 h-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4
                       M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
            </svg>
        </div>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Master Data</h1>
            <p class="text-sm text-gray-500">Kelola data referensi dan kategori sistem</p>
        </div>
    </div>
</div>

{{-- ── Flash Messages ── --}}
@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="mb-4 flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm">
        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
        class="mb-4 flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        {{ session('error') }}
    </div>
@endif

{{-- ══════════════════════════════════════════════════════════════
    TAB NAVIGATION
══════════════════════════════════════════════════════════════ --}}
<div class="bg-gray-100/80 rounded-xl p-1 inline-flex gap-1 mb-6">
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
</div>

{{-- ══════════════════════════════════════════════════════════════
    TAB: KELAS
══════════════════════════════════════════════════════════════ --}}
@if ($tab === 'kelas')
<div x-data="kelasManager()" x-init="init()">

    {{-- Panel Header --}}
    <div class="flex items-start justify-between mb-4">
        <div>
            <h2 class="text-base font-bold text-gray-800">Kelas / Tingkatan</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola kelas dan tingkatan santri. Seret baris untuk mengubah urutan.</p>
        </div>
        <button @click="openModal('create')"
            class="inline-flex items-center gap-2 px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kelas
        </button>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/60">
                    <th class="w-8 px-4 py-3"></th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">Urutan</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Label</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">Santri</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-28">Aksi</th>
                </tr>
            </thead>
            <tbody id="sortable-kelas">
                @forelse ($kelas as $item)
                <tr class="data-row border-b border-gray-50 transition-colors" data-id="{{ $item->id }}">
                    {{-- Drag Handle --}}
                    <td class="px-3 py-3">
                        <div class="drag-handle flex items-center justify-center w-6 h-6">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 4a1 1 0 100-2 1 1 0 000 2zM13 4a1 1 0 100-2 1 1 0 000 2zM7 8a1 1 0 100-2 1 1 0 000 2zM13 8a1 1 0 100-2 1 1 0 000 2zM7 12a1 1 0 100-2 1 1 0 000 2zM13 12a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                        </div>
                    </td>
                    {{-- Urutan --}}
                    <td class="px-4 py-3 text-gray-400 font-mono text-xs order-num">{{ $item->order }}</td>
                    {{-- Label --}}
                    <td class="px-4 py-3">
                        <p class="font-semibold text-gray-800">{{ $item->nama_kelas }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $item->slug }}</p>
                    </td>
                    {{-- Kategori --}}
                    <td class="px-4 py-3">
                        <span class="badge-kategori badge-{{ $item->kategori }}">
                            {{ $item->kategori }}
                        </span>
                    </td>
                    {{-- Santri Count --}}
                    <td class="px-4 py-3 text-center">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold
                            {{ $item->students_count > 0 ? 'bg-amber-400 text-white' : 'bg-gray-100 text-gray-500' }}">
                            {{ $item->students_count }}
                        </span>
                    </td>
                    {{-- Toggle Status --}}
                    <td class="px-4 py-3 text-center">
                        <button
                            class="toggle-switch {{ $item->is_active ? 'on' : 'off' }}"
                            data-id="{{ $item->id }}"
                            data-url="{{ route('master-data.kelas.toggle', $item) }}"
                            @click="toggleStatus($event.currentTarget, 'kelas')">
                        </button>
                    </td>
                    {{-- Aksi --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            {{-- Edit --}}
                            <button
                                @click="openModal('edit', {
                                    id: {{ $item->id }},
                                    nama_kelas: '{{ addslashes($item->nama_kelas) }}',
                                    kategori: '{{ $item->kategori }}',
                                    color: '{{ $item->color }}'
                                })"
                                class="w-8 h-8 flex items-center justify-center rounded-lg text-teal-600 hover:bg-teal-50 transition-colors"
                                title="Edit">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            {{-- Hapus --}}
                            <button
                                @click="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama_kelas) }}', 'kelas')"
                                class="w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50 transition-colors"
                                title="Hapus">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-gray-400">
                        <svg class="w-10 h-10 mx-auto mb-2 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Belum ada kelas. Tambah kelas pertama.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── MODAL TAMBAH / EDIT KELAS ── --}}
    <div x-show="modal.open" x-cloak
        class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4"
        @keydown.escape.window="closeModal()">
        <div x-show="modal.open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md"
            @click.stop>

            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800" x-text="modal.mode === 'create' ? 'Tambah Kelas Baru' : 'Edit Kelas'"></h3>
                <button @click="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Form Create --}}
            <form x-show="modal.mode === 'create'"
                action="{{ route('master-data.kelas.store') }}" method="POST"
                class="px-6 py-5 space-y-4">
                @csrf
                @include('master-data._form-kelas')
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="closeModal()"
                        class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold transition-colors">
                        Simpan Kelas
                    </button>
                </div>
            </form>

            {{-- Form Edit --}}
            <template x-if="modal.mode === 'edit' && modal.data">
                <form :action="`{{ url('master-data/kelas') }}/${modal.data.id}`" method="POST"
                    class="px-6 py-5 space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kelas" :value="modal.data.nama_kelas" required
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" required
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                            @foreach ($daftarKategori as $kat)
                            <option value="{{ $kat }}" :selected="modal.data.kategori === '{{ $kat }}'">{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Warna Label</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="color" :value="modal.data.color"
                                class="w-10 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                            <span class="text-xs text-gray-400">Pilih warna untuk label kelas</span>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="closeModal()"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold transition-colors">
                            Perbarui Kelas
                        </button>
                    </div>
                </form>
            </template>
        </div>
    </div>

    {{-- ── MODAL KONFIRMASI HAPUS ── --}}
    <div x-show="deleteModal.open" x-cloak
        class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4">
        <div x-show="deleteModal.open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-800 mb-1">Hapus Kelas?</h3>
            <p class="text-sm text-gray-500 mb-5">
                Kelas <strong x-text="deleteModal.name"></strong> akan dihapus permanen dan tidak bisa dikembalikan.
            </p>
            <div class="flex gap-3">
                <button @click="deleteModal.open = false"
                    class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <form :action="`{{ url('master-data/kelas') }}/${deleteModal.id}`" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold transition-colors">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>{{-- end x-data kelasManager --}}

{{-- ══════════════════════════════════════════════════════════════
    TAB: BIDANG ILMU
══════════════════════════════════════════════════════════════ --}}
@elseif ($tab === 'bidang-ilmu')
<div x-data="genericManager('bidang-ilmu')">

    <div class="flex items-start justify-between mb-4">
        <div>
            <h2 class="text-base font-bold text-gray-800">Bidang Ilmu</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola daftar mata pelajaran dan bidang studi. Seret untuk mengubah urutan.</p>
        </div>
        <button @click="openModal('create')"
            class="inline-flex items-center gap-2 px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Bidang Ilmu
        </button>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/60">
                    <th class="w-8 px-4 py-3"></th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Kode</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-28">Aksi</th>
                </tr>
            </thead>
            <tbody id="sortable-bidang-ilmu">
                @forelse ($bidangIlmu as $item)
                <tr class="data-row border-b border-gray-50 transition-colors" data-id="{{ $item->id }}">
                    <td class="px-3 py-3">
                        <div class="drag-handle flex items-center justify-center w-6 h-6">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 4a1 1 0 100-2 1 1 0 000 2zM13 4a1 1 0 100-2 1 1 0 000 2zM7 8a1 1 0 100-2 1 1 0 000 2zM13 8a1 1 0 100-2 1 1 0 000 2zM7 12a1 1 0 100-2 1 1 0 000 2zM13 12a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $item->urutan }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full shrink-0" style="background:{{ $item->warna }}"></span>
                            <span class="font-semibold text-gray-800">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        @if ($item->kode)
                        <span class="inline-flex px-2 py-0.5 rounded bg-gray-100 text-gray-600 font-mono text-xs">{{ $item->kode }}</span>
                        @else
                        <span class="text-gray-300 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500 text-xs max-w-xs truncate">{{ $item->deskripsi ?? '—' }}</td>
                    <td class="px-4 py-3 text-center">
                        <button
                            class="toggle-switch {{ $item->is_active ? 'on' : 'off' }}"
                            data-id="{{ $item->id }}"
                            data-url="{{ route('master-data.bidang-ilmu.toggle', $item) }}"
                            @click="toggleStatus($event.currentTarget)">
                        </button>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <button @click="openModal('edit', {
                                    id: {{ $item->id }},
                                    nama: '{{ addslashes($item->nama) }}',
                                    kode: '{{ $item->kode }}',
                                    deskripsi: '{{ addslashes($item->deskripsi ?? '') }}',
                                    warna: '{{ $item->warna }}'
                                })"
                                class="w-8 h-8 flex items-center justify-center rounded-lg text-teal-600 hover:bg-teal-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button @click="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama) }}')"
                                class="w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-4 py-12 text-center text-gray-400">Belum ada bidang ilmu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Bidang Ilmu --}}
    <div x-show="modal.open" x-cloak class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4" @keydown.escape.window="closeModal()">
        <div x-show="modal.open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md" @click.stop>
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800" x-text="modal.mode === 'create' ? 'Tambah Bidang Ilmu' : 'Edit Bidang Ilmu'"></h3>
                <button @click="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <template x-if="modal.open">
                <form :action="modal.mode === 'create' ? '{{ route('master-data.bidang-ilmu.store') }}' : `{{ url('master-data/bidang-ilmu') }}/${modal.data?.id}`"
                    method="POST" class="px-6 py-5 space-y-4">
                    @csrf
                    <input x-show="modal.mode === 'edit'" type="hidden" name="_method" value="PUT">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Bidang Ilmu <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" :value="modal.data?.nama ?? ''" required
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                            placeholder="cth: Fiqih, Nahwu, Matematika">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kode</label>
                            <input type="text" name="kode" :value="modal.data?.kode ?? ''"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                                placeholder="cth: FQH">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Warna</label>
                            <input type="color" name="warna" :value="modal.data?.warna ?? '#3b82f6'"
                                class="w-full h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi</label>
                        <textarea name="deskripsi" rows="2"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 resize-none"
                            placeholder="Opsional..." x-text="modal.data?.deskripsi ?? ''"></textarea>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="closeModal()"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold transition-colors"
                            x-text="modal.mode === 'create' ? 'Simpan' : 'Perbarui'"></button>
                    </div>
                </form>
            </template>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div x-show="deleteModal.open" x-cloak class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4">
        <div x-show="deleteModal.open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-800 mb-1">Hapus Bidang Ilmu?</h3>
            <p class="text-sm text-gray-500 mb-5">
                <strong x-text="deleteModal.name"></strong> akan dihapus permanen.
            </p>
            <div class="flex gap-3">
                <button @click="deleteModal.open = false"
                    class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                <form :action="`{{ url('master-data/bidang-ilmu') }}/${deleteModal.id}`" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold transition-colors">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

</div>

{{-- ══════════════════════════════════════════════════════════════
    TAB: WAKTU PELAJARAN
══════════════════════════════════════════════════════════════ --}}
@elseif ($tab === 'waktu-pelajaran')
<div x-data="genericManager('waktu-pelajaran')">

    <div class="flex items-start justify-between mb-4">
        <div>
            <h2 class="text-base font-bold text-gray-800">Waktu Pelajaran</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola jadwal jam pelajaran. Seret untuk mengubah urutan.</p>
        </div>
        <button @click="openModal('create')"
            class="inline-flex items-center gap-2 px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Waktu
        </button>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/60">
                    <th class="w-8 px-4 py-3"></th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Kode</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jam</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-28">Aksi</th>
                </tr>
            </thead>
            <tbody id="sortable-waktu-pelajaran">
                @forelse ($waktuPelajaran as $item)
                <tr class="data-row border-b border-gray-50 transition-colors" data-id="{{ $item->id }}">
                    <td class="px-3 py-3">
                        <div class="drag-handle flex items-center justify-center w-6 h-6">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 4a1 1 0 100-2 1 1 0 000 2zM13 4a1 1 0 100-2 1 1 0 000 2zM7 8a1 1 0 100-2 1 1 0 000 2zM13 8a1 1 0 100-2 1 1 0 000 2zM7 12a1 1 0 100-2 1 1 0 000 2zM13 12a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $item->urutan }}</td>
                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $item->nama }}</td>
                    <td class="px-4 py-3">
                        @if ($item->kode)
                        <span class="inline-flex px-2 py-0.5 rounded bg-gray-100 text-gray-600 font-mono text-xs">{{ $item->kode }}</span>
                        @else<span class="text-gray-300 text-xs">—</span>@endif
                    </td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center gap-1.5 text-gray-600">
                            <svg class="w-3.5 h-3.5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-mono text-xs">{{ $item->jam_mulai }} – {{ $item->jam_selesai }}</span>
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <button class="toggle-switch {{ $item->is_active ? 'on' : 'off' }}"
                            data-id="{{ $item->id }}"
                            data-url="{{ route('master-data.waktu-pelajaran.toggle', $item) }}"
                            @click="toggleStatus($event.currentTarget)">
                        </button>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <button @click="openModal('edit', {
                                    id: {{ $item->id }},
                                    nama: '{{ addslashes($item->nama) }}',
                                    kode: '{{ $item->kode }}',
                                    jam_mulai: '{{ $item->jam_mulai }}',
                                    jam_selesai: '{{ $item->jam_selesai }}'
                                })"
                                class="w-8 h-8 flex items-center justify-center rounded-lg text-teal-600 hover:bg-teal-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button @click="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama) }}')"
                                class="w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-4 py-12 text-center text-gray-400">Belum ada waktu pelajaran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Waktu Pelajaran --}}
    <div x-show="modal.open" x-cloak class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4" @keydown.escape.window="closeModal()">
        <div x-show="modal.open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md" @click.stop>
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800" x-text="modal.mode === 'create' ? 'Tambah Waktu Pelajaran' : 'Edit Waktu Pelajaran'"></h3>
                <button @click="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <template x-if="modal.open">
                <form :action="modal.mode === 'create' ? '{{ route('master-data.waktu-pelajaran.store') }}' : `{{ url('master-data/waktu-pelajaran') }}/${modal.data?.id}`"
                    method="POST" class="px-6 py-5 space-y-4">
                    @csrf
                    <input x-show="modal.mode === 'edit'" type="hidden" name="_method" value="PUT">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" :value="modal.data?.nama ?? ''" required
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                            placeholder="cth: Pelajaran ke-1">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kode</label>
                        <input type="text" name="kode" :value="modal.data?.kode ?? ''"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                            placeholder="cth: P1">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Jam Mulai <span class="text-red-500">*</span></label>
                            <input type="time" name="jam_mulai" :value="modal.data?.jam_mulai ?? ''" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Jam Selesai <span class="text-red-500">*</span></label>
                            <input type="time" name="jam_selesai" :value="modal.data?.jam_selesai ?? ''" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="closeModal()"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold transition-colors"
                            x-text="modal.mode === 'create' ? 'Simpan' : 'Perbarui'"></button>
                    </div>
                </form>
            </template>
        </div>
    </div>

    {{-- Modal Hapus Waktu --}}
    <div x-show="deleteModal.open" x-cloak class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4">
        <div x-show="deleteModal.open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-800 mb-1">Hapus Waktu Pelajaran?</h3>
            <p class="text-sm text-gray-500 mb-5"><strong x-text="deleteModal.name"></strong> akan dihapus permanen.</p>
            <div class="flex gap-3">
                <button @click="deleteModal.open = false" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                <form :action="`{{ url('master-data/waktu-pelajaran') }}/${deleteModal.id}`" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold transition-colors">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

</div>

{{-- ══════════════════════════════════════════════════════════════
    TAB: KATEGORI BERITA
══════════════════════════════════════════════════════════════ --}}
@elseif ($tab === 'kategori-berita')
<div x-data="genericManager('kategori-berita')">

    <div class="flex items-start justify-between mb-4">
        <div>
            <h2 class="text-base font-bold text-gray-800">Kategori Berita</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola kategori konten berita dan pengumuman.</p>
        </div>
        <button @click="openModal('create')"
            class="inline-flex items-center gap-2 px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kategori
        </button>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/60">
                    <th class="w-8 px-4 py-3"></th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-28">Aksi</th>
                </tr>
            </thead>
            <tbody id="sortable-kategori-berita">
                @forelse ($kategoriBeritas as $item)
                <tr class="data-row border-b border-gray-50 transition-colors" data-id="{{ $item->id }}">
                    <td class="px-3 py-3">
                        <div class="drag-handle flex items-center justify-center w-6 h-6">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 4a1 1 0 100-2 1 1 0 000 2zM13 4a1 1 0 100-2 1 1 0 000 2zM7 8a1 1 0 100-2 1 1 0 000 2zM13 8a1 1 0 100-2 1 1 0 000 2zM7 12a1 1 0 100-2 1 1 0 000 2zM13 12a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $item->urutan }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full shrink-0" style="background:{{ $item->warna }}"></span>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $item->nama }}</p>
                                <p class="text-xs text-gray-400">{{ $item->slug }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-500 text-xs max-w-xs truncate">{{ $item->deskripsi ?? '—' }}</td>
                    <td class="px-4 py-3 text-center">
                        <button class="toggle-switch {{ $item->is_active ? 'on' : 'off' }}"
                            data-id="{{ $item->id }}"
                            data-url="{{ route('master-data.kategori-berita.toggle', $item) }}"
                            @click="toggleStatus($event.currentTarget)">
                        </button>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <button @click="openModal('edit', {
                                    id: {{ $item->id }},
                                    nama: '{{ addslashes($item->nama) }}',
                                    deskripsi: '{{ addslashes($item->deskripsi ?? '') }}',
                                    warna: '{{ $item->warna }}'
                                })"
                                class="w-8 h-8 flex items-center justify-center rounded-lg text-teal-600 hover:bg-teal-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button @click="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama) }}')"
                                class="w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-4 py-12 text-center text-gray-400">Belum ada kategori berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Kategori Berita --}}
    <div x-show="modal.open" x-cloak class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4" @keydown.escape.window="closeModal()">
        <div x-show="modal.open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md" @click.stop>
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800" x-text="modal.mode === 'create' ? 'Tambah Kategori Berita' : 'Edit Kategori Berita'"></h3>
                <button @click="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <template x-if="modal.open">
                <form :action="modal.mode === 'create' ? '{{ route('master-data.kategori-berita.store') }}' : `{{ url('master-data/kategori-berita') }}/${modal.data?.id}`"
                    method="POST" class="px-6 py-5 space-y-4">
                    @csrf
                    <input x-show="modal.mode === 'edit'" type="hidden" name="_method" value="PUT">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" :value="modal.data?.nama ?? ''" required
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
                            placeholder="cth: Pengumuman, Prestasi">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Warna</label>
                        <input type="color" name="warna" :value="modal.data?.warna ?? '#3b82f6'"
                            class="w-full h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi</label>
                        <textarea name="deskripsi" rows="2"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 resize-none"
                            placeholder="Opsional..." x-text="modal.data?.deskripsi ?? ''"></textarea>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="closeModal()"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-lg text-sm font-semibold transition-colors"
                            x-text="modal.mode === 'create' ? 'Simpan' : 'Perbarui'"></button>
                    </div>
                </form>
            </template>
        </div>
    </div>

    {{-- Modal Hapus Kategori Berita --}}
    <div x-show="deleteModal.open" x-cloak class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4">
        <div x-show="deleteModal.open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-800 mb-1">Hapus Kategori?</h3>
            <p class="text-sm text-gray-500 mb-5"><strong x-text="deleteModal.name"></strong> akan dihapus permanen.</p>
            <div class="flex gap-3">
                <button @click="deleteModal.open = false" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">Batal</button>
                <form :action="`{{ url('master-data/kategori-berita') }}/${deleteModal.id}`" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold transition-colors">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endif

@endsection

{{-- ══════════════════════════════════════════════════════════════
    SCRIPTS
══════════════════════════════════════════════════════════════ --}}
@push('scripts')
{{-- SortableJS CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>
// ─────────────────────────────────────────────────────────────────
// Alpine Component: kelasManager (tab Kelas)
// ─────────────────────────────────────────────────────────────────
function kelasManager() {
    return {
        modal: { open: false, mode: 'create', data: null },
        deleteModal: { open: false, id: null, name: '' },

        openModal(mode, data = null) {
            this.modal = { open: true, mode, data };
        },
        closeModal() {
            this.modal.open = false;
        },
        confirmDelete(id, name) {
            this.deleteModal = { open: true, id, name };
        },

        async toggleStatus(btn) {
            const url  = btn.dataset.url;
            const isOn = btn.classList.contains('on');

            // Optimistic UI
            btn.classList.toggle('on',  !isOn);
            btn.classList.toggle('off',  isOn);

            try {
                const res = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json',
                    }
                });
                if (!res.ok) throw new Error();
            } catch {
                // Rollback jika gagal
                btn.classList.toggle('on',  isOn);
                btn.classList.toggle('off', !isOn);
                alert('Gagal mengubah status. Coba lagi.');
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
                    // Kumpulkan urutan baru
                    const rows  = el.querySelectorAll('tr[data-id]');
                    const items = [...rows].map((row, idx) => ({
                        id: parseInt(row.dataset.id),
                        order: idx + 1,
                    }));

                    // Update nomor urut di UI
                    rows.forEach((row, idx) => {
                        const cell = row.querySelector('.order-num');
                        if (cell) cell.textContent = idx + 1;
                    });

                    // Kirim ke server
                    try {
                        await fetch('{{ route('master-data.kelas.reorder') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ items }),
                        });
                    } catch {
                        console.error('Gagal menyimpan urutan.');
                    }
                }
            });
        }
    }
}

// ─────────────────────────────────────────────────────────────────
// Alpine Component: genericManager (untuk tab selain Kelas)
// ─────────────────────────────────────────────────────────────────
function genericManager(tabKey) {
    return {
        modal: { open: false, mode: 'create', data: null },
        deleteModal: { open: false, id: null, name: '' },

        openModal(mode, data = null) {
            this.modal = { open: true, mode, data };
        },
        closeModal() {
            this.modal.open = false;
        },
        confirmDelete(id, name) {
            this.deleteModal = { open: true, id, name };
        },

        async toggleStatus(btn) {
            const url  = btn.dataset.url;
            const isOn = btn.classList.contains('on');

            btn.classList.toggle('on',  !isOn);
            btn.classList.toggle('off',  isOn);

            try {
                const res = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json',
                    }
                });
                if (!res.ok) throw new Error();
            } catch {
                btn.classList.toggle('on',  isOn);
                btn.classList.toggle('off', !isOn);
                alert('Gagal mengubah status.');
            }
        },

        init() {
            // Mapping tabKey ke ID sortable & endpoint reorder
            const endpointMap = {
                'bidang-ilmu'     : '{{ route('master-data.bidang-ilmu.reorder') }}',
                'waktu-pelajaran' : '{{ route('master-data.waktu-pelajaran.reorder') }}',
                'kategori-berita' : '{{ route('master-data.kategori-berita.reorder') }}',
            };

            const el = document.getElementById(`sortable-${tabKey}`);
            if (!el || !endpointMap[tabKey]) return;

            Sortable.create(el, {
                handle: '.drag-handle',
                animation: 150,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                onEnd: async () => {
                    const rows  = el.querySelectorAll('tr[data-id]');
                    const items = [...rows].map((row, idx) => ({
                        id: parseInt(row.dataset.id),
                        urutan: idx + 1,
                    }));

                    try {
                        await fetch(endpointMap[tabKey], {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ items }),
                        });
                    } catch {
                        console.error('Gagal menyimpan urutan.');
                    }
                }
            });
        }
    }
}
</script>
@endpush