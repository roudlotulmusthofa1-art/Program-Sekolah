@extends('layouts.app')

@section('title', 'Detail – ' . $pendaftaran->no_pendaftaran)

@section('content')

{{-- Breadcrumb --}}
<nav class="flex items-center gap-1.5 text-sm text-gray-500 mb-5">
    <a href="{{ route('dashboard') }}" class="hover:text-gray-700 flex items-center gap-1">
        <i data-lucide="home" class="w-3.5 h-3.5"></i> Beranda
    </a>
    <span class="text-gray-300">/</span>
    <a href="{{ route('psb.pendaftaran.index') }}" class="hover:text-gray-700">Pendaftaran Masuk</a>
    <span class="text-gray-300">/</span>
    <span class="text-gray-800 font-semibold">{{ $pendaftaran->no_pendaftaran }}</span>
</nav>

@if(session('success'))
<div class="mb-4 flex items-start gap-3 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm"
     x-data x-init="setTimeout(()=>$el.remove(),6000)">
    <i data-lucide="check-circle" class="w-4 h-4 mt-0.5 shrink-0 text-green-500"></i>
    <span>{!! session('success') !!}</span>
</div>
@endif

@php
$statusColors = [
    'pending'      => 'bg-yellow-100 text-yellow-700 border-yellow-200',
    'follow_up'    => 'bg-orange-100 text-orange-700 border-orange-200',
    'dihubungi'    => 'bg-blue-100 text-blue-700 border-blue-200',
    'dalam_proses' => 'bg-purple-100 text-purple-700 border-purple-200',
    'diterima'     => 'bg-green-100 text-green-700 border-green-200',
    'ditolak'      => 'bg-red-100 text-red-700 border-red-200',
];
$namaWali = $pendaftaran->father_name ?? $pendaftaran->mother_name ?? '-';
$noWa     = $pendaftaran->father_phone ?? $pendaftaran->mother_phone ?? $pendaftaran->no_telepon ?? '-';
@endphp

