@extends('_superadmin._layout.app')

@section('title', 'Kategori')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Manajemen {{ $page['title'] }}
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <button type="button"
                    class="py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-brand-dark transition-all shadow-md shadow-brand/20 active:scale-95 cursor-pointer"
                    data-hs-overlay="#add-modal">
                    @include('_admin._layout.icons.add')
                    Tambah Kategori
                </button>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <div class="px-2 pt-2">
            <form action="{{ route('superadmin.categories.index') }}" method="GET" navigate-form
                class="flex flex-wrap items-center gap-3">
                <div class="relative w-64 max-w-full">
                    <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 shadow-sm"
                        placeholder="Cari Nama Kategori">
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="py-2 px-6 text-sm font-bold rounded-lg bg-brand text-white hover:bg-brand-dark cursor-pointer flex items-center justify-center gap-x-2 transition-all active:scale-95 shadow-md shadow-brand/20">
                        @include('_admin._layout.icons.search')
                        Cari
                    </button>

                    @if (!empty($keywords))
                        <a class="py-2 px-4 text-sm font-semibold rounded-lg border border-brand/20 text-brand hover:bg-brand-light dark:hover:bg-brand-dark/10 cursor-pointer flex items-center justify-center gap-x-2 transition-all active:scale-95"
                            href="{{ route('superadmin.categories.index') }}">
                            @include('_admin._layout.icons.reset')
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>


        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">

                        <div class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-lg dark:border-neutral-700">
                            <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                No
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Nama
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Slug
                                            </span>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-end"></th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @forelse($data as $d)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration + ($data->firstItem() - 1) }}</span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $d->name }}</span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm text-gray-800 dark:text-neutral-200">{{ $d->slug }}</span>
                                                </div>
                                            </td>

                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-1.5 flex items-center gap-x-2 justify-end">

                                                    <button type="button"
                                                        class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20 cursor-pointer"
                                                        data-hs-overlay="#edit-modal"
                                                        onclick="setEditData('{{ $d->id }}', '{{ $d->name }}', '{{ $d->slug }}')">
                                                        @include('_admin._layout.icons.pencil')
                                                    </button>
                                                    <button type="button"
                                                        class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:bg-red-800/30 dark:hover:bg-red-800/20 dark:focus:bg-red-800/20 cursor-pointer"
                                                        title="Delete" data-hs-overlay="#delete-modal"
                                                        onclick="setDeleteData('{{ $d->id }}', '{{ $d->name }}')">
                                                        @include('_admin._layout.icons.trash')
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-500">
                                                <x-admin.empty-state />
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if (count($data) > 0 && $data->hasPages())
                            <div class="px-6 py-4 border-t border-gray-200 dark:border-neutral-700">
                                <div class="flex justify-end">
                                    {{ $data->links() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin.modal id="add-modal" title="Tambah Kategori" formId="add-form"
        action="{{ route('superadmin.categories.do_create') }}">
        <div class="space-y-3 text-left">
            <div>
                <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama Kategori</label>
                <input type="text" name="name" id="name"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan nama kategori" required>
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium mb-2 dark:text-white">Slug</label>
                <input type="text" name="slug" id="slug"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan slug" required>
            </div>
        </div>
    </x-admin.modal>

    <x-admin.modal id="edit-modal" title="Edit Kategori" formId="edit-form" method="POST">
        <input type="hidden" name="id" id="edit-id">
        <div class="space-y-3 text-left">
            <div>
                <label for="edit-name" class="block text-sm font-medium mb-2 dark:text-white">Nama
                    Kategori</label>
                <input type="text" name="name" id="edit-name"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan nama kategori" required>
            </div>
            <div>
                <label for="edit-slug" class="block text-sm font-medium mb-2 dark:text-white">Slug</label>
                <input type="text" name="slug" id="edit-slug"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Masukkan slug" required>
            </div>
        </div>
    </x-admin.modal>

    <x-admin.modal id="delete-modal" title="Hapus Kategori">
        <div class="text-center">
            <span
                class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700 dark:border-red-600 dark:text-red-100">
                @include('_admin._layout.icons.warning_modal')
            </span>
            <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                Hapus Kategori
            </h3>
            <p class="text-gray-500 dark:text-neutral-500">
                Apakah Anda yakin ingin menghapus <span id="delete-item-name"
                    class="font-semibold text-gray-800 dark:text-neutral-200"></span>?
                <br>Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>

        <x-slot name="footer">
            <button type="button"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 cursor-pointer"
                data-hs-overlay="#delete-modal">
                Batal
            </button>
            <form id="delete-form" method="POST" class="inline" navigate-form>
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                    Ya, Hapus
                </button>
            </form>
        </x-slot>
    </x-admin.modal>

    <script>
        window.setEditData = function(id, name, slug) {
            let form = document.getElementById('edit-form');
            let idInput = document.getElementById('edit-id');
            let nameInput = document.getElementById('edit-name');
            let slugInput = document.getElementById('edit-slug');

            if (!form || !document.getElementById('main-content').contains(form)) {
                const modal = document.getElementById('edit-modal') || document.querySelector('[aria-labelledby="edit-modal-title"]') || document.body;
                form = modal.querySelector('#edit-form') || form;
                idInput = modal.querySelector('#edit-id') || idInput;
                nameInput = modal.querySelector('#edit-name') || nameInput;
                slugInput = modal.querySelector('#edit-slug') || slugInput;
            }

            if (idInput) idInput.value = id;
            if (nameInput) nameInput.value = name;
            if (slugInput) slugInput.value = slug;
            if (form) form.setAttribute('action', '{{ url('superadmin/categories/update') }}/' + id);
        };

        window.setDeleteData = function(id, name) {
            let form = document.getElementById('delete-form');
            let nameSpan = document.getElementById('delete-item-name');

            if (!form || !document.getElementById('main-content').contains(form)) {
                const modal = document.getElementById('delete-modal') || document.querySelector('[aria-labelledby="delete-modal-title"]') || document.body;
                form = modal.querySelector('#delete-form') || form;
                nameSpan = modal.querySelector('#delete-item-name') || nameSpan;
            }

            if (nameSpan) nameSpan.textContent = name;
            if (form) form.setAttribute('action', '{{ url('superadmin/categories/delete') }}/' + id);
        };

        function createSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        document.getElementById('name').addEventListener('input', function() {
            document.getElementById('slug').value = createSlug(this.value);
        });

        document.getElementById('edit-name').addEventListener('input', function() {
            document.getElementById('edit-slug').value = createSlug(this.value);
        });
    </script>
@endsection
