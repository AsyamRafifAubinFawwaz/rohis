@extends('_admin._layout.app')

@section('title', 'Galeri Foto')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-neutral-200 tracking-tight">
                Data {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-500 dark:text-neutral-500 mt-1">
                Koleksi dokumentasi visual kegiatan yang telah Anda unggah.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a navigate
                class="py-3 px-5 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-hidden focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none shadow-lg shadow-brand/20 active:scale-95 transition-all"
                href="{{ route('admin.galleries.add') }}">
                @include('_admin._layout.icons.add')
                Unggah Foto Baru
            </a>
        </div>
    </div>

    <!-- Stats / Overview (Premium Touch) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="flex flex-col bg-white border border-gray-200 rounded-2xl p-4 md:p-5 dark:bg-neutral-800 dark:border-neutral-700 shadow-sm">
            <div class="flex items-center gap-x-2 mb-2">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-neutral-500">Total Foto</p>
            </div>
            <div class="flex items-center gap-x-2">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-neutral-200">{{ $galleries->total() }}</h3>
            </div>
        </div>
        <!-- Bisa tambah stat lain jika ada data -->
    </div>

    <div class="flex flex-col gap-6">
        <!-- Filter Bar (Modern Pattern) -->
        <div class="bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-2xl p-2 shadow-sm">
            <form id="filter-form" action="{{ route('admin.galleries.index') }}" method="GET" navigate-form
                class="flex flex-col lg:flex-row items-center gap-2">

                <!-- Search -->
                <div class="relative w-full lg:grow">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                        @include('_admin._layout.icons.search')
                    </div>
                    <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                        class="py-3 ps-11 pe-4 block w-full border-transparent bg-gray-50 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 shadow-sm"
                        placeholder="Cari judul atau keterangan foto...">
                </div>

                <!-- Activity Select -->
                <div class="w-full lg:w-64">
                    <select id="activity_id" name="activity_id"
                        data-hs-select='{
                            "placeholder": "Semua Kegiatan",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-gray-50 border-transparent text-gray-800 rounded-xl text-start text-sm hover:bg-gray-100 focus:outline-hidden dark:bg-neutral-900 dark:border-transparent dark:text-neutral-200 dark:hover:bg-neutral-800",
                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto dark:bg-neutral-900 dark:border-neutral-700",
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

                <!-- Status Tabs (Pattern: Segmented Control) -->
                <div class="p-1 bg-gray-50 dark:bg-neutral-900 rounded-xl flex w-full lg:w-auto">
                    <input type="hidden" name="status_data" id="status_data_input" value="{{ $status_data ?? 'aktif' }}">
                    <button type="button" onclick="setStatusData('aktif')" id="status_data_aktif"
                        class="py-2 px-6 flex-1 lg:flex-none inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-lg border border-transparent transition-all {{ ($status_data ?? 'aktif') == 'aktif' ? 'bg-white dark:bg-neutral-800 text-brand shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                        Aktif
                    </button>
                    <button type="button" onclick="setStatusData('nonaktif')" id="status_data_nonaktif"
                        class="py-2 px-6 flex-1 lg:flex-none inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-lg border border-transparent transition-all {{ ($status_data ?? 'aktif') == 'nonaktif' ? 'bg-white dark:bg-neutral-800 text-red-500 shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                        Sampah
                    </button>
                </div>

                <div class="flex gap-1 w-full lg:w-auto">
                    <button type="submit"
                        class="flex-1 lg:flex-none py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-none transition-all active:scale-95 shadow-md shadow-brand/10 cursor-pointer">
                        @include('_admin._layout.icons.search')
                        <span class="lg:hidden uppercase tracking-widest text-xs">Cari</span>
                    </button>
                    @if (!empty($keywords) || !empty($activity_id) || ($status_data ?? 'aktif') !== 'aktif')
                        <a navigate
                            class="py-3 px-4 inline-flex justify-center items-center rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 focus:outline-none transition-all active:scale-95"
                            href="{{ route('admin.galleries.index') }}" title="Reset Filter">
                            @include('_admin._layout.icons.reset')
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Gallery Grid (Modern Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mt-6">
            @forelse ($galleries as $gallery)
                <div class="group relative flex flex-col bg-white dark:bg-neutral-800 shadow-sm hover:shadow-2xl border border-slate-100 dark:border-neutral-700/50 rounded-[2.5rem] transition-all duration-500 overflow-hidden h-full">
                    
                    <!-- Image Wrapper -->
                    <div class="relative aspect-[4/5] overflow-hidden m-2 rounded-[2rem]">
                        @if ($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" />
                            
                            <!-- Premium Hover Overlay -->
                            <div class="absolute inset-0 bg-brand/60 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center gap-3">
                                <button type="button" 
                                    data-hs-overlay="#lightbox-modal"
                                    onclick="openLightbox('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->title }}')"
                                    class="size-12 inline-flex items-center justify-center rounded-2xl bg-white text-brand shadow-xl transition-all duration-300 hover:scale-110 active:scale-95"
                                    title="Lihat Penuh">
                                    @include('_admin._layout.icons.eye')
                                </button>
                                <a navigate href="{{ route('admin.galleries.update', $gallery->id) }}" 
                                    class="size-12 inline-flex items-center justify-center rounded-2xl bg-white text-blue-600 shadow-xl transition-all duration-300 hover:scale-110 active:scale-95"
                                    title="Edit">
                                    @include('_admin._layout.icons.pencil')
                                </a>
                            </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-slate-50 dark:bg-neutral-900 text-slate-200 dark:text-neutral-800 gap-2">
                                <svg class="size-20 opacity-20" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </div>
                        @endif

                        <!-- Top Left Activity Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="py-1.5 px-3 rounded-xl bg-white/90 backdrop-blur shadow-xl text-[10px] font-black text-brand uppercase dark:bg-neutral-800/90 border border-white/20">
                                {{ $gallery->activity->title ?? 'Umum' }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="px-6 py-5 flex flex-col grow relative">
                        <h3 class="text-gray-800 dark:text-neutral-200 font-bold text-lg line-clamp-2 leading-tight mb-6 group-hover:text-brand transition-colors">
                            {{ $gallery->title }}
                        </h3>

                        <!-- Bottom Meta -->
                        <div class="mt-auto flex items-center justify-between border-t border-slate-50 dark:border-neutral-700/50 pt-4">
                            <div class="flex items-center gap-3">
                                <div class="size-9 rounded-xl bg-gradient-to-br from-brand to-brand-dark flex items-center justify-center text-white font-black text-xs shadow-lg shadow-brand/20">
                                    {{ substr($gallery->creator->name ?? 'A', 0, 1) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-gray-400 dark:text-neutral-500 font-bold uppercase tracking-widest">Kreator</span>
                                    <span class="text-xs text-gray-800 dark:text-neutral-200 font-black -mt-0.5">{{ $gallery->creator->name ?? 'Admin' }}</span>
                                </div>
                            </div>

                            <div class="text-end flex flex-col">
                                <span class="text-[10px] text-gray-400 dark:text-neutral-500 font-bold uppercase tracking-widest">Tanggal</span>
                                <span class="text-xs text-gray-800 dark:text-neutral-200 font-black -mt-0.5 italic">{{ $gallery->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        <!-- Trash Actions -->
                        @if ($gallery->trashed())
                            <div class="absolute top-4 right-4 flex gap-1.5">
                                <form action="{{ route('admin.galleries.restore', $gallery->id) }}" method="POST" navigate-form>
                                    @csrf
                                    <button type="submit" class="p-2 rounded-xl bg-emerald-500 text-white shadow-lg shadow-emerald-500/30 hover:scale-110 active:scale-95 transition-all" title="Pulihkan">
                                        @include('_admin._layout.icons.reset')
                                    </button>
                                </form>
                                <button type="button" class="p-2 rounded-xl bg-rose-500 text-white shadow-lg shadow-rose-500/30 hover:scale-110 active:scale-95 transition-all" 
                                    data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $gallery->id }}', '{{ $gallery->title }}', true)" title="Hapus Permanen">
                                    @include('_admin._layout.icons.trash')
                                </button>
                            </div>
                        @else
                           <div class="absolute -top-4 right-6 p-1.5 bg-white dark:bg-neutral-800 rounded-2xl shadow-xl border border-slate-50 dark:border-neutral-700 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                <button type="button" 
                                    class="p-2 text-slate-400 hover:text-red-500 transition-colors"
                                    data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $gallery->id }}', '{{ $gallery->title }}', false)" title="Pindahkan ke Sampah">
                                    @include('_admin._layout.icons.trash')
                                </button>
                           </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="py-24 flex flex-col items-center justify-center bg-gray-50/50 dark:bg-neutral-900/30 rounded-[3rem] border-4 border-dashed border-gray-100 dark:border-neutral-800/50">
                        <div class="size-24 mb-6 bg-white dark:bg-neutral-800 rounded-3xl flex items-center justify-center shadow-xl border border-gray-100 dark:border-neutral-700">
                             <svg class="size-10 text-gray-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                        </div>
                        <h2 class="text-xl font-extrabold text-gray-800 dark:text-neutral-200 mb-2 tracking-tight">Belum Ada Dokumentasi</h2>
                        <p class="text-gray-500 dark:text-neutral-500 text-sm max-w-xs text-center leading-relaxed">
                            Ayo mulai unggah foto-foto terbaik dari kegiatan Rohis yang telah Anda laksanakan.
                        </p>
                        <a navigate href="{{ route('admin.galleries.add') }}" class="mt-6 py-3 px-6 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark transition-all active:scale-95 shadow-lg shadow-brand/20">
                            Mulai Unggah Sekarang
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($galleries->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>

    <!-- Lightbox Modal (Preline Component) -->
    <div id="lightbox-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-90 overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-4xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="relative flex flex-col bg-black/90 backdrop-blur-xl border border-white/10 shadow-2xl rounded-[2rem] overflow-hidden w-full">
                <div class="absolute top-4 end-4 z-50">
                    <button type="button"
                        class="size-10 inline-flex justify-center items-center rounded-full border border-white/10 bg-white/10 text-white hover:bg-white hover:text-brand transition-all focus:outline-none"
                        data-hs-overlay="#lightbox-modal">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>

                <div class="p-2 sm:p-4">
                    <img id="lightbox-img" src="" alt="Preview" class="w-full h-auto max-h-[70vh] object-contain rounded-2xl">
                    <div class="mt-6 px-4 pb-4">
                         <h3 id="lightbox-title" class="text-xl font-bold text-white tracking-tight"></h3>
                         <p class="text-white/50 text-sm mt-1 uppercase tracking-widest font-extrabold">Preview Dokumentasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-100 overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border border-gray-200 shadow-2xl rounded-[2rem] dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden">
                <div class="p-8 sm:p-12 text-center">
                    <div class="mb-6 inline-flex justify-center items-center size-20 rounded-3xl border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700/20 dark:border-red-600/30 dark:text-red-400">
                         @include('_admin._layout.icons.warning_modal')
                    </div>
                    <h3 id="delete-modal-title" class="mb-3 text-2xl font-black text-gray-800 dark:text-neutral-200 tracking-tight">
                        Hapus Foto
                    </h3>
                    <p id="delete-modal-description" class="text-gray-500 dark:text-neutral-500 px-4 leading-relaxed">
                        Apakah Anda yakin ingin menghapus foto <span id="delete-gallery-name" class="font-black text-gray-800 dark:text-neutral-200"></span>? <span id="delete-alert-text">Tindakan ini tidak dapat dibatalkan.</span>
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row justify-center gap-3">
                        <button type="button" class="order-2 sm:order-1 py-3 px-8 inline-flex justify-center items-center text-sm font-bold rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 transition-all active:scale-95" data-hs-overlay="#delete-modal">Batal</button>
                        <form id="delete-form" method="POST" class="order-1 sm:order-2 inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-submit-btn" class="w-full py-3 px-8 inline-flex justify-center items-center text-sm font-bold rounded-xl border border-transparent bg-red-600 text-white hover:bg-red-700 cursor-pointer shadow-xl shadow-red-600/20 transition-all active:scale-95">
                                Ya, Hapus Sekarang
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

            const form = document.getElementById('filter-form');
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();
            } else {
                form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
            }
        }

        function openLightbox(src, title) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox-title').textContent = title;
        }

        function setDeleteData(id, name, isPermanent = false) {
            const form = document.getElementById('delete-form');
            const nameSpan = document.getElementById('delete-gallery-name');
            const title = document.getElementById('delete-modal-title');
            const alertText = document.getElementById('delete-alert-text');
            const submitBtn = document.getElementById('delete-submit-btn');

            nameSpan.textContent = name;

            if (isPermanent) {
                form.action = `{{ url('admin/galleries/force-delete') }}/${id}`;
                title.textContent = 'Hapus Permanen';
                alertText.textContent = 'Foto akan dihapus permanen dari server. Tindakan ini tidak dapat dibatalkan.';
                submitBtn.classList.replace('bg-red-600', 'bg-rose-600');
            } else {
                form.action = `{{ url('admin/galleries/delete') }}/${id}`;
                title.textContent = 'Pindahkan ke Sampah';
                alertText.textContent = 'Foto akan dipindahkan ke tempat sampah dan masih bisa dipulihkan.';
                submitBtn.classList.replace('bg-rose-600', 'bg-red-600');
            }
        }
    </script>
@endsection
