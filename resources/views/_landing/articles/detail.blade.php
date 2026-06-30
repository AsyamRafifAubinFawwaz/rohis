@extends('_landing._layout.app')
@section('title', $article->title)

@section('content')
<div class="pt-24 sm:pt-28 pb-20 bg-neutral-50 dark:bg-neutral-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            
            <!-- Main Content Area -->
            <div class="w-full lg:w-8/12 bg-white dark:bg-neutral-900 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 p-6 sm:p-8">
                
                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mb-4">
                    @forelse($article->categories as $category)
                        <span class="inline-block bg-emerald-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">
                            {{ $category->name }}
                        </span>
                    @empty
                        <span class="inline-block bg-emerald-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">
                            News
                        </span>
                    @endforelse
                </div>

                <!-- Title -->
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white leading-snug mb-4">
                    {{ $article->title }}
                </h1>
                
                <!-- Meta Info -->
                <div class="flex items-center gap-4 text-xs text-neutral-500 dark:text-neutral-400 mb-8 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <span>Telah Dilihat Sebanyak {{ rand(50, 500) }}</span>
                    </div>
                </div>

                <!-- Featured Image -->
                @if($article->thumbnail)
                    <div class="w-full aspect-[16/9] mb-8 bg-neutral-100 rounded-lg overflow-hidden">
                        @php
                            $mainImgUrl = Str::startsWith($article->thumbnail, ['http://', 'https://']) ? $article->thumbnail : asset('storage/' . $article->thumbnail);
                        @endphp
                        <img src="{{ $mainImgUrl }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <!-- Article Content -->
                <div class="prose prose-base sm:prose-lg prose-emerald dark:prose-invert max-w-none prose-img:rounded-xl">
                    {!! $article->content !!}
                </div>

                <!-- Author, Share & Like Section -->
                <div class="mt-12 pt-6 border-t border-neutral-100 dark:border-neutral-800 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-neutral-900 text-white flex items-center justify-center font-bold text-sm">
                            {{ substr($article->user->name ?? 'A', 0, 2) }}
                        </div>
                        <span class="font-bold text-neutral-900 dark:text-white">{{ $article->user->name ?? 'Admin' }}</span>
                    </div>
                    
                    <div class="flex items-center gap-4 sm:gap-6">
                        @include('partials.share-buttons', ['title' => $article->title])
                        
                        <div class="w-px h-8 bg-neutral-200 dark:bg-neutral-800"></div>

                        <button class="flex flex-col items-center gap-1 text-neutral-400 hover:text-red-500 transition-colors group">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 fill-neutral-200 group-hover:fill-red-100 stroke-currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                            <span class="text-xs font-bold">{{ rand(10, 500) }}</span>
                        </button>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-4/12 space-y-6 sm:space-y-8">
                
                <!-- Other Articles Widget -->
                <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Artikel Lainnya</h3>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse($otherArticles ?? [] as $other)
                            <a href="{{ route('landing.articles.detail', $other->slug) }}" class="flex gap-4 group">
                                <div class="w-20 h-20 rounded-md overflow-hidden bg-neutral-100 flex-shrink-0">
                                    @if($other->thumbnail)
                                        @php
                                            $otherImgUrl = Str::startsWith($other->thumbnail, ['http://', 'https://']) ? $other->thumbnail : asset('storage/' . $other->thumbnail);
                                        @endphp
                                        <img src="{{ $otherImgUrl }}" alt="{{ $other->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-neutral-400 bg-neutral-100 dark:bg-neutral-800/50">
                                            <svg class="w-6 h-6 stroke-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4 class="font-bold text-sm text-neutral-900 dark:text-white group-hover:text-emerald-600 transition-colors line-clamp-2 leading-snug mb-1">{{ $other->title }}</h4>
                                    <span class="text-[10px] text-neutral-500">{{ $other->created_at->translatedFormat('d F Y') }}</span>
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-neutral-500">Tidak ada artikel lain.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Kategori</h3>
                    </div>
                    
                    <ul class="space-y-3">
                        @forelse($categories ?? [] as $category)
                            <li>
                                <a href="{{ route('landing.articles.index', ['category' => $category->slug]) }}" class="block text-sm text-neutral-600 dark:text-neutral-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @empty
                            <!-- Fallback UI if db has no categories to match design -->
                            @foreach(['Prestasi', 'RPL', 'TKJ', 'DKV', 'TSM', 'TKR', 'APT', 'ATPH', 'News', 'Event', 'Karya Siswa', 'Ekstrakulikuler', 'Kunjungan', 'Teaching Factory', 'Keagamaan', 'Edukasi'] as $fallbackCat)
                                <li>
                                    <a href="#" class="block text-sm text-neutral-600 dark:text-neutral-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                                        {{ $fallbackCat }}
                                    </a>
                                </li>
                            @endforeach
                        @endforelse
                    </ul>
                </div>
            </div>
            
        </div>

    </div>
</div>
@endsection
