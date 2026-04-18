@extends('_superadmin._layout.app')

@section('title', 'Detail Pengumuman')

@section('content')
    <div class="grid grid-cols-1 gap-6">
        <!-- Header & Back Button -->
        <div class="bg-white dark:bg-neutral-800 shadow-sm border border-gray-200 dark:border-neutral-700 rounded-2xl p-4 flex items-center justify-between">
            <div class="flex items-center gap-x-3">
                <a navigate href="{{ route('superadmin.announcements.index') }}"
                    class="size-10 inline-flex justify-center items-center rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 transition-all">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                </a>
                <div>
                    <h2 class="text-lg font-bold text-gray-800 dark:text-neutral-200 leading-tight">Detail Pengumuman</h2>
                    <p class="text-xs text-gray-500 dark:text-neutral-500 mt-0.5">Lihat informasi lengkap pengumuman</p>
                </div>
            </div>
            
            <div class="flex gap-2">
                @if (!$announcement->trashed())
                    <a navigate href="{{ route('superadmin.announcements.update', $announcement->id) }}" 
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-blue-200 bg-blue-50 text-blue-600 hover:bg-blue-100 transition-all">
                        @include('_admin._layout.icons.pencil')
                        Edit
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-neutral-800 shadow-sm border border-gray-200 dark:border-neutral-700 rounded-3xl overflow-hidden min-h-[500px]">
                    <!-- Image Banner -->
                    <div class="relative w-full aspect-video bg-gray-100 dark:bg-neutral-900 border-b border-gray-100 dark:border-neutral-700">
                        @if ($announcement->image)
                            <img src="{{ asset('storage/' . $announcement->image) }}" alt="Banner" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 dark:text-neutral-700">
                                <svg class="size-20 opacity-20 mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                <span class="text-sm font-medium">Bukan gambar pengumuman</span>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-6 right-6">
                            @php
                                $isExpired = \Carbon\Carbon::parse($announcement->expires_at)->isPast();
                            @endphp
                            <div class="rounded-full {{ $isExpired ? 'bg-rose-600' : 'bg-emerald-600' }} py-1.5 px-4 text-[10px] font-bold text-white uppercase tracking-widest shadow-xl border border-white/20">
                                {{ $isExpired ? 'Berakhir' : 'Aktif' }}
                            </div>
                        </div>
                    </div>

                    <!-- Article Body -->
                    <div class="p-8 sm:p-10">
                        <div class="flex items-center gap-x-2 mb-4">
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-lg text-xs font-bold bg-brand/10 text-brand">
                                PENGUMUMAN
                            </span>
                            <span class="text-gray-300 dark:text-neutral-600">•</span>
                            <span class="text-sm text-gray-500 dark:text-neutral-500">
                                Diterbitkan pada {{ $announcement->created_at->format('d M, Y') }}
                            </span>
                        </div>

                        <h1 class="text-3xl sm:text-4xl font-black text-gray-800 dark:text-neutral-200 mb-8 leading-tight">
                            {{ $announcement->title }}
                        </h1>

                        <div class="prose prose-sm xl:prose-base dark:prose-invert max-w-none text-gray-600 dark:text-neutral-400">
                            {!! $announcement->content !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <!-- Meta Card -->
                <div class="bg-white dark:bg-neutral-800 shadow-sm border border-gray-200 dark:border-neutral-700 rounded-3xl p-6">
                    <h3 class="text-sm font-bold text-gray-800 dark:text-neutral-200 uppercase tracking-widest mb-6 border-l-4 border-brand pl-3">Informasi</h3>
                    
                    <div class="space-y-6">
                        <!-- Creator -->
                        <div class="flex items-start gap-x-4">
                            <div class="size-10 rounded-2xl bg-brand/10 text-brand flex items-center justify-center text-sm font-bold uppercase shrink-0">
                                {{ substr($announcement->creator->name ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <span class="block text-xs text-gray-400 dark:text-neutral-500 font-bold uppercase tracking-tighter">Dibuat Oleh</span>
                                <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">{{ $announcement->creator->name ?? 'Admin Rohis' }}</span>
                            </div>
                        </div>

                        <!-- Visibility -->
                        <div class="flex items-start gap-x-4">
                            <div class="size-10 rounded-2xl bg-amber-50 dark:bg-amber-900/20 text-amber-600 flex items-center justify-center shrink-0">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                            </div>
                            <div>
                                <span class="block text-xs text-gray-400 dark:text-neutral-500 font-bold uppercase tracking-tighter">Berlaku Hingga</span>
                                <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                    {{ \Carbon\Carbon::parse($announcement->expires_at)->format('d F Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Data Status -->
                        <div class="flex items-start gap-x-4">
                            <div class="size-10 rounded-2xl bg-gray-50 dark:bg-neutral-700 text-gray-600 dark:text-neutral-300 flex items-center justify-center shrink-0">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            </div>
                            <div>
                                <span class="block text-xs text-gray-400 dark:text-neutral-500 font-bold uppercase tracking-tighter">Status Data</span>
                                <span class="text-sm font-bold {{ $announcement->trashed() ? 'text-rose-600' : 'text-emerald-600' }}">
                                    {{ $announcement->trashed() ? 'Terhapus (Sampah)' : 'Aktif / Publik' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if ($announcement->trashed())
                        <div class="mt-8 pt-6 border-t border-gray-100 dark:border-neutral-700 space-y-3">
                            <form action="{{ route('superadmin.announcements.restore', $announcement->id) }}" method="POST" navigate-form>
                                @csrf
                                <button type="submit" class="w-full py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition-all shadow-md shadow-emerald-500/20 active:scale-95">
                                    Pulihkan Data
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Action Card if Active -->
                @if (!$announcement->trashed())
                    <div class="bg-gray-50 dark:bg-neutral-900/50 rounded-3xl p-6 border-2 border-dashed border-gray-200 dark:border-neutral-800">
                        <p class="text-[11px] text-gray-400 dark:text-neutral-500 font-medium leading-relaxed mb-4">
                            Anda dapat mengedit informasi atau memindahkan pengumuman ini ke tempat sampah jika sudah tidak relevan.
                        </p>
                        <div class="flex flex-col gap-2">
                            <button type="button" 
                                data-hs-overlay="#delete-modal" onclick="setDeleteData('{{ $announcement->id }}', '{{ $announcement->title }}', false)"
                                class="w-full py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl border border-red-100 bg-red-50 text-red-600 hover:bg-red-100 transition-all active:scale-95">
                                @include('_admin._layout.icons.trash')
                                Pindah ke Sampah
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modals (Borrowed from index for consistency) -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden">
                <div class="p-4 sm:p-10 text-center">
                    <span class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700/30 dark:border-red-600 dark:text-red-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>
                    <h3 id="delete-modal-title" class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Hapus Pengumuman
                    </h3>
                    <p id="delete-modal-description" class="text-gray-500 dark:text-neutral-500 px-6">
                        Apakah Anda yakin ingin memindahkan pengumuman <span id="delete-item-name" class="font-bold text-gray-800 dark:text-neutral-200"></span> ke tempat sampah?
                    </p>
                    <div class="mt-8 flex justify-center gap-x-3">
                        <button type="button" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" data-hs-overlay="#delete-modal">Batal</button>
                        <form id="delete-form" method="POST" class="inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-submit-btn" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-red-600 text-white hover:bg-red-700 cursor-pointer shadow-md shadow-red-500/20 transition-all active:scale-95">
                                Ya, Pindah ke Sampah
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setDeleteData(id, name, isPermanent = false) {
            const form = document.getElementById('delete-form');
            const nameSpan = document.getElementById('delete-item-name');
            const title = document.getElementById('delete-modal-title');
            const alertText = document.getElementById('delete-alert-text');
            const submitBtn = document.getElementById('delete-submit-btn');

            nameSpan.textContent = name;
            form.action = `{{ url('superadmin/announcements/delete') }}/${id}`;
        }
    </script>
@endsection
