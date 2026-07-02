@extends('_landing._layout.app')
@section('title', 'Dokumentasi Galeri')

@section('content')
<div class="pt-28 pb-20 bg-neutral-50 dark:bg-neutral-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="mb-12">
            <span class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-wider block mb-2">Dokumentasi</span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">Kilas Lensa Kegiatan</h1>
        </div>

        @if($galleries->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($galleries as $gallery)
                    <div class="relative aspect-square sm:aspect-[4/3] rounded-xl overflow-hidden cursor-pointer group bg-neutral-100 dark:bg-neutral-800" onclick="openGalleryModal('{{ isset($gallery->image) ? (Str::startsWith($gallery->image, ['http://', 'https://']) ? $gallery->image : asset('storage/' . $gallery->image)) : '' }}', '{{ addslashes($gallery->title) }}')">
                        @if(isset($gallery->image) && $gallery->image)
                            @php
                                $imgUrl = Str::startsWith($gallery->image, ['http://', 'https://']) ? $gallery->image : asset('storage/' . $gallery->image);
                            @endphp
                            <img src="{{ $imgUrl }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                 onerror="this.src='{{ asset('img/fallbacks/gallery.svg') }}';this.onerror=null;">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            </div>
                        @else
                            <img src="{{ asset('img/fallbacks/gallery.svg') }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $galleries->links() }}
            </div>
        @else
            <div class="py-20 text-center bg-white dark:bg-neutral-900 rounded-xl border border-neutral-100 dark:border-neutral-800">
                <p class="text-neutral-500 dark:text-neutral-400">Belum ada foto galeri saat ini.</p>
            </div>
        @endif
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
