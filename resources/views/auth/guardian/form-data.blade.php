<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Data – Ribath Riyadh Solo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-linear-to-br from-teal-900 via-teal-800 to-emerald-800 py-10 px-4">

<div class="max-w-lg mx-auto">

    {{-- Logo --}}
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl bg-amber-400 flex items-center justify-center mx-auto mb-2 shadow-lg">
            <svg class="w-7 h-7 text-teal-900" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <h1 class="text-lg font-bold text-white">Ribath Masjid Riyadh Solo</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

        {{-- Step bar --}}
        <div class="bg-gray-50 border-b border-gray-100 px-8 py-4">
            <div class="flex items-center">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-green-500 text-white text-xs flex items-center justify-center font-bold">✓</div>
                    <span class="text-sm text-green-600">Kode Akses</span>
                </div>
                <div class="flex-1 h-0.5 bg-teal-300 mx-3"></div>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-teal-700 text-white text-xs flex items-center justify-center font-bold">2</div>
                    <span class="text-sm font-semibold text-teal-700">Isi Data</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200 mx-3"></div>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-gray-200 text-gray-400 text-xs flex items-center justify-center font-bold">3</div>
                    <span class="text-sm text-gray-400">Selesai</span>
                </div>
            </div>
        </div>

        <div class="p-7">

            {{-- Info santri yang diterima --}}
            @if($pendaftaran)
            <div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl">
                <p class="text-xs font-semibold text-green-600 mb-1 uppercase tracking-wide">Santri yang Diterima</p>
                <p class="font-bold text-green-800 text-base">{{ $pendaftaran->nama_lengkap }}</p>
                <div class="flex items-center gap-3 mt-1 text-xs text-green-600">
                    <span>{{ $pendaftaran->no_pendaftaran }}</span>
                    @if($pendaftaran->student?->schoolClass)
                    <span>·</span>
                    <span>{{ $pendaftaran->student->schoolClass->nama_kelas }}</span>
                    @endif
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 p-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('guardian.simpan-data') }}" class="space-y-4">
                @csrf

                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Data Wali</p>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Wali <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap"
                           value="{{ old('nama_lengkap', $pendaftaran?->father_name ?? $pendaftaran?->mother_name) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('nama_lengkap') @enderror"
                           placeholder="Nama sesuai KTP">
                    @error('nama_lengkap')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="nik" value="{{ old('nik') }}"
                               maxlength="16" placeholder="16 digit NIK"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                               placeholder="Pekerjaan"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                    <input type="tel" name="no_hp"
                           value="{{ old('no_hp', $pendaftaran?->father_phone ?? $pendaftaran?->mother_phone) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('no_hp') @enderror"
                           placeholder="08xxxxxxxxxx">
                    @error('no_hp')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="2"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 resize-none"
                              placeholder="Alamat lengkap">{{ old('alamat', $pendaftaran?->parent_address) }}</textarea>
                </div>

                <div class="border-t border-gray-100 pt-4">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Akun Login</p>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email"
                                   value="{{ old('email', $pendaftaran?->father_email ?? $pendaftaran?->mother_email) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('email') @enderror"
                                   placeholder="email@contoh.com">
                            @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                                <input type="password" name="password"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300"
                                       placeholder="Min. 8 karakter">
                                @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ulangi Password</label>
                                <input type="password" name="password_confirmation"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300"
                                       placeholder="Ulangi">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit"
                        class="w-full py-3.5 bg-teal-700 text-white font-bold rounded-xl hover:bg-teal-800 transition text-sm tracking-wide mt-2">
                    Buat Akun & Masuk →
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>