@extends('_landing._layout.app')
@section('title', 'Artikel Kami')

@section('content')
<!-- Hero Section -->
<div class="relative w-full mt-16 sm:mt-20 py-16 sm:py-24 flex flex-col items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-neutral-900 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/banner-artikel.jpg') }}');"></div>
    <div class="absolute inset-0 bg-emerald-800/80 dark:bg-emerald-900/90 mix-blend-multiply"></div>
    
    <div class="relative z-10 text-center px-4">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-3">Artikel Kami</h1>
        <p class="text-sm sm:text-base text-emerald-100">Temukan berita-berita Terbaru Mengenai Organisasi Kami</p>
    </div>
</div>

<div class="bg-neutral-50 dark:bg-neutral-950 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Section -->
        <div class="mb-12 w-full max-w-4xl mx-auto">
            <form action="{{ route('landing.articles.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3" id="filterForm">
                
                <!-- Search Bar -->
                <div class="w-full md:flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="py-3.5 px-5 block w-full border border-neutral-200 rounded-2xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 shadow-sm"
                        placeholder="Cari Judul atau Isi Artikel...">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                        <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1116.65 1.65a7.5 7.5 0 010 15z"></path></svg>
                    </div>
                </div>

                <!-- Category Dropdown (Preline) -->
                <div class="w-full md:w-56">
                    <select id="category" name="category"
                        data-hs-select='{
                            "placeholder": "Semua Kategori",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3.5 px-5 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-neutral-200 text-neutral-800 rounded-2xl text-start text-sm hover:bg-neutral-50 focus:outline-hidden shadow-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800",
                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-neutral-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-neutral-100 [&::-webkit-scrollbar-thumb]:bg-neutral-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                            "optionClasses": "hs-selected:bg-emerald-100 dark:hs-selected:bg-emerald-900/30 py-2 px-4 w-full text-sm text-neutral-800 dark:text-neutral-200 cursor-pointer hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-emerald-600 dark:text-emerald-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-4 -translate-y-1/2\"><svg class=\"shrink-0 size-4 text-neutral-400 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }'
                        class="hidden">
                        <option value="all">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->slug }}"
                                {{ (request('category') == $cat->slug) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="sort" id="sortInput" value="{{ request('sort', 'newest') }}">
                <button type="submit" onclick="document.getElementById('sortInput').value = document.getElementById('sortInput').value === 'newest' ? 'oldest' : 'newest';" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white py-3.5 px-6 rounded-2xl text-sm font-medium transition-colors w-full md:w-auto justify-center shadow-sm">
                    {{ request('sort') == 'oldest' ? 'Terlama' : 'Terbaru' }}
                    <svg class="w-4 h-4 {{ request('sort') == 'oldest' ? 'rotate-180' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
                </button>
            </form>
        </div>

        @if($articles->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($articles as $article)
                    <div class="bg-white dark:bg-neutral-900 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-neutral-100 dark:border-neutral-800 flex flex-col h-full">
                        
                        <a href="{{ route('landing.articles.detail', $article->slug) }}" class="block relative aspect-[4/3] bg-neutral-100 dark:bg-neutral-800 overflow-hidden group">
                            @if($article->thumbnail)
                                @php
                                    $imgUrl = Str::startsWith($article->thumbnail, ['http://', 'https://']) ? $article->thumbnail : asset('storage/' . $article->thumbnail);
                                @endphp
                                <img src="{{ $imgUrl }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-neutral-400 dark:text-neutral-600 bg-neutral-100 dark:bg-neutral-800/50">
                                    <svg class="w-12 h-12 mb-2 stroke-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </a>

                        <div class="p-6 flex flex-col flex-1 relative">
                            <!-- Badges -->
                            <div class="flex flex-wrap gap-2 mb-3">
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

                            <a href="{{ route('landing.articles.detail', $article->slug) }}" class="block group">
                                <h3 class="font-bold text-neutral-900 dark:text-white text-lg leading-snug line-clamp-2 mb-2 group-hover:text-emerald-600 transition-colors">
                                    {{ $article->title }}
                                </h3>
                            </a>
                            
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2 mb-4 flex-1">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            
                            <div class="flex items-center gap-4 mt-auto text-xs text-neutral-500 dark:text-neutral-400">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span>Telah Dilihat Sebanyak {{ rand(50, 500) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $articles->links() }}
            </div>
        @else
            <div class="py-20 text-center bg-white dark:bg-neutral-900 rounded-xl border border-neutral-100 dark:border-neutral-800">
                <p class="text-neutral-500 dark:text-neutral-400">Belum ada artikel saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const catSelect = document.getElementById('category');
        if (catSelect) {
            catSelect.addEventListener('change', function () {
                document.getElementById('filterForm').submit();
            });
        }
    });
</script>
@endpush
