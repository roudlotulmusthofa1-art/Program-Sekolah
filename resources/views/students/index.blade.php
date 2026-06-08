@extends('layouts.app')

@section('title', 'Data Siswa')

@push('styles')
<style>
    .class-card { transition: all 0.18s ease; cursor: pointer; }
    .class-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.09); }
    .class-card.active { box-shadow: 0 0 0 2px #1a6b5a, 0 4px 16px rgba(26,107,90,0.15); }
    .class-icon { width: 40px; height: 40px; border-radius: 10px; display:flex; align-items:center; justify-content:center; }
    .table-row { transition: background 0.12s; }
    .table-row:hover { background: #f8fffe; }
    @keyframes fadeSlide {
        from { opacity:0; transform:translateY(10px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .fade-in { animation: fadeSlide 0.3s ease forwards; }
    .badge-class {
        display: inline-flex; align-items: center;
        padding: 3px 10px; border-radius: 6px;
        font-size: 11px; font-weight: 700;
        color: #fff; white-space: nowrap;
    }
    .checkbox-custom {
        width: 18px; height: 18px; border: 2px solid #d1d5db;
        border-radius: 50%; cursor: pointer; appearance: none;
        transition: all 0.15s;
    }
    .checkbox-custom:checked {
        background: #1a6b5a; border-color: #1a6b5a;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 10 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 4l2.5 2.5L9 1' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: center; background-size: 10px;
    }
    .avatar-ring { border: 2px solid #e5f7f3; }
</style>
@endpush

@section('content')
<div x-data="studentsPage()" x-init="init()">

{{-- ── Breadcrumb ──────────────────────────────────────────────────── --}}
<nav class="flex items-center gap-2 text-sm text-gray-500 mb-4">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-1 hover:text-ribath-primary transition-colors">
        <i data-lucide="home" class="w-3.5 h-3.5"></i>
        Beranda
    </a>
    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
    <span class="text-gray-800 font-medium">Data Siswa</span>
</nav>

{{-- ── Alert: Siswa Tanpa Skema Biaya ─────────────────────────────── --}}
@if($studentsWithoutFee > 0)
<div class="flex items-start gap-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 mb-5 fade-in">
    <i data-lucide="alert-triangle" class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5"></i>
    <div>
        <p class="text-sm font-semibold text-amber-700">
            {{ $studentsWithoutFee }} siswa belum memiliki skema biaya
        </p>
        <p class="text-xs text-amber-600 mt-0.5">
            Buka detail siswa lalu klik tab "Biaya" untuk mengatur tarif locked.
        </p>
    </div>
    <button onclick="this.parentElement.remove()" class="ml-auto text-amber-400 hover:text-amber-600">
        <i data-lucide="x" class="w-4 h-4"></i>
    </button>
</div>
@endif

{{-- ── Header Banner ───────────────────────────────────────────────── --}}
<div class="rounded-2xl mb-6 px-6 py-5 flex flex-col sm:flex-row sm:items-center gap-4 fade-in"
     style="background: linear-gradient(135deg, #1a6b5a 0%, #134d40 100%);">
    <div>
        <h1 class="text-xl font-bold text-white">Data Siswa</h1>
        <p class="text-white/70 text-sm mt-0.5">
            Total {{ $classes->sum('total_aktif') }} Siswa
        </p>
    </div>
    <div class="sm:ml-auto flex flex-wrap items-center gap-2">
        {{-- Kelola Massal --}}
        <button @click="massalMode = !massalMode"
                :class="massalMode ? 'bg-purple-600 text-white' : 'bg-white/15 text-white hover:bg-white/25'"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-all">
            <i data-lucide="edit-3" class="w-4 h-4"></i>
            Kelola Massal
        </button>

        {{-- Tambah Detail --}}
        <a href="{{ route('students.create') }}"
           class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition-colors">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Siswa (Mode Detail)
        </a>

        {{-- Tambah Cepat --}}
        <button @click="showQuickAdd = true"
                class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-semibold transition-colors">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Cepat
        </button>
    </div>
</div>

{{-- ── Grid Kelas ──────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 mb-6">
    @foreach($classes as $class)
    <a href="{{ route('students.index', ['class' => $class->slug]) }}"
       class="class-card bg-white rounded-xl p-4 border border-gray-100 fade-in
              {{ isset($selectedClass) && $selectedClass->id === $class->id ? 'active' : '' }}">
        <div class="class-icon mb-3" style="background-color: {{ $class->color }}1a;">
            <i data-lucide="graduation-cap" class="w-5 h-5" style="color: {{ $class->color }};"></i>
        </div>
        <p class="text-xs text-gray-500 mb-0.5">{{ $class->name }}</p>
        <p class="text-xl font-bold text-gray-800">{{ $class->total_aktif }}</p>
    </a>
    @endforeach
</div>

{{-- ── Tabel Siswa (muncul saat kelas dipilih) ────────────────────── --}}
@if($selectedClass)
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden fade-in">

    {{-- Search + Filter Bar --}}
    <div class="px-5 py-4 border-b border-gray-100 flex flex-col sm:flex-row gap-3">
        <form method="GET" action="{{ route('students.index') }}" class="flex gap-3 flex-1">
            <input type="hidden" name="class" value="{{ $selectedClass->slug }}">

            {{-- Search --}}
            <div class="relative flex-1">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                <input type="text" name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari siswa (nama, tempat lahir, alamat)..."
                       class="w-full pl-9 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl
                              focus:outline-none focus:ring-2 focus:ring-ribath-primary/20 focus:border-ribath-primary transition-all">
            </div>

            {{-- Filter Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button type="button" @click="open = !open"
                        class="flex items-center gap-2 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl
                               text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                    Filter
                    <i data-lucide="chevron-down" class="w-3 h-3"></i>
                </button>
                <div x-show="open" @click.outside="open = false" x-cloak
                     class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg z-10 p-2">
                    <p class="text-xs font-semibold text-gray-400 px-2 py-1 uppercase tracking-wider">Status</p>
                    @foreach(['aktif' => 'Aktif', 'nonaktif' => 'Non-Aktif', 'alumni' => 'Alumni', 'keluar' => 'Keluar'] as $val => $label)
                    <a href="{{ route('students.index', ['class' => $selectedClass->slug, 'status' => $val, 'search' => request('search')]) }}"
                       class="flex items-center gap-2 px-2 py-1.5 text-sm rounded-lg hover:bg-gray-50
                              {{ request('status') === $val ? 'text-ribath-primary font-semibold' : 'text-gray-700' }}">
                        <span class="w-2 h-2 rounded-full
                            {{ $val === 'aktif' ? 'bg-green-500' :
                               ($val === 'nonaktif' ? 'bg-gray-400' :
                               ($val === 'alumni' ? 'bg-blue-500' : 'bg-red-500')) }}">
                        </span>
                        {{ $label }}
                    </a>
                    @endforeach
                    @if(request('status'))
                    <a href="{{ route('students.index', ['class' => $selectedClass->slug]) }}"
                       class="block px-2 py-1.5 text-xs text-gray-400 hover:text-red-500 mt-1 border-t border-gray-100 pt-2">
                        Hapus filter
                    </a>
                    @endif
                </div>
            </div>

            <button type="submit"
                    class="px-4 py-2.5 bg-ribath-primary text-white rounded-xl text-sm font-medium hover:bg-ribath-dark transition-colors">
                Cari
            </button>
        </form>

        {{-- Tombol Hapus Massal --}}
        <div x-show="massalMode && selectedIds.length > 0" x-cloak>
            <form method="POST" action="{{ route('students.bulkDestroy') }}"
                  @submit.prevent="confirmBulkDelete($el)">
                @csrf
                <template x-for="id in selectedIds" :key="id">
                    <input type="hidden" name="ids[]" :value="id">
                </template>
                <button type="submit"
                        class="flex items-center gap-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-xl text-sm font-semibold transition-colors">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    Hapus (<span x-text="selectedIds.length"></span>)
                </button>
            </form>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/50">
                    <th class="px-4 py-3 text-left w-10">
                        <input type="checkbox" class="checkbox-custom"
                               x-show="massalMode" x-cloak
                               @change="toggleAll($event.target.checked)">
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-12">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Masuk</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Wali</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($students as $s)
                <tr class="table-row">
                    {{-- Checkbox --}}
                    <td class="px-4 py-3">
                        <input type="checkbox" class="checkbox-custom"
                               x-show="massalMode" x-cloak
                               :value="{{ $s->id }}"
                               @change="toggleOne({{ $s->id }}, $event.target.checked)">
                    </td>

                    {{-- No --}}
                    <td class="px-4 py-3 text-gray-500 font-medium">
                        {{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}
                    </td>

                    {{-- Nama + Foto --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full overflow-hidden flex-shrink-0 avatar-ring">
                                @if($s->photo)
                                    <img src="{{ asset('storage/' . $s->photo) }}"
                                         alt="{{ $s->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"
                                         style="background-color: {{ $s->schoolClass->color ?? '#14b8a6' }}20;">
                                        <i data-lucide="user" class="w-4 h-4"
                                           style="color: {{ $s->schoolClass->color ?? '#14b8a6' }};"></i>
                                    </div>
                                @endif
                            </div>
                            <span class="font-medium text-gray-800">{{ $s->name }}</span>
                        </div>
                    </td>

                    {{-- Kelas Badge --}}
                    <td class="px-4 py-3">
                        <span class="badge-class"
                              style="background-color: {{ $s->schoolClass->color ?? '#14b8a6' }};">
                            {{ $s->schoolClass->name ?? '-' }}
                        </span>
                    </td>

                    {{-- Tanggal Masuk --}}
                    <td class="px-4 py-3 text-gray-600">
                        {{ $s->entry_date ? $s->entry_date->translatedFormat('d M Y') : '-' }}
                    </td>

                    {{-- Wali --}}
                    <td class="px-4 py-3 text-gray-600">
                        {{ $s->guardian?->name ?? '-' }}
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-3">
                        @php
                            $statusStyle = match($s->status) {
                                'aktif'    => 'color:#16a34a; background:#dcfce7; border:1px solid #bbf7d0;',
                                'nonaktif' => 'color:#6b7280; background:#f3f4f6; border:1px solid #e5e7eb;',
                                'alumni'   => 'color:#2563eb; background:#dbeafe; border:1px solid #bfdbfe;',
                                'keluar'   => 'color:#dc2626; background:#fee2e2; border:1px solid #fecaca;',
                                default    => '',
                            };
                        @endphp
                        <span class="text-xs font-semibold px-3 py-1 rounded-md"
                              style="{{ $statusStyle }}">
                            {{ $s->status }}
                        </span>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('students.show', $s) }}"
                               class="text-teal-600 hover:text-teal-800 transition-colors" title="Lihat Detail">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <form method="POST" action="{{ route('students.destroy', $s) }}"
                                  onsubmit="return confirm('Yakin hapus data {{ addslashes($s->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="text-red-400 hover:text-red-600 transition-colors" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <i data-lucide="users" class="w-12 h-12 opacity-30"></i>
                            <p class="text-sm font-medium">Belum ada data siswa di kelas ini</p>
                            <a href="{{ route('students.create') }}"
                               class="text-ribath-primary text-sm font-semibold hover:underline">
                                + Tambah siswa sekarang
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($students->hasPages())
    <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between">
        <p class="text-xs text-gray-500">
            Menampilkan {{ $students->firstItem() }}–{{ $students->lastItem() }}
            dari {{ $students->total() }} siswa
        </p>
        {{ $students->links('pagination::tailwind') }}
    </div>
    @endif
</div>

@else
<div class="bg-white rounded-2xl border border-dashed border-gray-200 py-20 text-center fade-in">
    <i data-lucide="mouse-pointer-click" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
    <p class="text-gray-500 font-medium">Pilih kelas di atas untuk melihat daftar siswa</p>
</div>
@endif

{{-- ═══════════════════════════════════════════════════════
     MODAL: Tambah Cepat
════════════════════════════════════════════════════════ --}}
<div x-show="showQuickAdd" x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center p-4"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100">

    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
         @click="showQuickAdd = false"></div>

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 fade-in">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-gray-800 text-lg">Tambah Siswa Cepat</h2>
            <button @click="showQuickAdd = false" class="text-gray-400 hover:text-gray-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('students.quickStore') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa *</label>
                    <input type="text" name="name" required
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm
                                  focus:outline-none focus:ring-2 focus:ring-ribath-primary/20 focus:border-ribath-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelas *</label>
                    <select name="school_class_id" required
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm
                                   focus:outline-none focus:ring-2 focus:ring-ribath-primary/20 focus:border-ribath-primary">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classes as $class)
                        <option value="{{ $class->id }}"
                            {{ isset($selectedClass) && $selectedClass->id === $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin *</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="gender" value="L" checked class="accent-ribath-primary">
                            <span class="text-sm text-gray-700">Laki-laki</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="gender" value="P" class="accent-ribath-primary">
                            <span class="text-sm text-gray-700">Perempuan</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                    <input type="date" name="entry_date" value="{{ now()->format('Y-m-d') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm
                                  focus:outline-none focus:ring-2 focus:ring-ribath-primary/20 focus:border-ribath-primary">
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="button" @click="showQuickAdd = false"
                        class="flex-1 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-2.5 bg-ribath-primary text-white rounded-xl text-sm font-semibold hover:bg-ribath-dark transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

</div>{{-- end x-data --}}
@endsection

@push('scripts')
<script>
function studentsPage() {
    return {
        massalMode:   false,
        showQuickAdd: false,
        selectedIds:  [],

        init() {
            lucide.createIcons();
        },

        toggleAll(checked) {
            this.selectedIds = checked
                ? [...document.querySelectorAll('input[type=checkbox][value]')].map(el => parseInt(el.value))
                : [];
            document.querySelectorAll('input[type=checkbox][value]').forEach(el => el.checked = checked);
        },

        toggleOne(id, checked) {
            if (checked) {
                if (!this.selectedIds.includes(id)) this.selectedIds.push(id);
            } else {
                this.selectedIds = this.selectedIds.filter(i => i !== id);
            }
        },

        confirmBulkDelete(form) {
            if (confirm(`Yakin hapus ${this.selectedIds.length} data siswa yang dipilih?`)) {
                form.submit();
            }
        },
    };
}

document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
</script>
@endpush
