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

                <!-- Category Dropdown -->
                <div class="w-full md:w-56">
                    <select id="category" name="category"
                        class="py-3.5 px-5 block w-full border border-neutral-200 rounded-2xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 shadow-sm cursor-pointer transition-colors">
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

            fetch(fetchUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
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

        // Handle category change
        if (catSelect) {
            catSelect.addEventListener('change', function () {
                const url = new URL(filterForm.action);
                url.searchParams.set('category', this.value);
                url.searchParams.set('search', filterForm.querySelector('input[name="search"]').value);
                url.searchParams.set('sort', sortInput.value);
                
                window.history.pushState({}, '', url);
                fetchArticles(url);
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
