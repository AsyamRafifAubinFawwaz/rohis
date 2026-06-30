@extends('_landing._layout.app')
@section('title', 'Program & Kegiatan')

@section('content')
<div class="pt-28 pb-20 bg-neutral-50 dark:bg-neutral-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="mb-12">
            <span class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-wider block mb-2">Rencana Strategis</span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">Program & Kegiatan Unggulan</h1>
        </div>

        @if($programs->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($programs as $program)
                    <div class="bg-white dark:bg-neutral-900 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-neutral-100 dark:border-neutral-800 flex flex-col h-full group">
                        
                        <a href="{{ route('landing.programs.detail', $program->id) }}" class="block relative aspect-[4/3] bg-neutral-50 dark:bg-neutral-900 border-b border-neutral-100 dark:border-neutral-800 overflow-hidden">
                            @if(isset($program->image) && $program->image)
                                @php
                                    $imgUrl = Str::startsWith($program->image, ['http://', 'https://']) ? $program->image : asset('storage/' . $program->image);
                                @endphp
                                <img src="{{ $imgUrl }}" alt="{{ $program->title ?? $program->name }}" class="w-full h-full object-contain p-6 transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-neutral-400 dark:text-neutral-600 bg-neutral-100 dark:bg-neutral-800/50">
                                    <svg class="w-12 h-12 mb-2 stroke-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </a>

                        <div class="p-6 flex flex-col flex-1 relative">
                            <!-- Badges -->
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-block bg-emerald-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">
                                    Program
                                </span>
                            </div>

                            <a href="{{ route('landing.programs.detail', $program->id) }}" class="block group">
                                <h3 class="font-bold text-neutral-900 dark:text-white text-lg leading-snug line-clamp-2 mb-2 group-hover:text-emerald-600 transition-colors">
                                    {{ $program->title ?? $program->name }}
                                </h3>
                            </a>
                            
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2 mb-4 flex-1">
                                {{ Str::limit(strip_tags($program->description), 100) }}
                            </p>
                            
                            <div class="flex items-center gap-4 mt-auto text-xs text-neutral-500 dark:text-neutral-400">
                                <div class="flex items-center gap-1.5">
                                    <span class="font-semibold text-emerald-600 dark:text-emerald-400">Divisi Rohis</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $programs->links() }}
            </div>
        @else
            <div class="py-20 text-center bg-white dark:bg-neutral-900 rounded-xl border border-neutral-100 dark:border-neutral-800">
                <p class="text-neutral-500 dark:text-neutral-400">Belum ada program saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
