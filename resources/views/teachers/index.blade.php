<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10 px-4">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Data Pendaftaran Guru
                </h1>

                <p class="text-gray-500 mt-1">
                    Semua data guru yang telah mendaftar
                </p>
            </div>

            <a href="{{ route('teachers.create') }}"
                class="bg-teal-700 text-white px-5 py-3 rounded-xl hover:bg-teal-800 transition">

                Tambah Guru

            </a>

        </div>

        <!-- ALERT -->
        @if (session('success'))
            <div
                class="bg-green-100 border border-green-300
                    text-green-700 px-4 py-3 rounded-xl mb-6">

                {{ session('success') }}

            </div>
        @endif

        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-teal-700 text-white">

                        <tr>

                            <th class="px-6 py-4 text-left">No</th>

                            <th class="px-6 py-4 text-left">
                                Nama
                            </th>

                            <th class="px-6 py-4 text-left">
                                Tempat Lahir
                            </th>

                            <th class="px-6 py-4 text-left">
                                Tanggal Lahir
                            </th>

                            <th class="px-6 py-4 text-left">
                                Gender
                            </th>

                            <th class="px-6 py-4 text-left">
                                WhatsApp
                            </th>

                            <th class="px-6 py-4 text-left">
                                Email
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($teachers as $teacher)
                            <tr class="border-b hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-medium">
                                    {{ $teacher->student_name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $teacher->birth_place }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $teacher->birth_date }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $teacher->gender }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $teacher->whatsapp }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $teacher->email }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-10 text-gray-500">

                                    Belum ada data guru

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>
