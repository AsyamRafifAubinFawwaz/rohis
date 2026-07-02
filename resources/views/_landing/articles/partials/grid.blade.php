@if($articles->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
        @foreach($articles as $article)
            <div class="bg-white dark:bg-neutral-900 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-neutral-100 dark:border-neutral-800 flex flex-col h-full group" data-aos="fade-up">
                
                <a href="{{ route('landing.articles.detail', $article->slug) }}" class="block relative aspect-[16/10] overflow-hidden bg-neutral-100 dark:bg-neutral-800">
                    @if(isset($article->thumbnail) && $article->thumbnail)
                        @php
                            $imgUrl = Str::startsWith($article->thumbnail, ['http://', 'https://']) ? $article->thumbnail : asset('storage/' . $article->thumbnail);
                        @endphp
                        <img src="{{ $imgUrl }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-emerald-800/5">
                            <svg class="w-12 h-12 stroke-1 text-emerald-700/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L16.5 5.5M9 11l3 3L22 4" /></svg>
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center ajax-pagination">
        {{ $articles->links() }}
    </div>
@else
    <div class="py-20 text-center bg-white dark:bg-neutral-900 rounded-xl border border-neutral-100 dark:border-neutral-800">
        <p class="text-neutral-500 dark:text-neutral-400">Belum ada artikel saat ini.</p>
    </div>
@endif
