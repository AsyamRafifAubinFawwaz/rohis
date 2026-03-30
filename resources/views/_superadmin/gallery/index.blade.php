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
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($galleries as $gallery)
                <div class="group relative flex flex-col bg-white dark:bg-neutral-800 shadow-sm border border-slate-200 dark:border-neutral-700 rounded-2xl transition-all hover:shadow-xl overflow-hidden h-full">
                    <!-- Image Area -->
                    <div class="relative h-64 overflow-hidden bg-gray-100 dark:bg-neutral-900 flex items-center justify-center">
                        @if ($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="size-16 opacity-10" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </div>
                        @endif

                        <!-- Hover Actions Overlay -->
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                             <a navigate href="{{ route('superadmin.galleries.update', $gallery->id) }}" 
                                class="size-10 inline-flex justify-center items-center rounded-xl bg-white/20 backdrop-blur-md text-white border border-white/30 hover:bg-white/40 transition-all active:scale-90" title="Edit">
                                @include('_admin._layout.icons.pencil')
                            </a>
                            <button type="button" 
                                class="size-10 inline-flex justify-center items-center rounded-xl bg-red-500/20 backdrop-blur-md text-red-200 border border-red-500/30 hover:bg-red-500/40 transition-all active:scale-90"
                                data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $gallery->id }}', '{{ $gallery->title }}')" title="Hapus">
                                @include('_admin._layout.icons.trash')
                            </button>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4 flex flex-col grow">
                        <div class="flex items-center gap-1.5 mb-2 text-brand font-bold text-[10px] uppercase tracking-wider">
                            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                            {{ $gallery->activity->title ?? 'Umum' }}
                        </div>
                        <h3 class="text-gray-800 dark:text-neutral-200 font-bold text-sm line-clamp-2 leading-tight group-hover:text-brand transition-colors">
                            {{ $gallery->title }}
                        </h3>
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
                        Apakah Anda yakin ingin menghapus foto <span id="delete-gallery-name" class="font-bold text-gray-800 dark:text-neutral-200"></span>? Data yang dihapus tidak dapat dikembalikan.
                    </p>
                    <div class="mt-8 flex justify-center gap-x-3">
                        <button type="button" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" data-hs-overlay="#delete-modal">Batal</button>
                        <form id="delete-form" method="POST" class="inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-red-600 text-white hover:bg-red-700 cursor-pointer shadow-md shadow-red-500/20 transition-all active:scale-95">
                                Ya, Hapus Permanen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setDeleteData(id, name) {
            const form = document.getElementById('delete-form');
            const nameSpan = document.getElementById('delete-gallery-name');
            nameSpan.textContent = name;
            form.action = `{{ url('superadmin/galleries/delete') }}/${id}`;
        }
    </script>
@endsection
