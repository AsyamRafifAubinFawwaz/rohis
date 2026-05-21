@extends('_superadmin._layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Welcome Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-200">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-sm text-gray-500 dark:text-neutral-500">Berikut adalah ringkasan aktivitas sistem hari ini.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-xs font-medium bg-brand/10 text-brand dark:bg-brand/20">
                    <span class="size-1.5 rounded-full bg-brand"></span>
                    Sistem Online
                </span>
                <span class="text-xs text-gray-400 dark:text-neutral-500">{{ now()->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
            <a navigate href="{{ route('superadmin.posts.add') }}" class="p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl hover:border-brand transition-all group text-center shadow-xs">
                <div class="size-10 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    @include('_admin._layout.icons.add')
                </div>
                <span class="text-xs font-semibold text-gray-700 dark:text-neutral-300">Buat Post</span>
            </a>
            <a navigate href="{{ route('superadmin.galleries.add') }}" class="p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl hover:border-brand transition-all group text-center shadow-xs">
                <div class="size-10 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                </div>
                <span class="text-xs font-semibold text-gray-700 dark:text-neutral-300">Upload Galeri</span>
            </a>
            <a navigate href="{{ route('superadmin.programs.add') }}" class="p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl hover:border-brand transition-all group text-center shadow-xs">
                <div class="size-10 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M12 2v20m10-10H2"/></svg>
                </div>
                <span class="text-xs font-semibold text-gray-700 dark:text-neutral-300">Tambah Program</span>
            </a>
            <a navigate href="{{ route('superadmin.announcements.add') }}" class="p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl hover:border-brand transition-all group text-center shadow-xs">
                <div class="size-10 bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0m-7.2-4a6 6 0 1 1 11 0l1 2H4.5l1-2Z"/></svg>
                </div>
                <span class="text-xs font-semibold text-gray-700 dark:text-neutral-300">Pengumuman</span>
            </a>
            <a navigate href="{{ route('superadmin.profiles.index') }}" class="p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl hover:border-brand transition-all group text-center shadow-xs">
                <div class="size-10 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <span class="text-xs font-semibold text-gray-700 dark:text-neutral-300">Profil Organisasi</span>
            </a>
            <a navigate href="{{ route('superadmin.users.add') }}" class="p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl hover:border-brand transition-all group text-center shadow-xs">
                <div class="size-10 bg-gray-100 dark:bg-neutral-700 text-gray-600 dark:text-neutral-300 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <span class="text-xs font-semibold text-gray-700 dark:text-neutral-300">Tambah Akun</span>
            </a>
        </div>

        <!-- Stats Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Total Users -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 transition-all hover:shadow-md">
                <div class="p-4 md:p-5 flex items-center gap-x-4">
                    <div class="shrink-0 flex justify-center items-center size-12 bg-blue-50 text-blue-600 rounded-xl dark:bg-blue-900/20 dark:text-blue-400">
                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /><path d="M22 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg>
                    </div>
                    <div class="grow">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-500">Total Pengguna</p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-black text-gray-800 dark:text-neutral-200">{{ number_format($stats['total_users']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Posts -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 transition-all hover:shadow-md">
                <div class="p-4 md:p-5 flex items-center gap-x-4">
                    <div class="shrink-0 flex justify-center items-center size-12 bg-emerald-50 text-emerald-600 rounded-xl dark:bg-emerald-900/20 dark:text-emerald-400">
                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" /><polyline points="14 2 14 8 20 8" /></svg>
                    </div>
                    <div class="grow">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-500">Total Postingan</p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-black text-gray-800 dark:text-neutral-200">{{ number_format($stats['total_posts']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Galleries -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 transition-all hover:shadow-md">
                <div class="p-4 md:p-5 flex items-center gap-x-4">
                    <div class="shrink-0 flex justify-center items-center size-12 bg-amber-50 text-amber-600 rounded-xl dark:bg-amber-900/20 dark:text-amber-400">
                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2" /><circle cx="9" cy="9" r="2" /><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" /></svg>
                    </div>
                    <div class="grow">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-500">Total Galeri</p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-black text-gray-800 dark:text-neutral-200">{{ number_format($stats['total_galleries']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Programs -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-xs rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 transition-all hover:shadow-md">
                <div class="p-4 md:p-5 flex items-center gap-x-4">
                    <div class="shrink-0 flex justify-center items-center size-12 bg-indigo-50 text-indigo-600 rounded-xl dark:bg-indigo-900/20 dark:text-indigo-400">
                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2" /><line x1="16" x2="16" y1="2" y2="6" /><line x1="8" x2="8" y1="2" y2="6" /><line x1="3" x2="21" y1="10" y2="10" /></svg>
                    </div>
                    <div class="grow">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-500">Total Program</p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-black text-gray-800 dark:text-neutral-200">{{ number_format($stats['total_programs']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-4 sm:gap-6">
            <!-- Approval Card -->
            <div class="lg:col-span-2 flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex justify-between items-center">
                    <h2 class="text-sm font-bold text-gray-800 dark:text-neutral-200">Approval Postingan (Terakhir)</h2>
                    <a navigate href="{{ route('superadmin.posts.index', ['status' => 'pending']) }}" class="text-xs text-brand hover:underline font-semibold">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-900/30">
                            <tr>
                                <th class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase tracking-wider">Penulis</th>
                                <th class="px-6 py-3 text-end text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse($pending_posts as $post)
                                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="max-w-[250px] truncate text-sm font-medium text-gray-800 dark:text-neutral-200" title="{{ $post->title }}">{{ $post->title }}</div>
                                        <div class="text-[10px] text-gray-400 mt-0.5">{{ $post->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-x-2">
                                            <div class="size-6 bg-brand/10 text-brand rounded-full flex items-center justify-center text-[10px] font-bold">
                                                {{ strtoupper(substr($post->user->name ?? 'A', 0, 1)) }}
                                            </div>
                                            <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $post->user->name ?? 'Unknown' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <form navigate-form action="{{ route('superadmin.posts.approve', $post->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-400 text-xs transition-colors cursor-pointer">Setujui</button>
                                            </form>
                                            <form navigate-form action="{{ route('superadmin.posts.reject', $post->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 dark:bg-rose-900/20 dark:text-rose-400 text-xs transition-colors cursor-pointer">Tolak</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-14 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="size-12 bg-gray-50 dark:bg-neutral-700 rounded-full flex items-center justify-center mb-3">
                                                <svg class="size-6 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                            </div>
                                            <p class="text-sm text-gray-400 dark:text-neutral-500">Semua postingan sudah diproses.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Chart Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                    <h2 class="text-sm font-bold text-gray-800 dark:text-neutral-200">Distribusi Status Post</h2>
                </div>
                <div class="p-4 flex-1 flex flex-col justify-center">
                    <div id="post-status-chart"></div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Profile Status Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex justify-between items-center">
                    <h2 class="text-sm font-bold text-gray-800 dark:text-neutral-200">Kelengkapan Profil Organisasi</h2>
                    <a navigate href="{{ route('superadmin.profiles.index') }}" class="text-xs text-brand hover:underline font-semibold">Kelola</a>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach(['about' => 'Tentang Kami', 'vision' => 'Visi', 'mission' => 'Misi', 'structure' => 'Struktur'] as $type => $label)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-x-3">
                                    @if(isset($profile_stats[$type]) && $profile_stats[$type] > 0)
                                        <span class="size-2 rounded-full bg-emerald-500"></span>
                                    @else
                                        <span class="size-2 rounded-full bg-gray-300 dark:bg-neutral-600"></span>
                                    @endif
                                    <span class="text-sm text-gray-700 dark:text-neutral-300">{{ $label }}</span>
                                </div>
                                <span class="text-xs font-medium {{ isset($profile_stats[$type]) && $profile_stats[$type] > 0 ? 'text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full dark:bg-emerald-900/20 dark:text-emerald-400' : 'text-gray-400' }}">
                                    {{ isset($profile_stats[$type]) && $profile_stats[$type] > 0 ? 'Sudah Ada' : 'Belum Ada' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Latest Programs Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex justify-between items-center">
                    <h2 class="text-sm font-bold text-gray-800 dark:text-neutral-200">Program Terbaru</h2>
                    <a navigate href="{{ route('superadmin.programs.index') }}" class="text-xs text-brand hover:underline font-semibold">Lihat Semua</a>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        @forelse($latest_programs as $program)
                            <div class="flex items-center gap-x-3 p-2 rounded-xl hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors">
                                <div class="size-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center text-indigo-600 overflow-hidden shrink-0">
                                    @if($program->image)
                                        <img src="{{ asset('storage/' . $program->image) }}" class="size-full object-cover">
                                    @else
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 1 0-18 9 9 0 0 1 0 18z"/></svg>
                                    @endif
                                </div>
                                <div class="grow min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-neutral-200 truncate">{{ $program->name }}</h4>
                                    <p class="text-xs text-gray-500 dark:text-neutral-500 truncate">{{ Str::limit(strip_tags($program->description), 50) }}</p>
                                </div>
                                <a navigate href="{{ route('superadmin.programs.detail', $program->id) }}" class="p-1.5 text-gray-400 hover:text-brand">
                                    @include('_admin._layout.icons.view_detail')
                                </a>
                            </div>
                        @empty
                            <p class="text-center text-sm text-gray-400 py-10">Belum ada program.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Gallery Section -->
        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-sm font-bold text-gray-800 dark:text-neutral-200">Galeri Terbaru</h2>
                <a navigate href="{{ route('superadmin.galleries.index') }}" class="text-xs text-brand hover:underline font-semibold">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4">
                @forelse ($latest_galleries as $gallery)
                    <div class="group relative block overflow-hidden rounded-xl bg-gray-100 dark:bg-neutral-900 aspect-square border border-gray-200 dark:border-neutral-700">
                        <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-2">
                            <p class="text-[10px] text-white font-medium truncate">{{ $gallery->title }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center text-sm text-gray-400">Belum ada foto galeri.</div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            (function() {
                var options = {
                    series: [{{ implode(',', array_values($chart_data)) }}],
                    chart: {
                        type: 'donut',
                        height: 280,
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                        }
                    },
                    labels: {!! json_encode(array_keys($chart_data)) !!},
                    colors: ['#10b981', '#f59e0b', '#f43f5e', '#94a3b8'],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        fontSize: '12px',
                                        fontWeight: 600,
                                        offsetY: -10
                                    },
                                    value: {
                                        show: true,
                                        fontSize: '20px',
                                        fontWeight: 900,
                                        offsetY: 10,
                                        formatter: function(val) {
                                            return val
                                        }
                                    },
                                    total: {
                                        show: true,
                                        label: 'Total Post',
                                        formatter: function(w) {
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                        }
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        markers: {
                            radius: 12
                        }
                    },
                    stroke: {
                        show: false
                    }
                };

                var chartContainer = document.querySelector("#post-status-chart");
                if (chartContainer) {
                    var chart = new ApexCharts(chartContainer, options);
                    chart.render();
                }
            })();
        </script>
    @endpush
@endsection
