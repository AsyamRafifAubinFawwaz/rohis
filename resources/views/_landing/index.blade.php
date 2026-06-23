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
        .card-rise { transition: none !important; }
    }
</style>
@endpush

@section('content')

<section id="beranda" class="relative min-h-[600px] lg:max-h-screen flex items-center overflow-hidden bg-white lg:bg-transparent pt-28 pb-0 lg:py-0">
    
    <div class="hidden lg:block absolute w-full h-[200%] rounded-full left-[-45%] bottom-[-5%]" style="background: linear-gradient(135deg, #064e3b 0%, #065f46 60%, #0f766e 100%);">
    </div>

    <div class="relative mx-auto px-6 sm:px-8 lg:px-8 w-full z-20 pb-0">
    
        <div class="flex flex-col lg:flex-row justify-between items-center max-w-screen gap-10 lg:gap-12">
    
            <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left" data-aos="fade-up">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-neutral-900 lg:text-white leading-tight lg:leading-none mb-5 lg:mb-6">
                    Bersama Membangun <br class="block sm:hidden" /><span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent lg:from-[#6ee7b7] lg:to-[#99f6e4] lg:-webkit-text-fill-color-transparent">Generasi Islami</span>
                </h1>

                <p class="text-sm sm:text-base md:text-lg leading-relaxed mb-7 lg:mb-8 max-w-2xl mx-auto lg:mx-0 text-neutral-600 lg:text-[rgba(209,250,229,0.8)]">
                    @if($about)
                        {{ Str::limit(strip_tags($about->content), 180) }}
                    @else
                        Wadah pengembangan karakter islami melalui berbagai program dakwah, pendidikan, dan kegiatan positif.
                    @endif
                </p>

                <div class="flex flex-row justify-center lg:justify-start gap-4 w-full sm:w-auto">
                    <a href="#tentang" class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 sm:px-10 py-3 sm:py-3.5 rounded-full bg-emerald-700 lg:bg-white font-bold text-sm sm:text-base text-white lg:text-[#065f46] transition-all duration-200 shadow-xl hover:scale-105">
                        Pengumuman
                    </a>
                    <a href="#tentang" class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 sm:px-10 py-3 sm:py-3.5 rounded-full bg-transparent border-2 border-emerald-600 lg:border-white font-bold text-sm sm:text-base text-emerald-700 lg:text-white transition-all duration-200 shadow-sm hover:scale-105">
                        Aktivitas
                    </a>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex relative justify-center items-end self-end mt-8 lg:mt-40" data-aos="fade-left">
                
                <div class="absolute w-72 h-72 sm:w-80 sm:h-80 md:w-[450px] md:h-[450px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-emerald-500/30 to-teal-400/15 blur-3xl pointer-events-none z-0"></div>
                
                <img class="relative z-10 h-auto w-full mx-auto block mb-0 max-w-[260px] sm:max-w-[340px] md:max-w-[440px] lg:max-w-none max-h-[280px] sm:max-h-[380px] md:max-h-[480px] lg:max-h-none object-contain" 
                    src="images/hero.png" 
                    alt="Karakter">
            </div>

        </div>
    </div>

    <div class="absolute w-full bottom-0 left-0 z-30 pointer-events-none style-gradasi">
        <style>
            .style-gradasi {
                height: 120px;
                background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,0.85) 50%, #ffffff 100%);
            }
            @media (min-width: 1024px) {
                .style-gradasi {
                    height: 60px;
                    background: linear-gradient(to bottom, transparent 0%, rgba(255,255,255,0.4) 50%, #ffffff 100%);
                }
            }
        </style>
    </div>
</section>

<section id="tentang" class="relative py-24 md:py-24 bg-white dark:bg-neutral-950">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <!-- Layout Grid: 1 Kolom di HP/Tab, 2 Kolom di Laptop (lg:) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12 lg:gap-16">
            
            <!-- SISI KIRI: Kombinasi Grid Gambar ala Nugas Cafe -->
            <div class="flex items-center justify-center gap-4 w-full max-w-md sm:max-w-xl mx-auto" data-aos="fade-right">
                
                <!-- 1. Gambar Utama Kiri (Vertikal Panjang dengan Sudut Membulat Asimetris) -->
                <div class="w-1/2 aspect-[3/5] sm:aspect-[3/4] lg:aspect-[3/5] rounded-[2rem] rounded-bl-none overflow-hidden shadow-md">
                    <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" 
                         src="images/pengurus.jpg" 
                         alt="Pengurus Rohis">
                </div>
                
                <!-- Sisi Kanan: 2 Gambar Bertumpuk Vertikal -->
                <div class="w-1/2 flex flex-col gap-4">
                    <!-- 2. Gambar Kanan Atas (Membulat di Sudut Kanan Atas) -->
                    <div class="w-full aspect-square sm:aspect-[4/3] lg:aspect-square rounded-[2rem] rounded-tr-[4rem] overflow-hidden shadow-md">
                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" 
                             src="images/belajar.jpg" 
                             alt="Kajian Mentoring Rohis">
                    </div>
                    
                    <!-- 3. Gambar Kanan Bawah (Membulat di Sudut Kanan Bawah) -->
                    <div class="w-full aspect-square sm:aspect-[4/3] lg:aspect-square rounded-[2rem] rounded-br-[4rem] overflow-hidden shadow-md">
                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" 
                             src="images/berbagi.jpg" 
                             alt="Aksi Sosial Rohis">
                    </div>
                </div>

            </div>

            <!-- SISI KANAN: Konten Deskripsi About -->
            <div class="w-full text-center lg:text-left" data-aos="fade-up">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 px-3 py-1 rounded-full">
                    Tentang Kami
                </span>
                
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mt-4 mb-6 leading-tight">
                    Mengenal Lebih Dekat <br class="hidden sm:inline" />
                    <span class="text-emerald-600 dark:text-emerald-400">Ekstrakurikuler Rohis</span>
                </h2>

                <p class="text-base text-gray-600 dark:text-neutral-400 leading-relaxed mb-6">
                    Rohis (Kerohanian Islam) merupakan wadah bagi siswa-siswi untuk memperdalam nilai-nilai agama Islam, membangun akhlak karimah, dan mempererat ukhuwah islamiyah di lingkungan sekolah. 
                </p>
                
                <p class="text-base text-gray-600 dark:text-neutral-400 leading-relaxed mb-8">
                    Melalui berbagai program inovatif mulai dari kajian interaktif, mentoring karakter, hingga aksi sosial kemanusiaan, kami berkomitmen untuk mencetak generasi muda yang tidak hanya unggul dalam akademik tetapi juga kokoh secara spiritual.
                </p>

                <div class="flex justify-center lg:justify-start">
                    <a href="#selengkapnya" class="inline-flex items-center justify-center px-8 py-3.5 rounded-full bg-emerald-600 hover:bg-emerald-700 font-bold text-sm text-white transition-all duration-200 shadow-md shadow-emerald-600/10 hover:scale-105">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


<section id="program" class="py-24 bg-white dark:bg-neutral-950 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 lg:mb-20" data-aos="fade-up">
            <div>
                <span class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-widest block mb-2">Rencana Strategis</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">Program & Kegiatan Unggulan</h2>
            </div>
            <p class="hidden md:block max-w-xs text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed mt-4 md:mt-0">
                Empat pilar utama yang membentuk arah pembinaan dan kontribusi kami untuk pelajar dan masyarakat sekitar.
            </p>
        </div>

        @php
            $progList = ($programs && $programs->count()) ? $programs : collect([
                (object)['name' => 'Kajian Intensif Pemuda', 'description' => 'Pembahasan kontekstual menarik seputar problematika hijrah, fiqh kontemporer, dan tantangan perkembangan zaman bagi generasi muda yang terus bergerak maju.', 'image' => null],
                (object)['name' => 'Tahsin & Tahfidz Quran', 'description' => 'Bimbingan tartil berjenjang, program perbaikan bacaan kilat, serta akselerasi hafalan Qur\'an dengan metode talaqqi yang akurat dan terukur.', 'image' => null],
                (object)['name' => 'Aksi Sosial Berbagi', 'description' => 'Gerakan penyaluran logistik dasar, renovasi minor fasilitas umum sarana ibadah, dan program pendampingan ekonomi produktif bagi warga sekitar.', 'image' => null],
            ]);
        @endphp

        <div class="divide-y divide-neutral-100 dark:divide-neutral-800">
            @foreach($progList->take(4) as $i => $program)
                <div class="group grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-10 items-center py-10 lg:py-12" data-aos="fade-up" data-aos-delay="{{ $i * 60 }}">

                    <div class="md:col-span-1 hidden md:flex items-start justify-start">
                        <span class="text-5xl lg:text-6xl font-black text-emerald-900/[0.08] dark:text-emerald-300/[0.08] leading-none tracking-tighter group-hover:text-emerald-700/[0.18] transition-colors duration-300 select-none">
                            {{ sprintf('%02d', $i + 1) }}
                        </span>
                    </div>

                    @if($i % 2 === 0)
                        <div class="md:col-span-5 order-1">
                            <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-emerald-900 relative">
                                @if(isset($program->image) && $program->image)
                                    <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->name }}" class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-800 to-teal-700">
                                        <svg class="w-12 h-12 stroke-[1.25] text-emerald-300/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="md:col-span-6 order-2">
                            <span class="md:hidden text-xs font-extrabold text-emerald-700 dark:text-emerald-400 uppercase tracking-widest block mb-2">Pilar {{ sprintf('%02d', $i + 1) }}</span>
                            <h3 class="font-black text-neutral-900 dark:text-white text-2xl lg:text-[1.75rem] tracking-tight leading-snug mb-3 group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
                                {{ $program->name }}
                            </h3>
                            <p class="text-sm lg:text-base text-neutral-500 dark:text-neutral-400 leading-relaxed mb-5">
                                {{ Str::limit(strip_tags($program->description), 150) }}
                            </p>
                            <span class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-wide">
                                Selengkapnya
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    @else
                        <div class="md:col-span-6 order-2 md:order-1">
                            <span class="md:hidden text-xs font-extrabold text-emerald-700 dark:text-emerald-400 uppercase tracking-widest block mb-2">Pilar {{ sprintf('%02d', $i + 1) }}</span>
                            <h3 class="font-black text-neutral-900 dark:text-white text-2xl lg:text-[1.75rem] tracking-tight leading-snug mb-3 group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
                                {{ $program->name }}
                            </h3>
                            <p class="text-sm lg:text-base text-neutral-500 dark:text-neutral-400 leading-relaxed mb-5">
                                {{ Str::limit(strip_tags($program->description), 150) }}
                            </p>
                            <span class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-wide">
                                Selengkapnya
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                        <div class="md:col-span-5 order-1 md:order-2">
                            <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-emerald-900 relative">
                                @if(isset($program->image) && $program->image)
                                    <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->name }}" class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-teal-700 to-emerald-800">
                                        <svg class="w-12 h-12 stroke-[1.25] text-emerald-300/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</section>


