<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-teal': '#117b73',
                    },
                    keyframes: {
                        'scale-in': {
                            '0%'   : { transform: 'scale(0)', opacity: '0' },
                            '70%'  : { transform: 'scale(1.1)' },
                            '100%' : { transform: 'scale(1)', opacity: '1' },
                        },
                        'fade-up': {
                            '0%'  : { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)',    opacity: '1' },
                        },
                    },
                    animation: {
                        'scale-in' : 'scale-in 0.6s ease-out forwards',
                        'fade-up'  : 'fade-up 0.6s ease-out forwards',
                        'fade-up-delay': 'fade-up 0.6s ease-out 0.3s forwards',
                        'fade-up-delay2': 'fade-up 0.6s ease-out 0.5s forwards',
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center px-4">

    <!-- CARD UTAMA -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl px-8 py-12 flex flex-col items-center text-center">

        <!-- ICON CENTANG ANIMASI -->
        <div class="animate-scale-in mb-6">
            <div class="w-28 h-28 rounded-full border-[6px] border-green-500 flex items-center justify-center">
                <svg class="w-14 h-14 text-green-500" fill="none" stroke="currentColor"
                    stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <!-- TEKS SUCCESS -->
        <div class="opacity-0 animate-fade-up">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Pendaftaran Berhasil!
            </h1>
            <p class="text-gray-500 text-base">
                Data pendaftaran Anda telah berhasil dikirim.
            </p>
        </div>

        <!-- INFO PENDAFTAR (jika ada) -->
        @if($pendaftaran)
        <div class="opacity-0 animate-fade-up-delay w-full mt-8 bg-teal-50 border border-teal-200 rounded-2xl px-6 py-5 text-left">
            <h3 class="text-sm font-bold text-teal-700 mb-3 uppercase tracking-wide">
                Detail Pendaftaran
            </h3>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Nama</span>
                    <span class="font-semibold text-gray-800">{{ $pendaftaran->nama_lengkap }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">NIK</span>
                    <span class="font-semibold text-gray-800">{{ $pendaftaran->nik }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Status</span>
                    <span class="inline-flex items-center gap-1 font-semibold text-green-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Menunggu Review
                    </span>
                </div>
            </div>
        </div>
        @endif

        <!-- INFO BOX -->
        <div class="opacity-0 animate-fade-up-delay w-full mt-4 bg-amber-50 border border-amber-200 rounded-2xl px-6 py-4 text-left">
            <p class="text-sm text-amber-700 leading-relaxed">
                <span class="font-bold">Info:</span>
                Kami akan menghubungi Anda melalui nomor telepon atau email yang telah didaftarkan
                setelah proses verifikasi selesai.
            </p>
        </div>

        <!-- TOMBOL -->
        <div class="opacity-0 animate-fade-up-delay2 w-full mt-8">
            <a href="{{ route('pendaftaransiswa.step1') }}"
                class="block w-full py-4 rounded-2xl
                bg-green-500 hover:bg-green-600
                text-white font-bold text-lg
                transition duration-200 text-center">
                Daftar Lagi
            </a>

            <a href="/"
                class="block w-full mt-3 py-4 rounded-2xl
                border border-gray-300
                text-gray-600 font-semibold text-base
                hover:bg-gray-50 transition duration-200 text-center">
                Kembali ke Beranda
            </a>
        </div>

    </div>

    <!-- FOOTER -->
    <p class="mt-8 text-sm text-gray-400">
        PP Roudlotul Musthofa &copy; {{ date('Y') }}
    </p>

</body>

</html>