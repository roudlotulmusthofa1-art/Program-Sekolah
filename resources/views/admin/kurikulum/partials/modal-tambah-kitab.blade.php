{{--
    Modal ini dipakai untuk create DAN edit (mode dikontrol oleh Alpine
    "mode" di kitabPage()). Method spoofing (_method) selalu dirender,
    nilainya di-bind dinamis lewat :value — BUKAN di-x-show — supaya
    tidak mengulang bug lama (PUT ikut terkirim saat create karena
    input method disembunyikan, bukan dihapus dari form).
--}}
<div
    x-show="showModal"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none;"
>
    {{-- backdrop --}}
    <div class="absolute inset-0 bg-black/50" @click="closeModal()"></div>

    <div
        x-show="showModal"
        x-transition
        @click.outside="closeModal()"
        class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800" x-text="mode === 'edit' ? 'Edit Kitab' : 'Tambah Kitab Baru'"></h2>
            <button type="button" @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form
            method="POST"
            :action="formAction"
            class="px-6 py-5 space-y-5"
        >
            @csrf
            <input type="hidden" name="_method" :value="mode === 'edit' ? 'PUT' : 'POST'">

            {{-- Nama Kitab --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Nama Kitab <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="nama_kitab"
                    x-model="form.nama_kitab"
                    placeholder="Masukkan nama kitab"
                    required
                    class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"
                >
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea
                    name="deskripsi"
                    x-model="form.deskripsi"
                    @input="descCount = form.deskripsi.length"
                    maxlength="500"
                    rows="3"
                    placeholder="Deskripsi singkat tentang kitab ini..."
                    class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm resize-none focus:outline-none focus:ring-2 focus:ring-teal-500"
                ></textarea>
                <p class="text-xs text-gray-400 text-right mt-1" x-text="descCount + '/500'"></p>
            </div>

            {{-- Bidang Ilmu --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Bidang Ilmu (Fann) <span class="text-red-500">*</span>
                </label>
                <select
                    name="bidang_ilmu_id"
                    x-model="form.bidang_ilmu_id"
                    required
                    class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white"
                >
                    <option value="">-- Pilih Bidang Ilmu --</option>
                    @foreach ($bidangIlmuOptions as $bidang)
                        <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Kelas (multi-select kartu) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Kelas <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($schoolClasses as $kelas)
                        <button
                            type="button"
                            @click="toggleKelas('{{ $kelas->id }}')"
                            :class="isKelasSelected('{{ $kelas->id }}')
                                ? 'border-teal-500 bg-teal-50'
                                : 'border-gray-200 hover:border-gray-300'"
                            class="text-left border rounded-lg px-3.5 py-2.5 transition"
                        >
                            <p class="text-sm font-medium text-gray-800">{{ $kelas->nama_kelas }}</p>
                            <p class="text-xs text-gray-400">{{ $kelas->kategori }}</p>
                        </button>
                    @endforeach
                </div>
                {{-- kirim tiap kelas terpilih sebagai kelas_ids[] --}}
                <template x-for="id in form.kelas_ids" :key="id">
                    <input type="hidden" name="kelas_ids[]" :value="id">
                </template>
            </div>

            {{-- Semester & Frekuensi --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Semester <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-2">
                        <button
                            type="button"
                            @click="toggleSemester('1')"
                            :class="isSemesterSelected('1') ? 'border-teal-500 bg-teal-50 text-teal-700' : 'border-gray-200 text-gray-600'"
                            class="flex-1 border rounded-lg py-2 text-sm font-medium flex items-center justify-center gap-1"
                        >
                            Sem 1
                            <i data-lucide="check" class="w-3.5 h-3.5" x-show="isSemesterSelected('1')"></i>
                        </button>
                        <button
                            type="button"
                            @click="toggleSemester('2')"
                            :class="isSemesterSelected('2') ? 'border-teal-500 bg-teal-50 text-teal-700' : 'border-gray-200 text-gray-600'"
                            class="flex-1 border rounded-lg py-2 text-sm font-medium flex items-center justify-center gap-1"
                        >
                            Sem 2
                            <i data-lucide="check" class="w-3.5 h-3.5" x-show="isSemesterSelected('2')"></i>
                        </button>
                    </div>
                    {{-- kirim tiap semester terpilih sebagai semesters[] --}}
                    <template x-for="s in form.semesters" :key="s">
                        <input type="hidden" name="semesters[]" :value="s">
                    </template>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Frekuensi per Minggu</label>
                    <input
                        type="number"
                        name="frekuensi_per_minggu"
                        x-model="form.frekuensi_per_minggu"
                        min="1"
                        max="20"
                        class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"
                    >
                </div>
            </div>

            {{-- Pengaturan Lanjutan (collapsible) --}}
            <div class="border border-gray-100 rounded-lg">
                <button
                    type="button"
                    @click="advancedOpen = !advancedOpen"
                    class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700"
                >
                    Pengaturan Lanjutan
                    <i data-lucide="chevron-right" class="w-4 h-4 transition-transform" :class="advancedOpen ? 'rotate-90' : ''"></i>
                </button>
                <div x-show="advancedOpen" x-transition class="px-4 pb-4 space-y-3 border-t border-gray-100">
                    {{--
                        Placeholder pengaturan tambahan — sesuaikan dengan
                        kebutuhan (mis. status aktif/nonaktif, catatan guru,
                        target hafalan halaman per pertemuan, dll).
                    --}}
                    <p class="text-xs text-gray-400 pt-3">Belum ada pengaturan tambahan.</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <button
                    type="button"
                    @click="closeModal()"
                    class="px-4 py-2.5 rounded-lg border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium"
                >
                    <i data-lucide="plus" class="w-4 h-4" x-show="mode === 'create'"></i>
                    <span x-text="mode === 'edit' ? 'Simpan Perubahan' : 'Simpan Kitab'"></span>
                </button>
            </div>
        </form>
    </div>
</div>