<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk – Portal Wali Ribath</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-linear-to-br from-teal-900 via-teal-800 to-emerald-800 flex items-center justify-center p-4">

<div class="w-full max-w-sm">

    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl bg-amber-400 flex items-center justify-center mx-auto mb-2 shadow-lg">
            <svg class="w-7 h-7 text-teal-900" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <h1 class="text-lg font-bold text-white">Portal Wali</h1>
        <p class="text-teal-200 text-sm">Ribath Masjid Riyadh Solo</p>
    </div>

    <div class="bg-white rounded-2xl shadow-2xl p-7">
        <h2 class="font-bold text-gray-800 text-lg mb-5">Masuk ke Akun Wali</h2>

        @if($errors->any())
        <div class="mb-4 p-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('guardian.login.post') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300"
                       placeholder="email@contoh.com" required autofocus>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300"
                       placeholder="Password" required>
            </div>
            <button type="submit"
                    class="w-full py-3 bg-teal-700 text-white font-bold rounded-xl hover:bg-teal-800 transition text-sm">
                Masuk
            </button>
        </form>

        <div class="mt-5 text-center text-sm">
            <p class="text-gray-400">Belum punya akun?
                <a href="{{ route('guardian.register') }}" class="text-teal-600 font-semibold hover:underline">Daftar dengan kode akses</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>