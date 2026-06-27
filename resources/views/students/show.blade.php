<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendaftaran - Data santri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        .heading-font { font-family: 'Playfair Display', serif; }

        body { background: #f0f4f4; }

        /* Sidebar sticky */
        .sidebar { position: sticky; top: 2rem; }

        /* Section card */
        .section-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e8f0ef;
            box-shadow: 0 2px 12px rgba(17,123,115,0.06);
            transition: box-shadow 0.3s;
        }
        .section-card:hover {
            box-shadow: 0 6px 24px rgba(17,123,115,0.12);
        }

        /* Section header */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f7f6;
        }
        .section-icon {
            width: 42px; height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #117b73, #1aab9f);
            display: flex; align-items: center; justify-content: center;
            color: white;
            flex-shrink: 0;
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f4c47;
        }
        .section-subtitle {
            font-size: 0.75rem;
            color: #6b9e99;
            margin-top: 1px;
        }

        /* Field item */
        .field-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0.65rem 0;
            border-bottom: 1px dashed #eaf2f1;
            gap: 1rem;
        }
        .field-item:last-child { border-bottom: none; }
        .field-label {
            font-size: 0.8rem;
            color: #7a9e9b;
            font-weight: 500;
            min-width: 140px;
            flex-shrink: 0;
        }
        .field-value {
            font-size: 0.875rem;
            color: #1a3c3a;
            font-weight: 600;
            text-align: right;
        }
        .field-value.empty {
            color: #b0c4c2;
            font-weight: 400;
            font-style: italic;
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-submitted { background: #fff3e0; color: #e65100; }
        .badge-accepted  { background: #e8f5e9; color: #2e7d32; }
        .badge-rejected  { background: #fce4ec; color: #c62828; }
        .badge-draft     { background: #f3f4f6; color: #6b7280; }
        .badge-reviewed  { background: #e3f2fd; color: #1565c0; }

        /* Step badge sidebar */
        .step-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            color: #4a7572;
            font-size: 0.82rem;
            font-weight: 500;
        }
        .step-nav-item:hover { background: #f0f7f6; }
        .step-nav-item.active {
            background: #117b73;
            color: white;
        }
        .step-dot {
            width: 28px; height: 28px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            background: #e8f5f4;
            color: #117b73;
            flex-shrink: 0;
        }
        .step-nav-item.active .step-dot {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        /* Document preview */
        .doc-card {
            border: 1.5px solid #e0eeec;
            border-radius: 14px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f8fcfb;
            transition: border-color 0.2s, background 0.2s;
        }
        .doc-card:hover {
            border-color: #117b73;
            background: #f0f9f8;
        }
        .doc-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, #117b73, #1aab9f);
            display: flex; align-items: center; justify-content: center;
            color: white;
            flex-shrink: 0;
        }
        .doc-uploaded { border-color: #a7d7d3; background: #f0f9f8; }
        .doc-missing  { border-color: #fca5a5; background: #fff5f5; opacity: 0.7; }

        /* Hero card */
        .hero-card {
            background: linear-gradient(135deg, #0d6b64 0%, #117b73 50%, #159f96 100%);
            border-radius: 24px;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        .hero-card::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .hero-card::after {
            content: '';
            position: absolute;
            bottom: -60px; right: 60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        /* Progress bar */
        .progress-bar {
            height: 6px;
            border-radius: 999px;
            background: rgba(255,255,255,0.2);
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            transition: width 1s ease;
        }

        /* Quran ability visual */
        .ability-pip {
            width: 10px; height: 10px;
            border-radius: 50%;
        }

        /* Agree check */
        .agree-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px dashed #eaf2f1;
        }
        .agree-row:last-child { border-bottom: none; }
        .agree-icon {
            width: 22px; height: 22px;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .agree-yes { background: #d1fae5; color: #059669; }
        .agree-no  { background: #fee2e2; color: #dc2626; }

        /* Animasi masuk */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .section-card { animation: fadeUp 0.4s ease both; }
        .section-card:nth-child(1) { animation-delay: 0.05s; }
        .section-card:nth-child(2) { animation-delay: 0.10s; }
        .section-card:nth-child(3) { animation-delay: 0.15s; }
        .section-card:nth-child(4) { animation-delay: 0.20s; }
        .section-card:nth-child(5) { animation-delay: 0.25s; }
        .section-card:nth-child(6) { animation-delay: 0.30s; }
        .section-card:nth-child(7) { animation-delay: 0.35s; }
        .section-card:nth-child(8) { animation-delay: 0.40s; }
        .section-card:nth-child(9) { animation-delay: 0.45s; }

        /* Print */
        @media print {
            .sidebar, .btn-back, .btn-print { display: none !important; }
            .section-card { box-shadow: none !important; break-inside: avoid; }
            body { background: white; }
        }
    </style>
</head>

<body>

{{-- ============================================================ --}}
{{-- TOP BAR                                                      --}}
{{-- ============================================================ --}}
<div class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-teal-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">

        <div class="flex items-center gap-3">
            <a href="{{ url()->previous() }}"
               class="btn-back flex items-center gap-2 text-sm text-teal-700 font-semibold
                      hover:text-teal-900 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
            <span class="text-gray-300">|</span>
            <span class="text-sm text-gray-500">Detail Pendaftaran</span>
        </div>

        <div class="flex items-center gap-2">
            {{-- Badge Status --}}
            @php
                $statusClass = match($student->status) {
                    'submitted' => 'badge-submitted',
                    'accepted'  => 'badge-accepted',
                    'rejected'  => 'badge-rejected',
                    'reviewed'  => 'badge-reviewed',
                    default     => 'badge-draft',
                };
            @endphp
            <span class="badge {{ $statusClass }}">
                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                {{ $student->status_label }}
            </span>

            <button onclick="window.print()"
                class="btn-print flex items-center gap-2 px-4 py-2 rounded-xl
                       bg-teal-700 text-white text-sm font-semibold
                       hover:bg-teal-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak
            </button>
        </div>

    </div>
</div>

{{-- ============================================================ --}}
{{-- MAIN LAYOUT                                                   --}}
{{-- ============================================================ --}}
<div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
    <div class="flex gap-6 items-start">

        {{-- ====================================================== --}}
        {{-- SIDEBAR KIRI                                            --}}
        {{-- ====================================================== --}}
        <aside class="sidebar w-56 shrink-0 hidden lg:block">

            {{-- Foto --}}
            <div class="bg-white rounded-2xl p-4 mb-4 border border-teal-50 shadow-sm text-center">
                @if($student->photo)
                    <img src="{{ asset('storage/' . $student->pendaftaran->photo) }}"
                         alt="Foto {{ $student->pendaftaran->name }}"
                         class="w-20 h-20 rounded-xl object-cover mx-auto mb-3 ring-2 ring-teal-200">
                @else
                    <div class="w-20 h-20 rounded-xl bg-teal-100 mx-auto mb-3
                                flex items-center justify-center text-teal-400 text-3xl font-bold">
                        {{ strtoupper(substr($student->pendaftaran->nama_lengkap, 0, 1)) }}
                    </div>
                @endif
                <p class="text-sm font-bold text-gray-800 leading-tight">{{ $student->pendaftaran->nama_lengkap }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $student->pendaftaran->nik }}</p>
            </div>

            {{-- Navigasi Step --}}
            <div class="bg-white rounded-2xl p-3 border border-teal-50 shadow-sm">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider px-2 mb-2">Navigasi</p>

                @php
                    $navSteps = [
                        ['id' => 'step1', 'label' => 'Data Pribadi',    'num' => 1],
                        ['id' => 'step2', 'label' => 'Data Orang Tua',  'num' => 2],
                        ['id' => 'step3', 'label' => 'Pendidikan',      'num' => 3],
                        ['id' => 'step4', 'label' => 'Kesehatan',       'num' => 4],
                        ['id' => 'step5', 'label' => 'Keagamaan',       'num' => 5],
                        ['id' => 'step6', 'label' => 'Info Lainnya',    'num' => 6],
                        ['id' => 'step7', 'label' => 'Dokumen',         'num' => 7],
                        ['id' => 'step8', 'label' => 'Motivasi',        'num' => 8],
                        ['id' => 'step9', 'label' => 'Verifikasi',      'num' => 9],
                    ];
                @endphp

                @foreach($navSteps as $nav)
                <a href="#{{ $nav['id'] }}" class="step-nav-item">
                    <span class="step-dot">{{ $nav['num'] }}</span>
                    {{ $nav['label'] }}
                </a>
                @endforeach
            </div>

            {{-- Progress Dokumen --}}
            <div class="bg-white rounded-2xl p-4 mt-4 border border-teal-50 shadow-sm">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Dokumen</p>
                <p class="text-2xl font-bold text-teal-700">
                    {{ $student->pendaftaran?->countUploadedDocuments() ?? 0 }}/4
                </p>
                <p class="text-xs text-gray-400 mb-2">file terupload</p>
                <div class="progress-bar" style="background:#e8f5f4;">
                    <div class="progress-fill"
                         style="width:{{ ($student->pendaftaran?->countUploadedDocuments() ?? 0) / 4 * 100 }}%;
                                background: linear-gradient(90deg,#117b73,#1aab9f);">
                    </div>
                </div>
            </div>

        </aside>

        {{-- ====================================================== --}}
        {{-- KONTEN UTAMA                                            --}}
        {{-- ====================================================== --}}
        <main class="flex-1 min-w-0">

            {{-- -------------------------------------------------- --}}
            {{-- HERO CARD                                           --}}
            {{-- -------------------------------------------------- --}}
            <div class="hero-card">
                <div class="relative z-10">
                    <div class="flex items-start justify-between flex-wrap gap-4">
                        <div>
                            <p class="text-teal-200 text-xs font-semibold uppercase tracking-widest mb-1">
                                PP Roudlotul Musthofa
                            </p>
                            <h1 class="heading-font text-3xl text-white mb-1">
                                {{ $student->pendaftaran->nama_lengkap }}
                            </h1>
                            <p class="text-teal-200 text-sm">
                                NIK: {{ $student->pendaftaran->nik }}
                                &nbsp;·&nbsp;
                                {{ $student->pendaftaran->jenis_kelamin }}
                                &nbsp;·&nbsp;
                                {{ \Carbon\Carbon::parse($student->pendaftaran->tanggal_lahir)->age }} tahun
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-teal-300 text-xs mb-1">Terdaftar</p>
                            <p class="text-white font-bold text-sm">
                                {{ $student->entry_date->format('d M Y') }}
                            </p>
                            <p class="text-teal-300 text-xs mt-2">Step Terakhir</p>
                            <p class="text-white font-bold">{{ $student->pendaftaran->last_step }}/9</p>
                        </div>
                    </div>

                    {{-- Progress --}}
                    <div class="mt-5">
                        <div class="flex justify-between text-xs text-teal-200 mb-1">
                            <span>Progress Pengisian</span>
                            <span>{{ round(($student->pendaftaran->last_step / 9) * 100) }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill"
                                 style="width:{{ round(($student->pendaftaran->last_step / 9) * 100) }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- -------------------------------------------------- --}}
            {{-- STEP 1 — DATA PRIBADI                              --}}
            {{-- -------------------------------------------------- --}}
            <div class="section-card" id="step1">
                <div class="section-header">
                    <div class="section-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="section-title">Data Pribadi</p>
                        <p class="section-subtitle">Step 1 — Info Siswa</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                    <div>
                        <div class="field-item">
                            <span class="field-label">Nama Lengkap</span>
                            <span class="field-value">{{ $student->pendaftaran->nama_lengkap }}</span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">NIK</span>
                            <span class="field-value font-mono text-sm">{{ $student->pendaftaran->nik }}</span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Email</span>
                            <span class="field-value {{ !$student->pendaftaran->email ? 'empty' : '' }}">
                                {{ $student->pendaftaran->email ?? 'Tidak diisi' }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Jenis Kelamin</span>
                            <span class="field-value">{{ $student->pendaftaran->jenis_kelamin }}</span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">No. Telepon</span>
                            <span class="field-value">{{ $student->pendaftaran->no_telepon }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="field-item">
                            <span class="field-label">Tempat Lahir</span>
                            <span class="field-value">{{ $student->pendaftaran->tempat_lahir }}</span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Tanggal Lahir</span>
                            <span class="field-value">
                                {{ \Carbon\Carbon::parse($student->pendaftaran->tanggal_lahir)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Anak ke-</span>
                            <span class="field-value">{{ $student->pendaftaran->anak_ke }}</span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Jumlah Saudara</span>
                            <span class="field-value">{{ $student->pendaftaran->jml_saudara }} orang</span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Alamat</span>
                            <span class="field-value text-left" style="text-align:left;max-width:220px;">
                                {{ $student->pendaftaran->alamat }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>


            {{-- -------------------------------------------------- --}}
            {{-- STEP 2 — DATA ORANG TUA                            --}}
            {{-- -------------------------------------------------- --}}
            <div class="section-card" id="step2">
                <div class="section-header">
                    <div class="section-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                  d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="section-title">Data Orang Tua</p>
                        <p class="section-subtitle">Step 2 — Info Wali</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-0">

                    {{-- Ayah --}}
                    <div>
                        <p class="text-xs font-bold text-teal-600 uppercase tracking-wider mb-3">Ayah</p>
                        <div class="field-item">
                            <span class="field-label">Nama Ayah</span>
                            <span class="field-value {{ !$student->pendaftaran->father_name ? 'empty' : '' }}">
                                {{ $student->pendaftaran->father_name ?? '-' }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Pekerjaan</span>
                            <span class="field-value {{ !$student->pendaftaran->father_job ? 'empty' : '' }}">
                                {{ $student->pendaftaran->father_job ?? '-' }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Email</span>
                            <span class="field-value {{ !$student->pendaftaran->father_email ? 'empty' : '' }}">
                                {{ $student->pendaftaran->father_email ?? '-' }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">No. HP</span>
                            <span class="field-value {{ !$student->pendaftaran->father_phone ? 'empty' : '' }}">
                                {{ $student->pendaftaran->father_phone ?? '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- Ibu --}}
                    <div>
                        <p class="text-xs font-bold text-teal-600 uppercase tracking-wider mb-3">Ibu</p>
                        <div class="field-item">
                            <span class="field-label">Nama Ibu</span>
                            <span class="field-value {{ !$student->pendaftaran->mother_name ? 'empty' : '' }}">
                                {{ $student->pendaftaran->mother_name ?? '-' }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Pekerjaan</span>
                            <span class="field-value {{ !$student->pendaftaran->mother_job ? 'empty' : '' }}">
                                {{ $student->pendaftaran->mother_job ?? '-' }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Email</span>
                            <span class="field-value {{ !$student->pendaftaran->mother_email ? 'empty' : '' }}">
                                {{ $student->pendaftaran->mother_email ?? '-' }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">No. HP</span>
                            <span class="field-value {{ !$student->pendaftaran->mother_phone ? 'empty' : '' }}">
                                {{ $student->pendaftaran->mother_phone ?? '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- Alamat & Penghasilan --}}
                    <div class="md:col-span-2 mt-4 pt-4 border-t border-dashed border-teal-100">
                        <p class="text-xs font-bold text-teal-600 uppercase tracking-wider mb-3">Alamat & Penghasilan</p>
                        <div class="field-item">
                            <span class="field-label">Alamat Ortu</span>
                            <span class="field-value {{ !$student->pendaftaran?->parent_address ? 'empty' : '' }}"
                                  style="text-align:right;max-width:340px;">
                                {{ $student->pendaftaran?->parent_address ?? '-' }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Penghasilan/Bulan</span>
                            <span class="field-value {{ !$student->pendaftaran?->income ? 'empty' : '' }}">
                                {{ $student->pendaftaran?->income_label ?? '-' }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>


            {{-- -------------------------------------------------- --}}
            {{-- STEP 3 — PENDIDIKAN                                --}}
            {{-- -------------------------------------------------- --}}
            <div class="section-card" id="step3">
                <div class="section-header">
                    <div class="section-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3.786 9.5 12.786 14l9-4.5-9-4.5-9 4.5Zm0 0V17m3-6v6.222c0 .348 2 1.778 6 1.778s6-1.374 6-1.778V11"/>
                        </svg>
                    </div>
                    <div>
                        <p class="section-title">Pendidikan</p>
                        <p class="section-subtitle">Step 3 — Riwayat Sekolah</p>
                    </div>
                </div>

                <div class="field-item">
                    <span class="field-label">Nama Sekolah</span>
                    <span class="field-value {{ !$student->pendaftaran?->school_name ? 'empty' : '' }}">
                        {{ $student->pendaftaran?->school_name ?? '-' }}
                    </span>
                </div>
                <div class="field-item">
                    <span class="field-label">Jenjang</span>
                    <span class="field-value {{ !$student->pendaftaran?->education_level ? 'empty' : '' }}">
                        {{ $student->pendaftaran?->education_level ?? '-' }}
                    </span>
                </div>
                <div class="field-item">
                    <span class="field-label">Tahun Lulus</span>
                    <span class="field-value {{ !$student->pendaftaran?->graduation_year ? 'empty' : '' }}">
                        {{ $student->pendaftaran?->graduation_year ?? '-' }}
                    </span>
                </div>
                <div class="field-item">
                    <span class="field-label">Prestasi</span>
                    <span class="field-value {{ !$student->pendaftaran?->achievement ? 'empty' : '' }}"
                          style="text-align:right;max-width:340px;">
                        {{ $student->pendaftaran?->achievement ?? 'Tidak ada' }}
                    </span>
                </div>
            </div>


            {{-- -------------------------------------------------- --}}
            {{-- STEP 4 — KESEHATAN                                 --}}
            {{-- -------------------------------------------------- --}}
            <div class="section-card" id="step4">
                <div class="section-header">
                    <div class="section-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="section-title">Kesehatan</p>
                        <p class="section-subtitle">Step 4 — Info Medis</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                    <div>
                        <div class="field-item">
                            <span class="field-label">Golongan Darah</span>
                            @if($student->pendaftaran?->blood_type)
                                <span class="badge" style="background:#fef3c7;color:#92400e;font-size:0.85rem;">
                                    {{ $student->pendaftaran?->blood_type }}
                                </span>
                            @else
                                <span class="field-value empty">Tidak diisi</span>
                            @endif
                        </div>
                        <div class="field-item">
                            <span class="field-label">Riwayat Penyakit</span>
                            <span class="field-value {{ !$student->pendaftaran?->medical_history ? 'empty' : '' }}"
                                  style="text-align:right;max-width:220px;">
                                {{ $student->pendaftaran?->medical_history ?? 'Tidak ada' }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="field-item">
                            <span class="field-label">Alergi</span>
                            <span class="field-value {{ !$student->pendaftaran?->allergy ? 'empty' : '' }}"
                                  style="text-align:right;max-width:220px;">
                                {{ $student->pendaftaran?->allergy ?? 'Tidak ada' }}
                            </span>
                        </div>
                        <div class="field-item">
                            <span class="field-label">Kondisi Khusus</span>
                            <span class="field-value {{ !$student->pendaftaran?->special_condition ? 'empty' : '' }}"
                                  style="text-align:right;max-width:220px;">
                                {{ $student->pendaftaran?->special_condition ?? 'Tidak ada' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>


            {{-- -------------------------------------------------- --}}
            {{-- STEP 5 — KEAGAMAAN                                 --}}
            {{-- -------------------------------------------------- --}}
            <div class="section-card" id="step5">
                <div class="section-header">
                    <div class="section-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023"/>
                        </svg>
                    </div>
                    <div>
                        <p class="section-title">Keagamaan</p>
                        <p class="section-subtitle">Step 5 — Kemampuan</p>
                    </div>
                </div>

                <div class="field-item">
                    <span class="field-label">Kemampuan Baca Quran</span>
                    <span class="field-value {{ !$student->pendaftaran?->quran_reading_ability ? 'empty' : '' }}">
                        {{ $student->pendaftaran?->quran_ability_label ?? '-' }}
                    </span>
                </div>

                {{-- Visual level kemampuan --}}
                @php
                    $levels = ['belum_bisa','iqro','terbata','lancar','tartil'];
                    $currentLevel = array_search($student->pendaftaran?->quran_reading_ability, $levels);
                @endphp
                @if($currentLevel !== false)
                <div class="flex items-center gap-2 px-0 py-2">
                    <span class="text-xs text-gray-400 w-24">Level</span>
                    <div class="flex gap-1.5">
                        @foreach($levels as $i => $level)
                            <div class="ability-pip {{ $i <= $currentLevel ? 'bg-teal-500' : 'bg-gray-200' }}"
                                 title="{{ $level }}"></div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="field-item">
                    <span class="field-label">Juz Dihafal</span>
                    <span class="field-value">
                        {{ $student->pendaftaran?->memorized_juz ?? 0 }} Juz
                    </span>
                </div>
                <div class="field-item">
                    <span class="field-label">Pernah Pesantren</span>
                    <span class="field-value {{ !$student->pendaftaran?->previous_pesantren ? 'empty' : '' }}">
                        {{ $student->pendaftaran?->previous_pesantren === 'ya' ? 'Pernah' : 'Belum Pernah' }}
                    </span>
                </div>
                <div class="field-item">
                    <span class="field-label">Kemampuan Lainnya</span>
                    <span class="field-value {{ !$student->pendaftaran?->religious_skill ? 'empty' : '' }}"
                          style="text-align:right;max-width:280px;">
                        {{ $student->pendaftaran?->religious_skill ?? 'Tidak ada' }}
                    </span>
                </div>
            </div>


            {{-- -------------------------------------------------- --}}
            {{-- STEP 6 — INFO LAINNYA                              --}}
            {{-- -------------------------------------------------- --}}
            <div class="section-card" id="step6">
                <div class="section-header">
                    <div class="section-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16v-4m0-4h.01"/>
                        </svg>
                    </div>
                    <div>
                        <p class="section-title">Info Lainnya</p>
                        <p class="section-subtitle">Step 6 — Hobi & Minat</p>
                    </div>
                </div>

                <div class="field-item">
                    <span class="field-label">Hobi / Bakat</span>
                    <span class="field-value {{ !$student->pendaftaran?->hobby_talent ? 'empty' : '' }}">
                        {{ $student->pendaftaran?->hobby_talent ?? 'Tidak diisi' }}
                    </span>
                </div>
                <div class="field-item">
                    <span class="field-label">Minat Ekskul</span>
                    <span class="field-value {{ !$student->pendaftaran?->extracurricular_interest ? 'empty' : '' }}">
                        {{ $student->pendaftaran?->extracurricular_interest ?? 'Tidak diisi' }}
                    </span>
                </div>
                <div class="field-item">
                    <span class="field-label">Harapan Setelah Lulus</span>
                    <span class="field-value {{ !$student->pendaftaran?->future_goal ? 'empty' : '' }}"
                          style="text-align:right;max-width:320px;">
                        {{ $student->pendaftaran?->future_goal ?? 'Tidak diisi' }}
                    </span>
                </div>
            </div>


            {{-- -------------------------------------------------- --}}
            {{-- STEP 7 — DOKUMEN                                   --}}
            {{-- -------------------------------------------------- --}}
            <div class="section-card" id="step7">
                <div class="section-header">
                    <div class="section-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="section-title">Dokumen</p>
                        <p class="section-subtitle">Step 7 — Upload File</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                    @php
                        $docs = [
                            ['label' => 'Pas Foto 3×4',       'field' => 'photo',             'icon' => '📷'],
                            ['label' => 'Akta Kelahiran',      'field' => 'birth_certificate', 'icon' => '📄'],
                            ['label' => 'Kartu Keluarga',      'field' => 'family_card',       'icon' => '🏠'],
                            ['label' => 'Ijazah / SKL',        'field' => 'certificate',       'icon' => '🎓'],
                        ];
                    @endphp

                    @foreach($docs as $doc)
                    @php $uploaded = !empty($student->pendaftaran?->{$doc['field']}); @endphp
                    <div class="doc-card {{ $uploaded ? 'doc-uploaded' : 'doc-missing' }}">
                        <div class="doc-icon" style="{{ !$uploaded ? 'background:linear-gradient(135deg,#f87171,#ef4444)' : '' }}">
                            @if($uploaded)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800">{{ $doc['label'] }}</p>
                            @if($uploaded)
                                <a href="{{ asset('storage/'.$student->pendaftaran?->{$doc['field']}) }}"
                                   target="_blank"
                                   class="text-xs text-teal-600 hover:underline truncate block">
                                    Lihat File →
                                </a>
                            @else
                                <p class="text-xs text-red-400">Belum diupload</p>
                            @endif
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>


            {{-- -------------------------------------------------- --}}
            {{-- STEP 8 — MOTIVASI                                  --}}
            {{-- -------------------------------------------------- --}}
            <div class="section-card" id="step8">
                <div class="section-header">
                    <div class="section-icon">
                        <svg class="w-5 h-5" fill="white" viewBox="0 0 240 240">
                            <path d="M220,20 L10,105 L75,125 L155,60 L95,135 L95,200 L130,165 L175,195 L220,20 Z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="section-title">Motivasi</p>
                        <p class="section-subtitle">Step 8 — Alasan Mendaftar</p>
                    </div>
                </div>

                @if($student->pendaftaran?->alasan)
                    <div class="bg-teal-50 border-l-4 border-teal-500 rounded-xl p-5">
                        <p class="text-gray-700 text-sm leading-relaxed italic">
                            "{{ $student->pendaftaran?->alasan }}"
                        </p>
                    </div>
                @else
                    <p class="field-value empty">Belum diisi</p>
                @endif
            </div>


            {{-- -------------------------------------------------- --}}
            {{-- STEP 9 — VERIFIKASI                                --}}
            {{-- -------------------------------------------------- --}}
            <div class="section-card" id="step9">
                <div class="section-header">
                    <div class="section-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="section-title">Verifikasi & Pernyataan</p>
                        <p class="section-subtitle">Step 9 — Persetujuan</p>
                    </div>
                </div>

                <div class="agree-row">
                    <div class="agree-icon {{ $student->pendaftaran?->agree_rules ? 'agree-yes' : 'agree-no' }}">
                        @if($student->pendaftaran?->agree_rules)
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        @else
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600">
                        Sanggup mematuhi <strong>seluruh tata tertib</strong> yang berlaku di Ribath Masjid Riyadh Solo
                    </p>
                </div>

                <div class="agree-row">
                    <div class="agree-icon {{ $student->pendaftaran?->agree_payment ? 'agree-yes' : 'agree-no' }}">
                        @if($student->pendaftaran?->agree_payment)
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        @else
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600">
                        Orang tua/wali sanggup membayar <strong>biaya pendidikan</strong> sesuai ketentuan yang berlaku
                    </p>
                </div>

                <div class="agree-row">
                    <div class="agree-icon {{ $student->pendaftaran?->agree_data_truth ? 'agree-yes' : 'agree-no' }}">
                        @if($student->pendaftaran?->agree_data_truth)
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        @else
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600">
                        Menyatakan bahwa <strong>semua data yang diisi adalah benar</strong> dan dapat dipertanggungjawabkan
                    </p>
                </div>

                {{-- Status final --}}
                <div class="mt-5 pt-4 border-t border-dashed border-teal-100 flex items-center justify-between">
                    <span class="text-sm text-gray-500">Status Pendaftaran</span>
                    <span class="badge {{ $statusClass }} text-sm px-4 py-1.5">
                        {{ $student->pendaftaran?->status_label }}
                    </span>
                </div>

            </div>

        </main>
    </div>
</div>

{{-- Smooth scroll --}}
<script>
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            const target = document.querySelector(a.getAttribute('href'));
            if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });

            // Active state sidebar
            document.querySelectorAll('.step-nav-item').forEach(el => el.classList.remove('active'));
            a.classList.add('active');
        });
    });

    // Highlight sidebar saat scroll
    const sections = document.querySelectorAll('[id^="step"]');
    const navItems = document.querySelectorAll('.step-nav-item');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(s => {
            if (window.scrollY >= s.offsetTop - 120) current = s.id;
        });
        navItems.forEach(n => {
            n.classList.toggle('active', n.getAttribute('href') === '#' + current);
        });
    });
</script>

</body>
</html>