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
                <span>Step 1 dari 9</span>
                <span>0% selesai</span>
            </div>

            <div class="w-full bg-inactive-gray rounded-full h-1.5 mb-6">
                <div class="bg-yellow-400 h-1.5 rounded-full" style="width: 0%"></div>
            </div>

            <div class="flex justify-center gap-4 md:gap-8 text-center flex-wrap">

                <!-- STEP AKTIF -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 rounded-full
            bg-teal-100 border-2 border-teal-700
            text-teal-600
            flex items-center justify-center
            ring-4 ring-teal-200 mb-2">

                        <!-- ICON USER -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                            </path>
                        </svg>

                    </div>

                    <span class="text-xs text-primary-teal font-medium">
                        Data Pribadi
                    </span>
                </div>

                @php
                    $steps = [
                        [
                            'label' => 'Data Orang Tua',
                            'icon' => '
                    <svg class="w-5 h-5 text-gray-800 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>',
                        ],
                        [
                            'label' => 'Pendidikan',
                            'icon' => '
                    <svg class="w-5 h-5 text-gray-800 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.78552 9.5 12.7855 14l9-4.5-9-4.5-8.99998 4.5Zm0 0V17m3-6v6.2222c0 .3483 2 1.7778 5.99998 1.7778 4 0 6-1.3738 6-1.7778V11"/>
</svg>

                ',
                        ],

                        [
                            'label' => 'Kesehatan',
                            'icon' => '
                    <svg class="w-5 h-5 text-gray-800 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                ',
                        ],

                        [
                            'label' => 'Keagamaan',
                            'icon' => '
                    <svg class="w- h-5 text-gray-800 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023"/>
</svg>

                ',
                        ],

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

                @foreach ($steps as $step)
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


            <div class="bg-primary-teal p-6 border-b border-gray-50 rounded-xl">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="text-gray-50">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-50">Data Pribadi</h1>
                </div>
                <p class="text-gray-200 text-xl ml-3">Info Siswa</p>
            </div>

            <form action="{{ route('pendaftaransiswa.storeStep1') }}" method="POST"
                class="bg-white shadow-lg rounded-xl overflow-hidden">
                @csrf


                <div class="p-8 space-y-8">

                    <div class="space-y-2">
                        <label for="nama_lengkap" class="font-semibold text-gray-900 block">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" required
                            placeholder="Nama lengkap sesuai akta kelahiran"
                            class="w-full rounded-xl border border-gray-300
                px-4 py-3 focus:outline-none
                focus:ring-2 focus:ring-teal-500">
                        @error('nama_lengkap')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="space-y-2">
                        <label for="nik" class="font-semibold text-gray-900 block">NIK (Nomor Induk
                            Kependudukan)
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="nik" id="nik" required pattern="[0-9]{16}" maxlength="16"
                            placeholder="16 digit NIK"
                            class="w-full rounded-xl border border-gray-300
                px-4 py-3 focus:outline-none
                focus:ring-2 focus:ring-teal-500"">
                        <p class="text-sm text-gray-500">Isi dengan 16 digit angka.</p>
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="font-semibold text-gray-900 block">Email Santri
                            (opsional)</label>
                        <input type="email" name="email" id="email" placeholder="email@example.com"
                            class="w-full rounded-xl border border-gray-300
                px-4 py-3 focus:outline-none
                focus:ring-2 focus:ring-teal-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="tempat_lahir" class="font-semibold text-gray-900 block">Tempat Lahir <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" required
                                placeholder="Kota kelahiran"
                                class="w-full rounded-xl border border-gray-300
                px-4 py-3 focus:outline-none
                focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div class="space-y-2">
                            <label for="tanggal_lahir" class="font-semibold text-gray-900 block">Tanggal Lahir <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required
                                    class="w-full rounded-xl border border-gray-300
                px-4 py-3 focus:outline-none
                focus:ring-2 focus:ring-teal-500">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="jenis_kelamin" class="font-semibold text-gray-900 block">Jenis Kelamin <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="jenis_kelamin" id="jenis_kelamin" required
                                class="w-full p-3 pr-5 border  border-gray-300 rounded-xl focus:ring-2  focus:ring-teal-500 focus:outline-none appearance-none ">
                                <option value="" disabled selected>Pilih jenis kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>



                    <!-- GRID -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Anak Ke -->
                        <div class="space-y-2">
                            <label class="font-semibold text-gray-900 block">
                                Anak ke- <span
                                    class="text-red-500">*</span>
                            </label>

                            <input type="number" placeholder="Contoh: 1" required
                                class="w-full rounded-xl border border-gray-300
                px-4 py-3 focus:outline-none
                focus:ring-2 focus:ring-teal-500">
                        </div>

                        <!-- Jumlah Saudara -->
                        <div class="space-y-2">
                            <label class="font-semibold text-gray-900 block">
                                Jumlah Saudara <span
                                    class="text-red-500">*</span>
                            </label>

                            <input type="number" placeholder="Termasuk diri sendiri" required
                                class="w-full rounded-xl border border-gray-300
                px-4 py-3 focus:outline-none
                focus:ring-2 focus:ring-teal-500">
                        </div>

                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2">

                        <label class="font-semibold text-gray-900 block">
                            Alamat Lengkap <span
                                    class="text-red-500">*</span>
                        </label>

                        <textarea rows="3" placeholder="Alamat lengkap dengan RT/RW, Kelurahan , Kecamatan , Kota" required
                            class="w-full rounded-xl border border-gray-300
            px-4 py-3 focus:outline-none
            focus:ring-2 focus:ring-teal-500"></textarea>

                    </div>

                    <!-- No HP -->
                    <div class="mt-6">

                        <label class="block font-semibold text-gray-800 mb-2">
                            No. Telepon/WhatsApp *
                        </label>

                        <input type="text" placeholder="08xxxxxxxxxx"
                            class="w-full rounded-xl border border-gray-300
            px-4 py-3 focus:outline-none
            focus:ring-2 focus:ring-teal-500">
                    </div>

                    <!-- FOOTER BUTTON -->
                    <div class="mt-8 pt-6 border-t border-gray-200
        flex items-center justify-between">

                        <!-- Button Sebelumnya -->
                        <button type="button"
                            class="flex items-center gap-2 px-6 py-3
            rounded-xl border border-gray-300
            text-gray-500 bg-gray-100
            hover:bg-gray-200 transition">

                            <!-- ICON -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />

                            </svg>

                            Sebelumnya
                        </button>

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
