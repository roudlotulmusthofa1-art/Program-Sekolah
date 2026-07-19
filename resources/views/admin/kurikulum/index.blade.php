{{--
    Sesuaikan baris @extends & @section di bawah ini dengan layout admin
    yang sudah dipakai di modul lain (Tahun Ajaran / Data Ustadz).
--}}
@extends('layouts.app')

@section('title', 'Kurikulum & Kitab')

@push('styles')
    <style>
        /* Chrome, Edge, Safari */
        .thin-scrollbar::-webkit-scrollbar {
            height: 3px;
        }

        .thin-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 9999px;
        }

        .thin-scrollbar::-webkit-scrollbar-thumb {
            background: #a7adb4;
            border-radius: 9999px;
        }

        .thin-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9fafc6;
        }

        /* Firefox */
        .thin-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #94a3b8 #f1f5f9;
        }
    </style>
@endpush
@section('content')
    <div x-data="kitabPage(@js(
    $kelasOptionsJs ??
        $schoolClasses->map(
            fn($k) => [
                'id' => $k->id,
                'nama_kelas' => $k->nama_kelas,
                'color' => $k->color,
            ],
        ),
))" x-init="init()" class="space-y-6">

        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4 ml-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-1 hover:text-ribath-primary transition-colors">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                Beranda
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-gray-800 font-medium">Kurikulum & Kitab</span>
        </nav>

        {{-- ============ FLASH MESSAGES ============ --}}
        @if (session('success'))
            <div
                class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-lg px-4 py-3 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <p class="font-medium mb-1">Data belum tersimpan, periksa kembali:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ============ HEADER BANNER ============ --}}
        <div
            class="bg-teal-600 rounded-xl p-6 flex items-center justify-between text-white shadow-sm mx-4 md:mx-10 lg:mx-20 xl:mx-60">
            <div>
                <h1 class="text-2xl font-bold mb-2">Manajemen Kurikulum & Kitab</h1>
                <p class="text-teal-100 text-base mt-1">
                    Total {{ $totalKitab }} Kitab Klasik - {{ $bidangIlmuOptions->count() }} Bidang Ilmu
                </p>
            </div>
            <button type="button" @click="openCreate()"
                class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 transition text-white font-medium px-4 py-2.5 rounded-lg shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Kitab
            </button>
        </div>

        {{-- ============ STAT CARDS ============ --}}
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-3">
                    <i data-lucide="book-open" class="w-5 h-5 text-blue-500"></i>
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ $totalKitab }}</p>
                <p class="text-sm font-semibold text-gray-600">Total Kitab</p>
                <p class="text-xs text-gray-400">{{ $bidangIlmuOptions->count() }} Bidang Ilmu</p>
            </div>

            {{--
            Kartu kelas dibuat otomatis dari $kelasStatGroups (dikirim dari
            AdminKitabController), yang datanya diambil langsung dari relasi
            Kitab <-> SchoolClass — bukan nama kelas yang di-hardcode di Blade.
        --}}
            @php
                $kelasCardColors = [
                    ['bg' => 'bg-sky-100', 'text' => 'text-sky-500', 'icon' => 'graduation-cap'],
                    ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-500', 'icon' => 'school'],
                    ['bg' => 'bg-purple-100', 'text' => 'text-purple-500', 'icon' => 'graduation-cap'],
                    ['bg' => 'bg-rose-100', 'text' => 'text-rose-500', 'icon' => 'school'],
                    ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-500', 'icon' => 'graduation-cap'],
                ];
            @endphp

            @foreach ($kelasStatGroups as $i => $group)
                @php $color = $kelasCardColors[$i % count($kelasCardColors)]; @endphp
                <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                    <div class="w-10 h-10 rounded-lg {{ $color['bg'] }} flex items-center justify-center mb-3">
                        <i data-lucide="{{ $color['icon'] }}" class="w-5 h-5 {{ $color['text'] }}"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-800">{{ $group['jumlah_penempatan'] }}</p>
                    <p class="text-sm font-semibold text-gray-600">Kelas {{ $group['label'] }}</p>
                    <p class="text-xs text-gray-400">{{ $group['jumlah_kitab'] }} kitab dipelajari</p>
                </div>
            @endforeach

            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center mb-3">
                    <i data-lucide="clock" class="w-5 h-5 text-amber-500"></i>
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ $totalJamPerMinggu }}</p>
                <p class="text-sm font-semibold text-gray-600">Total Jam/Minggu</p>
                <p class="text-xs text-gray-400">Seluruh Program</p>
            </div>
        </div>

        {{-- ============ SEARCH + FILTER ============ --}}
        <div class="p-4 mx-4 md:mx-10 lg:mx-20 xl:mx-60 bg-white rounded-xl border border-gray-200 shadow-sm ">
            <div class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between ">
                <div class="relative flex-1 w-full ">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    <input type="text" x-model="search" placeholder="Cari kitab (nama, deskripsi)..."
                        class="w-full pl-9 pr-3 py-2.5 border bg-gray-50 border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <button type="button"
                    class="inline-flex items-center gap-2 border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-600 bg-gray-50 hover:teal-50 transition focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                    Filter
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
        {{-- ============ FILTER PILLS (per Bidang Ilmu) ============ --}}
        <div class="p-4 mx-4 md:mx-10 lg:mx-20 xl:mx-60 bg-white rounded-xl border border-gray-200 shadow-sm ">
            <div class="flex gap-2 overflow-x-auto pb-2 thin-scrollbar ">
                <button type="button" @click="activeBidang = 'semua'"
                    :class="activeBidang === 'semua' ? 'bg-teal-600 text-white' :
                        'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'"
                    class="shrink-0 flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-medium transition">
                    Semua
                    <span :class="activeBidang === 'semua' ? 'bg-white/20' : 'bg-gray-100'"
                        class="px-1.5 py-0.5 rounded-full text-sm">
                        {{ $totalKitab }}
                    </span>
                </button>

                @foreach ($bidangIlmus as $bidang)
                    <button type="button" @click="activeBidang = '{{ $bidang->id }}'"
                        :class="activeBidang === '{{ $bidang->id }}' ? 'bg-teal-600 text-white' :
                            'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'"
                        class="shrink-0 flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-medium transition">
                        {{ $bidang->nama }}
                        <span :class="activeBidang === '{{ $bidang->id }}' ? 'bg-white/20' : 'bg-gray-100'"
                            class="px-1.5 py-0.5 rounded-full text-sm">
                            {{ $bidang->kitabs_count }}
                        </span>
                    </button>
                @endforeach
            </div>
        </div>
        {{-- ============ KITAB GROUPS ============ --}}
        @forelse ($kitabs as $namaBidang => $kitabList)
            <div class="p-4 mx-4 md:mx-10 lg:mx-20 xl:mx-60 bg-white rounded-xl border border-gray-200 shadow-sm ">
                <div x-show="activeBidang === 'semua' || activeBidang === '{{ $kitabList->first()->bidang_ilmu_id }}'"
                    class="space-y-3 ">
                    <h2 class="text-lg font-semibold text-gray-700">
                        {{ $namaBidang }} <span class="text-gray-600 text-sm font-normal">({{ $kitabList->count() }}
                            kitab)</span>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach ($kitabList as $kitab)
                            <div x-show="matchesSearch('{{ addslashes(strtolower($kitab->nama_kitab . ' ' . $kitab->deskripsi)) }}')"
                                class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex flex-col justify-between mb-2">
                                <div
                                    class="flex items-center gap-1.5 text-base text-gray-700 mb-1 bg-gray-100 px-2 py-1 rounded-lg w-max">
                                    <i data-lucide="book-open" class="w-3.5 h-3.5"></i>
                                    {{ $namaBidang }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2 text-lg">{{ $kitab->nama_kitab }}</h3>

                                    <p class="text-xs text-gray-700 mb-1">Kelas:</p>
                                    <div class="flex flex-wrap gap-1.5 mb-3">
                                        @foreach ($kitab->schoolClasses->unique('id') as $kelas)
                                            <span
                                                class="text-xs text-white px-2 py-1 rounded-full font-medium font-semibold"
                                                style="background-color: {{ $kelas->color }}">
                                                {{ $kelas->nama_kelas }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-1">
                                        <span>Semester:</span>
                                        <span class="text-gray-800 font-medium">{{ $kitab->semester_list ?: '-' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                        <span>Frekuensi:</span>
                                        <span
                                            class="text-gray-800 font-medium">{{ $kitab->frekuensi_ringkas ?: '-' }}</span>
                                    </div>

                                    @if ($kitab->jumlah_kelas > 0)
                                        <p class="text-xs text-emerald-600 font-medium">
                                            Dijadwalkan di {{ $kitab->jumlah_kelas }} kelas
                                        </p>
                                    @else
                                        <p class="text-xs text-gray-400">Belum dijadwalkan</p>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                                    <button type="button" @click="openEdit(@js([
    'id' => $kitab->id,
    'nama_kitab' => $kitab->nama_kitab,
    'deskripsi' => $kitab->deskripsi,
    'bidang_ilmu_id' => $kitab->bidang_ilmu_id,
    'kelas_ids' => $kitab->schoolClasses->pluck('id')->unique()->values(),
    'semesters' => $kitab->schoolClasses->pluck('pivot.semester')->unique()->values(),
    'frekuensi_per_minggu' => optional($kitab->schoolClasses->first())->pivot->frekuensi_per_minggu ?? 1,
]))"
                                        class="inline-flex items-center gap-1.5 text-sm text-blue-600 hover:text-blue-700 font-medium">
                                        <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                        Edit
                                    </button>

                                    <form action="{{ route('kurikulum.destroy', $kitab) }}" method="POST"
                                        onsubmit="return confirm('Hapus kitab &quot;{{ $kitab->nama_kitab }}&quot;? Semua penempatan kelasnya juga akan dihapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 text-sm text-red-500 hover:text-red-600 font-medium">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16 text-gray-400 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <i data-lucide="book-open" class="w-10 h-10 mx-auto mb-2"></i>
                Belum ada kitab. Klik "Tambah Kitab" untuk mulai menambahkan.
            </div>
        @endforelse

        @include('admin.kurikulum.partials.modal-tambah-kitab')
    </div>

    @push('scripts')
        <script>
            function kitabPage(kelasOptions) {
                return {
                    search: '',
                    activeBidang: 'semua',
                    kelasOptions: kelasOptions,

                    showModal: false,
                    mode: 'create', // 'create' | 'edit'
                    advancedOpen: false,
                    descCount: 0,

                    form: {
                        id: null,
                        nama_kitab: '',
                        deskripsi: '',
                        bidang_ilmu_id: '',
                        kelas_ids: [],
                        semesters: ['1'],
                        frekuensi_per_minggu: 1,
                    },

                    init() {
                        if (window.lucide) window.lucide.createIcons();
                    },

                    matchesSearch(haystack) {
                        if (this.search.trim() === '') return true;
                        return haystack.includes(this.search.toLowerCase());
                    },

                    resetForm() {
                        this.form = {
                            id: null,
                            nama_kitab: '',
                            deskripsi: '',
                            bidang_ilmu_id: '',
                            kelas_ids: [],
                            semesters: ['1'],
                            frekuensi_per_minggu: 1,
                        };
                        this.descCount = 0;
                        this.advancedOpen = false;
                    },

                    openCreate() {
                        this.resetForm();
                        this.mode = 'create';
                        this.showModal = true;
                        this.$nextTick(() => {
                            if (window.lucide) window.lucide.createIcons();
                        });
                    },

                    openEdit(kitab) {
                        this.mode = 'edit';
                        this.form = {
                            id: kitab.id,
                            nama_kitab: kitab.nama_kitab,
                            deskripsi: kitab.deskripsi ?? '',
                            bidang_ilmu_id: String(kitab.bidang_ilmu_id),
                            kelas_ids: (kitab.kelas_ids ?? []).map(String),
                            semesters: (kitab.semesters && kitab.semesters.length ? kitab.semesters : ['1']).map(String),
                            frekuensi_per_minggu: kitab.frekuensi_per_minggu ?? 1,
                        };
                        this.descCount = this.form.deskripsi.length;
                        this.showModal = true;
                        this.$nextTick(() => {
                            if (window.lucide) window.lucide.createIcons();
                        });
                    },

                    closeModal() {
                        this.showModal = false;
                    },

                    toggleKelas(id) {
                        id = String(id);
                        const idx = this.form.kelas_ids.indexOf(id);
                        if (idx === -1) {
                            this.form.kelas_ids.push(id);
                        } else {
                            this.form.kelas_ids.splice(idx, 1);
                        }
                    },

                    isKelasSelected(id) {
                        return this.form.kelas_ids.includes(String(id));
                    },

                    toggleSemester(value) {
                        value = String(value);
                        const idx = this.form.semesters.indexOf(value);
                        if (idx === -1) {
                            this.form.semesters.push(value);
                        } else {
                            // minimal harus ada 1 semester terpilih
                            if (this.form.semesters.length > 1) {
                                this.form.semesters.splice(idx, 1);
                            }
                        }
                    },

                    isSemesterSelected(value) {
                        return this.form.semesters.includes(String(value));
                    },

                    get formAction() {
                        return this.mode === 'edit' ?
                            `{{ url('kurikulum-kitab') }}/${this.form.id}` :
                            `{{ route('kurikulum.store') }}`;
                    },
                };
            }
        </script>
    @endpush
@endsection
