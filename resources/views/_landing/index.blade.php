@extends('_landing._layout.app')
@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<section id="beranda" class="relative min-h-screen flex items-center overflow-hidden">
    <div class="absolute inset-0" style="background: linear-gradient(135deg, #064e3b 0%, #065f46 40%, #0f766e 100%);"></div>
    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.15&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-40">
        <div class="max-w-3xl" data-aos="fade-up">
            <span class="inline-flex items-center gap-x-2 px-4 py-1.5 rounded-full backdrop-blur-sm text-sm font-medium mb-6" style="background: rgba(255,255,255,0.1); color: #a7f3d0;">
                <span class="size-2 rounded-full animate-pulse" style="background: #34d399;"></span>
                Organisasi Kerohanian Islam
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                Bersama Membangun <br>
                <span style="background: linear-gradient(to right, #6ee7b7, #99f6e4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Generasi Islami</span>
            </h1>
            <p class="text-lg leading-relaxed mb-8 max-w-2xl" style="color: rgba(209, 250, 229, 0.8);">
                @if($about)
                    {{ Str::limit(strip_tags($about->content), 180) }}
                @else
                    Wadah pengembangan karakter islami melalui berbagai program dakwah, pendidikan, dan kegiatan positif.
                @endif
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#tentang" class="inline-flex items-center gap-x-2 px-6 py-3 rounded-xl bg-white font-semibold text-sm transition-all duration-200 shadow-lg" style="color: #065f46;">
                    Tentang Kami
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                </a>
                <a href="#program" class="inline-flex items-center gap-x-2 px-6 py-3 rounded-xl backdrop-blur-sm text-white font-semibold text-sm border border-white/20 hover:bg-white/20 transition-all duration-200" style="background: rgba(255,255,255,0.1);">
                    Lihat Program
                </a>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-24" style="background: linear-gradient(to top, white, transparent);"></div>
</section>

{{-- Tentang Section --}}
<section id="tentang" class="py-20 lg:py-28 bg-white dark:bg-neutral-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-brand font-semibold text-sm uppercase tracking-wider">Tentang Kami</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mt-2">Mengenal Rohis Lebih Dekat</h2>
        </div>
        <div class="max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            @if($about)
                <div class="prose prose-lg dark:prose-invert max-w-none text-center text-gray-600 dark:text-neutral-400 leading-relaxed">
                    {!! $about->content !!}
                </div>
            @else
                <p class="text-center text-gray-500 dark:text-neutral-500">Belum ada informasi tentang rohis.</p>
            @endif
        </div>
    </div>
</section>

