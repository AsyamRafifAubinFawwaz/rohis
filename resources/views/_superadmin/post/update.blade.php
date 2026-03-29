@extends('_superadmin._layout.app')

@section('title', 'Edit Postingan')

@section('content')
    <div class="grid grid-cols-1 gap-4">
        <div
            class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center">
                <a href="{{ route('superadmin.posts.index') }}"
                    class="py-3 px-3 inline-flex items-center gap-x-2 text-xl rounded-xl border border-gray-200 bg-white text-gray-800 shadow-md hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="90" height="90"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                </a>
                <div class="ms-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Edit {{ $page['title'] }}
                    </h2>
                </div>
            </div>

            <form navigate-form action="{{ route('superadmin.posts.doUpdate', $post->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6">
                @csrf
                <input type="hidden" name="id" value="{{ $post->id }}">
                <div class="space-y-4">
                    <!-- Form Group -->
                    <div>
                        <label for="title" class="block text-sm font-medium mb-2 dark:text-white">Judul Postingan <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('title') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required placeholder="Masukkan judul postingan">
                        </div>
                        @error('title')
                            <p class="text-xs text-red-600 mt-2" id="title-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div>
                        <label for="slug" class="block text-sm font-medium mb-2 dark:text-white">Slug (Opsional)</label>
                        <div class="relative">
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('slug') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="slug-otomatis-dari-judul">
                        </div>
                        @error('slug')
                            <p class="text-xs text-red-600 mt-2" id="slug-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="prose max-w-none dark:prose-invert">
                        <label for="content" class="block text-sm font-medium mb-2 dark:text-white">Konten <span
                                class="text-red-500">*</span></label>
                        <x-trix-input id="content" name="content" :value="old('content', $post->content->toEditorHtml())" />
                        @error('content')
                            <p class="text-xs text-red-600 mt-2" id="content-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="space-y-2">
                        <label for="category_ids" class="block text-sm font-medium mb-2 dark:text-white">Kategori <span
                                class="text-red-500">*</span></label>
                        <select id="category_ids" name="category_ids[]" multiple
                            class="py-3 px-4 block w-full {{ $errors->has('category_ids') ? 'border-red-500' : 'border-gray-200' }} rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 shadow-sm min-h-[120px]"
                            required>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ in_array($cat->id, old('category_ids', $post->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-gray-400 dark:text-neutral-500 mt-1 italic">
                            * Tahan Ctrl (Windows) atau Cmd (Mac) untuk memilih lebih dari satu kategori.
                        </p>
                        @error('category_ids')
                            <p class="text-xs text-red-600 mt-2" id="category_ids-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <x-admin.file-upload name="thumbnail" id="thumbnail" label="Gambar Postingan" :value="$post->thumbnail" />
                    <!-- End Form Group -->
                </div>

                <div class="mt-6 flex justify-start gap-x-2">
                    <a navigate href="{{ route('superadmin.posts.index') }}"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800">
                        Batal
                    </a>
                    <button type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-none focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none cursor-pointer shadow-sm shadow-brand/20 transition-all active:scale-95">
                        @include('_admin._layout.icons.pencil')
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Slug generation
            function createSlug(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
            }

            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');

            if (titleInput && slugInput) {
                titleInput.addEventListener('input', function() {
                    slugInput.value = createSlug(this.value);
                });
            }
        });
    </script>
@endsection
