@extends('_superadmin._layout.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Total Users -->
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 transition-all hover:shadow-md">
            <div class="p-4 md:p-5 flex items-center gap-x-4">
                <div
                    class="shrink-0 flex justify-center items-center size-12 bg-blue-50 text-blue-600 rounded-xl dark:bg-blue-900/20 dark:text-blue-400">
                    <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
                <div class="grow">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-500">Total
                        Pengguna</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-black text-gray-800 dark:text-neutral-200">
                            {{ number_format($stats['total_users']) }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Posts -->
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 transition-all hover:shadow-md">
            <div class="p-4 md:p-5 flex items-center gap-x-4">
                <div
                    class="shrink-0 flex justify-center items-center size-12 bg-emerald-50 text-emerald-600 rounded-xl dark:bg-emerald-900/20 dark:text-emerald-400">
                    <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                </div>
                <div class="grow">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-500">Total
                        Postingan</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-black text-gray-800 dark:text-neutral-200">
                            {{ number_format($stats['total_posts']) }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Galleries -->
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 transition-all hover:shadow-md">
            <div class="p-4 md:p-5 flex items-center gap-x-4">
                <div
                    class="shrink-0 flex justify-center items-center size-12 bg-amber-50 text-amber-600 rounded-xl dark:bg-amber-900/20 dark:text-amber-400">
                    <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                        <circle cx="9" cy="9" r="2" />
                        <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                    </svg>
                </div>
                <div class="grow">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-500">Total
                        Galeri</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-black text-gray-800 dark:text-neutral-200">
                            {{ number_format($stats['total_galleries']) }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Programs -->
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 transition-all hover:shadow-md">
            <div class="p-4 md:p-5 flex items-center gap-x-4">
                <div
                    class="shrink-0 flex justify-center items-center size-12 bg-indigo-50 text-indigo-600 rounded-xl dark:bg-indigo-900/20 dark:text-indigo-400">
                    <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                        <line x1="16" x2="16" y1="2" y2="6" />
                        <line x1="8" x2="8" y1="2" y2="6" />
                        <line x1="3" x2="21" y1="10" y2="10" />
                    </svg>
                </div>
                <div class="grow">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-500">Total
                        Program</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-black text-gray-800 dark:text-neutral-200">
                            {{ number_format($stats['total_programs']) }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Stats Grid -->

    <div class="grid lg:grid-cols-3 gap-4 sm:gap-6 mt-6">
        <div
            class="lg:col-span-2 flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex justify-between items-center">
                <h2 class="text-sm font-semibold text-gray-800 dark:text-neutral-200">Approval Postingan (Terakhir)</h2>
                <a navigate href="{{ route('superadmin.posts.index', ['status' => 'pending']) }}"
                    class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
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
                                    <div class="max-w-[200px] truncate" title="{{ $post->title }}">{{ $post->title }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $post->user->name ?? 'Unknown' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <form navigate-form action="{{ route('superadmin.posts.approve', $post->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-teal-600 hover:text-teal-800 dark:text-teal-500 dark:hover:text-teal-400">Approve</button>
                                        </form>
                                        <form navigate-form action="{{ route('superadmin.posts.reject', $post->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-sm text-gray-500">Tidak ada
                                    postingan
                                    yang memerlukan approval.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Latest Gallery Section -->
    <div
        class="mt-6 p-4 md:p-5 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-semibold text-gray-800 dark:text-neutral-200">Galeri Terbaru</h2>
            <a navigate href="{{ route('superadmin.galleries.index') }}"
                class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($latest_galleries as $gallery)
                <div class="group relative block overflow-hidden rounded-xl bg-gray-100 dark:bg-neutral-900 aspect-square">
                    <img class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                        src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}">
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
            document.addEventListener('load', function() {
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
