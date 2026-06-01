<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10 px-4">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Data Pendaftaran Santri
            </h1>

            <p class="text-gray-500 mt-1">
                Daftar seluruh calon santri yang telah mendaftar
            </p>
        </div>

        <a href="{{ route('guardians.create') }}"
           class="bg-teal-700 hover:bg-teal-800 text-white px-5 py-3 rounded-xl font-medium transition">
            + Tambah Pendaftaran
        </a>

    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
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
                        <th class="px-6 py-4 text-left">Nama Santri</th>
                        <th class="px-6 py-4 text-left">Tempat Lahir</th>
                        <th class="px-6 py-4 text-left">Tanggal Lahir</th>
                        <th class="px-6 py-4 text-left">Gender</th>
                        <th class="px-6 py-4 text-left">Program</th>
                        <th class="px-6 py-4 text-left">Nama Wali</th>
                        <th class="px-6 py-4 text-left">WhatsApp</th>
                        <th class="px-6 py-4 text-left">Email</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($guardians as $guardian)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $guardian->student_name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $guardian->birth_place }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $guardian->birth_date }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $guardian->gender }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $guardian->program }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $guardian->guardian_name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $guardian->whatsapp }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $guardian->email }}
                            </td>
                            
                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center py-10 text-gray-500">
                                Belum ada data pendaftaran
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