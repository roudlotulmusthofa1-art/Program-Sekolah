@extends('layouts.app')

@section('title', 'Pendaftaran Masuk')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('dropdown', {
            activeId: null,
            open(id) {
                this.activeId = id;
            },
            close() {
                this.activeId = null;
            },
            isOpen(id) {
                return this.activeId === id;
            }
        });
    });
</script>
@section('content')
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-1.5 text-sm text-gray-500 mb-5 ml-4">
        <a href="{{ route('dashboard') }}" class="hover:text-gray-700 flex items-center gap-1">
            <i data-lucide="home" class="w-3.5 h-3.5"></i> Beranda
        </a>
        <span class="text-gray-300">/</span>
        <span>Admin</span>
        <span class="text-gray-300">/</span>
        <span class="text-gray-800 font-semibold">Pendaftaran-masuk</span>
    </nav>

    <div class="space-y-6" x-data="{
        modalTerima: false,
        modalTolak: false,
        selectedId: null,
        selectedName: '',
        selectedIds: [],
        openTerima(id, name) {
            this.selectedId = id;
            this.selectedName = name;
            this.modalTerima = true;
        },
        openTolak(id, name) {
            this.selectedId = id;
            this.selectedName = name;
            this.modalTolak = true;
        },
        toggleSelectAll(checked) {
            this.selectedIds = checked ? [{{ $pendaftarans->pluck('id')->implode(',') }}] : [];
        }
    }">

        {{-- ── Header ─────────────────────────────────────────────── --}}
        <div class="mx-4 md:mx-10 lg:mx-20 xl:mx-60 mt-12 mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Pendaftaran Masuk</h1>
            <p class="text-2sm text-gray-500 mt-0.5">Kelola data calon santri yang mendaftar melalui formulir PSB online</p>
        </div>

        {{-- ── Flash Message ──────────────────────────────────────── --}}
        @if (session('success'))
            <div class="flex items-start gap-3 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm"
                x-data x-init="setTimeout(() => $el.remove(), 6000)">
                <i data-lucide="check-circle" class="w-4 h-4 mt-0.5 shrink-0 text-green-500"></i>
                <span>{!! session('success') !!}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="flex items-start gap-3 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm">
                <i data-lucide="x-circle" class="w-4 h-4 mt-0.5 shrink-0 text-red-500"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- ── Stats Cards ─────────────────────────────────────────── --}}
        @php
            $cards = [
                [
                    'label' => 'Total',
                    'value' => $stats['total'],
                    'bg' => 'bg-blue-50',
                    'border' => 'border-blue-200',
                    'text' => 'text-blue-600',
                    'num' => 'text-blue-700',
                    'icon' => 'users',
                ],
                [
                    'label' => 'Perlu Follow-up',
                    'value' => $stats['follow_up'],
                    'bg' => 'bg-orange-50',
                    'border' => 'border-orange-200',
                    'text' => 'text-orange-600',
                    'num' => 'text-orange-700',
                    'icon' => 'clock',
                ],
                [
                    'label' => 'Dihubungi',
                    'value' => $stats['dihubungi'],
                    'bg' => 'bg-cyan-50',
                    'border' => 'border-cyan-200',
                    'text' => 'text-cyan-600',
                    'num' => 'text-cyan-700',
                    'icon' => 'message-circle',
                ],
                [
                    'label' => 'Dalam Proses',
                    'value' => $stats['dalam_proses'],
                    'bg' => 'bg-purple-50',
                    'border' => 'border-purple-200',
                    'text' => 'text-purple-600',
                    'num' => 'text-purple-700',
                    'icon' => 'trending-up',
                ],
                [
                    'label' => 'Diterima',
                    'value' => $stats['diterima'],
                    'bg' => 'bg-green-50',
                    'border' => 'border-green-200',
                    'text' => 'text-green-600',
                    'num' => 'text-green-700',
                    'icon' => 'check-circle',
                ],
                [
                    'label' => 'Ditolak',
                    'value' => $stats['ditolak'],
                    'bg' => 'bg-red-50',
                    'border' => 'border-red-200',
                    'text' => 'text-red-600',
                    'num' => 'text-red-700',
                    'icon' => 'x-circle',
                ],
            ];
        @endphp

        <div class="mx-4 md:mx-10 lg:mx-20 xl:mx-60 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach ($cards as $c)
                <div class="rounded-xl border p-2 {{ $c['bg'] }} {{ $c['border'] }} h-20">
                    <div class="flex items-center gap-2 mb-3 ml-2">
                        <div
                            class="w-10 h-10 {{ str_replace('text-', 'bg-', $c['text']) }} rounded-lg flex items-center justify-center">
                            <i data-lucide="{{ $c['icon'] }}" class="w-5 h-5 text-white"></i>
                        </div>

                        <div class="ml-2">
                            <span class="text-xs {{ $c['text'] }} font-medium">{{ $c['label'] }}</span>
                            <p class="text-3xl font-bold {{ $c['num'] }}">{{ $c['value'] }}</p>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        {{-- ── Table Card ───────────────────────────────────────────── --}}
        <div class="mx-4 md:mx-10 lg:mx-20 xl:mx-60 bg-white rounded-2xl border border-gray-100 shadow-sm">

            {{-- Card Header --}}
            <div class="flex items-center justify-between px-6 mt-6 mb-2 ">
                <h2 class="font-semibold text-xl text-gray-800">Manajemen Pendaftaran</h2>
                <button onclick="window.location.reload()"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Refresh
                </button>
            </div>


            {{-- Filter Bar --}}
            <form method="GET" action="{{ route('psb.pendaftaran.index') }}"
                class="flex flex-wrap items-center gap-3 px-6 py-3">

                <div class="relative flex-1 min-w-64">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, nomor pendaftaran, atau WhatsApp..."
                        class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400">
                </div>

                <select name="status" onchange="this.form.submit()"
                    class="px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-300 bg-gray-50 min-w-40">
                    <option value="semua" @selected(!request('status') || request('status') === 'semua')>Semua Status</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                    <option value="follow_up" @selected(request('status') === 'follow_up')>Perlu Follow-up</option>
                    <option value="dihubungi" @selected(request('status') === 'dihubungi')>Dihubungi</option>
                    <option value="dalam_proses" @selected(request('status') === 'dalam_proses')>Dalam Proses</option>
                    <option value="diterima" @selected(request('status') === 'diterima')>Diterima</option>
                    <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
                </select>

                {{-- Toggle Arsip --}}
                <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer select-none">
                    <div class="relative" x-data>
                        <input type="checkbox" name="arsip" value="1" {{ request('arsip') ? 'checked' : '' }}
                            class="sr-only peer" onchange="this.form.submit()">
                        <div
                            class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-teal-600 transition-colors duration-200">
                        </div>
                        <div
                            class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-5">
                        </div>
                    </div>
                    Tampilkan Arsip
                </label>
            </form>
            {{-- table terima,tolak, hapus data massal --}}
            {{-- ── Bulk Action Toolbar ── --}}
            <div x-show="selectedIds.length > 0" x-cloak
                class="flex items-center justify-between px-6 py-3 bg-teal-50 border border-teal-200 mx-5 my-3 rounded-2xl">
                <span class="text-sm text-teal-700 font-medium" x-text="selectedIds.length + ' Pendaftaran dipilih'"></span>

                <div class="flex items-center gap-2">
                    {{-- Terima Terpilih --}}
                    {{-- Terima Terpilih --}}
                    <button type="button"
                        @click="
        if (confirm('Saya Menerima ' + selectedIds.length + ' pendaftaran terpilih?')) {
            $nextTick(() => {
                document.getElementById('bulk_ids_terima').value = selectedIds.join(',');
                document.getElementById('bulk-terima-form').submit();
            });
        }
    "
                        class="inline-flex items-center gap-1.5 px-3 py-3 text-xs font-medium bg-green-600 text-white rounded-lg hover:bg-green-700">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Terima Terpilih
                    </button>

                    {{-- Tolak Terpilih --}}
                    <button type="button"
                        @click="
        if (confirm('Saya menolak ' + selectedIds.length + ' pendaftaran terpilih?')) {
            $nextTick(() => {
                document.getElementById('bulk_ids_tolak').value = selectedIds.join(',');
                document.getElementById('bulk-tolak-form').submit();
            });
        }
    "
                        class="inline-flex items-center gap-1.5 px-3 py-3 text-xs font-medium bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                        <i data-lucide="x-circle" class="w-3.5 h-3.5"></i> Tolak Terpilih
                    </button>

                    {{-- Hapus Terpilih --}}
                    <button type="button"
                        @click="
        if (confirm('saya menghapus ' + selectedIds.length + ' data terpilih? Tidak dapat dibatalkan!')) {
            $nextTick(() => {
                document.getElementById('bulk_ids_hapus').value = selectedIds.join(',');
                document.getElementById('bulk-delete-form').submit();
            });
        }
    "
                        class="inline-flex items-center gap-1.5 px-3 py-3 text-xs font-medium bg-red-600 text-white rounded-lg hover:bg-red-700">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus Terpilih
                    </button>
                </div>
            </div>



            {{-- Table --}}

            <div class="overflow-x-auto mx-5 my-3 border border-gray-200 rounded-2xl">
                <table class="w-full text-sm ">
                    <thead class="border-b border-gray-200 bg-gray-100">
                        <th class="px-6 py-4 w-8">
                            <div @click="toggleSelectAll(!(selectedIds.length > 0 && selectedIds.length === {{ $pendaftarans->count() }}))"
                                class="w-5 h-5 rounded-full border-2 cursor-pointer flex items-center justify-center transition-all duration-150"
                                :class="selectedIds.length > 0 && selectedIds.length === {{ $pendaftarans->count() }} ?
                                    'bg-teal-600 border-teal-600' :
                                    'bg-white border-gray-300 hover:border-teal-400'">
                                <svg x-show="selectedIds.length > 0 && selectedIds.length === {{ $pendaftarans->count() }}"
                                    class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </th>
                        <th class="px-6 py-3">No. Pendaftaran</th>
                        <th class="px-6 py-3">Nama Santri</th>
                        <th class="px-6 py-3">Nama Wali</th>
                        <th class="px-6 py-3">WhatsApp</th>
                        <th class="px-6 py-3">Program</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 ">
                        @forelse($pendaftarans as $p)
                            @php
                                $namaWali = $p->father_name ?? ($p->mother_name ?? '-');
                                $noWa = $p->father_phone ?? ($p->mother_phone ?? ($p->no_telepon ?? '-'));
                                $waLink =
                                    'https://wa.me/' . preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $noWa));
                                // Program dari quran_reading_ability atau education_level bisa jadi indikator,
                                // tapi kita gunakan periode_psb atau fallback
                                $program = $p->education_level ?? 'Program Regular';
                                $programColor =
                                    str_contains(strtolower($program), 'tahfidz') || $p->memorized_juz > 0
                                        ? 'bg-teal-600 text-white'
                                        : 'bg-amber-500 text-white';

                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'follow_up' => 'bg-orange-100 text-orange-700',
                                    'dihubungi' => 'bg-blue-100 text-blue-700',
                                    'dalam_proses' => 'bg-purple-100 text-purple-700',
                                    'diterima' => 'bg-green-100 text-green-700',
                                    'ditolak' => 'bg-red-100 text-red-700',
                                ];
                            @endphp

                            <tr class="hover:bg-gray-50/90 transition-colors group ">
                                <td class="px-6 py-4">
                                    <div @click="selectedIds.includes({{ $p->id }})
                                            ? selectedIds = selectedIds.filter(i => i !== {{ $p->id }})
                                        : selectedIds.push({{ $p->id }})"
                                        class="w-5 h-5 rounded-full border-2 cursor-pointer flex items-center justify-center transition-all duration-150"
                                        :class="selectedIds.includes({{ $p->id }}) ?
                                            'bg-teal-600 border-teal-600' :
                                            'bg-white border-gray-300 hover:border-teal-400'">
                                        <svg x-show="selectedIds.includes({{ $p->id }})"
                                            class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('psb.pendaftaran.show', $p) }}"
                                        class="text-teal-700 hover:text-teal-800 font-medium hover:underline">
                                        {{ $p->no_pendaftaran }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    {{ $p->nama_lengkap }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $namaWali }}</td>
                                <td class="px-6 py-4">
                                    @if ($noWa !== '-')
                                        <a href="{{ $waLink }}" target="_blank"
                                            class="text-teal-600 hover:text-teal-700 inline-flex items-center gap-1 hover:underline">
                                            {{ $noWa }}
                                            <i data-lucide="external-link" class="w-3 h-3"></i>
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $programColor }}">
                                        {{ $program }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColors[$p->status] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ $p->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs whitespace-nowrap">
                                    {{ $p->created_at?->translatedFormat('j M Y') ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div x-data="{
                                        dropdownId: 'menu-{{ $p->id }}',
                                        subOpen: false,
                                        dropX: 0,
                                        dropY: 0,
                                        openMenu(btn) {
                                            const rect = btn.getBoundingClientRect();
                                            $store.dropdown.open('menu-{{ $p->id }}');
                                            this.$nextTick(() => {
                                                const dropdownHeight = this.$refs.dropdown.offsetHeight;
                                                const dropdownWidth = this.$refs.dropdown.offsetWidth;
                                                const spaceBelow = window.innerHeight - rect.bottom;
                                                this.dropX = rect.right - dropdownWidth;
                                                this.dropY = spaceBelow < dropdownHeight ?
                                                    rect.top - dropdownHeight - 6 :
                                                    rect.bottom + 6;
                                            });
                                        }
                                    }" class="flex justify-center">

                                        <button @click.stop="openMenu($el)"
                                            class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-700 transition-colors">
                                            <i data-lucide="more-horizontal" class="w-4 h-4"></i>
                                        </button>

                                        {{-- Dropdown: posisi fixed, tidak geser tabel --}}
                                        <div x-show="$store.dropdown.isOpen(dropdownId)" x-ref="dropdown"
                                            @click.outside="$store.dropdown.close(); subOpen=false" x-transition
                                            :style="'position:fixed; top:' + dropY + 'px; left:' + dropX + 'px; z-index:9999;'"
                                            class="w-52 bg-white border border-gray-100 rounded-xl shadow-xl py-1.5 text-left">

                                            <a href="{{ route('psb.pendaftaran.show', $p) }}"
                                                class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                <i data-lucide="eye" class="w-4 h-4 text-gray-400"></i> Lihat Detail
                                            </a>

                                            {{-- Ubah Status (submenu) --}}
                                            <div class="relative">
                                                <button @click="subOpen=!subOpen"
                                                    class="w-full flex items-center justify-between gap-2.5 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                    <span class="flex items-center gap-2.5">
                                                        <i data-lucide="activity" class="w-4 h-4 text-gray-400"></i> Ubah
                                                        Status
                                                    </span>
                                                    <i data-lucide="chevron-right" class="w-3 h-3 text-gray-400"></i>
                                                </button>
                                                <div x-show="subOpen"
                                                    class="absolute left-full top-0 w-44 bg-white border border-gray-100 rounded-xl shadow-lg py-1.5 ml-1">
                                                    @foreach (\App\Models\PendaftaranSiswa::STATUS_LABELS as $val => $label)
                                                        @if ($val !== $p->status)
                                                            <form
                                                                action="{{ route('psb.pendaftaran.update-status', $p) }}"
                                                                method="POST">
                                                                @csrf @method('PATCH')
                                                                <input type="hidden" name="status"
                                                                    value="{{ $val }}">
                                                                <button
                                                                    class="w-full text-left px-4 py-2 text-xs hover:bg-gray-50 text-gray-700">
                                                                    {{ $label }}
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="border-t border-gray-100 my-1"></div>

                                            {{-- Terima & Tolak — buka modal, tidak pakai form wrapper --}}
                                            @if ($p->status !== 'diterima' && $p->status !== 'ditolak')
                                                <button type="button"
                                                    @click="open=false; openTerima({{ $p->id }}, '{{ addslashes($p->nama_lengkap) }}')"
                                                    class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-green-700 hover:bg-green-50">
                                                    <i data-lucide="check-circle" class="w-4 h-4"></i> Terima Santri
                                                </button>

                                                <button type="button"
                                                    @click="open=false; openTolak({{ $p->id }}, '{{ addslashes($p->nama_lengkap) }}')"
                                                    class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                    <i data-lucide="x-circle" class="w-4 h-4"></i> Tolak
                                                </button>
                                            @endif

                                            @if ($p->status === 'diterima' && $p->kode_akses)
                                                <a href="{{ route('psb.pendaftaran.kirim-kode', $p) }}"
                                                    class="flex items-center gap-2.5 px-4 py-2 text-sm text-green-700 hover:bg-green-50">
                                                    <i data-lucide="message-circle" class="w-4 h-4"></i> Kirim Kode WA
                                                </a>
                                            @endif

                                            <div class="border-t border-gray-100 my-1"></div>

                                            <form action="{{ route('psb.pendaftaran.archive', $p) }}" method="POST">
                                                @csrf
                                                <button
                                                    class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-gray-500 hover:bg-gray-50">
                                                    <i data-lucide="archive" class="w-4 h-4"></i>
                                                    {{ $p->is_archived ? 'Pulihkan dari Arsip' : 'Arsipkan' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('psb.pendaftaran.destroy', $p) }}" method="POST"
                                                onsubmit="return confirm('Hapus data ini? Tidak dapat dibatalkan!')">
                                                @csrf @method('DELETE')
                                                <button
                                                    class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-red-500 hover:bg-red-50">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-16 text-gray-400">
                                    <div class="flex flex-col items-center gap-3">
                                        <i data-lucide="inbox" class="w-12 h-12 opacity-20"></i>
                                        <p class="text-sm">Belum ada data pendaftaran</p>
                                        <a href="{{ url('/pendaftaransiswa/step1') }}"
                                            class="text-xs text-teal-600 hover:underline">Lihat form pendaftaran publik
                                            →</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($pendaftarans->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $pendaftarans->links() }}
                </div>
            @endif
        </div>



            {{-- Hidden Forms --}}
            <form id="bulk-terima-form" action="{{ route('psb.pendaftaran.bulk-terima') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="ids" id="bulk_ids_terima">
            </form>

            <form id="bulk-tolak-form" action="{{ route('psb.pendaftaran.bulk-tolak') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="ids" id="bulk_ids_tolak">
            </form>

            <form id="bulk-delete-form" action="{{ route('psb.pendaftaran.bulk-destroy') }}" method="POST"
                class="hidden">
                @csrf
                @method('DELETE')
                <input type="hidden" name="ids" id="bulk_ids_hapus">
            </form>

        {{-- ══════════════════════════════════════════════════════════════
     MODAL: TERIMA SANTRI
══════════════════════════════════════════════════════════════ --}}
        <div x-show="modalTerima" x-cloak class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div @click.outside="modalTerima=false"
                class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100">

                <div class="p-6 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Terima Pendaftaran</h3>
                        <p class="text-sm text-gray-500" x-text="selectedName"></p>
                    </div>
                </div>

                <form :action="`/psb/pendaftaran/${selectedId}/terima`" method="POST" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Tempatkan di Kelas <span class="text-gray-400 font-normal">(opsional)</span>
                        </label>
                        <select name="school_class_id"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 bg-white">
                            <option value="">-- Belum ditentukan --</option>
                            @foreach ($schoolClasses as $class)
                                <option value="{{ $class->id }}">{{ $class->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="bg-amber-50 border border-amber-100 rounded-xl p-3.5 text-sm text-amber-800">
                        <p class="font-medium mb-1">💡 Yang akan terjadi setelah ini:</p>
                        <ul class="space-y-1 text-xs list-disc list-inside text-amber-700">
                            <li>Data santri disalin ke tabel <strong>students</strong></li>
                            <li>Kode akses unik dibuat otomatis</li>
                            <li>Wali dapat mendaftar akun menggunakan kode tersebut</li>
                        </ul>
                    </div>

                    <div class="flex gap-3 pt-1">
                        <button type="button" @click="modalTerima=false"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 text-sm transition font-medium">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 text-sm transition font-semibold">
                            ✓ Ya, Terima
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
     MODAL: TOLAK
══════════════════════════════════════════════════════════════ --}}
        <div x-show="modalTolak" x-cloak class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div @click.outside="modalTolak=false" class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100">

                <div class="p-6 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                        <i data-lucide="x-circle" class="w-5 h-5 text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Tolak Pendaftaran</h3>
                        <p class="text-sm text-gray-500" x-text="selectedName"></p>
                    </div>
                </div>

                <form :action="`/psb/pendaftaran/${selectedId}/tolak`" method="POST" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Alasan Penolakan <span class="text-gray-400 font-normal">(opsional)</span>
                        </label>
                        <textarea name="catatan" rows="3" placeholder="Tulis alasan penolakan..."
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-300 resize-none"></textarea>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="modalTolak=false"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 text-sm transition font-medium">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 text-sm transition font-semibold">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div> {{-- tutup x-data --}}

    @push('scripts')
        <script>
            // Re-init Lucide setelah Alpine render dropdown
            document.addEventListener('alpine:initialized', () => {
                setTimeout(() => lucide.createIcons(), 50);
            });
        </script>
    @endpush
@endsection
