@extends('layouts.app')

@section('title', 'Biaya Pendidikan')
@push('styles')
    <style>
        .modal-content {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }

        .modal-backdrop {
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.35);
        }

        .data-row:hover {
            background-color: #f8fafc;
        }
    </style>
@endpush

@section('content')
    <div x-data="biayaPendidikanManager()">
        <div class="mb-6">
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4 ml-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-1 hover:text-teal-700 transition-colors">
                    <i data-lucide="home" class="w-3.5 h-3.5"></i>
                    Beranda
                </a>
                <span class="text-gray-300">/</span>
                <span class="font-medium text-gray-800">Biaya Pendidikan</span>
            </nav>
            <div class="flex flex-col item-start justify-between mt-12 mb-4 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div class="flex gap-4 justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Biaya Pendidikan</h1>
                    <button @click="openModal('create')"
                        class="flex items-center gap-1 justify-between bg-teal-700 hover:bg-teal-800 text-white py-2 px-4 rounded-md transition-colors">
                        <i data-lucide="plus" class="w-4 h-4 mr-1 inline-block"></i>
                        Tambah Biaya
                    </button>

                </div>
                <p class="text-sm text-gray-500 max-w-sm md:max-w-5xl">Komponen biaya per kombinasi Tahun Ajaran & Jenis
                    Biaya
                    (Pendaftaran, SPP, Uang
                    Gedung, dll). Tarif baru hanya berlaku untuk siswa yang masuk setelah perubahan (locked at enrollment)
                </p>
            </div>

            {{-- filter tahuhn ajaran dan jenis biaya --}}

            <div class="flex gap-4 mt-6 mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div class="relative w-60 ">
                    <select
                        class="w-full px-3 py-3 pr-10 appearance-none border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 hover:bg-gray-50 transition-colors sm:text-sm cursor-pointer"
                        name="tahun_ajaran" id="tahun_ajaran">
                        <option class="text-gray-300 mr-5" value="">Pilih Tahun Ajaran</option>
                    </select>
                    <i data-lucide="chevron-down"
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none"></i>
                </div>
                <div class="relative w-60">
                    <select
                        class="w-full px-3 py-3 pr-10 appearance-none border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 hover:bg-gray-50 transition-colors sm:text-sm cursor-pointer"
                        name="jenis_biaya" id="jenis_biaya">
                        <option class="text-gray-300 mr-5" value="">Pilih Jenis Biaya</option>
                    </select>
                    <i data-lucide="chevron-down"
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none"></i>
                </div>

            </div>
            <div class="mt-6 bg-white rounded-xl border-gray-200 shadow-sm overflow-hidden mx-4 md:mx-10 lg:mx-20 xl:mx-60">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr class="h-14 border border-gray-200">
                                <th scope="col" class="text-left px-6 py-3  tracking-wider">Tahun Ajaran</th>
                                <th scope="col" class="text-left px-6 py-3 tracking-wide">Jenis Biaya</th>
                                <th scope="col" class="text-left px-6 py-3 tracking-wide">Nominal</th>
                                <th scope="col" class="text-left px-6 py-3 tracking-wide">Frekuensi Tagihan</th>
                                <th scope="col" class="text-left pl-8xl py-3 tracking-wide">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="biaya-pendidikan-table-body">
                            @forelse ($biayaPendidikan as $biaya)
                                <tr class="data-row border-b border-gray-200 transtion-colors" {{-- data-id="{{ $biaya->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $biaya->tahun_ajaran }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $biaya->jenis_biaya }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $biaya->nominal }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $biaya->frekuensi_tagihan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap"> --}}
                                    data-id="{{ $biaya['id'] }}">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $biaya['tahun_ajaran_id'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $biaya['jenis_biaya_id'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $biaya['nominal'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $biaya['frekuensi_tagihan'] }}</td>

                                    <td class=" py-4 whitespace-nowrap">
                                        <div class="flex gap-1.5">

                                            <button
                                                @click="openModal('edit', {
        id: {{ $biaya['id'] }},
        tahun_ajaran_id: {{ $biaya['tahun_ajaran_id'] }},
        jenis_biaya_id: {{ $biaya['jenis_biaya_id'] }},
        nominal: {{ $biaya['nominal'] }},
        frekuensi_tagihan: '{{ $biaya['frekuensi_tagihan'] }}'
        })"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg text-teal-500 hover:text-teal-700 transition-colors"
                                                title="Edit">
                                                <i data-lucide="edit" class="h-3.5 w-3.5"></i>
                                            </button>
                                            <button
                                                @click="confirmDelete(
        {{ $biaya['id'] }},
        'Data Biaya Pendidikan'
        )"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg text-red-500 hover:text-red-700 transition-colors"
                                                title="Hapus">
                                                <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data biaya
                                        pendidikan.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- modal biaya pendidikan --}}
        <div x-show="modal.open" x-cloak class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4"
            @keydown.escape.window="closeModal()">
            <div x-show="modal.open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="bg-white rounded-2xl shadow-2xl w-full max-w-fit" @click.stop>
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-gray-800 text-xl"
                            x-text="modal.mode==='create' ? 'Tambah Biaya Pendidikan' : 'Edit Biaya Pendidikan'"></h3>
                        <button @click="closeModal()"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100"
                            title="Tutup">
                            <i data-lucide="x" class="w-5 h-5"></i>
                    </div>
                    <p class="text-gray-400 text-sm w-full max-w-sm">
                        Satu tarif per kombinasi Tahun Ajaran × Jenis Biaya. Frekuensi tagihan mengikuti definisi jenis
                        biaya.
                    </p>
                </div>
                {{-- form create --}}
                <form x-show="modal.mode==='create'" action="{{ route('biaya-pendidikan.store') }}" method="post"
                    class="px-6 py-2 space-y-4">
                    @csrf
                    <div>
                        <label for="tahun_ajaran_id" class="text-sm font-semibold text-gray-700 mb-2">Tahun Ajaran <span
                                class="text-red-500">*</span></label>
                        <select name="tahun_ajaran_id" x-model="modal.data.tahun_ajaran_id"
                            class="w-full px-3 py-2.5 border rounded-lg">

                            <option value="">Pilih Tahun Ajaran</option>

                            @foreach ($tahunAjaran as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['nama'] }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div>
                        <label for="jenis_biaya_id" class="text-sm font-semibold text-gray-700 mb-2">Jenis Biaya<span
                                class="text-red-500">*</span></label>
                        <select name="jenis_biaya_id" id="jenis_biaya_id"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 mt-2">
                            <option value="">Pilih Jenis Biaya</option>
                            @foreach ($jenisBiaya as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['nama'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="nominal">Nominal <span class="text-red-500">*</span></label>
                        <input type="number" name="nominal" id="nominal" required placeholder="Contoh : 50.000"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 mt-2">
                    </div>
                    <div>
                        <label for="Frekuensi_tagihan" class="text-sm font-semibold text-gray-700 mb-2">Frekuensi
                            Tagihan<span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_biaya_id" id="jenis_biaya_id"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 mt-2">
                            <option value="">Pilih Frekuensi Tagihan</option>
                            <option value="">minguan</option>
                            <option value="">tahunan</option>
                            {{-- @foreach ($jenisBiaya as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['nama'] }}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class=" flex gap-4 justify-end border-t border-gray-200">
                        <button type="button" @click="closeModal()"
                            class=" px-5 py-2 bg-white border border-teal-300 rounded-lg text-gray-600 text-sm font-semibold hover:bg-teal-600/10 my-5">Batal</button>
                        <button type="submit"
                            class="px-5 py-2 bg-teal-700  rounded-lg text-gray-100 text-sm font-semibold hover:bg-teal-800 my-5">Simpan</button>
                    </div>
                </form>

                {{-- Form EDIT --}}
                <form x-show="modal.mode==='edit'" action="#" method="POST" class="px-6 py-2 space-y-4">
                    <div>
                        <label for="jenis_biaya_id" class="text-sm font-semibold text-gray-700 mb-2">Tahun Ajaran <span
                                class="text-red-500">*</span></label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" x-model="modal.data.tahun_ajaran_id"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 mt-2">

                            <option value="">Pilih Tahun Ajaran</option>

                            @foreach ($tahunAjaran as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['nama'] }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div>
                        <label for="jenis_biaya_id" class="text-sm font-semibold text-gray-700 mb-2">Jenis Biaya<span
                                class="text-red-500">*</span></label>
                        <select name="jenis_biaya" id="jenis_biaya" x-model="modal.data.jenis_biaya_id"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 mt-2">
                            <option value="">Pilih Jenis Biaya</option>
                            @foreach ($jenisBiaya as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['nama'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="nominal">Nominal <span class="text-red-500">*</span></label>
                        <input type="number" name="nominal" id="nominal" x-model="modal.data.nominal" required
                            placeholder="Contoh : 50.000"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 mt-2">
                    </div>
                    <div>
                        <label for="Frekuensi_tagihan" class="text-sm font-semibold text-gray-700 mb-2">Frekuensi
                            Tagihan<span class="text-red-500">*</span>
                        </label>
                        <select name="frekuensi_tagihan" id="frekuensi_tagihan" x-model="modal.data.frekuensi_tagihan"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 mt-2">
                            <option value="">Pilih Frekuensi Tagihan</option>

                            {{-- @foreach ($jenisBiaya as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['nama'] }}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class=" flex gap-4 justify-end border-t border-gray-200">
                        <button type="button" @click="closeModal()"
                            class=" px-5 py-2 bg-white border border-teal-300 rounded-lg text-gray-600 text-sm font-semibold hover:bg-teal-600/10 my-5">Batal</button>
                        <button type="submit"
                            class="px-5 py-2 bg-teal-700  rounded-lg text-gray-100 text-sm font-semibold hover:bg-teal-800 my-5">Simpan
                            Perubahan</button>
                    </div>

                </form>
            </div>
        </div>
        {{-- Mpdal Hapus  --}}
                    <div x-show="deleteModal.open" x-cloak
                        class="fixed inset-0 z-50 modal-backdrop flex items-center justify-center p-4">
                        <div x-show="deleteModal.open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
                            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-1">Hapus Biaya Pendidikan</h3>
                            <p class="text-sm text-gray-500 mb-5">Anda yakin akan menghapus Biaya Pendidikan "<strong
                                    x-text="deleteModal.name"></strong>" secara permanen ?</p>
                            <div class="flex gap-3">
                                <button @click="deleteModal.open=false"
                                    class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                                <form :action="'/biaya-pendidikan/' + deleteModal.id" method="POST" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold">Ya,
                                        Hapus</button>
                                </form>

                            </div>
                        </div>

                    </div>
    @endsection

    @push('scripts')
        <script>
            function biayaPendidikanManager() {
                return {
                    modal: {
                        open: false,
                        mode: 'create',
                        data: null
                    },
                    deleteModal: {
                        open: false,
                        id: null,
                        name: ''
                    },
                    // openModal(mode, data = null) {
                    //     this.modal.open = true;
                    //     this.modal.mode = mode;
                    //     this.modal.data = data;
                    // },

                    openModal(mode, data = null) {
                        this.modal.mode = mode;
                        this.modal.open = true;

                        if (mode === 'edit') {
                            this.modal.data = {
                                ...data
                            };
                        } else {
                            this.modal.data = {
                                tahun_ajaran_id: '',
                                jenis_biaya_id: '',
                                nominal: '',
                                frekuensi_tagihan: ''
                            };
                        }
                    },

                    closeModal() {
                        this.modal.open = false;
                        this.modal.data = null;
                    },

                    confirmDelete(id, name) {
                        this.deleteModal = {
                            open: true,
                            id: id,
                            name: name
                        };
                    },
                }
            }
        </script>
    @endpush
