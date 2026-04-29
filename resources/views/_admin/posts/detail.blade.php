@extends('_admin._layout.app')

@section('title', 'Detail Postingan')

@section('content')
    <div class="grid grid-cols-1 gap-6">
        <div
            class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center justify-between">
                <div class="flex items-center">
                    <a navigate href="{{ route('admin.posts.index') }}"
                        class="p-2 inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
                        <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </a>
                    <div class="ms-4">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                            {{ $page['title'] }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Status Badge -->
                <div class="mb-6">
                    @if ($post->status == 'published')
                        <span
                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Published</span>
                    @elseif($post->status == 'pending')
                        <span
                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">Pending
                            Review</span>
                    @elseif($post->status == 'rejected')
                        <span
                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">Rejected</span>
                    @else
                        <span
                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white">{{ ucfirst($post->status) }}</span>
                    @endif
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-8">
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-neutral-200 leading-tight">
                                {{ $post->title }}
                            </h1>
                            <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500 italic">
                                /{{ $post->slug }}
                            </p>
                        </div>

                        @if ($post->thumbnail)
                            <div
                                class="rounded-2xl overflow-hidden shadow-md border border-gray-100 dark:border-neutral-700">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail"
                                    class="w-full object-cover">
                            </div>
                        @endif

                        <div class="prose prose-neutral dark:prose-invert max-w-none">
                            {!! $post->content !!}
                        </div>
                    </div>

                    <!-- Sidebar Info -->
                    <div class="space-y-6">
                        <div
                            class="bg-gray-50 dark:bg-neutral-700/50 rounded-2xl p-6 space-y-4 border border-gray-100 dark:border-neutral-700/50">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 dark:text-neutral-500">
                                Metadata Postingan
                            </h3>

                            <div>
                                <h4 class="text-xs font-medium text-gray-500 dark:text-neutral-500 mb-2">Kategori</h4>
                                <div class="flex flex-wrap gap-1">
                                    @forelse($post->categories as $cat)
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-lg text-xs font-medium bg-brand/10 text-brand dark:bg-brand/20 dark:text-brand-light">
                                            {{ $cat->name }}
                                        </span>
                                    @empty
                                        <span class="text-sm text-gray-400 dark:text-neutral-500">-</span>
                                    @endforelse
                                </div>
                            </div>

                            <div>
                                <h4 class="text-xs font-medium text-gray-500 dark:text-neutral-500">Dibuat Pada</h4>
                                <p class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                    {{ $post->created_at->format('d F Y, H:i') }}</p>
                                <p class="text-xs text-gray-400 dark:text-neutral-500 italic">
                                    {{ $post->created_at->diffForHumans() }}</p>
                            </div>

                            @if ($post->approved_by)
                                <div class="pt-4 border-t border-gray-200 dark:border-neutral-700">
                                    <h4 class="text-xs font-medium text-gray-500 dark:text-neutral-500">Disetujui Oleh</h4>
                                    <p class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        {{ $post->approver->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-400 dark:text-neutral-500 italic">
                                        {{ \Carbon\Carbon::parse($post->approved_at)->diffForHumans() }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col gap-2">
                            <a href="{{ route('admin.posts.update', $post->id) }}" navigate
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none shadow-sm transition-all active:scale-95">
                                @include('_admin._layout.icons.pencil')
                                Edit Postingan
                            </a>
                            <button type="button"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none cursor-pointer shadow-sm transition-all active:scale-95"
                                data-hs-overlay="#delete-modal">
                                @include('_admin._layout.icons.trash')
                                Hapus Postingan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto"
        role="dialog" tabindex="-1">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-4 sm:p-10 text-center">
                    <span
                        class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700 dark:border-red-600 dark:text-red-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>
                    <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Hapus Postingan
                    </h3>
                    <p class="text-gray-500 dark:text-neutral-500">
                        Apakah Anda yakin ingin menghapus postingan ini?
                    </p>
                    <div class="mt-6 flex justify-center gap-x-4">
                        <button type="button"
                            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300"
                            data-hs-overlay="#delete-modal">Batal</button>
                        <form
                            action="{{ route('admin.posts.delete', $post->id) }}"
                            method="POST" class="inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-red-600 hover:bg-red-700 text-white cursor-pointer shadow-md shadow-rose-500/20 transition-all active:scale-95">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