<section id="artikel" class="py-24 bg-white dark:bg-neutral-950 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14" data-aos="fade-up">
            <div>
                <span class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-wider block mb-2">Media Edukasi</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">Kanal Artikel & Wawasan</h2>
            </div>
            <a href="" class="mt-4 md:mt-0 inline-flex items-center gap-2 font-bold text-sm text-emerald-700 hover:text-emerald-950 dark:text-emerald-400 border-b-2 border-emerald-600/30 pb-1 transition-all group">
                Selengkapnya di Blog
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/></svg>
            </a>
        </div>

        @php
            $artList = ($articles && $articles->count()) ? $articles->take(5) : collect([
                (object)['title' => 'Menjaga Ruang Istiqomah di Pusaran Padatnya Rutinitas Duniawi', 'category' => 'Esai Islami', 'excerpt' => 'Langkah praktis menata hati dan manajemen waktu agar kualitas spiritual tetap terjaga prima di tengah kesibukan harian.', 'thumbnail' => null, 'author' => 'Redaksi', 'date' => null, 'slug' => null],
                (object)['title' => 'Keutamaan Membaca & Mentadabburi Al-Quran di Pagi Hari', 'category' => 'Edukasi Quran', 'excerpt' => null, 'thumbnail' => null, 'author' => 'Redaksi', 'date' => null, 'slug' => null],
                (object)['title' => 'Sinergi Pemuda Menghadapi Disrupsi Digital Terkini', 'category' => 'Opini Publik', 'excerpt' => null, 'thumbnail' => null, 'author' => 'Ust. Pembina', 'date' => null, 'slug' => null],
                (object)['title' => 'Membangun Ukhuwah di Tengah Kesibukan Akademik Pelajar', 'category' => 'Komunitas', 'excerpt' => null, 'thumbnail' => null, 'author' => 'Redaksi', 'date' => null, 'slug' => null],
                (object)['title' => 'Adab Menuntut Ilmu yang Sering Dilupakan Generasi Muda', 'category' => 'Esai Islami', 'excerpt' => null, 'thumbnail' => null, 'author' => 'Redaksi', 'date' => null, 'slug' => null],
            ]);
            $mainArticle = $artList->first();
            $sideArticles = $artList->slice(1, 4);
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12">

            <div class="lg:col-span-8" data-aos="fade-up">
                <a href="{{ isset($mainArticle->slug) && $mainArticle->slug ? route('landing.artikel.detail', $mainArticle->slug) : '#' }}" class="group block">
                    <div class="relative aspect-[16/9] rounded-2xl overflow-hidden bg-emerald-900">
                        @if(isset($mainArticle->thumbnail) && $mainArticle->thumbnail)
                            <img src="{{ asset('storage/' . $mainArticle->thumbnail) }}" alt="{{ $mainArticle->title }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-emerald-800 to-teal-700"></div>
                        @endif
                       
                        <div class="absolute inset-0 bg-gradient-to-t from-neutral-950/90 via-neutral-950/30 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 sm:p-8">
                            <span class="inline-block text-[11px] font-extrabold text-white uppercase tracking-widest bg-emerald-600 px-3 py-1 rounded-sm mb-3">
                                @if(isset($mainArticle->categories))
                                    @foreach($mainArticle->categories->take(1) as $cat){{ $cat->name }}@endforeach
                                @else
                                    {{ $mainArticle->category }}
                                @endif
                            </span>
                            <h3 class="text-white font-black text-2xl sm:text-3xl leading-tight tracking-tight max-w-2xl">
                                {{ $mainArticle->title }}
                            </h3>
                        </div>
                    </div>
                </a>
                <div class="flex items-center justify-between mt-5 pb-6 border-b border-neutral-100 dark:border-neutral-800">
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed max-w-xl">
                        {{ $mainArticle->excerpt ?? 'Pembahasan ringkas yang relevan untuk menemani keseharian dan menjaga semangat belajar bersama dalam komunitas.' }}
                    </p>
                    <div class="hidden sm:flex items-center gap-3 flex-shrink-0 ml-6">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-emerald-800 to-teal-600 text-white flex items-center justify-center font-bold text-xs uppercase">
                            {{ substr(isset($mainArticle->user) ? ($mainArticle->user->name ?? 'R') : $mainArticle->author, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs font-bold text-neutral-800 dark:text-neutral-300 leading-none mb-1">{{ isset($mainArticle->user) ? ($mainArticle->user->name ?? 'Redaksi') : $mainArticle->author }}</p>
                            <p class="text-[10px] text-neutral-400">{{ isset($mainArticle->created_at) ? $mainArticle->created_at->format('d M Y') : date('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    @foreach($sideArticles->take(2) as $i => $article)
                        <a href="{{ isset($article->slug) && $article->slug ? route('landing.artikel.detail', $article->slug) : '#' }}" class="group flex items-start gap-4" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden flex-shrink-0 bg-emerald-900">
                                @if(isset($article->thumbnail) && $article->thumbnail)
                                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-800 to-teal-700"></div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <span class="text-[10px] font-extrabold text-emerald-700 dark:text-emerald-400 uppercase tracking-widest block mb-1.5">
                                    @if(isset($article->categories))
                                        @foreach($article->categories->take(1) as $cat){{ $cat->name }}@endforeach
                                    @else
                                        {{ $article->category }}
                                    @endif
                                </span>
                                <h4 class="font-bold text-neutral-900 dark:text-neutral-100 text-sm leading-snug line-clamp-2 group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
                                    {{ $article->title }}
                                </h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center gap-2 mb-1">
                    <span class="font-black text-sm uppercase tracking-widest text-neutral-900 dark:text-white">Terpopuler</span>
                </div>
                <div class="w-8 h-1 bg-emerald-600 rounded-full mb-5"></div>

                <div class="divide-y divide-neutral-100 dark:divide-neutral-800">
                    @foreach($sideArticles->skip(2)->take(3) as $i => $article)
                        <a href="{{ isset($article->slug) && $article->slug ? route('landing.artikel.detail', $article->slug) : '#' }}" class="group flex items-start gap-4 py-5">
                            <span class="text-3xl font-black text-emerald-900/15 dark:text-emerald-300/15 leading-none flex-shrink-0 w-9 group-hover:text-emerald-700/40 transition-colors">
                                {{ sprintf('%02d', $i + 1) }}
                            </span>
                            <div class="min-w-0">
                                <h4 class="font-bold text-neutral-900 dark:text-neutral-100 text-sm leading-snug line-clamp-2 group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors mb-1.5">
                                    {{ $article->title }}
                                </h4>
                                <span class="text-[11px] font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-wide">
                                    @if(isset($article->categories))
                                        @foreach($article->categories->take(1) as $cat){{ $cat->name }}@endforeach
                                    @else
                                        {{ $article->category }}
                                    @endif
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<section id="galeri" class="py-24 bg-gradient-to-b from-neutral-50 via-emerald-50/20 to-neutral-50 dark:from-neutral-950 dark:to-neutral-950 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="text-center max-w-2xl mx-auto mb-20" data-aos="fade-up">
            <span class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-widest block mb-2">Dokumentasi</span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">Kilas Lensa Kegiatan</h2>
        </div>

        @php
            $galList = ($galleries && $galleries->count()) ? $galleries->take(5) : collect(range(1,5))->map(fn($i) => (object)['title' => 'Kompilasi Dokumentasi Kegiatan Lapangan Umat', 'image' => null]);
            $galGrad = ['#065f46,#0f766e', '#064e3b,#065f46', '#0f766e,#064e3b', '#065f46,#0f766e', '#064e3b,#0f766e'];
        @endphp

        <div class="relative h-[340px] sm:h-[440px] md:h-[480px] max-w-5xl mx-auto" data-aos="fade-up">

            <div class="absolute left-0 top-4 sm:top-8 w-[34%] sm:w-[28%] aspect-[3/4] rounded-2xl overflow-hidden shadow-lg border-4 border-white dark:border-neutral-950 -rotate-3 z-10 group hover:z-30 hover:scale-105 hover:rotate-0 transition-all duration-400">
                @if(isset($galList[1]) && $galList[1]->image)
                    <img src="{{ asset('storage/' . $galList[1]->image) }}" alt="" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full" style="background: linear-gradient(160deg, {{ $galGrad[1] }});"></div>
                @endif
            </div>

            <div class="absolute right-0 top-2 sm:top-6 w-[34%] sm:w-[28%] aspect-[3/4] rounded-2xl overflow-hidden shadow-lg border-4 border-white dark:border-neutral-950 rotate-3 z-10 group hover:z-30 hover:scale-105 hover:rotate-0 transition-all duration-400">
                @if(isset($galList[2]) && $galList[2]->image)
                    <img src="{{ asset('storage/' . $galList[2]->image) }}" alt="" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full" style="background: linear-gradient(160deg, {{ $galGrad[2] }});"></div>
                @endif
            </div>

            <div class="absolute left-[6%] sm:left-[10%] bottom-0 w-[26%] sm:w-[20%] aspect-square rounded-2xl overflow-hidden shadow-lg border-4 border-white dark:border-neutral-950 rotate-2 z-20 group hover:z-30 hover:scale-105 hover:rotate-0 transition-all duration-400 hidden sm:block">
                @if(isset($galList[3]) && $galList[3]->image)
                    <img src="{{ asset('storage/' . $galList[3]->image) }}" alt="" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full" style="background: linear-gradient(160deg, {{ $galGrad[3] }});"></div>
                @endif
            </div>

            <div class="absolute right-[6%] sm:right-[10%] bottom-0 w-[26%] sm:w-[20%] aspect-square rounded-2xl overflow-hidden shadow-lg border-4 border-white dark:border-neutral-950 -rotate-2 z-20 group hover:z-30 hover:scale-105 hover:rotate-0 transition-all duration-400 hidden sm:block">
                @if(isset($galList[4]) && $galList[4]->image)
                    <img src="{{ asset('storage/' . $galList[4]->image) }}" alt="" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full" style="background: linear-gradient(160deg, {{ $galGrad[4] }});"></div>
                @endif
            </div>

            <a href="" class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[58%] sm:w-[42%] aspect-[4/5] rounded-[1.75rem] overflow-hidden shadow-[0_30px_60px_-15px_rgba(6,78,59,0.45)] border-[6px] border-white dark:border-neutral-950 z-40 group block hover:scale-[1.03] transition-transform duration-400">
                @if(isset($galList[0]) && $galList[0]->image)
                    <img src="{{ asset('storage/' . $galList[0]->image) }}" alt="{{ $galList[0]->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full" style="background: linear-gradient(160deg, {{ $galGrad[0] }});"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/85 via-emerald-950/10 to-transparent flex items-end p-5">
                    <p class="text-white text-sm font-bold leading-snug">{{ $galList[0]->title }}</p>
                </div>
            </a>
        </div>

        <div class="text-center mt-16">
            <a href="" class="inline-flex items-center justify-center px-8 py-3.5 rounded-full border-2 border-emerald-800 text-emerald-800 dark:text-emerald-400 font-bold text-sm tracking-wide hover:bg-emerald-800 hover:text-white transition-all shadow-md">
                Lihat Album Selengkapnya
            </a>
        </div>
    </div>
</section>


<section id="pengumuman" class="py-24 bg-white dark:bg-neutral-950 relative overflow-hidden">
    <div class="absolute top-1/2 right-0 w-80 h-80 bg-teal-500/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-20" data-aos="fade-up">
            <div>
                <span class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-wider block mb-2">Papan Informasi</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">Pengumuman Resmi</h2>
            </div>
            <a href="" class="mt-4 md:mt-0 text-sm font-bold tracking-wider text-emerald-700 hover:text-emerald-900 dark:text-emerald-400 flex items-center gap-2 group border-b-2 border-emerald-600/20 pb-1">
                Buka Papan Pengumuman
                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @php
            $annList = ($announcements && $announcements->count()) ? $announcements->take(3) : collect([
                (object)['title' => 'Pendaftaran Penerimaan Kader Pembinaan Remaja Masjid', 'content' => 'Peluang bergabung bersama ratusan pemuda aktif untuk kelas materi eksklusif dan upgrading softskill mingguan.', 'created_at' => null, 'id' => null],
                (object)['title' => 'Pelaksanaan Agenda Bakti Sosial Massal & Penataan Masjid', 'content' => 'Undangan aksi kolaborasi bersih lingkungan fasilitas ibadah bersama tokoh masyarakat setempat.', 'created_at' => null, 'id' => null],
                (object)['title' => 'Penyesuaian Jadwal Majelis Ta\'lim Pekanan Ba\'da Isya', 'content' => 'Informasi pergeseran jam pelaksanaan dikarenakan adanya sinkronisasi agenda tablig akbar wilayah hulu.', 'created_at' => null, 'id' => null],
            ]);
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($annList as $i => $announcement)
                <div class="group relative" data-aos="fade-up" data-aos-delay="{{ $i * 75 }}">

                    <span class="absolute -top-7 -right-3 text-[6.5rem] font-black leading-none text-emerald-800/[0.06] dark:text-emerald-400/[0.07] select-none z-0 group-hover:text-emerald-700/[0.1] transition-colors duration-300">
                        {{ sprintf('%02d', $i + 1) }}
                    </span>

                    <div class="relative z-10 bg-neutral-50 dark:bg-neutral-900 rounded-3xl p-8 border border-neutral-100 dark:border-neutral-800 flex flex-col justify-between shadow-sm hover:shadow-[0_20px_40px_-15px_rgba(6,78,59,0.12)] hover:-translate-y-1.5 transition-all duration-300 h-full overflow-hidden">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-xs font-bold text-neutral-400">
                                <span class="tracking-wider text-emerald-700 uppercase">Warta Utama</span>
                                <span>{{ $announcement->created_at ? $announcement->created_at->format('d M Y') : date('d M Y') }}</span>
                            </div>
                            <a href="{{ isset($announcement->id) && $announcement->id ? route('landing.pengumuman.detail', $announcement->id) : '#' }}" class="block group">
                                <h3 class="font-extrabold text-neutral-900 dark:text-white group-hover:text-emerald-700 transition-colors text-lg tracking-tight line-clamp-2 leading-snug">
                                    {{ $announcement->title }}
                                </h3>
                            </a>
                            <p class="text-sm text-neutral-500 dark:text-neutral-400 line-clamp-3 font-medium leading-relaxed">
                                {{ Str::limit(strip_tags($announcement->content), 120) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<section id="aktivitas" class="py-24 bg-gradient-to-b from-white to-teal-50/40 dark:from-neutral-950 dark:to-neutral-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-20" data-aos="fade-up">
            <div>
                <span class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-wider block mb-2">Kalender Aksi</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">Agenda Terdekat</h2>
            </div>
            <a href="" class="mt-4 md:mt-0 inline-flex items-center gap-2 font-bold text-sm text-emerald-700 hover:text-emerald-950 dark:text-emerald-400 border-b-2 border-emerald-600/20 pb-1 transition-all group">
                Buka Kalender Kegiatan
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/></svg>
            </a>
        </div>

        @php
            $actList = ($activities && $activities->count()) ? $activities->take(3) : collect([
                (object)['title' => 'Tabligh Akbar Menyambut Awal Tahun Hijriah', 'location' => 'Aula Utama Kompleks Pusat', 'event_start' => now()->addDays(3), 'status' => 'upcoming', 'poster' => null, 'id' => null],
                (object)['title' => 'Gema Ramadhan: Festival Adzan & Tartil Pemuda', 'location' => 'Serambi Masjid Jami Raya', 'event_start' => now()->addDays(9), 'status' => 'upcoming', 'poster' => null, 'id' => null],
                (object)['title' => 'Bazar UMKM Kreatif & Pembagian Sembako Murah', 'location' => 'Area Lapangan Terbuka Hijau', 'event_start' => now()->addDays(13), 'status' => 'ongoing', 'poster' => null, 'id' => null],
            ]);
            $tiltDate = ['-rotate-3', 'rotate-3', '-rotate-2'];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($actList as $i => $activity)
                <div class="group relative pt-6 pr-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                    <div class="relative bg-white dark:bg-neutral-800 rounded-3xl overflow-hidden border border-emerald-100/30 dark:border-neutral-800 transition-all duration-300 hover:shadow-[0_30px_60px_-15px_rgba(6,78,59,0.18)] hover:-translate-y-1.5 h-full">
                        @if(isset($activity->poster) && $activity->poster)
                            <div class="aspect-[16/10] overflow-hidden bg-neutral-200">
                                <img src="{{ asset('storage/' . $activity->poster) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover transition-transform duration-500">
                            </div>
                        @else
                            <div class="aspect-[16/10] overflow-hidden relative" style="background: linear-gradient(135deg, #064e3b, #0f766e);">
                                <svg class="absolute right-4 bottom-0 w-28 h-28 opacity-15" viewBox="0 0 200 200" fill="none"><path d="M20,200 L20,90 Q20,10 100,10 Q180,10 180,90 L180,200" stroke="white" stroke-width="8"/></svg>
                            </div>
                        @endif
                        <div class="p-8 pt-5 space-y-4">
                            <div>
                                @php $status = $activity->status; @endphp
                                <span class="inline-flex text-xs font-extrabold tracking-widest uppercase px-3 py-1 rounded-full {{ $status === 'upcoming' ? 'bg-teal-50 text-teal-700 dark:bg-teal-950/40 dark:text-teal-400' : ($status === 'ongoing' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400' : 'bg-neutral-200 text-neutral-600') }}">
                                    • {{ $status }}
                                </span>
                            </div>
                            <a href="{{ isset($activity->id) && $activity->id ? route('landing.aktivitas.detail', $activity->id) : '#' }}" class="block">
                                <h3 class="font-black text-neutral-900 dark:text-white group-hover:text-emerald-700 transition-colors text-lg tracking-tight line-clamp-2 leading-snug">
                                    {{ $activity->title }}
                                </h3>
                            </a>
                            @if(!empty($activity->location))
                                <div class="flex items-center gap-x-2.5 pt-4 text-xs text-neutral-500 dark:text-neutral-400 font-bold border-t border-neutral-100 dark:border-neutral-700">
                                    <svg class="w-4 h-4 text-emerald-700 stroke-[2.5] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z"/></svg>
                                    <span class="truncate">{{ $activity->location }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(!empty($activity->event_start))
                        <div class="absolute -top-1 right-0 z-20 w-16 sm:w-[4.5rem] aspect-square rounded-xl shadow-[0_12px_25px_-6px_rgba(6,78,59,0.45)] border-3 border-white dark:border-neutral-950 flex flex-col items-center justify-center {{ $tiltDate[$i % 3] }} group-hover:rotate-0 group-hover:scale-110 transition-transform duration-400 ease-out" style="background: linear-gradient(160deg, #064e3b, #0f766e); border-width: 3px;">
                            <span class="text-white text-xl sm:text-2xl font-black leading-none">{{ $activity->event_start->format('d') }}</span>
                            <span class="text-emerald-200 text-[9px] font-extrabold uppercase tracking-wide leading-none mt-0.5">{{ $activity->event_start->translatedFormat('M') }}</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
