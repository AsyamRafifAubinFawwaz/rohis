@extends('_landing._layout.app')
@section('title', 'Beranda')

@push('styles')
    <style>
        :root {
            --rh-deep: #064e3b;
            --rh-primary: #065f46;
            --rh-teal: #0f766e;
            --rh-mint: #f0fdf4;
            --rh-ink: #1c1917;
            --rh-ink-soft: #44403c;
            --rh-line: rgba(6, 78, 59, 0.12);
        }

        .card-rise {
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-rise:hover {
            transform: translateY(-8px) rotate(0deg) !important;
            box-shadow: 0 30px 60px -20px rgba(6, 78, 59, 0.25);
        }

        @media (prefers-reduced-motion: reduce) {
            .card-rise {
                transition: none !important;
            }
        }
    </style>
@endpush

@section('content')

    <section id="beranda"
        class="relative min-h-[600px] lg:max-h-screen flex items-center overflow-hidden bg-white lg:bg-transparent pt-28 pb-0 lg:py-0">

        <div
            class="hidden lg:block absolute w-full h-[200%] rounded-[10%] rotate-12 left-[-45%] bottom-[20%] bg-emerald-800">
        </div>

        <div class="relative mx-auto px-6 sm:px-8 lg:px-8 w-full z-20 pb-0">

            <div class="flex flex-col lg:flex-row justify-between items-center max-w-screen gap-10 lg:gap-12">

                <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left"
                    data-aos="fade-up">
                    <h1
                        class="text-3xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-neutral-900 lg:text-white leading-tight lg:leading-none mb-5 lg:mb-6">
                        Bersama Membangun <br class="block sm:hidden" /><span
                            class="text-emerald-600 lg:text-emerald-300">Generasi Islami</span>
                    </h1>

                    <p
                        class="text-sm sm:text-base md:text-lg leading-relaxed mb-7 lg:mb-8 max-w-lg mx-auto lg:mx-0 text-neutral-600 lg:text-emerald-50">
                        @if ($about)
                            {{ Str::limit(strip_tags($about->content), 180) }}
                        @else
                            Wadah pengembangan karakter islami melalui berbagai program dakwah, pendidikan, dan kegiatan
                            positif.
                        @endif
                    </p>

                    <div class="flex flex-row justify-center lg:justify-start gap-4 w-full sm:w-auto">
                        <a href="#pengumuman"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 sm:px-10 py-3 sm:py-3.5 rounded-full bg-emerald-700 lg:bg-white font-bold text-sm sm:text-base text-white lg:text-emerald-800 transition-all duration-200 shadow-xl hover:scale-105">
                            Pengumuman
                        </a>
                        <a href="#aktivitas"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 sm:px-10 py-3 sm:py-3.5 rounded-full bg-transparent border-2 border-emerald-600 lg:border-white font-bold text-sm sm:text-base text-emerald-700 lg:text-white transition-all duration-200 shadow-sm hover:scale-105">
                            Kegiatan
                        </a>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 flex relative justify-center items-end self-end mt-8 lg:mt-40"
                    data-aos="fade-left">
                    <div
                        class="absolute w-72 h-72 sm:w-80 sm:h-80 md:w-[450px] md:h-[450px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none z-0">
                    </div>

                    <img class="relative z-10 h-auto w-full mx-auto block mb-0 max-w-[260px] sm:max-w-[340px] md:max-w-[440px] lg:max-w-none max-h-[280px] sm:max-h-[380px] md:max-h-[480px] lg:max-h-none object-contain"
                        src="{{ asset('images/hero.png') }}" alt="Karakter">
                </div>

            </div>
        </div>

        <div class="absolute w-full bottom-0 left-0 z-30 pointer-events-none style-gradasi">
            <style>
                .style-gradasi {
                    height: 120px;
                    background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.85) 50%, #ffffff 100%);
                }

                @media (min-width: 1024px) {
                    .style-gradasi {
                        height: 60px;
                        background: linear-gradient(to bottom, transparent 0%, rgba(255, 255, 255, 0.4) 50%, #ffffff 100%);
                    }
                }
            </style>
        </div>
    </section>

    <section id="tentang" class="relative py-24 md:py-24 bg-white dark:bg-neutral-950">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12 lg:gap-16">

                <div class="flex items-center justify-center gap-4 w-full max-w-md sm:max-w-xl mx-auto"
                    data-aos="fade-right">
                    <div
                        class="w-1/2 aspect-[3/5] sm:aspect-[3/4] lg:aspect-[3/5] rounded-[2rem] rounded-bl-none overflow-hidden shadow-md">
                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                            src="{{ asset('images/pengurus.jpeg') }}" alt="Pengurus Rohis">
                    </div>

                    <div class="w-1/2 flex flex-col gap-4">
                        <div
                            class="w-full aspect-square sm:aspect-[4/3] lg:aspect-square rounded-[2rem] rounded-tr-[4rem] overflow-hidden shadow-md">
                            <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                src="{{ asset('images/belajar.png') }}" alt="Kajian Mentoring Rohis">
                        </div>

                        <div
                            class="w-full aspect-square sm:aspect-[4/3] lg:aspect-square rounded-[2rem] rounded-br-[4rem] overflow-hidden shadow-md">
                            <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                src="{{ asset('images/IMG_2011.JPG') }}" alt="Aksi Sosial Rohis">
                        </div>
                    </div>
                </div>

                <div class="w-full text-center lg:text-left" data-aos="fade-up">
                    <span
                        class="text-xs font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 px-3 py-1 rounded-full">
                        Tentang Kami
                    </span>

                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mt-4 mb-6 leading-tight">
                        Mengenal Lebih Dekat <br class="hidden sm:inline" />
                        <span class="text-emerald-600 dark:text-emerald-400">Ekstrakurikuler Rohis</span>
                    </h2>

                    <p class="text-[12px] text-gray-600 dark:text-neutral-400 leading-relaxed mb-6">
                        @if ($about)
                            {{ strip_tags($about->content) }}
                        @else
                            Rohis (Kerohanian Islam) merupakan wadah bagi siswa-siswi untuk memperdalam nilai-nilai agama
                            Islam, membangun akhlak karimah, dan mempererat ukhuwah islamiyah di lingkungan sekolah.
                        @endif
                    </p>

                    <!-- <div class="flex justify-center lg:justify-start">
                        <a href="#selengkapnya" class="inline-flex items-center justify-center px-8 py-3.5 rounded-full bg-emerald-600 hover:bg-emerald-700 font-bold text-sm text-white transition-all duration-200 shadow-md shadow-emerald-600/10 hover:scale-105">
                            Baca Selengkapnya
                        </a>
                    </div> -->
                </div>

            </div>
        </div>
    </section>
    {{-- 
<section id="visi-misi" class="py-24 bg-neutral-50 dark:bg-neutral-900">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" data-aos="fade-up">
            <!-- Visi -->
            <div class="bg-emerald-50 dark:bg-emerald-900/20 p-10 sm:p-12 rounded-[2rem] flex flex-col items-center text-center shadow-sm border border-emerald-100 dark:border-emerald-800/30">
                <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-800/50 rounded-full flex items-center justify-center mb-6 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </div>
                <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-4">Visi</h3>
                <div class="text-neutral-600 dark:text-neutral-300 leading-relaxed font-medium">
                    {!! $vision ? $vision->content : '"Terwujudnya generasi muda yang berakhlak mulia, cerdas, dan tangguh."' !!}
                </div>
            </div>

            <!-- Misi -->
            <div class="bg-emerald-50 dark:bg-emerald-900/20 p-10 sm:p-12 rounded-[2rem] flex flex-col items-center text-center shadow-sm border border-emerald-100 dark:border-emerald-800/30">
                <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-800/50 rounded-full flex items-center justify-center mb-6 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-4">Misi</h3>
                <div class="text-neutral-600 dark:text-neutral-300 leading-relaxed prose dark:prose-invert">
                    {!! $mission ? $mission->content : '<ul class="text-left list-disc pl-5"><li>Meningkatkan kualitas ibadah dan akhlak.</li><li>Menyelenggarakan kajian keislaman rutin.</li></ul>' !!}
                </div>
            </div>
        </div>
    </div>
</section> --}}

    <section id="program" class="py-24 bg-white dark:bg-neutral-950 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 lg:mb-20" data-aos="fade-up">
                <div>
                    <span
                        class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-widest block mb-2">Rencana
                        Strategis</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">
                        Program & Kegiatan Unggulan</h2>
                </div>
                <a href="{{ route('landing.programs.index') }}"
                    class="mt-4 md:mt-0 inline-flex items-center gap-2 font-bold text-sm text-emerald-700 hover:text-emerald-950 dark:text-emerald-400 border-b-2 border-emerald-600/30 pb-1 transition-all group">
                    Selengkapnya
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>

            <div class="divide-y divide-neutral-100 dark:divide-neutral-800">
                @forelse($programs as $i => $program)
                    <div class="group grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-10 items-center py-10 lg:py-12"
                        data-aos="fade-up" data-aos-delay="{{ $i * 60 }}">
                        <div class="md:col-span-1 hidden md:flex items-start justify-start">
                            <span
                                class="text-5xl lg:text-6xl font-black text-emerald-900/[0.08] dark:text-emerald-300/[0.08] leading-none tracking-tighter group-hover:text-emerald-700/[0.18] transition-colors duration-300 select-none">
                                {{ sprintf('%02d', $i + 1) }}
                            </span>
                        </div>

                        @if ($i % 2 === 0)
                            <div class="md:col-span-5 order-1">
                                <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-neutral-50 dark:bg-neutral-900 relative border border-neutral-100 dark:border-neutral-800">
                                    @if (isset($program->image) && $program->image)
                                        <img src="{{ asset('storage/' . $program->image) }}"
                                            alt="{{ $program->title ?? $program->name }}"
                                            class="w-full h-full object-contain p-6 group-hover:scale-[1.04] transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-emerald-800">
                                            <svg class="w-12 h-12 stroke-[1.25] text-emerald-300/40" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="md:col-span-6 order-2">
                                <span
                                    class="md:hidden text-xs font-extrabold text-emerald-700 dark:text-emerald-400 uppercase tracking-widest block mb-2">Pilar
                                    {{ sprintf('%02d', $i + 1) }}</span>
                                <h3
                                    class="font-black text-neutral-900 dark:text-white text-2xl lg:text-[1.75rem] tracking-tight leading-snug mb-3 group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
                                    {{ $program->title ?? $program->name }}
                                </h3>
                                <p class="text-sm lg:text-base text-neutral-500 dark:text-neutral-400 leading-relaxed mb-5">
                                    {{ Str::limit(strip_tags($program->description), 150) }}
                                </p>
                                <a href="{{ route('landing.programs.detail', $program->id) }}"
                                    class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-wide">
                                    Selengkapnya
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="md:col-span-6 order-2 md:order-1">
                                <span
                                    class="md:hidden text-xs font-extrabold text-emerald-700 dark:text-emerald-400 uppercase tracking-widest block mb-2">Pilar
                                    {{ sprintf('%02d', $i + 1) }}</span>
                                <h3
                                    class="font-black text-neutral-900 dark:text-white text-2xl lg:text-[1.75rem] tracking-tight leading-snug mb-3 group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
                                    {{ $program->title ?? $program->name }}
                                </h3>
                                <p
                                    class="text-sm lg:text-base text-neutral-500 dark:text-neutral-400 leading-relaxed mb-5">
                                    {{ Str::limit(strip_tags($program->description), 150) }}
                                </p>
                                <a href="{{ route('landing.programs.detail', $program->id) }}"
                                    class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-wide">
                                    Selengkapnya
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                            <div class="md:col-span-5 order-1 md:order-2">
                                <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-neutral-50 dark:bg-neutral-900 relative border border-neutral-100 dark:border-neutral-800">
                                    @if (isset($program->image) && $program->image)
                                        <img src="{{ asset('storage/' . $program->image) }}"
                                            alt="{{ $program->title ?? $program->name }}"
                                            class="w-full h-full object-contain p-6 group-hover:scale-[1.04] transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-emerald-800">
                                            <svg class="w-12 h-12 stroke-[1.25] text-emerald-300/40" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="py-12 text-center">
                        <p class="text-neutral-500 dark:text-neutral-400">Belum ada data program saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="artikel" class="py-24 bg-neutral-50 dark:bg-neutral-950 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center mb-14" data-aos="fade-up">
                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight mb-2">
                    Artikel <span class="text-emerald-600">Terbaru</span>
                </h2>
                <div class="w-24 h-1 bg-emerald-600 mx-auto mb-6"></div>
                <p class="text-neutral-500 dark:text-neutral-400 text-sm sm:text-base">Ikuti berita dan informasi terkini
                    seputar kegiatan dan prestasi organisasi</p>
            </div>

            @if ($articles->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach ($articles->take(3) as $article)
                        <div class="bg-white dark:bg-neutral-900 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-neutral-100 dark:border-neutral-800 flex flex-col h-full"
                            data-aos="fade-up">

                            <a href="{{ route('landing.articles.detail', $article->slug) }}"
                                class="block relative aspect-[4/3] bg-neutral-100 dark:bg-neutral-800 overflow-hidden group">
                                @if ($article->thumbnail)
                                    @php
                                        $imgUrl = Str::startsWith($article->thumbnail, ['http://', 'https://'])
                                            ? $article->thumbnail
                                            : asset('storage/' . $article->thumbnail);
                                    @endphp
                                    <img src="{{ $imgUrl }}" alt="{{ $article->title }}"
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
                                    @forelse($article->categories as $category)
                                        <span
                                            class="inline-block bg-emerald-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">
                                            {{ $category->name }}
                                        </span>
                                    @empty
                                        <span
                                            class="inline-block bg-emerald-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">
                                            News
                                        </span>
                                    @endforelse
                                </div>

                                <a href="{{ route('landing.articles.detail', $article->slug) }}" class="block group">
                                    <h3
                                        class="font-bold text-neutral-900 dark:text-white text-lg leading-snug line-clamp-2 mb-2 group-hover:text-emerald-600 transition-colors">
                                        {{ $article->title }}
                                    </h3>
                                </a>

                                <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2 mb-4 flex-1">
                                    {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                                </p>

                                <div
                                    class="flex items-center gap-4 mt-auto text-xs text-neutral-500 dark:text-neutral-400">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('landing.articles.index') }}"
                        class="inline-flex items-center justify-center px-8 py-3.5 rounded-full border border-emerald-600 text-emerald-600 dark:text-emerald-400 font-bold text-sm tracking-wide hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                        Lihat Semua Artikel
                    </a>
                </div>
            @else
                <div
                    class="py-12 text-center bg-white dark:bg-neutral-900 rounded-xl border border-neutral-100 dark:border-neutral-800">
                    <p class="text-neutral-500 dark:text-neutral-400">Belum ada artikel saat ini.</p>
                </div>
            @endif
        </div>
    </section>

    <section id="pengumuman" class="py-24 bg-white dark:bg-neutral-950 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20" data-aos="fade-up">
                <div>
                    <span
                        class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-wider block mb-2">Papan
                        Informasi</span>
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">
                        Pengumuman Resmi</h2>
                </div>
                <a href="{{ route('landing.announcements.index') }}"
                    class="mt-4 md:mt-0 text-sm font-bold tracking-wider text-emerald-700 hover:text-emerald-900 dark:text-emerald-400 flex items-center gap-2 group border-b-2 border-emerald-600/20 pb-1">
                    Buka Papan Pengumuman
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="bg-neutral-50 dark:bg-neutral-900 rounded-[2rem] p-6 sm:p-10 border border-neutral-100 dark:border-neutral-800 shadow-sm max-w-5xl mx-auto"
                data-aos="fade-up">
                <div class="flex items-center gap-4 mb-8 border-b border-neutral-200 dark:border-neutral-800 pb-6">
                    <div
                        class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/40 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-neutral-900 dark:text-white">Papan Pengumuman</h3>
                </div>

                <div class="space-y-4">
                    @forelse($announcements as $i => $announcement)
                        @php
                            $isImportant =
                                stripos($announcement->title, 'PPDB') !== false ||
                                stripos($announcement->title, 'Ujian') !== false ||
                                stripos($announcement->title, 'Penting') !== false;
                            $badgeText = $isImportant ? 'Penting' : 'Info';
                            $badgeClass = $isImportant
                                ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'
                                : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400';
                        @endphp
                        <div class="bg-white dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 sm:p-6 hover:border-emerald-300 hover:shadow-md transition-all cursor-pointer block"
                            onclick="openAnnouncementModal({{ $announcement->id }})">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between sm:hidden mb-2">
                                        <span
                                            class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full {{ $badgeClass }}">{{ $badgeText }}</span>
                                    </div>
                                    <h4 class="text-lg font-bold text-neutral-900 dark:text-white mb-2 leading-snug">
                                        {{ $announcement->title }}</h4>
                                    <p
                                        class="text-neutral-500 dark:text-neutral-400 text-sm leading-relaxed mb-4 line-clamp-2">
                                        {{ Str::limit(strip_tags($announcement->content), 150) }}
                                    </p>
                                    <div class="flex items-center text-xs font-semibold text-neutral-400">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($announcement->created_at)->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                                <div class="hidden sm:block flex-shrink-0">
                                    <span
                                        class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full {{ $badgeClass }}">{{ $badgeText }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-neutral-500">Belum ada pengumuman.</div>
                    @endforelse
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('landing.announcements.index') }}"
                        class="inline-flex items-center justify-center px-8 py-3 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm transition-colors shadow-sm">
                        Lihat Semua Pengumuman
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="aktivitas" class="py-24 bg-neutral-50 dark:bg-neutral-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20" data-aos="fade-up">
                <div>
                    <span
                        class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-wider block mb-2">Kalender
                        Aksi</span>
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">
                        Agenda Terdekat</h2>
                </div>
                <a href="{{ route('landing.activities.index') }}"
                    class="mt-4 md:mt-0 inline-flex items-center gap-2 font-bold text-sm text-emerald-700 hover:text-emerald-950 dark:text-emerald-400 border-b-2 border-emerald-600/20 pb-1 transition-all group">
                    Buka Kalender Kegiatan
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php $tiltDate = ['-rotate-3', 'rotate-3', '-rotate-2']; @endphp
                @forelse($activities as $i => $activity)
                    <div class="group relative pt-6 pr-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                        <div
                            class="relative bg-white dark:bg-neutral-800 rounded-3xl overflow-hidden border border-emerald-100/30 dark:border-neutral-800 transition-all duration-300 hover:shadow-[0_30px_60px_-15px_rgba(6,78,59,0.18)] hover:-translate-y-1.5 h-full">
                            @if (isset($activity->poster) && $activity->poster)
                                <div class="aspect-[4/3] overflow-hidden bg-neutral-200">
                                    <img src="{{ asset('storage/' . $activity->poster) }}" alt="{{ $activity->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500">
                                </div>
                            @else
                                <div class="aspect-[4/3] overflow-hidden relative bg-emerald-800">
                                    <svg class="absolute right-4 bottom-0 w-28 h-28 opacity-15" viewBox="0 0 200 200"
                                        fill="none">
                                        <path d="M20,200 L20,90 Q20,10 100,10 Q180,10 180,90 L180,200" stroke="white"
                                            stroke-width="8" />
                                    </svg>
                                </div>
                            @endif
                            <div class="p-8 pt-5 space-y-4">
                                <div>
                                    @php
                                        $eventStart = \Carbon\Carbon::parse($activity->event_start);
                                        $eventEnd = $activity->event_end
                                            ? \Carbon\Carbon::parse($activity->event_end)
                                            : null;
                                        $now = now();
                                        if ($eventStart->isFuture()) {
                                            $status = 'upcoming';
                                        } elseif ($eventEnd && $eventEnd->isPast()) {
                                            $status = 'completed';
                                        } else {
                                            $status = 'ongoing';
                                        }
                                    @endphp
                                    <span
                                        class="inline-flex text-xs font-extrabold tracking-widest uppercase px-3 py-1 rounded-full {{ $status === 'upcoming' ? 'bg-teal-50 text-teal-700 dark:bg-teal-950/40 dark:text-teal-400' : ($status === 'ongoing' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400' : 'bg-neutral-200 text-neutral-600') }}">
                                        • {{ $status }}
                                    </span>
                                </div>
                                <a href="{{ route('landing.activities.detail', $activity->id) }}"
                                    class="cursor-pointer group block">
                                    <h3
                                        class="font-black text-neutral-900 dark:text-white group-hover:text-emerald-700 transition-colors text-lg tracking-tight line-clamp-2 leading-snug">
                                        {{ $activity->title }}
                                    </h3>
                                </a>
                                @if (!empty($activity->location))
                                    <div
                                        class="flex items-center gap-x-2.5 pt-4 text-xs text-neutral-500 dark:text-neutral-400 font-bold border-t border-neutral-100 dark:border-neutral-700">
                                        <svg class="w-4 h-4 text-emerald-700 stroke-[2.5] flex-shrink-0" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span class="truncate">{{ $activity->location }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if (!empty($activity->event_start))
                            <div class="absolute -top-1 right-0 z-20 w-16 sm:w-[4.5rem] aspect-square rounded-xl shadow-[0_12px_25px_-6px_rgba(6,78,59,0.45)] border-3 border-white dark:border-neutral-950 flex flex-col items-center justify-center {{ $tiltDate[$i % 3] }} group-hover:rotate-0 group-hover:scale-110 transition-transform duration-400 ease-out bg-emerald-700"
                                style="border-width: 3px;">
                                <span
                                    class="text-white text-xl sm:text-2xl font-black leading-none">{{ $eventStart->format('d') }}</span>
                                <span
                                    class="text-emerald-200 text-[9px] font-extrabold uppercase tracking-wide leading-none mt-0.5">{{ $eventStart->translatedFormat('M') }}</span>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-3 py-12 text-center">
                        <p class="text-neutral-500 dark:text-neutral-400">Belum ada agenda terdekat saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="galeri" class="py-24 bg-white dark:bg-neutral-950 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center max-w-2xl mx-auto mb-20" data-aos="fade-up">
                <span
                    class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-widest block mb-2">Dokumentasi</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">
                    Kilas Lensa Kegiatan</h2>
            </div>

            @if ($galleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up">
                    @foreach ($galleries->take(4) as $gal)
                        @if ($gal->image)
                            <div class="relative aspect-square rounded-2xl overflow-hidden cursor-pointer group shadow-sm border border-neutral-200 dark:border-neutral-800"
                                onclick="openGalleryModal('{{ asset('storage/' . $gal->image) }}', '{{ addslashes($gal->title) }}')">
                                <img src="{{ asset('storage/' . $gal->image) }}" alt="{{ $gal->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div
                                    class="absolute inset-0 bg-neutral-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('landing.galleries.index') }}"
                        class="inline-flex items-center justify-center px-8 py-3.5 rounded-full border-2 border-emerald-800 text-emerald-800 dark:text-emerald-400 font-bold text-sm tracking-wide hover:bg-emerald-800 hover:text-white transition-all shadow-md">
                        Lihat Album Selengkapnya
                    </a>
                </div>
            @else
                <div class="py-12 text-center">
                    <p class="text-neutral-500 dark:text-neutral-400">Belum ada foto galeri saat ini.</p>
                </div>
            @endif
        </div>
    </section>

@endsection

@push('scripts')
    <!-- Modals Container -->
    <div>
        <!-- Announcement Modals -->
        @foreach ($announcements as $announcement)
            <div id="modal-announcement-{{ $announcement->id }}"
                class="fixed inset-0 z-[100] hidden bg-neutral-900/80 backdrop-blur-sm flex items-center justify-center p-4 opacity-0 transition-opacity duration-300"
                onclick="closeAnnouncementModal({{ $announcement->id }})">
                <div class="bg-white dark:bg-neutral-900 w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl transform scale-95 transition-transform duration-300 relative"
                    onclick="event.stopPropagation()">
                    <div
                        class="sticky top-0 bg-white/90 dark:bg-neutral-900/90 backdrop-blur-md z-10 p-6 sm:p-8 border-b border-neutral-100 dark:border-neutral-800 flex justify-between items-start">
                        <h3 class="text-xl sm:text-2xl font-bold text-neutral-900 dark:text-white leading-snug pr-8">
                            {{ $announcement->title }}</h3>
                        <button onclick="closeAnnouncementModal({{ $announcement->id }})"
                            class="absolute top-6 sm:top-8 right-6 sm:right-8 text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 sm:p-8">
                        <div class="flex items-center text-sm font-semibold text-neutral-500 mb-6">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($announcement->created_at)->translatedFormat('d F Y') }}
                        </div>
                        <div
                            class="prose dark:prose-invert max-w-none text-neutral-600 dark:text-neutral-300 text-sm sm:text-base leading-relaxed overflow-hidden">
                            {!! $announcement->content !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Gallery Lightbox Modal -->
        <div id="galleryModal"
            class="fixed inset-0 z-[110] hidden bg-neutral-950/90 backdrop-blur-sm flex items-center justify-center p-4 opacity-0 transition-opacity duration-300"
            onclick="closeGalleryModal()">
            <button class="absolute top-6 right-6 text-white/70 hover:text-white z-10" onclick="closeGalleryModal()">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="max-w-5xl w-full flex flex-col items-center justify-center transform scale-95 transition-transform duration-300"
                onclick="event.stopPropagation()">
                <img id="modalImage" src="" alt=""
                    class="max-h-[80vh] w-auto max-w-full rounded-xl shadow-2xl mb-6">
                <h3 id="modalTitle" class="text-white text-xl md:text-2xl font-bold text-center"></h3>
            </div>
        </div>
    </div>

    <script>
        function openAnnouncementModal(id) {
            const modal = document.getElementById('modal-announcement-' + id);
            if (!modal) return;
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.children[0].classList.remove('scale-95');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeAnnouncementModal(id) {
            const modal = document.getElementById('modal-announcement-' + id);
            if (!modal) return;
            modal.classList.add('opacity-0');
            modal.children[0].classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        }

        function openGalleryModal(src, title) {
            if (!src) return;
            const modal = document.getElementById('galleryModal');
            const modalImg = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');

            modalImg.src = src;
            modalTitle.textContent = title;

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.children[1].classList.remove('scale-95');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeGalleryModal() {
            const modal = document.getElementById('galleryModal');
            modal.classList.add('opacity-0');
            modal.children[1].classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.getElementById('modalImage').src = '';
            }, 300);
            document.body.style.overflow = '';
        }
    </script>
@endpush
