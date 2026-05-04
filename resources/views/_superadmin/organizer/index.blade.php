@extends('_superadmin._layout.app')

@section('title', 'Manajemen Struktur Organisasi')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Kelola struktur dan jabatan pengurus Rohis per periode
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-hidden focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none font-bolder shadow-md shadow-brand/20 active:scale-95 transition-all text-center"
                    href="{{ route('superadmin.organizer.add') }}">
                    @include('_admin._layout.icons.add')
                    Tambah Anggota
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-6 mt-4">
        <!-- Filter Form -->
        <div class="px-2 pt-4">
            <form id="filter-form" action="{{ route('superadmin.organizer.index') }}" method="GET" navigate-form
                class="flex flex-col lg:flex-row items-end gap-x-4 gap-y-4">

                <!-- Search -->
                <div class="w-full lg:w-72">
                    <label for="keywords"
                        class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                        Cari Anggota...
                    </label>
                    <div class="relative">
                        <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                            class="py-2.5 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 shadow-sm"
                            placeholder="Cari nama atau jabatan...">
                        <div class="absolute inset-y-0 inset-e-0 flex items-center pointer-events-none pe-4">
                            @include('_admin._layout.icons.search')
                        </div>
                    </div>
                </div>

                <!-- Filter Periode -->
                <div class="w-full lg:w-56">
                    <label for="periode"
                        class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                        Periode
                    </label>
                    <select id="periode" name="periode"
                        data-hs-select='{
                            "placeholder": "Pilih periode...",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 ps-4 pe-9 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-gray-200 text-gray-800 rounded-xl text-start text-sm hover:bg-gray-50 focus:outline-hidden shadow-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800",
                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                            "optionClasses": "hs-selected:bg-brand/10 dark:hs-selected:bg-brand/20 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-brand\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-400 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }'
                        class="hidden">
                        @foreach ($periodeList as $p)
                            <option value="{{ $p }}" {{ $periode === $p ? 'selected' : '' }}>
                                Periode {{ $p }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <button type="submit"
                        class="size-[42px] inline-flex justify-center items-center gap-x-1 text-sm font-semibold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-none transition-all active:scale-95 shadow-md shadow-brand/20 cursor-pointer"
                        title="Terapkan Filter">
                        @include('_admin._layout.icons.search')
                    </button>
                    @if (!empty($keywords) || ($status_data ?? 'aktif') !== 'aktif' || $periode !== $defaultPeriode)
                        <a navigate
                            class="size-[42px] inline-flex justify-center items-center gap-x-1 text-sm font-semibold rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 focus:outline-none transition-all active:scale-95 shadow-sm"
                            href="{{ route('superadmin.organizer.index') }}" title="Reset Filter">
                            @include('_admin._layout.icons.reset')
                        </a>
                    @endif
                </div>

                <!-- Status Data Toggle -->
                <div class="w-full lg:w-auto lg:ms-auto">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                        Status Data
                    </label>
                    <div class="inline-flex p-0.5 bg-gray-100 rounded-xl dark:bg-neutral-800 w-full lg:w-auto">
                        <input type="hidden" name="status_data" id="status_data_input" value="{{ $status_data ?? 'aktif' }}">
                        <button type="button" onclick="setStatusData('aktif')" id="status_data_aktif"
                            class="py-2 px-6 flex-1 lg:flex-none inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent transition-all {{ ($status_data ?? 'aktif') == 'aktif' ? 'bg-brand text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                            Aktif
                        </button>
                        <button type="button" onclick="setStatusData('nonaktif')" id="status_data_nonaktif"
                            class="py-2 px-6 flex-1 lg:flex-none inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent transition-all {{ ($status_data ?? 'aktif') == 'nonaktif' ? 'bg-brand text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                            Sampah
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Periode Badge Info -->
        <div class="px-2">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold uppercase text-gray-400 dark:text-neutral-500">Menampilkan periode:</span>
                <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-lg text-xs font-bold bg-brand/10 text-brand">
                    {{ $periode }}
                </span>
                @if ($periode !== $defaultPeriode)
                    <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-lg text-xs font-semibold bg-amber-50 text-amber-600 dark:bg-amber-900/20">
                        Periode Lampau
                    </span>
                @else
                    <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20">
                        Periode Aktif
                    </span>
                @endif
            </div>
        </div>

        <!-- Table View -->
        <div class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-2xl dark:border-neutral-700 shadow-sm bg-white dark:bg-neutral-800">
            <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-900/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Anggota</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Jabatan</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Periode</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-end">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @forelse ($organizers as $organizer)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-x-4">
                                    @if ($organizer->image)
                                        <img src="{{ asset('storage/' . $organizer->image) }}" alt="{{ $organizer->name }}"
                                            class="size-12 rounded-xl object-cover shrink-0 border border-gray-100 dark:border-neutral-700">
                                    @else
                                        <div class="size-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center text-sm font-bold uppercase shrink-0">
                                            {{ substr($organizer->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <span class="block text-sm font-bold text-gray-800 dark:text-neutral-200 line-clamp-1">
                                            {{ $organizer->name }}
                                        </span>
                                        <span class="block text-xs text-gray-500 dark:text-neutral-500 mt-1">
                                            Ditambahkan: {{ $organizer->created_at->format('d M, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $jabatanColor = match($organizer->jabatan) {
                                        'Pembina' => 'bg-purple-50 text-purple-700 dark:bg-purple-900/20 dark:text-purple-400',
                                        'Ketua' => 'bg-brand/10 text-brand',
                                        'Wakil Ketua' => 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400',
                                        'Sekretaris 1', 'Sekretaris 2' => 'bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400',
                                        'Bendahara' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400',
                                        default => 'bg-gray-100 text-gray-600 dark:bg-neutral-700 dark:text-neutral-300',
                                    };
                                @endphp
                                <span class="inline-flex items-center py-1 px-3 rounded-lg text-xs font-bold {{ $jabatanColor }}">
                                    {{ $organizer->jabatan }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600 dark:text-neutral-400 font-medium">
                                    {{ $organizer->periode }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-end">
                                <div class="flex justify-end gap-1.5">
                                    @if ($organizer->trashed())
                                        <button type="button"
                                            class="p-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-500 transition-all active:scale-90"
                                            title="Pulihkan"
                                            data-hs-overlay="#restore-modal"
                                            onclick="setRestoreData('{{ $organizer->id }}', '{{ addslashes($organizer->name) }}')"
                                        >
                                            @include('_admin._layout.icons.reset')
                                        </button>
                                        <button type="button" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 dark:bg-rose-900/20 dark:text-rose-500 transition-all active:scale-90"
                                            data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $organizer->id }}', '{{ addslashes($organizer->name) }}', true)" title="Hapus Permanen">
                                            @include('_admin._layout.icons.trash')
                                        </button>
                                    @else
                                        <a navigate href="{{ route('superadmin.organizer.update', $organizer->id) }}"
                                            class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-500 transition-all active:scale-90" title="Edit">
                                            @include('_admin._layout.icons.pencil')
                                        </a>
                                        <button type="button" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-500 transition-all active:scale-90"
                                            data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $organizer->id }}', '{{ addslashes($organizer->name) }}', false)" title="Hapus">
                                            @include('_admin._layout.icons.trash')
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <x-admin.empty-state title="Belum Ada Data Pengurus" description="Belum ada data pengurus untuk periode {{ $periode }}. Tambahkan anggota baru atau pilih periode lain." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($organizers->hasPages())
            <div class="mt-4 px-2">
                {{ $organizers->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden">
                <div class="p-4 sm:p-10 text-center">
                    <span class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700/30 dark:border-red-600 dark:text-red-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>
                    <h3 id="delete-modal-title" class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Hapus Anggota
                    </h3>
                    <p class="text-gray-500 dark:text-neutral-500 px-6">
                        Apakah Anda yakin ingin menghapus <span id="delete-item-name" class="font-bold text-gray-800 dark:text-neutral-200"></span>? <span id="delete-alert-text">Data akan dipindahkan ke sampah.</span>
                    </p>
                    <div class="mt-8 flex justify-center gap-x-3">
                        <button type="button" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" data-hs-overlay="#delete-modal">Batal</button>
                        <form id="delete-form" method="POST" class="inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-submit-btn" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-red-600 text-white hover:bg-red-700 cursor-pointer shadow-md shadow-red-500/20 transition-all active:scale-95">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Restore Confirmation Modal -->
    <div id="restore-modal" class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden">
                <div class="p-4 sm:p-10 text-center">
                    <span class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-blue-50 bg-blue-100 text-blue-500 dark:bg-blue-700/30 dark:border-blue-600 dark:text-blue-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>
                    <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Pulihkan Anggota
                    </h3>
                    <p class="text-gray-500 dark:text-neutral-500 px-6">
                        Apakah Anda yakin ingin memulihkan
                        <span id="restore-item-name" class="font-bold text-gray-800 dark:text-neutral-200"></span>
                        dari sampah?
                    </p>
                    <div class="mt-8 flex justify-center gap-x-3">
                        <button type="button"
                            class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300"
                            data-hs-overlay="#restore-modal">
                            Batal
                        </button>
                        <form id="restore-form" method="POST" class="inline" navigate-form>
                            @csrf
                            <button type="submit"
                                class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-blue-600 text-white hover:bg-blue-700 cursor-pointer shadow-md shadow-blue-500/20 transition-all active:scale-95">
                                Ya, Pulihkan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setStatusData(status) {
            const input   = document.getElementById('status_data_input');
            if (input.value === status) return;

            input.value = status;

            const aktifBtn  = document.getElementById('status_data_aktif');
            const sampahBtn = document.getElementById('status_data_nonaktif');
            const brandOn   = ['bg-brand', 'text-white', 'shadow-sm'];
            const brandOff  = ['text-gray-500', 'hover:text-gray-700', 'dark:text-neutral-400', 'dark:hover:text-neutral-300'];

            if (status === 'aktif') {
                aktifBtn.classList.add(...brandOn);
                aktifBtn.classList.remove(...brandOff);
                sampahBtn.classList.remove(...brandOn);
                sampahBtn.classList.add(...brandOff);
            } else {
                sampahBtn.classList.add(...brandOn);
                sampahBtn.classList.remove(...brandOff);
                aktifBtn.classList.remove(...brandOn);
                aktifBtn.classList.add(...brandOff);
            }

            const form = document.getElementById('filter-form');
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();
            } else {
                form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
            }
        }

        // Auto-submit saat pilih periode dari hs-select
        document.addEventListener('DOMContentLoaded', function () {
            const periodeSelect = document.getElementById('periode');
            if (periodeSelect) {
                periodeSelect.addEventListener('change', function () {
                    const form = document.getElementById('filter-form');
                    if (typeof form.requestSubmit === 'function') {
                        form.requestSubmit();
                    } else {
                        form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
                    }
                });
            }
        });

        function setRestoreData(id, name) {
            document.getElementById('restore-item-name').textContent = name;
            document.getElementById('restore-form').action = `{{ url('superadmin/organizer/restore') }}/${id}`;
        }

        function setDeleteData(id, name, isPermanent = false) {
            const form = document.getElementById('delete-form');
            const nameSpan = document.getElementById('delete-item-name');
            const title = document.getElementById('delete-modal-title');
            const alertText = document.getElementById('delete-alert-text');
            const submitBtn = document.getElementById('delete-submit-btn');

            nameSpan.textContent = name;

            if (isPermanent) {
                form.action = `{{ url('superadmin/organizer/force-delete') }}/${id}`;
                title.textContent = 'Hapus Permanen Anggota';
                alertText.textContent = 'Data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.';
                submitBtn.classList.replace('bg-red-600', 'bg-rose-600');
                submitBtn.textContent = 'Ya, Hapus Permanen';
            } else {
                form.action = `{{ url('superadmin/organizer/delete') }}/${id}`;
                title.textContent = 'Hapus Anggota';
                alertText.textContent = 'Data akan dipindahkan ke tempat sampah.';
                submitBtn.classList.replace('bg-rose-600', 'bg-red-600');
                submitBtn.textContent = 'Ya, Hapus';
            }
        }
    </script>
@endsection
