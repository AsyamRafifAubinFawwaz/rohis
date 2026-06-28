@extends('_landing._layout.app')
@section('title', $program->title ?? $program->name)

@section('content')
<div class="pt-28 pb-20 bg-white dark:bg-neutral-950 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center" data-aos="fade-up">
            <span class="inline-block text-[11px] font-extrabold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 uppercase tracking-widest px-3 py-1 rounded-sm mb-4">
                Program & Kegiatan
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-neutral-900 dark:text-white tracking-tight leading-tight mb-6">
                {{ $program->title ?? $program->name }}
            </h1>
        </div>

        <div class="bg-white dark:bg-neutral-900 rounded-3xl p-6 sm:p-10 border border-neutral-100 dark:border-neutral-800 shadow-sm" data-aos="fade-up" data-aos-delay="100">
            <div class="prose prose-lg prose-emerald dark:prose-invert max-w-none prose-img:rounded-2xl clear-both">
                @if(isset($program->image) && $program->image)
                    <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->title ?? $program->name }}" class="float-left w-full sm:w-1/2 md:w-1/3 lg:w-[30%] aspect-square object-cover mr-6 sm:mr-8 mb-4 mt-2 rounded-2xl shadow-md border border-neutral-100 dark:border-neutral-800">
                @endif
                {!! $program->description !!}
            </div>
            <!-- Clearfix for float -->
            <div class="clear-both"></div>
        </div>

        <div class="mt-16 pt-8 border-t border-neutral-100 dark:border-neutral-800 text-center">
            <a href="{{ route('landing.programs.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 hover:text-emerald-900 dark:text-emerald-400 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar Program
            </a>
        </div>
    </div>
</div>
@endsection
