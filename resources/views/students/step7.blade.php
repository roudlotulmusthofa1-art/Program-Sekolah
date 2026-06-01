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
                <span>Step 7 dari 9</span>
                <span>72% selesai</span>
            </div>

            <div class="w-full bg-inactive-gray rounded-full h-1.5 mb-6">
                <div class="bg-yellow-400 h-1.5 rounded-full" style="width: 72%"></div>
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

                <!-- STEP AKTIF -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-100 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
            ring-4 ring-teal-200 mb-2">

                        <!-- ICON  -->
                        <svg class="w- h-5 text-gray-800 dark:text-teal-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Documen
                    </span>
                </div>

                @php
                    $steps = [
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
                        <svg class="w-9 h-9 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-50">Documen</h1>
                </div>
                <p class="text-gray-200 text-xl ml-3">Upload File</p>
            </div>

            <form action="{{ route('pendaftaransiswa.storeStep7') }}" method="POST" enctype="multipart/form-data"
                class="bg-white shadow-lg rounded-xl overflow-hidden">
                @csrf

                {{-- Isi Formulir --}}
                <div class="max-w-4xl mx-auto">

                    <!-- Card -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">

                        {{-- isi form --}}
                        <!-- PAS FOTO -->
                        <div class="mb-5"> <label class="block mb-3 mt-4 text-[18px] font-semibold text-gray-900">
                                Pas Foto 3×4 <span class="text-red-500">*</span> </label>
                            <div class="upload-container">
                                <label for="photo"
                                    class="upload-box flex flex-col items-center justify-center  h-50 rounded-2xl border border-dashed border-gray-300 bg-white cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-500 mb-2 mt-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M12 4v12" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M8 8l4-4 4 4" />
                                    </svg>
                                    <p class="text-[18px] text-gray-600"> Seret file ke sini atau klik untuk memilih
                                    </p>
                                    <p class="mt-1 text-sm text-gray-400 mb-3"> Maks 5MB - Format: JPG, PNG </p>
                                    <input id="photo" name="photo" type="file" accept=".jpg,.jpeg,.png"
                                        class="mb-4 text-gray-400 file-input" required>
                                    <!-- Preview -->

                                    <div class="upload-placeholder ">



                                    </div>

                                    <div class="file-preview hidden mb-3 w-full"></div>


                                </label>
                            </div>
                            @error('photo')
                                <p class="mt-2 text-sm text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>


                        <!-- AKTA -->
                        <div class="mb-5">
                            <label class="block mb-3 text-[18px] font-semibold text-gray-900">
                                Akta Kelahiran
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="upload-container">
                                <label for="birth_certificate"
                                    class="upload-box flex flex-col items-center justify-center
                   w-full h-50
                   rounded-2xl
                   border border-dashed border-gray-300
                   bg-white
                   cursor-pointer
                   hover:border-teal-400
                   hover:bg-teal-50
                   transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-500 mb-2 mt-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1" />

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M12 4v12" />

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M8 8l4-4 4 4" />
                                    </svg>

                                    <p class="text-[18px] text-gray-600">
                                        Seret file ke sini atau klik untuk memilih
                                    </p>

                                    <p class="mt-1 text-sm text-gray-400 mb-3">
                                        Maks 5MB - Format: JPG, PNG, PDF
                                    </p>

                                    <input type="file" id="birth_certificate" name="birth_certificate"
                                        class="file-input hidden" accept=".jpg,.jpeg,.png,.pdf" required>
                                    <!-- Preview -->
                                    <div class="upload-placeholder">
                                    </div>
                                    <div class="file-preview hiddenn w-full"></div>

                                </label>

                            </div>
                            @error('photo')
                                <p class="mt-2 text-sm text-red-600"> {{ $message }} </p>
                            @enderror

                        </div>


                        <!-- KK -->
                        <div class="mb-5">
                            <label class="block mb-3 text-[18px] font-semibold text-gray-900">
                                Kartu Keluarga
                                <span class="text-red-500">*</span>
                            </label>

                            <label for="family_card"
                                class="group flex flex-col items-center justify-center
                   w-full h-32
                   rounded-2xl
                   border border-dashed border-gray-300
                   bg-white
                   cursor-pointer
                   hover:border-teal-400
                   hover:bg-gray-50
                   transition">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-500 mb-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 4v12" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M8 8l4-4 4 4" />
                                </svg>

                                <p class="text-[15px] text-gray-600">
                                    Seret file ke sini atau klik untuk memilih
                                </p>

                                <p class="mt-1 text-sm text-gray-400">
                                    Maks 5MB - Format: JPG, PNG, PDF
                                </p>

                                <input id="family_card" type="file" accept=".jpg,.jpeg,.png,.pdf" class="hidden">

                            </label>
                        </div>


                        <!-- IJAZAH -->
                        <div class="mb-5">
                            <label class="block mb-3 text-[18px] font-semibold text-gray-900">
                                Ijazah/SKL Terakhir
                                <span class="text-red-500">*</span>
                            </label>

                            <label for="certificate"
                                class="group flex flex-col items-center justify-center
                   w-full h-32
                   rounded-2xl
                   border border-dashed border-gray-300
                   bg-white
                   cursor-pointer
                   hover:border-teal-400
                   hover:bg-gray-50
                   transition">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-500 mb-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 4v12" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M8 8l4-4 4 4" />
                                </svg>

                                <p class="text-[15px] text-gray-600">
                                    Seret file ke sini atau klik untuk memilih
                                </p>

                                <p class="mt-1 text-sm text-gray-400">
                                    Maks 5MB - Format: JPG, PNG, PDF
                                </p>

                                <input id="certificate" type="file" accept=".jpg,.jpeg,.png,.pdf" class="hidden">
                            </label>
                        </div>


                        <!-- FOOTER BUTTON -->
                        <div class="mt-8 pt-6 border-t border-gray-200
        flex items-center justify-between">

                            <!-- Button Sebelumnya -->
                            <a href="{{ route('pendaftaransiswa.step6') }}"
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

    <script>
        document.querySelectorAll('.file-input').forEach(input => {

            input.addEventListener('change', function() {

                const file = this.files[0];

                if (!file) return;

                const container =
                    this.closest('.upload-container');

                const placeholder =
                    container.querySelector('.upload-placeholder');

                const preview =
                    container.querySelector('.file-preview');

                const sizeKB =
                    (file.size / 1024).toFixed(0);

                let content = '';

                if (file.type.startsWith('image/')) {

                    const imageUrl =
                        URL.createObjectURL(file);

                    content = `
                <div class="flex items-center justify-between
                            rounded-2xl
                            border border-teal-200
                            bg-teal-50
                            p-4">

                    <div class="flex items-center gap-4">

                        <img src="${imageUrl}"
                            class="w-16 h-16 rounded-xl object-cover">

                        <div>

                            <p class="font-medium text-gray-900">
                                ${file.name}
                            </p>

                            <p class="text-sm text-gray-500">
                                ${sizeKB} KB
                            </p>

                        </div>

                    </div>
 <button
            type="button"
            class="remove-file text-red-500 hover:text-red-700 text-xl font-bold">
            ✕
        </button>
                </div>
            `;

                } else {

                    content = `
                <div class="flex items-center justify-between
                            rounded-2xl
                            border border-teal-200
                            bg-teal-50
                            p-4">

                    <div class="flex items-center gap-4">

                        <div class="text-4xl">
                            📄
                        </div>

                        <div>

                            <p class="font-medium text-gray-900">
                                ${file.name}
                            </p>

                            <p class="text-sm text-gray-500">
                                ${sizeKB} KB
                            </p>

                        </div>

                    </div>
  <button
            type="button"
            class="remove-file text-red-500 hover:text-red-700 text-xl font-bold">
            ✕
        </button>
                </div>
            `;
                }

                placeholder.classList.add('hidden');

                preview.classList.remove('hidden');

                preview.innerHTML = content;

                const removeBtn =
                    preview.querySelector('.remove-file');

                removeBtn.addEventListener('click', function() {

                    input.value = '';

                    preview.innerHTML = '';

                    preview.classList.add('hidden');

                    placeholder.classList.remove('hidden');

                });

            });

        });
    </script>

</body>

</html>