{{-- Program Section --}}
<section id="program" class="py-20 lg:py-28 bg-gray-50 dark:bg-neutral-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-brand font-semibold text-sm uppercase tracking-wider">Program</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mt-2">Program Unggulan</h2>
            <p class="text-gray-500 dark:text-neutral-400 mt-3 max-w-xl mx-auto">Berbagai program yang kami selenggarakan untuk pengembangan diri.</p>
        </div>
        @if($programs->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($programs as $i => $program)
                    <div class="group bg-white dark:bg-neutral-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-neutral-700" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        @if($program->image)
                            <div class="aspect-video overflow-hidden">
                                <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="aspect-video bg-gradient-to-br from-emerald-100 to-teal-50 dark:from-emerald-900/30 dark:to-teal-900/20 flex items-center justify-center">
                                <svg class="size-12 text-brand/30" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/></svg>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-brand transition-colors">{{ $program->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-2 line-clamp-2">{{ Str::limit(strip_tags($program->description), 100) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 dark:text-neutral-500">Belum ada program.</p>
        @endif
    </div>
</section>

{{-- Artikel Section --}}
<section id="artikel" class="py-20 lg:py-28 bg-white dark:bg-neutral-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-brand font-semibold text-sm uppercase tracking-wider">Artikel</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mt-2">Artikel Terbaru</h2>
        </div>
        @if($articles->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($articles as $i => $article)
                    <article class="group bg-white dark:bg-neutral-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-neutral-700" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <div class="aspect-video overflow-hidden">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-50 dark:from-emerald-900/30 dark:to-teal-900/20 flex items-center justify-center">
                                    <svg class="size-12 text-brand/30" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-x-2 mb-3">
                                @foreach($article->categories->take(2) as $cat)
                                    <span class="px-2.5 py-0.5 rounded-full bg-brand/10 text-brand text-xs font-medium">{{ $cat->name }}</span>
                                @endforeach
                            </div>
                            <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-brand transition-colors line-clamp-2">{{ $article->title }}</h3>
                            <div class="flex items-center gap-x-2 mt-3 text-xs text-gray-500 dark:text-neutral-500">
                                <span>{{ $article->user->name ?? 'Admin' }}</span>
                                <span>&middot;</span>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 dark:text-neutral-500">Belum ada artikel.</p>
        @endif
    </div>
</section>

{{-- Galeri Section --}}
<section id="galeri" class="py-20 lg:py-28 bg-gray-50 dark:bg-neutral-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-brand font-semibold text-sm uppercase tracking-wider">Galeri</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mt-2">Galeri Kegiatan</h2>
        </div>
        @if($galleries->count())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" data-aos="fade-up" data-aos-delay="100">
                @foreach($galleries as $i => $gallery)
                    <div class="group relative aspect-square rounded-2xl overflow-hidden cursor-pointer">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <p class="text-white text-sm font-medium truncate">{{ $gallery->title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 dark:text-neutral-500">Belum ada galeri.</p>
        @endif
    </div>
</section>

{{-- Pengumuman Section --}}
<section id="pengumuman" class="py-20 lg:py-28 bg-white dark:bg-neutral-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-brand font-semibold text-sm uppercase tracking-wider">Pengumuman</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mt-2">Pengumuman Terbaru</h2>
        </div>
        @if($announcements->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($announcements as $i => $announcement)
                    <div class="group bg-white dark:bg-neutral-800 rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-neutral-700" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <div class="flex items-center gap-x-3 mb-4">
                            <span class="flex items-center justify-center size-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-500">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46"/></svg>
                            </span>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-brand transition-colors line-clamp-1">{{ $announcement->title }}</h3>
                                <p class="text-xs text-gray-500 dark:text-neutral-500">{{ $announcement->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-neutral-400 line-clamp-3">{{ Str::limit(strip_tags($announcement->content), 120) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 dark:text-neutral-500">Belum ada pengumuman.</p>
        @endif
    </div>
</section>

{{-- Aktivitas Section --}}
<section id="aktivitas" class="py-20 lg:py-28 bg-gray-50 dark:bg-neutral-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-brand font-semibold text-sm uppercase tracking-wider">Aktivitas</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mt-2">Aktivitas Mendatang</h2>
        </div>
        @if($activities->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($activities as $i => $activity)
                    <div class="group bg-white dark:bg-neutral-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-neutral-700" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        @if($activity->poster)
                            <div class="aspect-video overflow-hidden">
                                <img src="{{ asset('storage/' . $activity->poster) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @endif
                        <div class="p-5">
                            <div class="flex items-center gap-x-2 mb-3">
                                @php $status = $activity->status; @endphp
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status === 'upcoming' ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400' : ($status === 'ongoing' ? 'bg-green-50 text-green-600 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-600 dark:bg-neutral-700 dark:text-neutral-400') }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </div>
                            <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-brand transition-colors line-clamp-2">{{ $activity->title }}</h3>
                            <div class="flex items-center gap-x-4 mt-3 text-xs text-gray-500 dark:text-neutral-500">
                                @if($activity->event_start)
                                    <span class="flex items-center gap-x-1">
                                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                                        {{ $activity->event_start->format('d M Y') }}
                                    </span>
                                @endif
                                @if($activity->location)
                                    <span class="flex items-center gap-x-1">
                                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                        {{ Str::limit($activity->location, 20) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 dark:text-neutral-500">Belum ada aktivitas mendatang.</p>
        @endif
    </div>
</section>

@endsection
