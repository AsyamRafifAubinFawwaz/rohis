@extends('_superadmin._layout.app')

@section('title', 'Galeri Foto')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Dokumentasi Kegiatan Rohis
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-hidden focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none font-bolder shadow-md shadow-brand/20 active:scale-95 transition-all text-center"
                    href="{{ route('superadmin.galleries.add') }}">
                    @include('_admin._layout.icons.add')
                    Tambah Foto
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-6 mt-4">
        <!-- Filter Form -->
        <div class="px-2 pt-4">
            <form id="filter-form" action="{{ route('superadmin.galleries.index') }}" method="GET" navigate-form
                class="flex flex-col lg:flex-row items-end gap-x-4 gap-y-4">

                <!-- Search -->
                <div class="w-full lg:w-80">
                    <label for="keywords"
                        class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                        Cari Foto...
                    </label>
                    <div class="relative">
                        <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                            class="py-2.5 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 shadow-sm"
                            placeholder="Cari Judul Foto...">
                        
                    </div>
                </div>

                <!-- Activity Filter -->
                <div class="w-full lg:w-64">
                    <label for="activity_id"
                        class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                        Berdasarkan Kegiatan
                    </label>
                    <select id="activity_id" name="activity_id"
                        data-hs-select='{
                            "placeholder": "Semua Kegiatan",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 ps-4 pe-9 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-gray-200 text-gray-800 rounded-xl text-start text-sm hover:bg-gray-50 focus:outline-hidden shadow-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800",
                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                            "optionClasses": "hs-selected:bg-brand/10 dark:hs-selected:bg-brand/20 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-brand\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-400 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }'
                        class="hidden">
                        <option value="">Semua Kegiatan</option>
                        @foreach ($activities as $act)
                            <option value="{{ $act->id }}" {{ ($activity_id ?? '') == $act->id ? 'selected' : '' }}>
                                {{ $act->title }}
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
                    @if (!empty($keywords) || !empty($activity_id) || ($status_data ?? 'aktif') !== 'aktif')
                        <a navigate
                            class="size-[42px] inline-flex justify-center items-center gap-x-1 text-sm font-semibold rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 focus:outline-none transition-all active:scale-95 shadow-sm"
                            href="{{ route('superadmin.galleries.index') }}" title="Reset Filter">
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

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($galleries as $gallery)
                <div class="group relative flex flex-col bg-white dark:bg-neutral-800 shadow-sm border border-slate-200 dark:border-neutral-700 rounded-2xl transition-all hover:shadow-xl overflow-hidden h-full">
                    <!-- Image Area -->
                    <div class="relative h-56 overflow-hidden bg-gray-100 dark:bg-neutral-900 flex items-center justify-center">
                        @if ($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                onerror="this.src='{{ asset('img/fallbacks/gallery.svg') }}';this.onerror=null;" />
                        @else
                            <img src="{{ asset('img/fallbacks/gallery.svg') }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover" />
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-5 flex flex-col grow">
                        <div class="flex items-center gap-1.5 mb-3 text-brand font-semibold text-[11px] uppercase tracking-tighter">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                            {{ $gallery->activity->title ?? 'Umum' }}
                        </div>
                        <h3 class="text-gray-800 dark:text-neutral-200 font-bold text-lg line-clamp-2 leading-tight group-hover:text-brand transition-colors mb-4">
                            {{ $gallery->title }}
                        </h3>

                        <!-- Footer Meta (Consistent with Activities) -->
                        <div class="mt-auto flex items-center justify-between border-t border-gray-100 dark:border-neutral-700 pt-4">
                            <div class="flex items-center">
                                <div class="size-8 rounded-full bg-brand/10 dark:bg-brand/20 flex items-center justify-center text-brand font-bold text-[10px]">
                                    {{ substr($gallery->creator->name ?? 'A', 0, 1) }}
                                </div>
                                <div class="flex flex-col ml-3 text-[10px]">
                                    <span class="text-gray-800 dark:text-neutral-200 font-bold uppercase tracking-tight">{{ $gallery->creator->name ?? 'Admin' }}</span>
                                    <span class="text-gray-400 dark:text-neutral-500 font-medium">
                                        {{ $gallery->created_at->format('d M, Y') }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex gap-1.5">
                                @if ($gallery->trashed())
                                    <button type="button" class="p-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all active:scale-90" 
                                        data-hs-overlay="#restore-modal" onclick="setRestoreData('{{ $gallery->id }}', '{{ addslashes($gallery->title) }}')" title="Pulihkan">
                                        @include('_admin._layout.icons.reset')
                                    </button>
                                    <button type="button" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition-all active:scale-90 dark:bg-rose-900/30 dark:text-rose-600 dark:hover:bg-rose-100" 
                                        data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $gallery->id }}', '{{addslashes($gallery->title)}}', true)" title="Hapus Permanen">
                                        @include('_admin._layout.icons.trash')
                                    </button>
                                @else
                                    <a navigate href="{{ route('superadmin.galleries.update', $gallery->id) }}" 
                                        class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-all active:scale-90 dark:bg-blue-900/30 dark:text-blue-600 dark:hover:bg-blue-100" title="Edit">
                                        @include('_admin._layout.icons.pencil')
                                    </a>
                                    <button type="button" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all active:scale-90 dark:bg-red-900/30 dark:text-red-600 dark:hover:bg-red-100" 
                                        data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $gallery->id }}', '{{addslashes($gallery->title)}}', false)" title="Hapus">
                                        @include('_admin._layout.icons.trash')
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 bg-gray-50 dark:bg-neutral-900 rounded-3xl border-2 border-dashed border-gray-200 dark:border-neutral-800">
                    <x-admin.empty-state title="Belum Ada Foto" description="Mungkin kamu bisa mulai dengan mengunggah dokumentasi kegiatan pertama kamu." />
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($galleries->hasPages())
            <div class="mt-6">
                {{ $galleries->links() }}
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
                        Hapus Foto
                    </h3>
                    <p id="delete-modal-description" class="text-gray-500 dark:text-neutral-500 px-6">
                        Apakah Anda yakin ingin menghapus foto <span id="delete-gallery-name" class="font-bold text-gray-800 dark:text-neutral-200"></span>? <span id="delete-alert-text">Data yang dihapus tidak dapat dikembalikan.</span>
                    </p>
                    <div class="mt-8 flex justify-center gap-x-3">
                        <button type="button" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" data-hs-overlay="#delete-modal">Batal</button>
                        <form id="delete-form" method="POST" class="inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-submit-btn" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-red-600 text-white hover:bg-red-700 cursor-pointer shadow-md shadow-red-500/20 transition-all active:scale-95">
                                Ya, Hapus Permanen
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
                    <span class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-emerald-50 bg-emerald-100 text-emerald-500 dark:bg-emerald-700/30 dark:border-emerald-600 dark:text-emerald-100">
                        @include('_admin._layout.icons.reset')
                    </span>
                    <h3 id="restore-modal-title" class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Pulihkan Foto
                    </h3>
                    <p id="restore-modal-description" class="text-gray-500 dark:text-neutral-500 px-6">
                        Apakah Anda yakin ingin memulihkan foto <span id="restore-gallery-name" class="font-bold text-gray-800 dark:text-neutral-200"></span>?
                    </p>
                    <div class="mt-8 flex justify-center gap-x-3">
                        <button type="button" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" data-hs-overlay="#restore-modal">Batal</button>
                        <form id="restore-form" method="POST" class="inline" navigate-form>
                            @csrf
                            <button type="submit" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 cursor-pointer shadow-md shadow-emerald-500/20 transition-all active:scale-95">
                                Ya, Pulihkan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-submit saat pilih filter dari hs-select
        document.addEventListener('DOMContentLoaded', function () {
            const el = document.getElementById('activity_id');
            if (el) {
                el.addEventListener('change', function () {
                    document.getElementById('filter-form').submit();
                });
            }
        });

        function setStatusData(status) {
            const input = document.getElementById('status_data_input');
            if (input.value === status) return;

            input.value = status;

            const aktifBtn    = document.getElementById('status_data_aktif');
            const sampahBtn   = document.getElementById('status_data_nonaktif');
            const brandOn     = ['bg-brand', 'text-white', 'shadow-sm'];
            const brandOff    = ['text-gray-500', 'hover:text-gray-700', 'dark:text-neutral-400', 'dark:hover:text-neutral-300'];

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

        window.setDeleteData = function(id, name, isPermanent = false) {
            let form = document.getElementById('delete-form');
            let nameSpan = document.getElementById('delete-gallery-name');
            let title = document.getElementById('delete-modal-title');
            let alertText = document.getElementById('delete-alert-text');
            let submitBtn = document.getElementById('delete-submit-btn');

            if (!form || !document.getElementById('main-content').contains(form)) {
                const modal = document.getElementById('delete-modal') || document.querySelector('[aria-labelledby="delete-modal-title"]') || document.body;
                form = modal.querySelector('#delete-form') || form;
                nameSpan = modal.querySelector('#delete-gallery-name') || nameSpan;
                title = modal.querySelector('#delete-modal-title') || title;
                alertText = modal.querySelector('#delete-alert-text') || alertText;
                submitBtn = modal.querySelector('#delete-submit-btn') || submitBtn;
            }

            if (nameSpan) nameSpan.textContent = name;

            if (isPermanent) {
                if (form) form.setAttribute('action', `{{ url('superadmin/galleries/force-delete') }}/${id}`);
                if (title) title.textContent = 'Hapus Permanen Foto';
                if (alertText) alertText.textContent = 'Foto akan dihapus secara permanen dari server. Tindakan ini tidak dapat dibatalkan.';
                if (submitBtn) {
                    submitBtn.classList.replace('bg-red-600', 'bg-rose-600');
                    submitBtn.textContent = 'Ya, Hapus Permanen';
                }
            } else {
                if (form) form.setAttribute('action', `{{ url('superadmin/galleries/delete') }}/${id}`);
                if (title) title.textContent = 'Hapus Foto';
                if (alertText) alertText.textContent = 'Foto akan dipindahkan ke tempat sampah.';
                if (submitBtn) {
                    submitBtn.classList.replace('bg-rose-600', 'bg-red-600');
                    submitBtn.textContent = 'Ya, Hapus Foto';
                }
            }
        };

        window.setRestoreData = function(id, name) {
            let form = document.getElementById('restore-form');
            let nameSpan = document.getElementById('restore-gallery-name');

            if (!form || !document.getElementById('main-content').contains(form)) {
                const modal = document.getElementById('restore-modal') || document.querySelector('[aria-labelledby="restore-modal-title"]') || document.body;
                form = modal.querySelector('#restore-form') || form;
                nameSpan = modal.querySelector('#restore-gallery-name') || nameSpan;
            }

            if (nameSpan) nameSpan.textContent = name;
            if (form) form.setAttribute('action', '{{ url('superadmin/galleries/restore') }}/' + id);
        };
    </script>
@endsection
