<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Santri - Data Pribadi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-teal': '#117b73',
                        'light-teal-bg': '#f5f7f7',
                        'inactive-gray': '#e5e7eb',
                        'inactive-text': '#6b7280',
                    }
                }
            }
        }
    </script>
</head>



<body class="bg-gray-100">

    <!-- HEADER -->
    <header class="bg-white">

        <!-- BAGIAN ATAS BIASA -->
        <div class="text-center flex flex-col items-center py-6">

            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-teal-600">
                Formulir Pendaftaran
            </h1>

            <h1 class="text-2xl text-gray-400">
                PP Roudlotul Musthofa
            </h1>

            <div class="flex items-center justify-center space-x-2 text-slate-400 mb-4 mt-2">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                    </path>
                </svg>

                <span class="text-sm font-light">
                    Data otomatis tersimpan
                </span>

            </div>

        </div>
    </header>
    <!-- BAGIAN YANG MENEMPEL -->
    <div class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-sm">

        <div class="max-w-7xl mx-auto p-6">

            <div class="flex justify-between items-center text-sm mb-2 text-primary-teal font-medium">
                <span>Step 9 dari 9</span>
                <span>100% selesai</span>
            </div>

            <div class="w-full bg-inactive-gray rounded-full h-1.5 mb-6">
                <div class="bg-yellow-400 h-1.5 rounded-full" style="width: 100%"></div>
            </div>

            <div class="flex justify-center gap-4 md:gap-8 text-center flex-wrap">

                <!-- STEP 1 : SELESAI -->
                <div class="flex flex-col items-center">

                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-600 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
             mb-2">

                        <svg class="w-5 h-5 text-gray-800 dark:text-gray-100" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Data Pribadi
                    </span>

                </div>
                <!-- STEP 2 : SELESAI -->
                <div class="flex flex-col items-center">

                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-600 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
             mb-2">


                        <svg class="w-5 h-5 text-gray-800 dark:text-gray-100" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Data Orang Tua
                    </span>
                </div>

                <!-- STEP 3 : SELESAI -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-600 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
             mb-2">


                        <!-- ICON  -->
                        <svg class="w-5 h-5 text-gray-800 dark:text-gray-100" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Pendidikan
                    </span>
                </div>

                <!-- STEP 4 : SELESAI -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-600 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
             mb-2">


                        <!-- ICON  -->
                        <svg class="w-5 h-5 text-gray-800 dark:text-gray-100" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Kesehatan
                    </span>
                </div>

                <!-- STEP 5 : SELESAI -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-600 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
             mb-2">


                        <!-- ICON  -->
                        <svg class="w-5 h-5 text-gray-800 dark:text-gray-100" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Keagamaan
                    </span>
                </div>

                <!-- STEP 6 : SELESAI -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-600 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
             mb-2">


                        <!-- ICON  -->
                        <svg class="w-5 h-5 text-gray-800 dark:text-gray-100" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Info Lainya
                    </span>
                </div>

                <!-- STEP 7: SELESAI -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-600 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
             mb-2">


                        <!-- ICON  -->
                        <svg class="w-5 h-5 text-gray-800 dark:text-gray-100" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Documen
                    </span>
                </div>

                <!-- STEP 7: SELESAI -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-600 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
             mb-2">


                        <!-- ICON  -->
                        <svg class="w-5 h-5 text-gray-800 dark:text-gray-100" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Motivasi
                    </span>
                </div>


                <!-- STEP AKTIF -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-100 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
            ring-4 ring-teal-200 mb-2">

                        <!-- ICON  -->
                        <svg class="w- h-7 text-gray-800 dark:text-teal-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Verifikasi
                    </span>
                </div>

                @php
                    $steps = [];
                @endphp

                @foreach ($steps as $index => $step)
                    <div class="flex flex-col items-center text-gray-500 opacity-60">

                        <div
                            class="w-12 h-12 rounded-full bg-gray-100
                flex items-center justify-center mb-1">

                            {!! $step['icon'] !!}

                        </div>

                        <span class="text-xs">
                            {{ $step['label'] }}
                        </span>

                    </div>
                @endforeach

            </div>
        </div>
    </div>



    <!-- CONTENT -->
    <main class="pt-10">

        <div class="max-w-4xl mx-auto px-6 md:px-12 py-10  ">


            <div class="bg-primary-teal  p-6 border-b  border-gray-50 rounded-xl">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="text-gray-50">
                        <svg class="w-9 h-9 text-gray-800 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-50">Verifikasi</h1>
                </div>
                <p class="text-gray-200 text-xl ml-3">Pernyataan</p>
            </div>

            <form action="{{ route('pendaftaransiswa.storeStep9') }}" method="POST" enctype="multipart/form-data"
                class="bg-white shadow-lg rounded-xl overflow-hidden">
                @csrf
                <form action="{{ route('pendaftaransiswa.storeStep9') }}" method="POST">
                    @csrf

                    {{-- Tambahkan ini --}}
                    <input type="hidden" name="agree_rules" id="input_agree_rules" value="0">
                    <input type="hidden" name="agree_payment" id="input_agree_payment" value="0">
                    <input type="hidden" name="agree_data_truth" id="input_agree_data_truth" value="0">
                    {{-- Isi Formulir --}}
                    <div class="max-w-4xl mx-auto">

                        <!-- Card -->
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">

                            {{-- isi form --}}
                            {{-- Field: Alasan Mendaftar --}}
                            <div class="bg-teal-50/60 rounded-xl px-6 py-5">
                                <h3 class="text-base font-bold text-gray-800 mb-4">Review Data Pendaftaran</h3>
                                <div class="grid grid-cols-2 gap-x-4 gap-y-2.5">
                                    <span class="text-sm text-gray-500">Nama Lengkap</span>
                                    <span class="text-sm font-bold text-gray-800">{{ $nama ?? 'asdasd' }}</span>

                                    <span class="text-sm text-gray-500">NIK</span>
                                    <span
                                        class="text-sm font-bold text-gray-800">{{ $nik ?? '111111111111111' }}</span>

                                    <span class="text-sm text-gray-500">Sekolah</span>
                                    <span
                                        class="text-sm font-bold text-gray-800">{{ $sekolah ?? '1111111111111111111' }}</span>

                                    <span class="text-sm text-gray-500">Dokumen</span>
                                    <span class="text-sm font-bold text-gray-800">{{ $dokumen ?? '4 / 4 file' }}</span>
                                </div>
                            </div>

                            {{-- Pernyataan --}}
                            <div>
                                <h3 class="text-base font-bold text-gray-800 mt-3 mb-4">Pernyataan</h3>
                                <div class="flex flex-col gap-3" id="statement-list">

                                    {{-- Pernyataan 1 --}}
                                    <label
                                        class="statement-item flex items-start gap-4 border border-gray-200 rounded-xl px-5 py-4 cursor-pointer transition-all duration-200 hover:border-teal-500 hover:bg-teal-50/40"
                                        data-index="0">

                                        <span
                                            class="radio-dot mt-0.5 w-5 h-5 rounded-full border-2 border-gray-300 shrink-0 flex items-center justify-center transition-all duration-200">
                                            <span
                                                class="dot-inner w-2.5 h-2.5 rounded-full bg-teal-700 scale-0 transition-transform duration-200"></span>
                                        </span>
                                        <span class="text-sm text-gray-600 leading-relaxed">
                                            Saya sanggup mematuhi <strong class="font-bold text-gray-800">seluruh tata
                                                tertib</strong>
                                            yang berlaku di Rroudlotul musthofa
                                        </span>
                                    </label>

                                    {{-- Pernyataan 2 --}}
                                    <label
                                        class="statement-item flex items-start gap-4 border border-gray-200 rounded-xl px-5 py-4 cursor-pointer transition-all duration-200 hover:border-teal-500 hover:bg-teal-50/40"
                                        data-index="1">

                                        <span
                                            class="radio-dot mt-0.5 w-5 h-5 rounded-full border-2 border-gray-300 shrink-0 flex items-center justify-center transition-all duration-200">
                                            <span
                                                class="dot-inner w-2.5 h-2.5 rounded-full bg-teal-700 scale-0 transition-transform duration-200"></span>
                                        </span>
                                        <span class="text-sm text-gray-600 leading-relaxed">
                                            Orang tua/wali sanggup membayar <strong
                                                class="font-bold text-gray-800">biaya
                                                pendidikan</strong>
                                            sesuai ketentuan yang berlaku
                                        </span>
                                    </label>

                                    {{-- Pernyataan 3 --}}
                                    <label
                                        class="statement-item flex items-start gap-4 border border-gray-200 rounded-xl px-5 py-4 cursor-pointer transition-all duration-200 hover:border-teal-500 hover:bg-teal-50/40"
                                        data-index="2">

                                        <span
                                            class="radio-dot mt-0.5 w-5 h-5 rounded-full border-2 border-gray-300 shrink-0 flex items-center justify-center transition-all duration-200">
                                            <span
                                                class="dot-inner w-2.5 h-2.5 rounded-full bg-teal-700 scale-0 transition-transform duration-200"></span>
                                        </span>
                                        <span class="text-sm text-gray-600 leading-relaxed">
                                            Saya menyatakan bahwa <strong class="font-bold text-gray-800">semua data
                                                yang
                                                saya isi adalah benar</strong>
                                            dan dapat dipertanggungjawabkan
                                        </span>
                                    </label>

                                </div>
                            </div>
                            <!-- FOOTER BUTTON -->
                            <div class="mt-8 pt-6 border-t border-gray-200
        flex items-center justify-between">

                                <!-- Button Sebelumnya -->
                                <a href="{{ route('pendaftaransiswa.step8') }}"
                                    class="flex items-center gap-2 px-6 py-3
    rounded-xl border border-gray-300
    text-gray-500 bg-gray-100
    hover:bg-gray-200 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />

                                    </svg>
                                    Sebelumnya
                                </a>


                                <!-- Button Selanjutnya -->
                                <button type="submit" id="btn-submit" disabled
                                    class="flex items-center gap-2 px-8 py-3
    rounded-xl bg-teal-700 text-white
    hover:bg-teal-800 transition
    disabled:opacity-50 disabled:cursor-not-allowed">
                                    Kirim Pendaftaran
                                    ...
                                </button>

                            </div>

                </form>
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const items     = document.querySelectorAll('.statement-item');
    const submitBtn = document.getElementById('btn-submit');
    const checkedMap = { 0: false, 1: false, 2: false };

    const inputMap = {
        0: document.getElementById('input_agree_rules'),
        1: document.getElementById('input_agree_payment'),
        2: document.getElementById('input_agree_data_truth'),
    };

    items.forEach(function (label, i) {
        label.addEventListener('click', function (e) {
            e.preventDefault();
            checkedMap[i] = !checkedMap[i];

            // Update value hidden input — inilah yang dikirim ke server
            inputMap[i].value = checkedMap[i] ? '1' : '0';

            const radioDot = label.querySelector('.radio-dot');
            const dotInner = label.querySelector('.dot-inner');

            if (checkedMap[i]) {
                label.classList.add('border-teal-600', 'bg-teal-50');
                label.classList.remove('border-gray-200');
                radioDot.classList.add('border-teal-600');
                radioDot.classList.remove('border-gray-300');
                dotInner.classList.remove('scale-0');
                dotInner.classList.add('scale-100');
            } else {
                label.classList.remove('border-teal-600', 'bg-teal-50');
                label.classList.add('border-gray-200');
                radioDot.classList.remove('border-teal-600');
                radioDot.classList.add('border-gray-300');
                dotInner.classList.add('scale-0');
                dotInner.classList.remove('scale-100');
            }

            submitBtn.disabled = !Object.values(checkedMap).every(Boolean);
        });
    });
});
    </script>

</body>

</html>
