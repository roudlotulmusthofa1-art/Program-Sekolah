{{--
    Partial: master-data/_form-kelas.blade.php
    Dipakai di modal "Tambah Kelas" (form create).
    Modal Edit pakai <template x-if> langsung di index.blade.php.
--}}

<div>
    <label class="block text-sm font-semibold text-gray-600 mb-1.5">
        Nama Kelas <span class="text-red-500">*</span>
    </label>
    <input
        type="text"
        name="nama_kelas"
        required
        autofocus
        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm
               focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500"
        placeholder="contoh: Tamhidi, Ibtida 1, Tahfidz 2 . . .">
</div>

<div>
    <label class="block text-sm font-semibold text-gray-600 mb-1.5">
        Kategori <span class="text-red-500">*</span>
    </label>
    <select
        name="kategori"
        required
        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm
               focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
        <option value="" disabled selected>— Pilih kategori —</option>
        @foreach ($daftarKategori as $kat)
            <option value="{{ $kat }}">{{ $kat }}</option>
        @endforeach
    </select>
</div>

<div>
    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Warna Label</label>
    <div class="flex items-center gap-3">
        <input
            type="color"
            name="color"
            value="#3b82f6"
            class="w-16 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5">
        <span class="text-sm text-gray-400">Pilih warna untuk identitas kelas</span>
    </div>
</div>