{{-- Header --}}
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('psb.pendaftaran.index') }}"
       class="p-2 rounded-xl border border-gray-200 hover:bg-gray-50 transition text-gray-500">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
    </a>
    <div class="flex-1">
        <div class="flex items-center gap-3">
            <h1 class="text-xl font-bold text-gray-800">{{ $pendaftaran->nama_lengkap }}</h1>
            <span class="px-2.5 py-1 rounded-full text-xs font-medium border {{ $statusColors[$pendaftaran->status] ?? 'bg-gray-100 text-gray-600 border-gray-200' }}">
                {{ $pendaftaran->status_label }}
            </span>
        </div>
        <p class="text-sm text-gray-500 mt-0.5">
            {{ $pendaftaran->no_pendaftaran }} · Daftar {{ $pendaftaran->created_at?->translatedFormat('j F Y') }}
        </p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- ── Kolom Kiri: Data Detail ── --}}
    <div class="lg:col-span-2 space-y-4">

        {{-- Foto + Data Pribadi --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="user" class="w-4 h-4 text-teal-500"></i> Data Pribadi
            </h2>
            <div class="flex gap-5">
                {{-- Foto --}}
                <div class="shrink-0">
                    @if($pendaftaran->photo)
                    <img src="{{ asset('storage/'.$pendaftaran->photo) }}"
                         class="w-24 h-28 object-cover rounded-xl border border-gray-200" alt="Foto">
                    @else
                    <div class="w-24 h-28 bg-gray-100 rounded-xl flex items-center justify-center text-gray-300 border border-gray-200">
                        <i data-lucide="user" class="w-8 h-8"></i>
                    </div>
                    @endif
                </div>
                {{-- Data --}}
                <div class="grid grid-cols-2 gap-x-6 gap-y-3 text-sm flex-1">
                    @php
                    $fields = [
                        'NIK'             => $pendaftaran->nik,
                        'Tempat Lahir'    => $pendaftaran->tempat_lahir,
                        'Tanggal Lahir'   => $pendaftaran->tanggal_lahir?->translatedFormat('j F Y'),
                        'Jenis Kelamin'   => $pendaftaran->jenis_kelamin_label,
                        'Anak ke'         => $pendaftaran->anak_ke . ' dari ' . ($pendaftaran->jumlah_saudara + 1) . ' bersaudara',
                        'No. Telepon'     => $pendaftaran->no_telepon,
                        'Email'           => $pendaftaran->email ?? '-',
                    ];
                    @endphp
                    @foreach($fields as $label => $val)
                    <div>
                        <p class="text-gray-400 text-xs mb-0.5">{{ $label }}</p>
                        <p class="font-medium text-gray-700">{{ $val ?? '-' }}</p>
                    </div>
                    @endforeach
                    <div class="col-span-2">
                        <p class="text-gray-400 text-xs mb-0.5">Alamat</p>
                        <p class="font-medium text-gray-700">{{ $pendaftaran->alamat }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Orang Tua --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="users" class="w-4 h-4 text-blue-500"></i> Data Orang Tua / Wali
            </h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="p-4 bg-blue-50 rounded-xl">
                    <p class="text-xs text-blue-500 font-medium mb-2">AYAH</p>
                    <p class="font-semibold text-gray-800">{{ $pendaftaran->father_name ?? '-' }}</p>
                    <p class="text-gray-500 text-xs mt-1">{{ $pendaftaran->father_job ?? '-' }}</p>
                    <p class="text-teal-600 text-xs mt-1">{{ $pendaftaran->father_phone ?? '-' }}</p>
                    <p class="text-gray-400 text-xs">{{ $pendaftaran->father_email ?? '-' }}</p>
                </div>
                <div class="p-4 bg-pink-50 rounded-xl">
                    <p class="text-xs text-pink-500 font-medium mb-2">IBU</p>
                    <p class="font-semibold text-gray-800">{{ $pendaftaran->mother_name ?? '-' }}</p>
                    <p class="text-gray-500 text-xs mt-1">{{ $pendaftaran->mother_job ?? '-' }}</p>
                    <p class="text-teal-600 text-xs mt-1">{{ $pendaftaran->mother_phone ?? '-' }}</p>
                    <p class="text-gray-400 text-xs">{{ $pendaftaran->mother_email ?? '-' }}</p>
                </div>
                <div class="col-span-2 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-xs mb-0.5">Alamat Orang Tua</p>
                        <p class="text-gray-700 text-sm">{{ $pendaftaran->parent_address ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs mb-0.5">Penghasilan Bulanan</p>
                        <p class="text-gray-700 text-sm">{{ $pendaftaran->income_label }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pendidikan & Keagamaan --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h2 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 text-sm">
                    <i data-lucide="graduation-cap" class="w-4 h-4 text-purple-500"></i> Pendidikan
                </h2>
                <div class="space-y-2 text-sm">
                    <div><span class="text-gray-400 text-xs">Asal Sekolah</span><p class="font-medium text-gray-700">{{ $pendaftaran->school_name ?? '-' }}</p></div>
                    <div><span class="text-gray-400 text-xs">Jenjang</span><p class="font-medium text-gray-700">{{ $pendaftaran->education_level ?? '-' }}</p></div>
                    <div><span class="text-gray-400 text-xs">Tahun Lulus</span><p class="font-medium text-gray-700">{{ $pendaftaran->graduation_year ?? '-' }}</p></div>
                    <div><span class="text-gray-400 text-xs">Prestasi</span><p class="text-gray-600">{{ $pendaftaran->achievement ?? '-' }}</p></div>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h2 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 text-sm">
                    <i data-lucide="book-open" class="w-4 h-4 text-amber-500"></i> Keagamaan
                </h2>
                <div class="space-y-2 text-sm">
                    <div><span class="text-gray-400 text-xs">Kemampuan Al-Quran</span><p class="font-medium text-gray-700">{{ $pendaftaran->quran_ability_label }}</p></div>
                    <div><span class="text-gray-400 text-xs">Hafalan (Juz)</span><p class="font-medium text-gray-700">{{ $pendaftaran->memorized_juz ?? 0 }} Juz</p></div>
                    <div><span class="text-gray-400 text-xs">Pernah Pesantren</span><p class="font-medium text-gray-700">{{ $pendaftaran->previous_pesantren === 'ya' ? 'Ya' : 'Tidak' }}</p></div>
                    <div><span class="text-gray-400 text-xs">Kemampuan Agama</span><p class="text-gray-600">{{ $pendaftaran->religious_skill ?? '-' }}</p></div>
                </div>
            </div>
        </div>

        {{-- Dokumen --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="file-text" class="w-4 h-4 text-gray-500"></i> Dokumen
                <span class="ml-auto text-xs text-gray-400">{{ $pendaftaran->countUploadedDocuments() }} / 4 dokumen</span>
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @php
                $docs = [
                    'Pas Foto'    => $pendaftaran->photo,
                    'Akta Lahir'  => $pendaftaran->birth_certificate,
                    'Kartu Keluarga' => $pendaftaran->family_card,
                    'Ijazah / SKL'   => $pendaftaran->certificate,
                ];
                @endphp
                @foreach($docs as $label => $path)
                <div class="border border-gray-100 rounded-xl p-3 text-center">
                    @if($path)
                    <a href="{{ asset('storage/'.$path) }}" target="_blank"
                       class="block w-10 h-10 rounded-lg bg-green-100 items-center justify-center mx-auto mb-2">
                        <i data-lucide="check" class="w-5 h-5 text-green-600"></i>
                    </a>
                    @else
                    <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mx-auto mb-2">
                        <i data-lucide="x" class="w-5 h-5 text-gray-300"></i>
                    </div>
                    @endif
                    <p class="text-xs text-gray-600 font-medium">{{ $label }}</p>
                    <p class="text-xs mt-0.5 {{ $path ? 'text-green-600' : 'text-gray-400' }}">
                        {{ $path ? 'Terupload' : 'Belum ada' }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Catatan & Ubah Status --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="message-square" class="w-4 h-4 text-gray-400"></i> Catatan & Status Admin
            </h2>
            @if($pendaftaran->catatan_admin)
            <p class="text-sm text-gray-600 bg-gray-50 rounded-xl p-3 mb-4">{{ $pendaftaran->catatan_admin }}</p>
            @endif
            <form action="{{ route('psb.pendaftaran.update-status', $pendaftaran) }}" method="POST">
                @csrf @method('PATCH')
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Ubah Status</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 bg-white">
                            @foreach(\App\Models\PendaftaranSiswa::STATUS_LABELS as $val => $label)
                            <option value="{{ $val }}" @selected($pendaftaran->status === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Catatan</label>
                        <input type="text" name="catatan" value="{{ $pendaftaran->catatan_admin }}"
                               placeholder="Tambah catatan..."
                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 bg-teal-700 text-white text-sm rounded-xl hover:bg-teal-800 transition font-medium">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

    {{-- ── Kolom Kanan: Aksi ── --}}
    <div class="space-y-4">

        {{-- Kode Akses (jika sudah diterima) --}}
        @if($pendaftaran->status === 'diterima' && $pendaftaran->kode_akses)
        <div class="bg-white rounded-2xl border border-green-200 shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 text-sm">
                <i data-lucide="key" class="w-4 h-4 text-green-500"></i> Kode Akses Wali
            </h3>
            <div class="bg-green-50 rounded-xl p-4 text-center mb-3">
                <p class="text-2xl font-bold tracking-[.2em] text-green-700">{{ $pendaftaran->kode_akses }}</p>
                <p class="text-xs text-green-600 mt-1">Berikan ke wali untuk daftar akun</p>
            </div>
            <a href="{{ route('psb.pendaftaran.kirim-kode', $pendaftaran) }}"
               class="flex items-center justify-center gap-2 w-full py-2.5 bg-green-500 text-white text-sm font-semibold rounded-xl hover:bg-green-600 transition">
                <i data-lucide="message-circle" class="w-4 h-4"></i> Kirim via WhatsApp
            </a>
            <p class="text-xs text-gray-400 text-center mt-2">
                Wali daftar di: <a href="{{ route('guardian.register') }}" target="_blank" class="text-teal-600 hover:underline">{{ route('guardian.register') }}</a>
            </p>
        </div>
        @endif

        {{-- Data Student (jika sudah ada) --}}
        @if($pendaftaran->student)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 text-sm">
                <i data-lucide="graduation-cap" class="w-4 h-4 text-teal-500"></i> Data Siswa
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-400">NIS</span>
                    <span class="font-medium">{{ $pendaftaran->student->nis ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Kelas</span>
                    <span class="font-medium">{{ $pendaftaran->student->schoolClass?->nama_kelas ?? 'Belum ditentukan' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Status</span>
                    <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                        {{ ucfirst($pendaftaran->student->status) }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Tanggal Masuk</span>
                    <span class="font-medium">{{ $pendaftaran->student->entry_date?->translatedFormat('j M Y') ?? '-' }}</span>
                </div>
            </div>
        </div>
        @endif

        {{-- Aksi Cepat --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-3 text-sm">Aksi Cepat</h3>
            <div class="space-y-2">

                @if($pendaftaran->status !== 'diterima' && $pendaftaran->status !== 'ditolak')
                {{-- Form Terima --}}
                <form action="{{ route('psb.pendaftaran.terima', $pendaftaran) }}" method="POST">
                    @csrf
                    <select name="school_class_id" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm mb-2 focus:outline-none focus:ring-2 focus:ring-teal-300 bg-white">
                        <option value="">-- Pilih Kelas (opsional) --</option>
                        @foreach($schoolClasses as $class)
                        <option value="{{ $class->id }}">{{ $class->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-xl hover:bg-green-700 transition">
                        <i data-lucide="check-circle" class="w-4 h-4"></i> Terima Santri
                    </button>
                </form>

                <form action="{{ route('psb.pendaftaran.tolak', $pendaftaran) }}" method="POST">
                    @csrf
                    <button type="submit"
                            onclick="return confirm('Tolak pendaftaran ini?')"
                            class="w-full flex items-center justify-center gap-2 py-2.5 bg-red-50 text-red-600 border border-red-200 text-sm font-medium rounded-xl hover:bg-red-100 transition">
                        <i data-lucide="x-circle" class="w-4 h-4"></i> Tolak Pendaftaran
                    </button>
                </form>
                @endif

                <form action="{{ route('psb.pendaftaran.archive', $pendaftaran) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-2.5 text-gray-500 border border-gray-200 text-sm rounded-xl hover:bg-gray-50 transition">
                        <i data-lucide="archive" class="w-4 h-4"></i>
                        {{ $pendaftaran->is_archived ? 'Pulihkan dari Arsip' : 'Arsipkan' }}
                    </button>
                </form>

                <form action="{{ route('psb.pendaftaran.destroy', $pendaftaran) }}" method="POST"
                      onsubmit="return confirm('Hapus permanen? Data tidak bisa dikembalikan!')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-2.5 text-red-500 border border-red-100 text-sm rounded-xl hover:bg-red-50 transition">
                        <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus Data
                    </button>
                </form>
            </div>
        </div>

        {{-- Info Motivasi --}}
        @if($pendaftaran->alasan)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-2 text-sm flex items-center gap-2">
                <i data-lucide="heart" class="w-4 h-4 text-rose-400"></i> Motivasi Mendaftar
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">{{ $pendaftaran->alasan }}</p>
        </div>
        @endif
    </div>

</div>
@endsection