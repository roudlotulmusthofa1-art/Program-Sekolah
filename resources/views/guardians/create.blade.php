<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Santri</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto py-10 px-4">

        <!-- CARD -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <!-- HEADER -->
            <div class="bg-teal-700 text-white text-center py-8 px-6">
                <h1 class="text-3xl font-bold">
                    Pendaftaran Orang Tua / Wali
                </h1>

                <p class="mt-2 text-sm text-white/90">
                    Formulir singkat untuk mendaftar
                </p>
            </div>

            <!-- FORM -->
            <form action="{{ route('guardians.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

               

                <!-- DATA WALI -->


                <div>
                    <h2 class="font-bold text-gray-700 mb-4">
                        Data Orang Tua / Wali
                    </h2>

                    <div class="space-y-4">

                        <div>
                            <label class="block text-lg font-medium text-gray-800m mb-1">
                                Nama Anda
                            </label>

                            <input type="text" name="guardian_name"
                                class="w-full border rounded-lg px-4 py-3
                      border-gray-800 focus:ring-2  focus:ring-teal-500
                       focus:border-transparent">
                        </div>

                        <!-- NOMOR WHATSAPP -->
                        <div class="mb-5">
                            <label class="block text-lg font-medium text-gray-800 mb-2">
                                Nomor WhatsApp <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">

                                <!-- ICON -->
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500"
                                        fill="currentColor" viewBox="0 0 24 24">

                                        <path
                                            d="M20.52 3.48A11.8 11.8 0 0 0 12.04 0C5.41 0 .02 5.39.02 12c0 2.11.55 4.18 1.6 6.01L0 24l6.17-1.61A11.93 11.93 0 0 0 12.04 24c6.63 0 12.02-5.39 12.02-12 0-3.2-1.25-6.22-3.54-8.52ZM12.04 21.82c-1.8 0-3.56-.48-5.1-1.38l-.36-.21-3.66.95.98-3.57-.24-.37a9.77 9.77 0 0 1-1.5-5.24c0-5.4 4.39-9.8 9.8-9.8 2.62 0 5.08 1.02 6.93 2.87a9.73 9.73 0 0 1 2.87 6.93c0 5.4-4.39 9.82-9.72 9.82Zm5.37-7.35c-.29-.14-1.71-.84-1.98-.94-.27-.1-.46-.14-.66.15-.19.29-.76.94-.93 1.13-.17.19-.34.22-.63.07-.29-.14-1.22-.45-2.32-1.44-.86-.76-1.44-1.7-1.61-1.98-.17-.29-.02-.44.13-.58.13-.13.29-.34.43-.51.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.51-.07-.14-.66-1.59-.9-2.18-.24-.58-.48-.5-.66-.51h-.56c-.19 0-.51.07-.78.36-.27.29-1.02 1-.98 2.44.05 1.44 1.02 2.83 1.17 3.03.14.19 2.01 3.08 4.87 4.2.68.29 1.22.46 1.64.58.68.22 1.29.19 1.78.12.54-.07 1.71-.7 1.95-1.39.24-.68.24-1.27.17-1.39-.05-.12-.24-.19-.53-.34Z" />
                                    </svg>
                                </div>

                                <!-- INPUT -->
                                <input type="text" name="whatsapp" placeholder="08123456789(Contoh)"
                                    class="placeholder:text-gray-300 w-full border rounded-lg px-4 py-3 pl-14 pr-4
                      border-gray-800 focus:ring-2  focus:ring-teal-500
                       focus:border-transparent">

                            </div>

                            <p class="text-sm text-gray-500 mt-2">
                                Tim kami akan menghubungi via WhatsApp untuk konfirmasi
                            </p>
                        </div>


                        <!-- EMAIL -->
                        <div class="mb-5">
                            <label class="block text-lg font-medium text-gray-800 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>

                            <input type="email" name="email" placeholder="email@contoh.com"
                                class="placeholder:text-gray-300 w-full border rounded-lg py-3 px-4
                   border-gray-800 focus:ring-2  focus:ring-teal-500
                       focus:border-transparent">
                        </div>

                        <div>
                            <hr class="mt-4 mb-7 border-gray-300">
                        </div>

                    </div>
                </div>

                <!-- ALPINE JS -->
                <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

                <div x-data="{ showPassword: false, showConfirm: false }" class="space-y-6">

                    <!-- PASSWORD -->
                    <div>
                        <label class="block mb-2 text-lg font-medium text-gray-800">
                            Password <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <input :type="showPassword ? 'text' : 'password'" name="password"
                                placeholder="Minimal 8 karakter"
                                class="placeholder:text-gray-300 w-full border rounded-lg px-4 py-3
                      border-gray-800 focus:ring-2  focus:ring-teal-500
                       focus:border-transparent">

                            <!-- BUTTON MATA -->
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-5 top-1/2 -translate-y-1/2
                       text-gray-500 hover:text-teal-600
                       transition cursor-pointer">

                                <!-- MATA TERBUKA -->
                                <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                <!-- MATA TERTUTUP -->
                                <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <!-- MATA -->
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z" />

                                    <!-- GARIS -->
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4L20 20" />
                                </svg>

                            </button>

                        </div>
                    </div>


                    <!-- KONFIRMASI PASSWORD -->
                    <div>
                        <label class="block mb-2 text-lg font-medium text-gray-800">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation"
                                placeholder="Ulangi password"
                                class="placeholder:text-gray-300 w-full border rounded-lg px-4 py-3
                       focus:border-transparent">

                            <!-- BUTTON MATA -->
                            <button type="button" @click="showConfirm = !showConfirm"
                                class="absolute right-5 top-1/2 -translate-y-1/2
                        text-gray-500 hover:text-teal-600
                        transition cursor-pointer">

                                <!-- MATA TERBUKA -->
                                <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                <!-- MATA TERTUTUP -->
                                <svg x-show="showConfirm" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z" />

                                    <!-- GARIS -->
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4L20 20" />
                                </svg>

                            </button>

                        </div>
                    </div>

                    <div>
                        <hr class="mt-4 mb-7 border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="block text-lg font-medium text-gray-800 mb-2">
                            Code Regitrasi Santri <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="registration_code" placeholder="Contoh: GRC-2026-0001"
                            value="{{ old('registration_code') }}"
                            class="placeholder:text-gray-300 w-full border rounded-lg py-3 px-4
                   border-gray-800 focus:ring-2  focus:ring-teal-500
                       focus:border-transparent">
