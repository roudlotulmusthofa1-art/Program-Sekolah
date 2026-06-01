<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-[#edf3f4] min-h-screen flex items-center justify-center py-10">

    <div class="w-full max-w-md px-4">

        <!-- Judul -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-sky-500">
                Formulir Pendaftaran
            </h1>

            <p class="text-gray-500 text-sm mt-2">
                Silakan anda daftar sesuai dengan setatus anda!
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <!-- Header -->
            <div class="bg-linear-to-r from-sky-500 to-teal-400 text-white text-center py-5">
                <h2 class="tracking-wider text-3xl font-bold mt-4 mb-4">
                   Pilihan Pendaftaran
                </h2>
            </div>
            {{-- colom tombol --}}
            <div class="p-6 flex justify-center gap-6 flex-wrap ">
                <!-- Card 1 -->
                <a href="{{ route('teachers.create') }}">
                    <div class="bg-blue-100 rounded-xl w-72 h-28 flex flex-col items-center justify-center shadow-sm">
                        <h1 class="tracking-wide text-2xl font-bold text-blue-700">GURU</h1>
                       
                    </div>
                </a>
                <!-- Card 2 -->
                <a href="{{ route('guardians.create') }}">
                    <div class="bg-cyan-100 rounded-xl w-72 h-28 flex flex-col items-center justify-center shadow-sm">
                        <h1 class="tracking-wide text-2xl font-bold text-cyan-700">ORANG TUA / WALI</h1>
                       
                    </div>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
