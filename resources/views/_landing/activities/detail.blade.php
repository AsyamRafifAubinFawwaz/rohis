@extends('_landing._layout.app')
@section('title', $activity->title)

@section('content')
<div class="pt-24 sm:pt-28 pb-20 bg-neutral-50 dark:bg-neutral-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            
            <!-- Main Content Area -->
            <div class="w-full lg:w-8/12 bg-white dark:bg-neutral-900 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 p-6 sm:p-8" data-aos="fade-up">
                
                <div class="mb-8">
                    <span class="inline-block text-[11px] font-extrabold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 uppercase tracking-widest px-3 py-1 rounded-sm mb-4">
                        Agenda Kegiatan
                    </span>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white leading-snug mb-6">
                        {{ $activity->title }}
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                        @if($activity->event_start)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>
                                    {{ \Carbon\Carbon::parse($activity->event_start)->format('d M Y') }}
                                    @if($activity->event_end)
                                        - {{ \Carbon\Carbon::parse($activity->event_end)->format('d M Y') }}
                                    @endif
                                </span>
                            </div>
                        @endif
                        
                        @if($activity->location)
                            <span class="w-1 h-1 rounded-full bg-neutral-300 dark:bg-neutral-600 hidden sm:block"></span>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ $activity->location }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                @if(isset($activity->poster) && $activity->poster)
                    <div class="w-full aspect-[16/9] mb-8 bg-neutral-100 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $activity->poster) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="prose prose-base sm:prose-lg prose-emerald dark:prose-invert max-w-none prose-img:rounded-xl">
                    {!! $activity->description !!}
                </div>

                <!-- Like Section -->
                <div class="mt-12 pt-6 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
                    <div class="flex items-center gap-4 sm:gap-6">
                        @include('partials.share-buttons', ['title' => $activity->title])
                    </div>

                    <button class="flex flex-col items-center gap-1 text-neutral-400 hover:text-red-500 transition-colors group">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 fill-neutral-200 group-hover:fill-red-100 stroke-currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                        <span class="text-xs font-bold">{{ rand(10, 500) }}</span>
                    </button>
                </div>
            </div>

            <div class="w-full lg:w-4/12 space-y-6 sm:space-y-8" data-aos="fade-up" data-aos-delay="100">
                @if($activity->galleries && $activity->galleries->count() > 0)
                    <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 p-6">
                        <div class="flex items-center gap-2 mb-6">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Dokumentasi Kegiatan</h3>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($activity->galleries as $gallery)
                                @if($gallery->image)
                                    @php
                                        $galImg = Str::startsWith($gallery->image, ['http://', 'https://']) ? $gallery->image : asset('storage/' . $gallery->image);
                                    @endphp
                                    <div class="relative aspect-square rounded-lg overflow-hidden cursor-pointer group bg-neutral-100 dark:bg-neutral-800" onclick="openGalleryModal('{{ $galImg }}', '{{ addslashes($gallery->title) }}')">
                                        <img src="{{ $galImg }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 p-6 text-center">
                        <p class="text-sm text-neutral-500">Belum ada dokumentasi untuk kegiatan ini.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<!-- Gallery Lightbox Modal -->
<div id="galleryModal" class="fixed inset-0 z-[120] hidden bg-neutral-950/90 backdrop-blur-sm flex items-center justify-center p-4 opacity-0 transition-opacity duration-300" onclick="closeGalleryModal()">
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
