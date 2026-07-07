@extends('_landing._layout.app')
@section('title', 'Papan Pengumuman')

@section('content')
<div class="pt-28 pb-20 bg-neutral-50 dark:bg-neutral-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="mb-12">
            <span class="text-emerald-700 dark:text-emerald-400 font-extrabold text-xs uppercase tracking-wider block mb-2">Papan Informasi</span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-neutral-900 dark:text-white tracking-tight">Pengumuman Resmi</h1>
        </div>

        @if($announcements->count() > 0)
            <div class="bg-white dark:bg-neutral-900 rounded-[2rem] p-6 sm:p-10 border border-neutral-100 dark:border-neutral-800 shadow-sm max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-8 border-b border-neutral-200 dark:border-neutral-800 pb-6">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/40 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-neutral-900 dark:text-white">Daftar Pengumuman</h3>
                </div>

                <div class="space-y-4">
                    @foreach($announcements as $announcement)
                        @php 
                            $isImportant = stripos($announcement->title, 'PPDB') !== false || stripos($announcement->title, 'Ujian') !== false || stripos($announcement->title, 'Penting') !== false;
                            $badgeText = $isImportant ? 'Penting' : 'Info';
                            $badgeClass = $isImportant ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400';
                        @endphp
                        <div class="bg-neutral-50 dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 sm:p-6 hover:border-emerald-300 hover:shadow-md transition-all cursor-pointer" onclick="openAnnouncementModal({{ $announcement->id }})">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between sm:hidden mb-2">
                                        <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full {{ $badgeClass }}">{{ $badgeText }}</span>
                                    </div>
                                    <h4 class="text-lg font-bold text-neutral-900 dark:text-white mb-2 leading-snug">{{ $announcement->title }}</h4>
                                    <p class="text-neutral-500 dark:text-neutral-400 text-sm leading-relaxed mb-4 line-clamp-2">
                                        {{ Str::limit(strip_tags($announcement->content), 150) }}
                                    </p>
                                    <div class="flex items-center text-xs font-semibold text-neutral-400">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        {{ \Carbon\Carbon::parse($announcement->created_at)->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                                <div class="hidden sm:block flex-shrink-0">
                                    <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full {{ $badgeClass }}">{{ $badgeText }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-center">
                    {{ $announcements->links() }}
                </div>
            </div>
        @else
            <div class="py-20 text-center bg-white dark:bg-neutral-900 rounded-xl border border-neutral-100 dark:border-neutral-800">
                <p class="text-neutral-500 dark:text-neutral-400">Belum ada pengumuman resmi saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<!-- Modals Container -->
<div>
    <!-- Announcement Modals -->
    @foreach($announcements as $announcement)
        <div id="modal-announcement-{{ $announcement->id }}" class="fixed inset-0 z-[100] hidden bg-neutral-900/80 backdrop-blur-sm flex items-center justify-center p-4 opacity-0 transition-opacity duration-300" onclick="closeAnnouncementModal({{ $announcement->id }})">
            <div class="bg-white dark:bg-neutral-900 w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl transform scale-95 transition-transform duration-300 relative" onclick="event.stopPropagation()">
                <div class="sticky top-0 bg-white/90 dark:bg-neutral-900/90 backdrop-blur-md z-10 p-6 sm:p-8 border-b border-neutral-100 dark:border-neutral-800 flex justify-between items-start">
                    <h3 class="text-xl sm:text-2xl font-bold text-neutral-900 dark:text-white leading-snug pr-8">{{ $announcement->title }}</h3>
                    <button onclick="closeAnnouncementModal({{ $announcement->id }})" class="absolute top-6 sm:top-8 right-6 sm:right-8 text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="flex items-center text-sm font-semibold text-neutral-500 mb-6">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        {{ \Carbon\Carbon::parse($announcement->created_at)->translatedFormat('d F Y') }}
                    </div>
                    @if($announcement->image)
                        <div class="mb-6 group overflow-hidden rounded-xl shadow-sm cursor-pointer" onclick="openGalleryModal('{{ asset('storage/' . $announcement->image) }}', '{{ addslashes($announcement->title) }}')">
                            <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-auto object-cover max-h-96 transition-transform duration-500 group-hover:scale-105">
                        </div>
                    @endif
                    <div class="prose dark:prose-invert max-w-none text-neutral-600 dark:text-neutral-300 text-sm sm:text-base leading-relaxed overflow-hidden">
                        {!! $announcement->content !!}
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-neutral-100 dark:border-neutral-800 flex justify-end">
                        @include('partials.share-buttons', ['title' => $announcement->title, 'url' => route('landing.announcements.detail', $announcement->slug ?? $announcement->id)])
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Gallery Lightbox Modal -->
<div id="galleryModal" class="fixed inset-0 z-[110] hidden bg-neutral-950/90 backdrop-blur-sm flex items-center justify-center p-4 opacity-0 transition-opacity duration-300" onclick="closeGalleryModal()">
    <button class="absolute top-6 right-6 text-white/70 hover:text-white z-[120]" onclick="closeGalleryModal()">
        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <div class="max-w-5xl w-full flex flex-col items-center justify-center transform scale-95 transition-transform duration-300" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="" class="max-h-[80vh] w-auto max-w-full rounded-xl shadow-2xl mb-6">
        <h3 id="modalTitle" class="text-white text-xl md:text-2xl font-bold text-center"></h3>
    </div>
</div>

<script>
// Announcement Modal Scripts
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
}

function closeGalleryModal() {
    const modal = document.getElementById('galleryModal');
    modal.classList.add('opacity-0');
    modal.children[1].classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
        document.getElementById('modalImage').src = '';
    }, 300);
}
</script>
@endpush