<p class="text-sm text-gray-500 mt-1">
    Masukkan kode registrasi yang diberikan oleh admin setelah santri dinyatakan diterima.
</p>

                        @error('registration_code')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <hr class="mt-4 mb-7 border-gray-300">
                    </div>

                    <!-- CHECKBOX -->
                    <div class="flex items-start gap-3">

                        <input type="checkbox"
                            class="mt-1 w-5 h-5 rounded border-gray-300
                   text-teal-600 focus:ring-teal-500">

                        <p class="text-gray-700 text-lg">
                            Saya menyetujui

                            <a href="#" class="text-teal-600 hover:text-teal-700 underline">
                                syarat dan ketentuan
                            </a>

                            yang berlaku
                        </p>

                    </div>

                </div>

                <!-- BUTTON SUBMIT -->
                <div class="mt-8">
                    <button type="submit"
                        class="w-full bg-teal-700 hover:bg-teal-800
                text-white font-bold text-xl
                    py-4 rounded-2xl
                    shadow-md hover:shadow-lg
                    transition duration-300
                    flex items-center justify-center gap-3 cursor-pointer">

                        Kirim Pendaftaran

                        <!-- ICON PANAH -->
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>


                    </button>

                    <!-- TEXT BAWAH -->
                    <p class="text-center text-gray-500 text-xs mt-4">
                        Dengan mengirim, Anda menyetujui bahwa tim kami akan menghubungi Anda via WhatsApp.
                    </p>

                </div>

            </form>

        </div>
        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm mb-3">Ingin langsung melengkapi semua data pendaftaran?</p><a
                href="/pendaftaran"><button
                    class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-11 rounded-md px-8 gap-2"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-book-open h-4 w-4">
                        <path d="M12 7v14"></path>
                        <path
                            d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z">
                        </path>
                    </svg>Isi Formulir Lengkap</button></a>
        </div>

        <footer class="text-center mt-12 pb-8">
            <div class="space-y-2">
                <p class="text-gray-600 font-medium">PP Roudlotul Musthofa</p>
                <p class="text-sm text-gray-500">Butuh bantuan? <a href="https://wa.me/6287783975110" target="_blank"
                        rel="noopener noreferrer"
                        class="text-primary text-cyan-700 hover:underline font-medium">Hubungi Kami via
                        WhatsApp</a></p>
            </div>
        </footer>

    </div>

</body>

</html>
