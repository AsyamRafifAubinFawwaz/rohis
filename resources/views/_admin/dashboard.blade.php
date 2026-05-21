@extends('_admin._layout.app')

@section('title', 'Dashboard')

@section('content')
    {{-- Greeting --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-100">
            Halo, {{ auth()->user()->name }}! 👋
        </h1>
        <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">
            Selamat datang di panel admin. Kelola postingan dan galeri kamu di sini.
        </p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 hover:shadow-md transition-shadow duration-200">
            <div class="p-5">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-neutral-400">
                        Total Postingan
                    </p>
                    <span class="inline-flex items-center justify-center size-9 rounded-lg bg-blue-100 dark:bg-blue-500/20">
                        <svg class="size-5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 dark:text-neutral-100">
                    {{ $totalPosts }}
                </h3>
                <a href="{{ route('admin.posts.index') }}"
                    class="mt-2 inline-flex items-center gap-x-1 text-xs text-blue-600 dark:text-blue-400 hover:underline">
                    Lihat semua
                    <svg class="size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Pending --}}
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 hover:shadow-md transition-shadow duration-200">
            <div class="p-5">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-neutral-400">
                        Menunggu Persetujuan
                    </p>
                    <span
                        class="inline-flex items-center justify-center size-9 rounded-lg bg-amber-100 dark:bg-amber-500/20">
                        <svg class="size-5 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 dark:text-neutral-100">
                    {{ $pendingPosts }}
                </h3>
                <a href="{{ route('admin.posts.index', ['status' => 'pending']) }}"
                    class="mt-2 inline-flex items-center gap-x-1 text-xs text-amber-600 dark:text-amber-400 hover:underline">
                    Lihat pending
                    <svg class="size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Published --}}
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 hover:shadow-md transition-shadow duration-200">
            <div class="p-5">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-neutral-400">
                        Sudah Terbit
                    </p>
                    <span
                        class="inline-flex items-center justify-center size-9 rounded-lg bg-emerald-100 dark:bg-emerald-500/20">
                        <svg class="size-5 text-emerald-600 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 dark:text-neutral-100">
                    {{ $publishedPosts }}
                </h3>
                <a href="{{ route('admin.posts.index', ['status' => 'published']) }}"
                    class="mt-2 inline-flex items-center gap-x-1 text-xs text-emerald-600 dark:text-emerald-400 hover:underline">
                    Lihat terbit
                    <svg class="size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Total Galeri --}}
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 hover:shadow-md transition-shadow duration-200">
            <div class="p-5">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-neutral-400">
                        Total Galeri
                    </p>
                    <span
                        class="inline-flex items-center justify-center size-9 rounded-lg bg-violet-100 dark:bg-violet-500/20">
                        <svg class="size-5 text-violet-600 dark:text-violet-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 dark:text-neutral-100">
                    {{ $totalGalleries }}
                </h3>
                <a href="{{ route('admin.galleries.index') }}"
                    class="mt-2 inline-flex items-center gap-x-1 text-xs text-violet-600 dark:text-violet-400 hover:underline">
                    Lihat galeri
                    <svg class="size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-brand dark:bg-brand-dark rounded-xl p-6 mb-6 text-white shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold">Aksi Cepat</h2>
                <p class="text-sm text-white/80 mt-0.5">Buat konten baru dengan cepat</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.posts.add') }}"
                    class="inline-flex items-center gap-x-2 py-2.5 px-5 bg-white text-green-700 dark:text-green-700 font-semibold text-sm rounded-lg hover:bg-blue-50 transition-colors duration-150 shadow-sm">
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Buat Postingan
                </a>
                <a href="{{ route('admin.galleries.add') }}"
                    class="inline-flex items-center gap-x-2 py-2.5 px-5 bg-white/20 text-white font-semibold text-sm rounded-lg hover:bg-white/30 transition-colors duration-150 border border-white/30">
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Upload Galeri
                </a>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-5 gap-6">
        {{-- Postingan Terbaru --}}
        <div
            class="lg:col-span-3 bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-semibold text-gray-800 dark:text-neutral-100">Postingan Terbaru</h2>
                    <p class="text-xs text-gray-500 dark:text-neutral-400 mt-0.5">5 postingan terakhir yang kamu buat</p>
                </div>
                <a href="{{ route('admin.posts.index') }}"
                    class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">
                    Lihat semua →
                </a>
            </div>

            @if ($recentPosts->isEmpty())
                <div class="flex flex-col items-center justify-center py-14 text-center px-6">
                    <svg class="size-12 text-gray-300 dark:text-neutral-600 mb-3" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">Belum ada postingan.</p>
                    <a href="{{ route('admin.posts.add') }}"
                        class="mt-3 text-sm text-blue-600 dark:text-blue-400 hover:underline font-medium">Buat postingan
                        pertama →</a>
                </div>
            @else
                <div class="divide-y divide-gray-100 dark:divide-neutral-700">
                    @foreach ($recentPosts as $post)
                        <div
                            class="flex items-center gap-4 px-5 py-3.5 hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors duration-150">
                            {{-- Thumbnail --}}
                            <div class="shrink-0">
                                @if ($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                        class="size-11 rounded-lg object-cover" alt="{{ $post->title }}">
                                @else
                                    <div
                                        class="size-11 rounded-lg bg-gray-100 dark:bg-neutral-700 flex items-center justify-center">
                                        <svg class="size-5 text-gray-400 dark:text-neutral-500"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 dark:text-neutral-100 truncate">
                                    {{ $post->title }}
                                </p>
                                <div class="flex items-center gap-2 mt-1">
                                    @if ($post->categories->isNotEmpty())
                                        <span class="text-xs text-gray-500 dark:text-neutral-400">
                                            {{ $post->categories->pluck('name')->join(', ') }}
                                        </span>
                                        <span class="text-gray-300 dark:text-neutral-600">·</span>
                                    @endif
                                    <span class="text-xs text-gray-400 dark:text-neutral-500">
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            <div class="shrink-0">
                                @php
                                    $statusMap = [
                                        'published' => [
                                            'label' => 'Terbit',
                                            'class' =>
                                                'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400',
                                        ],
                                        'pending' => [
                                            'label' => 'Pending',
                                            'class' =>
                                                'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400',
                                        ],
                                        'rejected' => [
                                            'label' => 'Ditolak',
                                            'class' => 'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400',
                                        ],
                                        'draft' => [
                                            'label' => 'Draft',
                                            'class' =>
                                                'bg-gray-100 text-gray-600 dark:bg-neutral-700 dark:text-neutral-400',
                                        ],
                                    ];
                                    $s = $statusMap[$post->status] ?? $statusMap['draft'];
                                @endphp
                                <span
                                    class="inline-block py-0.5 px-2 rounded-full text-xs font-medium {{ $s['class'] }}">
                                    {{ $s['label'] }}
                                </span>
                            </div>

                            {{-- Actions --}}
                            <div class="shrink-0 flex items-center gap-2">
                                <a href="{{ route('admin.posts.detail', $post->id) }}"
                                    class="text-xs text-gray-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.641 0-8.573-3.007-9.964-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.posts.update', $post->id) }}"
                                    class="text-xs text-gray-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Galeri Terbaru --}}
        <div
            class="lg:col-span-2 bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-semibold text-gray-800 dark:text-neutral-100">Galeri Terbaru</h2>
                    <p class="text-xs text-gray-500 dark:text-neutral-400 mt-0.5">6 foto terakhir yang kamu upload</p>
                </div>
                <a href="{{ route('admin.galleries.index') }}"
                    class="text-xs text-violet-600 dark:text-violet-400 hover:underline font-medium">
                    Lihat semua →
                </a>
            </div>

            @if ($recentGalleries->isEmpty())
                <div class="flex flex-col items-center justify-center py-14 text-center px-6">
                    <svg class="size-12 text-gray-300 dark:text-neutral-600 mb-3" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">Belum ada foto di galeri.</p>
                    <a href="{{ route('admin.galleries.add') }}"
                        class="mt-3 text-sm text-violet-600 dark:text-violet-400 hover:underline font-medium">Upload foto
                        pertama →</a>
                </div>
            @else
                <div class="p-4 grid grid-cols-3 gap-2">
                    @foreach ($recentGalleries as $gallery)
                        <div
                            class="group relative aspect-square rounded-lg overflow-hidden bg-gray-100 dark:bg-neutral-700">
                            <img src="{{ asset('storage/' . $gallery->image) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                alt="{{ $gallery->title }}">
                            <div
                                class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors duration-200 flex items-end">
                                <p
                                    class="text-white text-xs font-medium px-2 py-1.5 translate-y-full group-hover:translate-y-0 transition-transform duration-200 truncate w-full">
                                    {{ $gallery->title }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="px-4 pb-4">
                    <a href="{{ route('admin.galleries.add') }}"
                        class="block w-full text-center py-2 rounded-lg border-2 border-dashed border-gray-200 dark:border-neutral-700 text-sm text-gray-400 dark:text-neutral-500 hover:border-violet-400 hover:text-violet-500 dark:hover:border-violet-500 dark:hover:text-violet-400 transition-colors duration-150">
                        + Upload foto baru
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
