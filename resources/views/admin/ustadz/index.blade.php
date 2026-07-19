@extends('layouts.app')

@section('title', 'Data Ustadz')

@section('content')
    <div x-data="ustadzPage()" x-init="init()">

        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4 ml-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-1 hover:text-ribath-primary transition-colors">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                Beranda
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-gray-800 font-medium">Data Ustadz</span>
        </nav>

        <div class="mx-4 md:mx-10">

            {{-- Header Banner --}}
            <div class="rounded-2xl mb-6 px-6 py-6 flex items-center justify-between mx-4 md:mx-10 lg:mx-20 xl:mx-60 "
                style="background: linear-gradient(135deg, #1a6b5a 0%, #134d40 100%);">
                <div>
                    <h1 class="text-2xl font-bold text-white">Data Ustadz</h1>
                    <p class="text-white/70 text-base mt-2">Total {{ $teachers->total() }} Ustadz Pengajar</p>
                </div>
                <button @click="showForm = true; editMode = false; resetForm()"
                    class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-semibold">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Ustadz
                </button>
            </div>

            {{-- Search + Filter --}}
            <div
                class="mx-4 md:mx-10 lg:mx-20 xl:mx-60 bg-white rounded-2xl px-3 py-6  border border-gray-200 mb-6 h-20 flex items-center justify-between">
                <form method="GET" class="gap-3 mb-6 mx-4 w-full md:mx-0 flex items-center justify-between mt-5">
                    <div class="relative flex-1">
                        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari ustadz (nama, kode, email)..."
                            class="w-full pl-9 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl
                           focus:outline-none focus:ring-2 focus:ring-ribath-primary/20 focus:border-ribath-primary">
                    </div>
                    <select name="status" onchange="this.form.submit()"
                        class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="cuti" {{ request('status') === 'cuti' ? 'selected' : '' }}>Cuti</option>
                        <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                    <button type="submit" class="px-4 py-2.5 bg-ribath-primary text-white rounded-xl text-sm font-medium">
                        Cari
                    </button>
                </form>
            </div>
            {{-- Grid Card --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                @forelse ($teachers as $t)
                    <div class="bg-white rounded-xl border border-gray-100 p-5">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 rounded-full flex items-center justify-center bg-teal-100 text-teal-700 font-bold text-sm">
                                    {{ $t->photo ?? $t->initials() }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 text-lg leading-tight">{{ $t->teacher_name }}</p>
                                    <p class="text-sm text-gray-400">Kode: {{ $t->kode ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <button
                                    @click="showForm = true; editMode = true; fillForm(Object.assign({{ \Illuminate\Support\Js::from($t) }}, { updateUrl: '{{ route('ustadz.update', $t) }}' }))"
                                    class="text-gray-700 hover:text-ribath-primary" title="edit">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </button>
                                <button
                                    @click="openDeleteModal(Object.assign({{ \Illuminate\Support\Js::from($t) }}, { destroyUrl: '{{ route('ustadz.destroy', $t) }}' }))"
                                    class="text-red-400 hover:text-red-600" title="hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Berikan Akses --}}
                        @if ($t->user_id)
                            <div
                                class="w-full text-center py-2 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium mb-4">
                                <i data-lucide="check-circle" class="w-4 h-4 inline"></i> Sudah Punya Akses
                            </div>
                        @else
                            <button type="button"
                                @click="openAccessModal(Object.assign({{ \Illuminate\Support\Js::from($t) }}, { giveAccessUrl: '{{ route('ustadz.giveAccess', $t) }}' }))"
                                class="w-full flex items-center justify-center gap-2 py-2 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-sm font-medium hover:bg-amber-100 mb-4">
                                <i data-lucide="user-plus" class="w-4 h-4"></i> Berikan Akses
                            </button>
                        @endif

                        {{-- Status --}}
                        <form method="POST" action="{{ route('ustadz.updateStatus', $t) }}"
                            class="flex items-center justify-between text-sm pt-5 border-t border-gray-200">
                            @csrf @method('PATCH')
                            @foreach (['aktif' => 'Aktif', 'cuti' => 'Cuti', 'nonaktif' => 'Non Aktif'] as $val => $label)
                                <button type="submit" name="status" value="{{ $val }}"
                                    class="px-8 py-2 rounded-lg font-medium transition-colors
                                       {{ $t->status === $val ? 'bg-green-100 text-green-700' : 'text-gray-400 hover:bg-gray-50' }}">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </form>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 text-gray-400">
                        Belum ada data ustadz.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">{{ $teachers->links('pagination::tailwind') }}</div>
        </div>

        {{-- ============================================================ --}}
        {{-- Modal Tambah/Edit Ustadz --}}
        {{-- ============================================================ --}}
        <div x-show="showForm" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/40" @click="showForm = false"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 max-h-2xl overflow-y-auto">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-bold text-gray-800 text-lg"
                        x-text="editMode ? 'Edit Data Ustadz' : 'Tambah Ustadz Baru'"></h2>
                    <button @click="showForm = false"><i data-lucide="x" class="w-5 h-5 text-gray-400"></i></button>
                </div>

                <form :action="editMode ? form.updateUrl : '{{ route('ustadz.store') }}'" method="POST">
                    @csrf
                    <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>

                    {{-- Informasi Personal --}}
                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-8">
                        <i data-lucide="user" class="w-4 h-4 text-ribath-primary"></i>
                        Informasi Personal
                    </div>

                    <div class="space-y-3">
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-500 mb-1">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="teacher_name" x-model="form.teacher_name"
                                placeholder="Masukkan nama lengkap ustadz" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-gray-700 text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-500 mb-1">Tempat Lahir <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="birth_place" x-model="form.birth_place"
                                    placeholder="Masukkan tempat lahir" required
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-500 mb-1">Tanggal Lahir <span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="birth_date" x-model="form.birth_date" required
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm">
                            </div>


                            <div>
                                <label class="block text-sm font-semibold text-gray-500 mb-1">Kode Ustadz <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="kode" x-model="form.kode"
                                    placeholder="Contoh: AH, AS, UAS" required
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-500 mb-1">Status Ustadz <span
                                        class="text-red-500">*</span></label>
                                <div class="flex items-center gap-1 border border-gray-200 rounded-xl p-1">
                                    @foreach (['aktif' => 'Aktif', 'cuti' => 'Cuti', 'nonaktif' => 'Non Aktif'] as $val => $label)
                                        <button type="button" @click="form.status = '{{ $val }}'"
                                            :class="form.status === '{{ $val }}' ? 'bg-green-100 text-green-700' :
                                                'text-gray-400 hover:bg-gray-50'"
                                            class="flex-1 px-2 py-1.5 rounded-lg text-xs font-medium transition-colors w-52 text-center">
                                            {{ $label }}
                                        </button>
                                    @endforeach
                                </div>
                                <input type="hidden" name="status" x-model="form.status">
                            </div>


                            <div class="mb-2">
                                <label class="flex items-center gap-1 text-sm font-semibold text-gray-500 mb-1">
                                    <i data-lucide="mail" class="w-3.5 h-3.5"></i> Email (Opsional)
                                </label>
                                <input type="email" name="email" x-model="form.email"
                                    placeholder="ustadz@ribath.ac.id (opsional)"
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm">
                            </div>
                            <div class="mb-2">
                                <label class="flex items-center gap-1 text-sm font-semibold text-gray-500 mb-1">
                                    <i data-lucide="phone" class="w-3.5 h-3.5"></i> Nomor Telepon
                                </label>
                                <input type="text" name="whatsapp" x-model="form.whatsapp" placeholder="08123456789"
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-500 mb-1">Jenis Kelamin <span
                                    class="text-red-500">*</span></label>
                            <div class="flex items-center gap-1 border border-gray-200 rounded-xl p-1">
                                @foreach (['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'] as $val => $label)
                                    <button type="button" @click="form.gender = '{{ $val }}'"
                                        :class="form.gender === '{{ $val }}' ? 'bg-green-100 text-green-700' :
                                            'text-gray-400 hover:bg-gray-50'"
                                        class="flex-1 px-2 py-1.5 rounded-lg text-xs font-medium transition-colors w-52 text-center">
                                        {{ $label }}
                                    </button>
                                    <input type="hidden" name="gender" x-model="form.gender">
                                @endforeach
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-500 mb-1 mt-6">Password <span
                                        class="text-red-500" x-show="!editMode">*</span></label>
                                <input type="password" name="password" x-model="form.password"
                                    placeholder="Minimal 8 karakter" :required="!editMode"
                                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm">
                            </div>

                            {{-- Catatan --}}
                            <div class="flex items-center gap-2 text-sm font-semibold text-gray-700 mt-5 mb-3">
                                <i data-lucide="file-text" class="w-4 h-4 text-ribath-primary"></i>
                                Catatan
                            </div>
                            <textarea name="catatan" x-model="form.catatan" rows="3"
                                placeholder="Spesialisasi, pendidikan, atau catatan lainnya..."
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm resize-y"></textarea>

                            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-100">
                                <button type="button" @click="showForm = false"
                                    class="flex-1 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-700">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-ribath-primary text-white rounded-xl text-sm font-semibold">
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    <span x-text="editMode ? 'Simpan Perubahan' : 'Tambah Ustadz'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- Modal Berikan Akses --}}
        {{-- ============================================================ --}}
        <div x-show="showAccessModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/40" @click="showAccessModal = false"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto">
                <div class="flex items-start justify-between mb-7 border-b border-gray-200 pb-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                            <i data-lucide="key" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-gray-800 text-lg">Berikan Akses</h2>
                            <p class="text-sm text-gray-600"
                                x-text="'Buat akun untuk Ustadz ' + (selectedTeacher?.teacher_name ?? '')"></p>
                        </div>
                    </div>
                    <button @click="showAccessModal = false"><i data-lucide="x"
                            class="w-5 h-5 text-gray-400"></i></button>
                </div>

                <div class="flex items-start gap-2 bg-blue-50 border border-blue-200 rounded-xl p-4 mb-5">
                    <i data-lucide="check-circle" class="w-4 h-4 text-blue-600 mt-0.5 shrink-0"></i>
                    <p class="text-sm text-blue-700">
                        <span class="font-semibold">Akun akan dibuat dengan peran "Ustadz"</span><br>
                        Ustadz akan dapat login dan mengakses fitur: input nilai, absensi, dan tahfidz.
                    </p>
                </div>

                <form :action="selectedTeacher ? selectedTeacher.giveAccessUrl : '#'" method="POST">
                    @csrf
                    <div class="space-y-3">
                        <div>
                            <label class="flex items-center gap-1 text-sm font-semibold text-gray-700 mb-2 mt-4">
                                <i data-lucide="mail" class="w-3.5 h-3.5"></i> Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" x-model="accessForm.email" required
                                placeholder="ustadz@ribath.ac.id"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 mt-4">Password <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input :type="showPassword ? 'text' : 'password'" name="password"
                                    x-model="accessForm.password" required placeholder="Minimal 8 karakter"
                                    class="w-full px-3 py-2.5 pr-10 border border-gray-200 rounded-xl text-sm">
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i data-lucide="eye" class="w-4 h-4" x-show="!showPassword"></i>
                                    <i data-lucide="eye-off" class="w-4 h-4" x-show="showPassword" x-cloak></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 mt-4">Konfirmasi Password <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input :type="showPasswordConfirm ? 'text' : 'password'" name="password_confirmation"
                                    x-model="accessForm.password_confirmation" required placeholder="Ulangi password"
                                    class="w-full px-3 py-2.5 pr-10 border border-gray-200 rounded-xl text-sm">
                                <button type="button" @click="showPasswordConfirm = !showPasswordConfirm"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i data-lucide="eye" class="w-4 h-4" x-show="!showPasswordConfirm"></i>
                                    <i data-lucide="eye-off" class="w-4 h-4" x-show="showPasswordConfirm" x-cloak></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6 pt-4 border-t border-gray-200">
                        <button type="button" @click="showAccessModal = false"
                            class="flex-1 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-700">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-sm font-semibold">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            Buat Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- Modal Hapus Ustadz --}}
        {{-- ============================================================ --}}
        <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/40" @click="showDeleteModal = false"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
                <h2 class="font-bold text-gray-800 text-lg mb-5 border-b border-gray-200 pb-5">Hapus Ustadz</h2>

                <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-4 mb-4">
                    <div
                        class="w-10 h-10 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-base" x-text="selectedTeacher?.teacher_name"></p>
                        <p class="text-sm text-gray-400" x-text="'Kode: ' + (selectedTeacher?.kode ?? '-')"></p>
                    </div>
                </div>

                <div class="flex items-start gap-2 bg-amber-50 border border-amber-200 rounded-xl p-4 mb-4">
                    <i data-lucide="alert-triangle" class="w-4 h-4 text-amber-600 mt-0.5 shrink-0"></i>
                    <p class="text-sm text-amber-700">
                        <span class="font-semibold">Konfirmasi Penghapusan</span>
                        <br>
                        Data ustadz akan dihapus (soft delete). Data dapat dipulihkan oleh administrator jika diperlukan.
                    </p>
                </div>

                <label class="block text-base text-gray-700 mb-2">Ketik <span class="font-bold text-red-600">HAPUS</span>
                    untuk mengonfirmasi:</label>
                <input type="text" x-model="deleteConfirmText" placeholder="HAPUS (dengan huruf kapital)" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm mb-4  placeholder:normal-case">

                <form :action="selectedTeacher ? selectedTeacher.destroyUrl : '#'" method="POST">
                    @csrf @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" @click="showDeleteModal = false"
                            class="flex-1 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-700">
                            Batal
                        </button>
                        <button type="submit" :disabled="deleteConfirmText !== 'HAPUS'"
                            :class="deleteConfirmText === 'HAPUS' ? 'bg-red-500 hover:bg-red-600' :
                                'bg-red-300 cursor-not-allowed'"
                            class="flex-1 flex items-center justify-center gap-2 py-2.5 text-white rounded-xl text-sm font-semibold transition-colors">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function ustadzPage() {
            return {
                showForm: false,
                editMode: false,
                showAccessModal: false,
                showDeleteModal: false,
                showPassword: false,
                showPasswordConfirm: false,
                selectedTeacher: null,
                deleteConfirmText: '',
                form: {
                    id: null,
                    teacher_name: '',
                    birth_place: '',
                    birth_date: '',
                    kode: '',
                    status: 'aktif',
                    gender: 'Laki-laki',
                    email: '',
                    whatsapp: '',
                    catatan: '',
                    password: '',
                    updateUrl: ''
                },
                accessForm: {
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                init() {
                    lucide.createIcons();
                },
                resetForm() {
                    this.form = {
                        id: null,
                        teacher_name: '',
                        birth_place: '',
                        birth_date: '',
                        kode: '',
                        status: 'aktif',
                        gender: 'Laki-laki',
                        email: '',
                        whatsapp: '',
                        catatan: '',
                        password: '',
                        updateUrl: ''
                    };
                },
                fillForm(data) {
                    this.form = {
                        id: data.id,
                        teacher_name: data.teacher_name,
                        birth_place: data.birth_place,
                        birth_date: data.birth_date,
                        kode: data.kode,
                        status: data.status ?? 'aktif',
                        gender: data.gender ?? 'Laki-laki',
                        email: data.email,
                        whatsapp: data.whatsapp,
                        catatan: data.catatan,
                        password: data.password ?? '',
                        updateUrl: data.updateUrl,
                    };
                },
                openAccessModal(teacher) {
                    this.selectedTeacher = teacher;
                    this.accessForm = {
                        email: teacher.email || '',
                        password: '',
                        password_confirmation: ''
                    };
                    this.showPassword = false;
                    this.showPasswordConfirm = false;
                    this.showAccessModal = true;
                },
                openDeleteModal(teacher) {
                    this.selectedTeacher = teacher;
                    this.deleteConfirmText = '';
                    this.showDeleteModal = true;
                },
            };
        }
        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
    </script>
@endpush
