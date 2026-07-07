@extends('_superadmin._layout.app')

@section('title', 'Manajemen Program Kerja')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Kelola program kerja dan agenda organisasi Rohis
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-hidden focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none font-bolder shadow-md shadow-brand/20 active:scale-95 transition-all text-center"
                    href="{{ route('superadmin.programs.add') }}">
                    @include('_admin._layout.icons.add')
                    Tambah Program
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-6 mt-4">
        <!-- Filter Form -->
        <div class="px-2 pt-4">
            <form id="filter-form" action="{{ route('superadmin.programs.index') }}" method="GET" navigate-form
                class="flex flex-col lg:flex-row items-end gap-x-4 gap-y-4">

                <!-- Search -->
                <div class="w-full lg:w-80">
                    <label for="keywords"
                        class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                        Cari Program...
                    </label>
                    <div class="relative">
                        <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                            class="py-2.5 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 shadow-sm"
                            placeholder="Nama atau deskripsi program...">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <button type="submit"
                        class="size-[42px] inline-flex justify-center items-center gap-x-1 text-sm font-semibold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-none transition-all active:scale-95 shadow-md shadow-brand/20 cursor-pointer"
                        title="Terapkan Filter">
                        @include('_admin._layout.icons.search')
                    </button>
                    @if (!empty($keywords) || ($status_data ?? 'aktif') !== 'aktif')
                        <a navigate
                            class="size-[42px] inline-flex justify-center items-center gap-x-1 text-sm font-semibold rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 focus:outline-none transition-all active:scale-95 shadow-sm"
                            href="{{ route('superadmin.programs.index') }}" title="Reset Filter">
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
                        <input type="hidden" name="status_data" id="status_data_input"
                            value="{{ $status_data ?? 'aktif' }}">
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

        <!-- Table View -->
        <div
            class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-2xl dark:border-neutral-700 shadow-sm bg-white dark:bg-neutral-800">
            <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-900/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Program</span>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Penuls</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-end">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @forelse ($programs as $program)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-x-4">
                                    <div class="size-10 rounded-xl overflow-hidden bg-gray-100 dark:bg-neutral-700">
                                        @if ($program->image)
                                            <img src="{{ asset('storage/' . $program->image) }}"
                                                class="size-full object-cover" alt="{{ $program->name }}"
                                                onerror="this.src='{{ asset('img/fallbacks/article.svg') }}';this.onerror=null;">
                                        @else
                                            <img src="{{ asset('img/fallbacks/article.svg') }}"
                                                class="size-full object-cover" alt="{{ $program->name }}">
                                        @endif
                                    </div>
                                    <div>
                                        <span
                                            class="block text-sm font-bold text-gray-800 dark:text-neutral-200 line-clamp-1">
                                            {{ $program->name }}
                                        </span>
                                        <span class="block text-xs text-gray-500 dark:text-neutral-500 mt-1 line-clamp-1">
                                            {{ Str::limit($program->description, 50) }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="size-7 rounded-full bg-brand/10 text-brand flex items-center justify-center text-[10px] font-bold uppercase">
                                        {{ substr($program->creator->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="text-sm text-gray-600 dark:text-neutral-400 font-medium">
                                        {{ $program->creator->name ?? 'Admin' }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-end">
                                <div class="flex justify-end gap-1.5">
                                    <a navigate href="{{ route('superadmin.programs.detail', $program->id) }}"
                                        class="p-2 rounded-lg bg-gray-50 text-gray-600 hover:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-600 transition-all active:scale-90"
                                        title="Detail">
                                        @include('_admin._layout.icons.view_detail')
                                    </a>
                                    @if ($program->trashed())
                                        <button type="button"
                                            class="p-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-500 transition-all active:scale-90"
                                            title="Pulihkan" data-hs-overlay="#restore-modal"
                                            onclick="setRestoreData('{{ $program->id }}', '{{ addslashes($program->name) }}')">
                                            @include('_admin._layout.icons.reset')
                                        </button>
                                        <button type="button"
                                            class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 dark:bg-rose-900/20 dark:text-rose-500 transition-all active:scale-90"
                                            data-hs-overlay="#delete-modal"
                                            onclick="setDeleteData('{{ $program->id }}', '{{ addslashes($program->name) }}', true)"
                                            title="Hapus Permanen">
                                            @include('_admin._layout.icons.trash')
                                        </button>
                                    @else
                                        <a navigate href="{{ route('superadmin.programs.update', $program->id) }}"
                                            class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-500 transition-all active:scale-90"
                                            title="Edit">
                                            @include('_admin._layout.icons.pencil')
                                        </a>
                                        <button type="button"
                                            class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-500 transition-all active:scale-90"
                                            data-hs-overlay="#delete-modal"
                                            onclick="setDeleteData('{{ $program->id }}', '{{ addslashes($program->name) }}', false)"
                                            title="Hapus (Pindah ke Sampah)">
                                            @include('_admin._layout.icons.trash')
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <x-admin.empty-state title="Belum Ada Program Kerja"
                                    description="Mulai susun program kerja pertama Anda untuk menggerakkan roda organisasi." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($programs->hasPages())
            <div class="mt-4 px-2">
                {{ $programs->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal"
        class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto" role="dialog"
        tabindex="-1">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden">
                <div class="p-4 sm:p-10 text-center">
                    <span id="delete-icon-wrapper"
                        class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700/30 dark:border-red-600 dark:text-red-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>
                    <h3 id="delete-modal-title" class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Hapus Program Pekerjaan
                    </h3>
                    <p id="delete-modal-description" class="text-gray-500 dark:text-neutral-500 px-6">
                        Apakah Anda yakin ingin menghapus program <span id="delete-item-name"
                            class="font-bold text-gray-800 dark:text-neutral-200"></span>? <span
                            id="delete-alert-text">Data yang dihapus akan dipindahkan ke sampah.</span>
                    </p>
                    <div class="mt-8 flex justify-center gap-x-3">
                        <button type="button"
                            class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300"
                            data-hs-overlay="#delete-modal">Batal</button>
                        <form id="delete-form" method="POST" class="inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-submit-btn"
                                class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-red-600 text-white hover:bg-red-700 cursor-pointer shadow-md shadow-red-500/20 transition-all active:scale-95">
                                Ya, Hapus Program
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Restore Confirmation Modal -->
    <div id="restore-modal"
        class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto" role="dialog"
        tabindex="-1">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden">
                <div class="p-4 sm:p-10 text-center">
                    <span
                        class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-blue-50 bg-blue-100 text-blue-500 dark:bg-blue-700/30 dark:border-blue-600 dark:text-blue-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>
                    <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Pulihkan Program
                    </h3>
                    <p class="text-gray-500 dark:text-neutral-500 px-6">
                        Apakah Anda yakin ingin memulihkan program
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
            const input = document.getElementById('status_data_input');
            if (input.value === status) return;

            input.value = status;

            const aktifBtn = document.getElementById('status_data_aktif');
            const sampahBtn = document.getElementById('status_data_nonaktif');
            const brandOn = ['bg-brand', 'text-white', 'shadow-sm'];
            const brandOff = ['text-gray-500', 'hover:text-gray-700', 'dark:text-neutral-400',
                'dark:hover:text-neutral-300'
            ];

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
                form.dispatchEvent(new Event('submit', {
                    cancelable: true,
                    bubbles: true
                }));
            }
        }

        window.setRestoreData = function(id, name) {
            let form = document.getElementById('restore-form');
            let nameSpan = document.getElementById('restore-item-name');

            if (!form || !document.getElementById('main-content').contains(form)) {
                const modal = document.getElementById('restore-modal') || document.querySelector(
                    '[aria-labelledby="restore-modal-title"]') || document.body;
                form = modal.querySelector('#restore-form') || form;
                nameSpan = modal.querySelector('#restore-item-name') || nameSpan;
            }

            if (nameSpan) nameSpan.textContent = name;
            if (form) form.setAttribute('action', `{{ url('superadmin/programs/restore') }}/${id}`);
        };

        window.setDeleteData = function(id, name, isPermanent = false) {
            let form = document.getElementById('delete-form');
            let nameSpan = document.getElementById('delete-item-name');
            let title = document.getElementById('delete-modal-title');
            let alertText = document.getElementById('delete-alert-text');
            let submitBtn = document.getElementById('delete-submit-btn');

            if (!form || !document.getElementById('main-content').contains(form)) {
                const modal = document.getElementById('delete-modal') || document.querySelector(
                    '[aria-labelledby="delete-modal-title"]') || document.body;
                form = modal.querySelector('#delete-form') || form;
                nameSpan = modal.querySelector('#delete-item-name') || nameSpan;
                title = modal.querySelector('#delete-modal-title') || title;
                alertText = modal.querySelector('#delete-alert-text') || alertText;
                submitBtn = modal.querySelector('#delete-submit-btn') || submitBtn;
            }

            if (nameSpan) nameSpan.textContent = name;

            if (isPermanent) {
                if (form) form.setAttribute('action', `{{ url('superadmin/programs/force-delete') }}/${id}`);
                if (title) title.textContent = 'Hapus Permanen Program';
                if (alertText) alertText.textContent =
                    'Program akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.';
                if (submitBtn) {
                    submitBtn.classList.replace('bg-red-600', 'bg-rose-600');
                    submitBtn.textContent = 'Ya, Hapus Permanen';
                }
            } else {
                if (form) form.setAttribute('action', `{{ url('superadmin/programs/delete') }}/${id}`);
                if (title) title.textContent = 'Hapus Program Pekerjaan';
                if (alertText) alertText.textContent = 'Program akan dipindahkan ke tempat sampah.';
                if (submitBtn) {
                    submitBtn.classList.replace('bg-rose-600', 'bg-red-600');
                    submitBtn.textContent = 'Ya, Hapus Program';
                }
            }
        };
    </script>
@endsection
