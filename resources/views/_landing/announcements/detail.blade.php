@extends('_landing._layout.app')
@section('title', $announcement->title)

@section('meta_description', Str::limit(strip_tags($announcement->content), 150))

@section('meta')
    <meta property="og:title" content="{{ $announcement->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($announcement->content), 150) }}">
    @if($announcement->image)
        <meta property="og:image" content="{{ asset('storage/' . $announcement->image) }}">
    @else
        <meta property="og:image" content="{{ asset('favicon/logo-rohis.webp') }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
@endsection
@section('content')
<div class="pt-28 pb-20 bg-white dark:bg-neutral-950 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center" data-aos="fade-up">
            <span class="inline-block text-[11px] font-extrabold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 uppercase tracking-widest px-3 py-1 rounded-sm mb-4">
                Pengumuman Resmi
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-neutral-900 dark:text-white tracking-tight leading-tight mb-6">
                {{ $announcement->title }}
            </h1>
            
            <div class="flex items-center justify-center gap-4 text-sm text-neutral-500 dark:text-neutral-400">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>{{ $announcement->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <div class="prose prose-lg prose-emerald dark:prose-invert max-w-none prose-img:rounded-2xl bg-neutral-50 dark:bg-neutral-900 p-8 sm:p-12 rounded-3xl border border-neutral-100 dark:border-neutral-800" data-aos="fade-up" data-aos-delay="100">
            @if($announcement->image)
                <div class="mb-8 group overflow-hidden rounded-2xl shadow-md cursor-pointer" onclick="openGalleryModal('{{ asset('storage/' . $announcement->image) }}', '{{ addslashes($announcement->title) }}')">
                    <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-auto object-cover max-h-[500px] transition-transform duration-500 group-hover:scale-105">
                </div>
            @endif
            {!! $announcement->content !!}
        </div>

        <div class="mt-16 pt-8 border-t border-neutral-100 dark:border-neutral-800 flex flex-col sm:flex-row items-center justify-between gap-6">
            <a href="{{ route('landing.announcements.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 hover:text-emerald-900 dark:text-emerald-400 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Papan Pengumuman
            </a>

            @include('partials.share-buttons', ['title' => $announcement->title])
        </div>
    </div>
</div>

<!-- Gallery Lightbox Modal -->
<div id="galleryModal" class="fixed inset-0 z-[110] hidden bg-neutral-950/90 backdrop-blur-sm flex items-center justify-center p-4 opacity-0 transition-opacity duration-300" onclick="closeGalleryModal()">
    <button class="absolute top-6 right-6 text-white/70 hover:text-white z-10" onclick="closeGalleryModal()">
        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <div class="max-w-5xl w-full flex flex-col items-center justify-center transform scale-95 transition-transform duration-300" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="" class="max-h-[80vh] w-auto max-w-full rounded-xl shadow-2xl mb-6">
        <h3 id="modalTitle" class="text-white text-xl md:text-2xl font-bold text-center"></h3>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Gallery Lightbox Scripts
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
