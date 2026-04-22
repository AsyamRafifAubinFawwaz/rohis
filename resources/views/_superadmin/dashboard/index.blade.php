@extends('_superadmin._layout.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Total Users -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">Total Pengguna</p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                        {{ number_format($stats['total_users']) }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Total Posts -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">Total Postingan</p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                        {{ number_format($stats['total_posts']) }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Total Galleries -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">Total Galeri</p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                        {{ number_format($stats['total_galleries']) }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Total Programs -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">Total Program</p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                        {{ number_format($stats['total_programs']) }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- End Stats Grid -->

    <div class="grid lg:grid-cols-3 gap-4 sm:gap-6 mt-6">
        <!-- Chart: Post Status -->
        <div class="lg:col-span-1 p-4 md:p-5 flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <h2 class="text-sm font-semibold text-gray-800 dark:text-neutral-200 mb-4">Status Postingan</h2>
            <div id="post-status-chart"></div>
        </div>

        <!-- Quick Approval Table -->
        <div class="lg:col-span-2 flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex justify-between items-center">
                <h2 class="text-sm font-semibold text-gray-800 dark:text-neutral-200">Approval Postingan (Terakhir)</h2>
                <a navigate href="{{ route('superadmin.posts.index', ['status' => 'pending']) }}" class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-800">
                        <tr>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Penulis</th>
                            <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @forelse($pending_posts as $post)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    <div class="max-w-[200px] truncate" title="{{ $post->title }}">{{ $post->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $post->user->name ?? 'Unknown' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <form navigate-form action="{{ route('superadmin.posts.approve', $post->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-teal-600 hover:text-teal-800 dark:text-teal-500 dark:hover:text-teal-400">Approve</button>
                                        </form>
                                        <form navigate-form action="{{ route('superadmin.posts.reject', $post->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-sm text-gray-500">Tidak ada postingan yang memerlukan approval.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Latest Gallery Section -->
    <div class="mt-6 p-4 md:p-5 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-semibold text-gray-800 dark:text-neutral-200">Galeri Terbaru</h2>
            <a navigate href="{{ route('superadmin.galleries.index') }}" class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($latest_galleries as $gallery)
                <div class="group relative block overflow-hidden rounded-xl bg-gray-100 dark:bg-neutral-900 aspect-square">
                    <img class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" 
                         src="{{ asset('storage/' . $gallery->image) }}" 
                         alt="{{ $gallery->title }}">
                    <div class="absolute inset-x-0 bottom-0 p-2 bg-gradient-to-t from-black/60 to-transparent">
                        <p class="text-[10px] text-white truncate">{{ $gallery->title }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('load', function () {
            var options = {
                series: [{{ implode(',', array_values($chart_data)) }}],
                chart: {
                    type: 'donut',
                    height: 300,
                },
                labels: {!! json_encode(array_keys($chart_data)) !!},
                colors: ['#22c55e', '#f59e0b', '#ef4444', '#6b7280'],
                legend: {
                    position: 'bottom'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#post-status-chart"), options);
            chart.render();
        });
    </script>
    @endpush
@endsection
