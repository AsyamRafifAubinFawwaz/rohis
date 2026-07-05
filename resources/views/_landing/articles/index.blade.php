@extends('_landing._layout.app')
@section('title', 'Artikel Kami')

@section('content')
<!-- Hero Section -->
<div class="relative w-full mt-16 sm:mt-20 py-16 sm:py-24 flex flex-col items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-neutral-900 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/banner-artikel.jpg') }}?v={{ filemtime(public_path('images/banner-artikel.jpg')) }}');"></div>
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
                        class="py-3.5 pl-5 pr-5 block w-full border border-neutral-200 rounded-2xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 shadow-sm"
                        placeholder="Cari Judul atau Isi Artikel...">
                </div>

                <!-- Category Dropdown -->
                <div class="w-full md:w-56">
                    <select id="category" name="category"
                        data-hs-select='{
                            "placeholder": "Semua Kategori",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3.5 ps-5 pe-9 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-neutral-200 text-neutral-800 rounded-2xl text-start text-sm focus:outline-hidden focus:border-emerald-500 focus:ring-emerald-500 shadow-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300",
                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-neutral-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-neutral-100 [&::-webkit-scrollbar-thumb]:bg-neutral-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                            "optionClasses": "hs-selected:bg-emerald-600/10 dark:hs-selected:bg-emerald-600/20 hs-selected:text-emerald-700 dark:hs-selected:text-emerald-400 py-2.5 px-4 w-full text-sm text-neutral-800 dark:text-neutral-200 cursor-pointer hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-emerald-600 dark:text-emerald-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-4 -translate-y-1/2\"><svg class=\"shrink-0 size-4 text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
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
                <button type="button" id="sortBtn" class="flex-none flex items-center gap-2 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-neutral-800 text-neutral-700 dark:text-neutral-300 py-3.5 px-6 rounded-2xl text-sm font-medium transition-colors w-full md:w-auto justify-center shadow-sm">
                    <span id="sortText">{{ request('sort') == 'oldest' ? 'Terlama' : 'Terbaru' }}</span>
                    <svg id="sortIcon" class="w-4 h-4 {{ request('sort') == 'oldest' ? 'rotate-180' : '' }} transition-transform text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
                </button>

                <!-- Search Button -->
                <button type="submit" class="flex-none flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white py-3.5 px-6 rounded-2xl text-sm font-medium transition-colors w-full md:w-auto justify-center shadow-sm cursor-pointer" title="Cari Artikel">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1116.65 1.65a7.5 7.5 0 010 15z"></path></svg>
                    <span class="hidden sm:inline">Cari</span>
                </button>
            </form>
        </div>
        <!-- Article Grid Container -->
        <div id="articles-container" class="relative">
            <!-- Initial Skeleton Loading -->
            <div id="articles-skeleton" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @for($i=0; $i<6; $i++)
                    @include('components.skeleton-card')
                @endfor
            </div>
            
            <!-- Real content will be injected here -->
            <div id="articles-content" style="display: none;"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const catSelect = document.getElementById('category');
        const filterForm = document.getElementById('filterForm');
        const sortInput = document.getElementById('sortInput');
        const container = document.getElementById('articles-content');
        const skeleton = document.getElementById('articles-skeleton');

        // Function to fetch and render articles
        function fetchArticles(url) {
            // Show skeleton, hide content
            skeleton.style.display = 'grid';
            container.style.display = 'none';

            // Add partial flag to URL
            const fetchUrl = new URL(url, window.location.origin);
            fetchUrl.searchParams.set('partial', 'true');

            // Add a small artificial delay so the skeleton is visible
            const minDelay = new Promise(resolve => setTimeout(resolve, 500));
            const fetchPromise = fetch(fetchUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => response.text());

            Promise.all([fetchPromise, minDelay])
            .then(([html]) => {
                container.innerHTML = html;
                skeleton.style.display = 'none';
                container.style.display = 'block';

                // Intercept pagination clicks
                const paginationLinks = container.querySelectorAll('.ajax-pagination a');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        fetchArticles(this.href);
                        // Update URL without reload
                        window.history.pushState({}, '', this.href);
                    });
                });
            })
            .catch(err => {
                console.error('Error fetching articles:', err);
                container.innerHTML = '<p class="text-center py-10 text-red-500">Gagal memuat artikel.</p>';
                skeleton.style.display = 'none';
                container.style.display = 'block';
            });
        }

        // Handle category change (No auto-submit, wait for Search button)
        if (catSelect) {
            catSelect.addEventListener('change', function () {
                // We just update the value, form submit will handle the rest
            });
        }

        // Handle sort button click
        const sortBtn = document.getElementById('sortBtn');
        const sortText = document.getElementById('sortText');
        const sortIcon = document.getElementById('sortIcon');
        
        if (sortBtn) {
            sortBtn.addEventListener('click', function () {
                const isNewest = sortInput.value === 'newest';
                sortInput.value = isNewest ? 'oldest' : 'newest';
                
                // Update UI text and icon instantly
                sortText.textContent = isNewest ? 'Terlama' : 'Terbaru';
                if (isNewest) {
                    sortIcon.classList.add('rotate-180');
                } else {
                    sortIcon.classList.remove('rotate-180');
                }
                // No auto-submit here anymore, must press Search button
            });
        }

        // Handle form submit (Search & Sort)
        if (filterForm) {
            filterForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const url = new URL(this.action);
                url.searchParams.set('category', catSelect ? catSelect.value : 'all');
                url.searchParams.set('search', this.querySelector('input[name="search"]').value);
                url.searchParams.set('sort', sortInput.value);
                
                window.history.pushState({}, '', url);
                fetchArticles(url);
            });
        }

        // Initial Load
        fetchArticles(window.location.href);
    });
</script>
@endpush
