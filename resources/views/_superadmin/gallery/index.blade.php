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
                        <div class="absolute inset-y-0 inset-e-0 flex items-center pointer-events-none pe-4">
                            @include('_admin._layout.icons.search')
                        </div>
                    </div>
                </div>

                <!-- Activity Filter -->
                <div class="w-full lg:w-64">
                    <label for="activity_id"
                        class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                        Berdasarkan Kegiatan
                    </label>
                    <select name="activity_id" id="activity_id"
                        class="py-2.5 px-4 pe-9 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 shadow-sm">
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
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="size-16 opacity-10" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </div>
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
                                    <form action="{{ route('superadmin.galleries.restore', $gallery->id) }}" method="POST" navigate-form>
                                        @csrf
                                        <button type="submit" class="p-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all active:scale-90" title="Pulihkan">
                                            @include('_admin._layout.icons.reset')
                                        </button>
                                    </form>
                                    <button type="button" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition-all active:scale-90" 
                                        data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $gallery->id }}', '{{ $gallery->title }}', true)" title="Hapus Permanen">
                                        @include('_admin._layout.icons.trash')
                                    </button>
                                @else
                                    <a navigate href="{{ route('superadmin.galleries.update', $gallery->id) }}" 
                                        class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-all active:scale-90" title="Edit">
                                        @include('_admin._layout.icons.pencil')
                                    </a>
                                    <button type="button" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all active:scale-90" 
                                        data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $gallery->id }}', '{{ $gallery->title }}', false)" title="Hapus">
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

    <script>
        function setStatusData(status) {
            document.getElementById('status_data_input').value = status;
            document.getElementById('filter-form').submit();
        }

        function setDeleteData(id, name, isPermanent = false) {
            const form = document.getElementById('delete-form');
            const nameSpan = document.getElementById('delete-gallery-name');
            const title = document.getElementById('delete-modal-title');
            const alertText = document.getElementById('delete-alert-text');
            const submitBtn = document.getElementById('delete-submit-btn');

            nameSpan.textContent = name;

            if (isPermanent) {
                form.action = `{{ url('superadmin/galleries/force-delete') }}/${id}`;
                title.textContent = 'Hapus Permanen Foto';
                alertText.textContent = 'Foto akan dihapus secara permanen dari server. Tindakan ini tidak dapat dibatalkan.';
                submitBtn.classList.replace('bg-red-600', 'bg-rose-600');
                submitBtn.textContent = 'Ya, Hapus Permanen';
            } else {
                form.action = `{{ url('superadmin/galleries/delete') }}/${id}`;
                title.textContent = 'Hapus Foto';
                alertText.textContent = 'Foto akan dipindahkan ke tempat sampah.';
                submitBtn.classList.replace('bg-rose-600', 'bg-red-600');
                submitBtn.textContent = 'Ya, Hapus Foto';
            }
        }
    </script>
@endsection
