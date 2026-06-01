<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <title>Document</title>
</head>

<body class="antialiased">
    <section
        class="bg-[url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1920&auto=format&fit=crop')] bg-no-repeat bg-cover bg-center bg-fixed min-h-screen flex items-center justify-center">
        <div class="fixed inset-0 bg-emerald-900/40 z-0"></div>
        <x-navbar></x-navbar>
        <div class="z-10 flex flex-col items-center justify-center px-6 py-8 mx-auto w-full md:w-2/5 lg:w-[30%]">
            <img src="img/dar.png" alt="Logo" class="w-40 opacity-100 mt-12 mb-4 drop-shadow-md">
            <div
                class="w-full max-w-lg mx-auto 
            px-3 py-4
            bg-white/40 dark:bg-gray-900/40
            backdrop-blur-xl 
            border border-white/20 dark:border-gray-700/50
            rounded-2xl 
            shadow-2xl
            transition duration-300">

                <h1
                    class="text-xl mt-1 mb-5 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Masuk ke akun Anda
                </h1>
                @if (session('error'))
                    <div class="mb-4 text-sm text-red-700 bg-red-100/80 backdrop-blur p-3 rounded-xl text-center">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="mb-4 text-sm text-green-700 bg-green-100 p-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="p-3 space-y-2 sm:p-4">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <!-- Input Email -->
                        <div class="relative mb-5">
                            <!-- Ikon Email -->
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <input type="email" name="email"
                                class="w-full bg-transparent border-none text-gray-900 placeholder-gray-500 text-sm rounded-full focus:ring-2 focus:ring-teal-400 focus:border-transparent block pl-11 py-3 backdrop-blur-sm transition-all"
                                placeholder="Email" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Password dengan Toggle Mata -->
                        <div x-data="{ show: false }"
                            class="relative mb-5 flex rounded-full backdrop-blur-sm transition-all focus-within:ring-2 focus-within:ring-teal-400">

                            <!-- Ikon Kunci -->
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                    </path>
                                </svg>
                            </div>

                            <!-- Input Password -->
                            <input :type="show ? 'text' : 'password'" name="password" placeholder="Password"
                                class="w-full bg-transparent border-none text-gray-900 placeholder-gray-500 text-sm focus:ring-0 block pl-11 py-3 rounded-l-full"
                                required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror

                            <!-- Tombol Mata -->
                            <button type="button" @click="show = !show"
                                class="px-4 border-l border-gray-500/40 text-gray-500 hover:text-gray-500/80 rounded-r-full focus:outline-none">

                                <!-- Mata Terbuka -->
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0">
                                    </path>

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>

                                <!-- Mata Tertutup -->
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <!-- Bentuk Mata -->
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0">
                                    </path>

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>

                                    <!-- Garis Coret -->
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4L20 20">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center -mt-3 mb-6 justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50  dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-600 dark:text-gray-300">Ingat saya</label>
                                </div>
                            </div>
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                Lupa kata sandi?</a>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="w-50 mt-4 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-150 ease-in-out">
                                Masuk
                            </button>
                        </div>

                        <p class="text-sm mt-2 font-light text-gray-500 dark:text-gray-400">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">Daftar di sini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>
