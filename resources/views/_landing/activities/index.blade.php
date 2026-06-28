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

            @if ($activities->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @php $tiltDate = ['-rotate-3', 'rotate-3', '-rotate-2']; @endphp
                    @foreach ($activities as $i => $activity)
                        <div
                            class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm hover:shadow-md transition-shadow border border-neutral-100 dark:border-neutral-800 flex flex-col h-full group relative pt-4 sm:pt-6 pr-4">

                            <a href="{{ route('landing.activities.detail', $activity->id) }}"
                                class="cursor-pointer block relative aspect-[4/3] bg-neutral-100 dark:bg-neutral-800 rounded-t-xl sm:rounded-none">
                                @if (isset($activity->poster) && $activity->poster)
                                    @php
                                        $imgUrl = Str::startsWith($activity->poster, ['http://', 'https://'])
                                            ? $activity->poster
                                            : asset('storage/' . $activity->poster);
                                    @endphp
                                    <img src="{{ $imgUrl }}" alt="{{ $activity->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div
                                        class="w-full h-full flex flex-col items-center justify-center text-neutral-400 dark:text-neutral-600 bg-neutral-100 dark:bg-neutral-800/50">
                                        <svg class="w-12 h-12 mb-2 stroke-1" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </a>

                            <div class="p-6 flex flex-col flex-1 relative">
                                <!-- Badges -->
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @php
                                        $eventStart = \Carbon\Carbon::parse($activity->event_start);
                                        $eventEnd = $activity->event_end
                                            ? \Carbon\Carbon::parse($activity->event_end)
                                            : null;
                                        $now = now();
                                        if ($eventStart->isFuture()) {
                                            $status = 'Upcoming';
                                        } elseif ($eventEnd && $eventEnd->isPast()) {
                                            $status = 'Completed';
                                        } else {
                                            $status = 'Ongoing';
                                        }
                                    @endphp
                                    <span
                                        class="inline-block bg-emerald-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">
                                        {{ $status }}
                                    </span>
                                </div>

                                <a href="{{ route('landing.activities.detail', $activity->id) }}"
                                    class="cursor-pointer block group">
                                    <h3
                                        class="font-bold text-neutral-900 dark:text-white text-lg leading-snug line-clamp-2 mb-2 group-hover:text-emerald-600 transition-colors">
                                        {{ $activity->title }}
                                    </h3>
                                </a>

                                @if (!empty($activity->location))
                                    <div
                                        class="flex items-center gap-x-2 text-xs text-neutral-500 dark:text-neutral-400 font-bold mb-4">
                                        <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span class="truncate">{{ $activity->location }}</span>
                                    </div>
                                @endif

                                <div class="flex items-center gap-4 mt-auto text-xs text-neutral-500 dark:text-neutral-400">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $activity->created_at->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            @if (!empty($activity->event_start))
                                <div
                                    class="absolute top-0 right-0 z-50 w-14 sm:w-16 aspect-square rounded-xl shadow-md border-2 border-white dark:border-neutral-900 flex flex-col items-center justify-center {{ $tiltDate[$i % 3] }} group-hover:rotate-0 group-hover:scale-110 transition-transform duration-400 bg-emerald-700">
                                    <span
                                        class="text-white text-lg sm:text-xl font-black leading-none">{{ $eventStart->format('d') }}</span>
                                    <span
                                        class="text-emerald-200 text-[9px] font-extrabold uppercase tracking-wide leading-none mt-0.5">{{ $eventStart->translatedFormat('M') }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    {{ $activities->links() }}
                </div>
            @else
                <div
                    class="py-20 text-center bg-white dark:bg-neutral-900 rounded-xl border border-neutral-100 dark:border-neutral-800">
                    <p class="text-neutral-500 dark:text-neutral-400">Belum ada agenda kegiatan saat ini.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
@endpush
