@extends('_landing._layout.app')
@section('title', 'Agenda Terdekat')

@section('content')
    <div class="pt-28 pb-20 bg-neutral-50 dark:bg-neutral-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="mb-12">
                <span
                    class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-wider block mb-2">Kalender
                    Aksi</span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">
                    Agenda Kegiatan</h1>
            </div>

            <!-- Activities Grid Container -->
            <div id="activities-container" class="relative">
                <!-- Initial Skeleton Loading -->
                <div id="activities-skeleton" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @for($i=0; $i<6; $i++)
                        @include('components.skeleton-card')
                    @endfor
                </div>
                
                <!-- Real content will be injected here -->
                <div id="activities-content" style="display: none;"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('activities-content');
        const skeleton = document.getElementById('activities-skeleton');

        // Function to fetch and render activities
        function fetchActivities(url) {
            skeleton.style.display = 'grid';
            container.style.display = 'none';

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
                        fetchActivities(this.href);
                        window.history.pushState({}, '', this.href);
                    });
                });
            })
            .catch(err => {
                console.error('Error fetching activities:', err);
                container.innerHTML = '<p class="text-center py-10 text-red-500">Gagal memuat agenda kegiatan.</p>';
                skeleton.style.display = 'none';
                container.style.display = 'block';
            });
        }

        // Initial Load
        fetchActivities(window.location.href);
    });
</script>
@endpush
