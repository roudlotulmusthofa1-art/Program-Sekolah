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
                <span>Step 5 dari 9</span>
                <span>48% selesai</span>
            </div>

            <div class="w-full bg-inactive-gray rounded-full h-1.5 mb-6">
                <div class="bg-yellow-400 h-1.5 rounded-full" style="width: 48%"></div>
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

                <!-- STEP AKTIF -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-100 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
            ring-4 ring-teal-200 mb-2">

                        <!-- ICON  -->
                        <svg class="w- h-5 text-gray-800 dark:text-teal-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023" />
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Keagamaan
                    </span>
                </div>

                @php
                    $steps = [
                        [
                            'label' => 'Info Lainnya',
                            'icon' => '
                    <svg class="w- h-5 text-gray-800 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 16v-4m0-4h.01">
                        </path>
                    </svg>
                ',
                        ],

                        [
                            'label' => 'Dokumen',
                            'icon' => '
                    <svg class="w- h-5 text-gray-800 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                ',
                        ],

                        [
                            'label' => 'Motivasi',
                            'icon' => '
                    <svg class="w- h-5 text-gray-800 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12l14-7-7 14-2-5-5-2z">
                        </path>
                    </svg>
                ',
                        ],

                        [
                            'label' => 'Verifikasi',
                            'icon' => '
                    <svg class="w- h-5 text-gray-800 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
</svg>

                ',
                        ],
                    ];
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-50">Keagamaan</h1>
                </div>
                <p class="text-gray-200 text-xl ml-3">kemampuan</p>
            </div>

            <form action="{{ route('pendaftaransiswa.storeStep5') }}" method="POST"
                class="bg-white shadow-lg rounded-xl overflow-hidden">
                @csrf

                {{-- Isi Formulir --}}
                <div class="max-w-4xl mx-auto">

                    <!-- Card -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">

                        {{-- format form --}}
                            <!-- Kemampuan Membaca Al-Quran -->
                          <div class="space-y-2 mt-5">

                                <label class="block text-[15px] font-semibold text-gray-900">
                                    Kemampuan Membaca Al-Quran
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <select name="quran_reading_ability"
                                        class="appearance-none w-full h-11 px-4 pr-10
                rounded-[12px]
                border border-gray-300
                bg-white
                text-[15px]
                text-gray-900
                focus:outline-none
                focus:ring-2
                focus:ring-teal-600
                focus:border-teal-600">

                                        <option value="">
                                            Pilih kemampuan
                                        </option>

                                        <option value="belum_bisa">
                                            Belum Bisa
                                        </option>

                                        <option value="iqro">
                                            Iqro'
                                        </option>

                                        <option value="terbata">
                                            Bisa Membaca Terbata-bata
                                        </option>

                                        <option value="lancar">
                                            Lancar
                                        </option>

                                        <option value="tartil">
                                            Tartil
                                        </option>

                                    </select>

                                    <svg class="absolute right-4 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400 pointer-events-none"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />

                                    </svg>

                                </div>

                            </div>

                            <!-- Jumlah Juz -->
                           <div class="space-y-2 ">

                                <label class="block mt-5 text-[15px] font-semibold text-gray-900">
                                    Jumlah Juz yang Dihafal
                                    <span class="text-gray-500 font-normal">(opsional)</span>
                                </label>

                                <input type="number" name="memorized_juz" placeholder="Contoh: 1"
                                    class="w-full h-11 px-4
            rounded-[12px]
            border border-gray-300
            text-[15px]
            text-gray-900
            placeholder:text-gray-400
            focus:outline-none
            focus:ring-2
            focus:ring-teal-600
            focus:border-teal-600">

                            </div>

                            <!-- Pernah Pesantren -->
                          <div class="space-y-2">

                                <label class="block mt-5 text-[15px] font-semibold text-gray-900">
                                    Apakah pernah belajar di pesantren sebelumnya?
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="flex items-center gap-6">

                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="previous_pesantren" value="ya"
                                            class="w-4 h-4 text-teal-600 border-gray-300 focus:ring-teal-600">

                                        <span class="ml-2 text-[15px] text-gray-900">
                                            Ya
                                        </span>
                                    </label>

                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="previous_pesantren" value="tidak"
                                            class="w-4 h-4 text-teal-600 border-gray-300 focus:ring-teal-600">

                                        <span class="ml-2 text-[15px] text-gray-900">
                                            Tidak
                                        </span>
                                    </label>

                                </div>

                            </div>

                            <!-- Kemampuan Keagamaan -->
                            <div class="space-y-2">

                                <label class="block mt-5 text-[15px] font-semibold text-gray-900">
                                    Kemampuan Keagamaan Lainnya
                                    <span class="text-gray-500 font-normal">(opsional)</span>
                                </label>

                                <textarea name="religious_skill" rows="3" placeholder="Contoh: Tahfidz, Kitab Kuning, Khatib, dll"
                                    class="w-full
            min-h-20
            px-4
            py-3
            rounded-[12px]
            border border-gray-300
            text-[15px]
            text-gray-900
            placeholder:text-gray-400
            resize-none
            focus:outline-none
            focus:ring-2
            focus:ring-teal-600
            focus:border-teal-600"></textarea>

                            </div>

                      

                        <!-- FOOTER BUTTON -->
                        <div class="mt-8 pt-6 border-t border-gray-200
        flex items-center justify-between">

                            <!-- Button Sebelumnya -->
                            <a href="{{ route('pendaftaransiswa.step4') }}"
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
                            <button type="submit"
                                class="flex items-center gap-2 px-8 py-3
            rounded-xl bg-teal-700 text-white
            hover:bg-teal-800 transition">

                                Selanjutnya

                                <!-- ICON -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />

                                </svg>

                            </button>

                        </div>

            </form>



        </div>
    </main>

</body>

</html>
