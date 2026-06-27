<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Wali – Ribath Riyadh Solo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-linear-to-br from-teal-900 via-teal-800 to-emerald-800 flex items-center justify-center p-4">

<div class="w-full max-w-md">

    {{-- Logo --}}
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-2xl bg-amber-400 flex items-center justify-center mx-auto mb-3 shadow-lg">
            <svg class="w-8 h-8 text-teal-900" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-white">Ribath Masjid Riyadh Solo</h1>
        <p class="text-teal-200 text-sm mt-1">Portal Wali / Orang Tua Santri</p>
    </div>

    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

        {{-- Step bar --}}
        <div class="bg-gray-50 border-b border-gray-100 px-8 py-4">
            <div class="flex items-center">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-teal-700 text-white text-xs flex items-center justify-center font-bold">1</div>
                    <span class="text-sm font-semibold text-teal-700">Kode Akses</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200 mx-3"></div>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-gray-200 text-gray-400 text-xs flex items-center justify-center font-bold">2</div>
                    <span class="text-sm text-gray-400">Isi Data</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200 mx-3"></div>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-gray-200 text-gray-400 text-xs flex items-center justify-center font-bold">3</div>
                    <span class="text-sm text-gray-400">Selesai</span>
                </div>
            </div>
        </div>

        <div class="p-8">
            <h2 class="text-lg font-bold text-gray-800 mb-1">Masukkan Kode Akses</h2>
            <p class="text-sm text-gray-500 mb-6">Kode akses dikirim oleh admin Ribath melalui WhatsApp setelah pendaftaran santri disetujui.</p>

            {{-- Error --}}
            @if($errors->any())
            <div class="mb-5 p-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm flex items-start gap-2">
                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ $errors->first() }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-5 p-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('guardian.verify-kode') }}">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Akses</label>
                    <input type="text" name="kode_akses" value="{{ old('kode_akses') }}"
                           placeholder="Contoh: ABX-1234"
                           maxlength="8"
                           oninput="this.value = this.value.toUpperCase()"
                           class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl text-center text-2xl font-bold tracking-[.3em] uppercase focus:outline-none focus:border-teal-500 transition @error('kode_akses') @enderror">
                    <p class="mt-2 text-xs text-gray-400 text-center">Format: 3 huruf kapital + tanda (-) + 4 angka</p>
                </div>

                <button type="submit"
                        class="w-full py-3 bg-teal-700 text-white font-bold rounded-xl hover:bg-teal-800 transition text-sm tracking-wide">
                    Verifikasi Kode →
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-gray-100 text-center space-y-2">
                <p class="text-sm text-gray-500">
                    Sudah punya akun?
                    <a href="{{ route('guardian.login') }}" class="text-teal-600 font-semibold hover:underline">Masuk di sini</a>
                </p>
                <p class="text-xs text-gray-400">
                    Belum mendaftar?
                    <a href="{{ url('/pendaftaransiswa/step1') }}" class="text-teal-600 hover:underline">Formulir PSB</a>
                </p>
            </div>
        </div>
    </div>

    <p class="text-center text-teal-200/50 text-xs mt-6">© {{ now()->year }} Ribath Masjid Riyadh Solo</p>
</div>
</body>
</html>