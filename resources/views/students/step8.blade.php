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
                <span>Step 8 dari 9</span>
                <span>86% selesai</span>
            </div>

            <div class="w-full bg-inactive-gray rounded-full h-1.5 mb-6">
                <div class="bg-yellow-400 h-1.5 rounded-full" style="width: 86%"></div>
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


                <!-- STEP AKTIF -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-100 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
            ring-4 ring-teal-200 mb-2">

                        <!-- ICON  -->
                        <svg class="w-7 h-7 fill-teal-600" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                            viewBox="0 0 240 240">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="
    M 220,20
    L 10,105
    L 75,125
    L 155,60
    L 95,135
    L 95,200
    L 130,165
    L 175,195
    L 220,20
    Z" />

                        </svg>


                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Motivasi
                    </span>
                </div>

                @php
                    $steps = [
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
                        <svg class="w- h-9 fill-gray-200" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                            viewBox="0 0 240 240">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="
    M 220,20
    L 10,105
    L 75,125
    L 155,60
    L 95,135
    L 95,200
    L 130,165
    L 175,195
    L 220,20
    Z" />

                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-50">Motivasi</h1>
                </div>
                <p class="text-gray-200 text-xl ml-3">Alasan Daftar</p>
            </div>

            @if ($errors->any())
                <div class="bg-teal-200 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pendaftaransiswa.storeStep8') }}" method="POST" enctype="multipart/form-data"
                class="bg-white shadow-lg rounded-xl overflow-hidden">
                @csrf

                {{-- Isi Formulir --}}
                <div class="max-w-4xl mx-auto">

                    <!-- Card -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">

                        {{-- isi form --}}
                        {{-- Field: Alasan Mendaftar --}}
                        <div class="mb-5">
                            <label for="alasan" class="block text-sm font-semibold text-gray-800 mb-3">
                                Alasan Mendaftar di Roudlotul Musthofa
                                <span class="text-red-500 ml-0.5">*</span>
                            </label>

                            <textarea id="alasan" name="alasan" rows="5" minlength="50"
                                placeholder="Tuliskan motivasi dan alasan Anda ingin belajar di Roudlotul Musthofa (minimal 50 karakter)"
                                oninput="updateCharCount(this)"
                                class="w-full px-4 py-3 text-sm text-gray-800 bg-white border border-gray-300 rounded-lg resize-y
                       placeholder-gray-400 leading-relaxed
                       focus:outline-none focus:ring-2 focus:ring-emerald-500/10
                       transition duration-150 ease-in-out
                       @error('alasan') focus:border-red-400 @enderror">{{ old('alasan') }}</textarea>

                            {{-- Char Counter --}}
                            <div class="flex justify-end mt-1.5">
                                <span id="char-count"
                                    class="text-xs text-gray-400 transition-colors duration-200">0/50
                                    karakter</span>
                            </div>

                            {{-- Validation Error --}}
                            @error('alasan')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Tips Box --}}
                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3.5">
                            <p class="text-sm text-emerald-700 leading-relaxed">
                                <span class="font-bold text-emerald-800">Tips:</span>
                                Ceritakan dengan jujur mengapa Anda tertarik belajar di pesantren kami dan apa
                                yang ingin Anda capai.
                            </p>
                        </div>



                        @push('scripts')
                            <script>
                                function updateCharCount(el) {
                                    const len = el.value.length;
                                    const counter = document.getElementById('char-count');
                                    counter.textContent = len + '/50 karakter';

                                    if (len >= 50) {
                                        counter.classList.remove('text-gray-400');
                                        counter.classList.add('text-emerald-600', 'font-medium');
                                    } else {
                                        counter.classList.remove('text-emerald-600', 'font-medium');
                                        counter.classList.add('text-gray-400');
                                    }
                                }
                            </script>
                        @endpush


                        <!-- FOOTER BUTTON -->
                        <div class="mt-8 pt-6 border-t border-gray-200
        flex items-center justify-between">

                            <!-- Button Sebelumnya -->
                            <a href="{{ route('pendaftaransiswa.step7') }}"
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
