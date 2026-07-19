@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('content')
    <div x-data="tahunAjaranPage()" x-init="init()">

        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-1 hover:text-ribath-primary">
                <i data-lucide="home" class="w-4 h-4"></i> Beranda
            </a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <span>Admin</span>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <span class="text-gray-800 font-semibold">Tahun-ajaran</span>
        </nav>

        {{-- Header --}}
        <div class="flex items-start justify-between mt-12 mb-6 md:mx-10 lg:mx-20 xl:mx-60">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Tahun Ajaran</h1>
                <p class="text-base text-gray-500 mt-1">Kelola tahun ajaran dan semester aktif</p>
            </div>
            <button @click="openCreate()" x-transition x-cloak
                class="flex items-center gap-2 bg-ribath-primary hover:bg-ribath-dark text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Tahun Ajaran
            </button>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                class="mb-4 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="text-green-700 hover:text-green-900">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg">
                <p class="font-medium mb-1">Terjadi kesalahan:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Tambah/Edit --}}
        <div x-show="showForm" x-transition x-cloak
            class="bg-white border border-gray-200 rounded-xl p-6 mb-6 shadow-sm md:mx-10 lg:mx-20 xl:mx-60">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-bold text-gray-800"
                    x-text="editingId ? 'Edit Tahun Ajaran' : 'Tambah Tahun Ajaran'">
                </h2>
                <button @click="closeForm()" class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form :action="editingId ? `{{ url('tahun-ajaran') }}/${editingId}` : `{{ route('tahun-ajaran.store') }}`"
                method="POST">
                @csrf
                <template x-if="editingId">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 ">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Tahun Ajaran *</label>
                        <input type="text" name="nama" x-model="form.nama" maxlength="20" required
                            placeholder="Mis. 2024/2025, 1446/1447, atau Semester Ramadan"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ribath-primary/30 focus:border-ribath-primary">
                        <p class="text-xs text-gray-400 mt-1">Bebas, maksimal 20 karakter.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Semester Aktif *</label>
                        <select name="semester" x-model="form.semester" required
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ribath-primary/30 focus:border-ribath-primary">
                            <option value="ganjil">Semester 1 (Ganjil)</option>
                            <option value="genap">Semester 2 (Genap)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Mulai *</label>
                        <div class="relative">
                            <i data-lucide="calendar"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                            <input type="date" name="tanggal_mulai" x-model="form.tanggal_mulai" required
                                class="w-full pl-9 pr-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ribath-primary/30 focus:border-ribath-primary">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Selesai *</label>
                        <div class="relative">
                            <i data-lucide="calendar"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                            <input type="date" name="tanggal_selesai" x-model="form.tanggal_selesai" required
                                class="w-full pl-9 pr-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ribath-primary/30 focus:border-ribath-primary">
                        </div>
                    </div>
                </div>

                <label class="flex items-center gap-3 mt-5 cursor-pointer w-fit">
                    <input type="checkbox" name="is_aktif" value="1" x-model="form.is_aktif" class="sr-only peer">
                    <div
                        class="w-10 h-5.5 bg-gray-200 peer-checked:bg-ribath-primary rounded-full relative transition-colors">
                        <div class="absolute top-0.5 left-0.5 w-4.5 h-4.5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-4.5"
                            :class="form.is_aktif ? 'translate-x-4' : ''"></div>
                    </div>
                    <span class="text-sm text-gray-700">Aktifkan sebagai tahun ajaran utama</span>
                </label>

                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                        class="bg-ribath-primary hover:bg-ribath-dark text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                        Simpan
                    </button>
                    <button type="button" @click="closeForm()"
                        class="bg-white border border-gray-300 text-gray-700 text-sm font-medium px-5 py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>

        {{-- List Tahun Ajaran --}}
        <div class="space-y-4 md:mx-10 lg:mx-20 xl:mx-60">
            @forelse ($tahunAjarans as $tahun)
                <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center shrink-0">
                            <i data-lucide="calendar" class="w-5 h-5 text-ribath-primary"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="font-bold text-gray-800">{{ $tahun->nama }}</h3>
                                @if ($tahun->is_aktif)
                                    <span
                                        class="text-xs bg-green-100 text-green-700 font-medium px-2 py-0.5 rounded-full">Aktif</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-0.5">
                                {{ $tahun->semester_label }} • {{ $tahun->tanggal_mulai->translatedFormat('d M Y') }} -
                                {{ $tahun->tanggal_selesai->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <form action="{{ route('tahun-ajaran.toggle-status', $tahun) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="flex items-center gap-1.5 text-sm font-medium px-3.5 py-2 rounded-lg transition-colors
                                {{ $tahun->is_aktif ? 'bg-ribath-primary text-white hover:bg-ribath-dark' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}">
                                <i data-lucide="{{ $tahun->is_aktif ? 'check-circle' : 'circle-x' }}"
                                    class="w-4 h-4"></i>
                                {{ $tahun->is_aktif ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>

                        <button @click="openEdit(@js($tahun))"
                            class="w-9 h-9 flex items-center justify-center bg-white border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                            <i data-lucide="pencil" class="w-4 h-4"></i>
                        </button>

                        <form action="{{ route('tahun-ajaran.destroy', $tahun) }}" method="POST"
                            onsubmit="return confirm('Hapus tahun ajaran {{ $tahun->nama }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-9 h-9 flex items-center justify-center bg-red-500 hover:bg-red-600 rounded-lg text-white transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-400 text-sm">
                    Belum ada data tahun ajaran.
                </div>
            @endforelse
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        function tahunAjaranPage() {
            return {


                showForm: false,
                editingId: null,
                form: {
                    nama: '',
                    semester: 'ganjil',
                    tanggal_mulai: '',
                    tanggal_selesai: '',
                    is_aktif: false,
                },
                init() {
                    this.$nextTick(() => lucide.createIcons());
                },
                openCreate() {
                    this.editingId = null;
                    this.form = {
                        nama: '',
                        semester: 'ganjil',
                        tanggal_mulai: '',
                        tanggal_selesai: '',
                        is_aktif: false,
                    };
                    this.showForm = !this.showForm;
                    this.$nextTick(() => lucide.createIcons());
                },
                openEdit(data) {
                    if (this.showForm && this.editingId === data.id) {
                        this.closeForm();
                        return;
                    }
                    this.editingId = data.id;
                    this.form = {
                        nama: data.nama,
                        semester: data.semester,
                        tanggal_mulai: data.tanggal_mulai.split('T')[0],
                        tanggal_selesai: data.tanggal_selesai.split('T')[0],
                        is_aktif: !!data.is_aktif,
                    };
                    this.showForm = true;
                    this.$nextTick(() => lucide.createIcons());
                },
                closeForm() {
                    this.showForm = false;
                    this.editingId = null;
                    this.form = {
                        nama: '',
                        semester: 'ganjil',
                        tanggal_mulai: '',
                        tanggal_selesai: '',
                        is_aktif: false,
                    };
                }
            }
        }
    </script>
@endpush
