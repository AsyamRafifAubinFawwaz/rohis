@extends('_superadmin._layout.app')

@section('title', 'Detail Program Kerja')

@section('content')
    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center justify-between bg-gray-50/50 dark:bg-neutral-900/50">
                <div class="flex items-center">
                    <a navigate href="{{ route('superadmin.programs.index') }}"
                        class="size-10 inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 transition-all active:scale-90">
                        @include('_admin._layout.icons.back')
                    </a>
                    <div class="ms-4">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                            {{ $page['title'] }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                    <!-- Main Content [Left] -->
                    <div class="lg:col-span-8 space-y-8">
                        <div>
                            <div class="mb-4">
                                @if ($program->status == 'active')
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-xl text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-400 uppercase tracking-widest">
                                        <span class="size-2 rounded-full bg-blue-600 animate-pulse"></span>
                                        Berjalan (Active)
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-xl text-xs font-bold bg-gray-100 text-gray-600 dark:bg-neutral-700 dark:text-neutral-400 uppercase tracking-widest">
                                        <span class="size-2 rounded-full bg-gray-500"></span>
                                        Selesai (Finished)
                                    </span>
                                @endif
                                
                                @if($program->trashed())
                                    <span class="ms-2 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-xl text-xs font-bold bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-400 uppercase tracking-widest">
                                        @include('_admin._layout.icons.trash')
                                        Di Sampah
                                    </span>
                                @endif
                            </div>
                            
                            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-neutral-200 leading-tight">
                                {{ $program->name }}
                            </h1>
                        </div>

                        <!-- Banner / Poster -->
                        <div class="rounded-3xl overflow-hidden shadow-2xl border border-gray-100 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-900">
                            @if($program->image)
                                <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->name }}" 
                                    class="w-full h-auto object-contain max-h-[600px] mx-auto p-4 lg:p-6">
                            @else
                                <div class="w-full aspect-video flex flex-col items-center justify-center text-gray-400 dark:text-neutral-600 space-y-4">
                                    <svg class="size-24 opacity-20" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                    <p class="text-sm font-medium italic">Tidak ada poster program</p>
                                </div>
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-neutral-200 flex items-center gap-2">
                                <svg class="size-5 text-brand" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                                Deskripsi Program
                            </h3>
                            <div class="prose prose-neutral dark:prose-invert max-w-none text-gray-600 dark:text-neutral-400 leading-relaxed text-lg">
                                {!! nl2br(e($program->description ?? 'Tidak ada deskripsi rinci untuk program ini.')) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Info [Right] -->
                    <div class="lg:col-span-4 space-y-6">
                        <!-- Card Metadata -->
                        <div class="bg-gray-50 dark:bg-neutral-900/50 rounded-3xl p-6 border border-gray-100 dark:border-neutral-700/50 space-y-6">
                            <div>
                                <h3 class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 dark:text-neutral-500 mb-4">
                                    Informasi Pelaksanaan
                                </h3>
                                
                                <div class="space-y-4">
                                    <div class="flex items-start gap-3">
                                        <div class="p-2.5 rounded-xl bg-white dark:bg-neutral-800 shadow-sm border border-gray-100 dark:border-neutral-700 text-brand">
                                            @include('_admin._layout.icons.calendar')
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-medium text-gray-400 dark:text-neutral-500 uppercase">Mulai</p>
                                            <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                {{ \Carbon\Carbon::parse($program->start_date)->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start gap-4 ps-1.5 pb-1">
                                        <div class="w-0.5 h-6 bg-gray-200 dark:bg-neutral-700 ms-5 border-dashed border-l"></div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <div class="p-2.5 rounded-xl bg-white dark:bg-neutral-800 shadow-sm border border-gray-100 dark:border-neutral-700 text-rose-500">
                                            @include('_admin._layout.icons.calendar')
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-medium text-gray-400 dark:text-neutral-500 uppercase">Selesai</p>
                                            <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                {{ \Carbon\Carbon::parse($program->end_date)->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="border-gray-100 dark:border-neutral-700">

                            <!-- Creator Info -->
                            <div class="space-y-4">
                                <h3 class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 dark:text-neutral-500">
                                    Dibuat Oleh
                                </h3>
                                <div class="flex items-center gap-3">
                                    <div class="size-10 rounded-full bg-brand/10 text-brand flex items-center justify-center font-black text-xs">
                                        {{ substr($program->creator->name ?? 'A', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">{{ $program->creator->name ?? 'Admin' }}</p>
                                        <p class="text-xs text-gray-500 dark:text-neutral-500 italic">{{ $program->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col gap-3">
                            @if ($program->trashed())
                                <button type="button"
                                    data-hs-overlay="#restore-modal"
                                    class="w-full py-3.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-2xl border border-transparent bg-emerald-100 text-emerald-800 hover:bg-emerald-200 focus:outline-none shadow-sm transition-all active:scale-95 cursor-pointer">
                                    @include('_admin._layout.icons.reset')
                                    Pulihkan Program
                                </button>
                                <button type="button"
                                    data-hs-overlay="#delete-modal"
                                    class="w-full py-3.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-2xl border border-transparent bg-rose-100 text-rose-800 hover:bg-rose-200 focus:outline-none transition-all cursor-pointer shadow-sm active:scale-95">
                                    @include('_admin._layout.icons.trash')
                                    Hapus Permanen
                                </button>
                            @else
                                <a href="{{ route('superadmin.programs.update', $program->id) }}" navigate
                                    class="w-full py-3.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-2xl border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none shadow-sm transition-all active:scale-95">
                                    @include('_admin._layout.icons.pencil')
                                    Edit Program Kerja
                                </a>
                                <button type="button"
                                    data-hs-overlay="#delete-modal"
                                    class="w-full py-3.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-2xl border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none cursor-pointer shadow-sm transition-all active:scale-95">
                                    @include('_admin._layout.icons.trash')
                                    Pindahkan ke Sampah
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals (Simplified versions of index) -->
    @if(!$program->trashed())
    <!-- Delete Modal -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden text-center p-10">
                <span class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700/30">
                    @include('_admin._layout.icons.warning_modal')
                </span>
                <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">Hapus Program Kerja</h3>
                <p class="text-gray-500 dark:text-neutral-500 px-6">Pindahkan program <span class="font-bold">{{ $program->name }}</span> ke tempat sampah?</p>
                <div class="mt-8 flex justify-center gap-x-3">
                    <button type="button" class="py-2.5 px-6 rounded-xl border border-gray-200 bg-white text-gray-800" data-hs-overlay="#delete-modal">Batal</button>
                    <form action="{{ route('superadmin.programs.delete', $program->id) }}" method="POST" navigate-form>
                        @csrf @method('DELETE')
                        <button type="submit" class="py-2.5 px-6 rounded-xl bg-red-600 text-white font-bold">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Restore Modal -->
    <div id="restore-modal" class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden text-center p-10">
                <span class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-blue-50 bg-blue-100 text-blue-500">
                    @include('_admin._layout.icons.warning_modal')
                </span>
                <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">Pulihkan Program</h3>
                <div class="mt-8 flex justify-center gap-x-3">
                    <button type="button" class="py-2.5 px-6 rounded-xl border border-gray-200" data-hs-overlay="#restore-modal">Batal</button>
                    <form action="{{ route('superadmin.programs.restore', $program->id) }}" method="POST" navigate-form>
                        @csrf
                        <button type="submit" class="py-2.5 px-6 rounded-xl bg-blue-600 text-white font-bold">Ya, Pulihkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Force Delete Modal -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden text-center p-10">
                <span class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-rose-50 bg-rose-100 text-rose-500">
                    @include('_admin._layout.icons.warning_modal')
                </span>
                <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">Hapus Permanen</h3>
                <p class="text-gray-500 dark:text-neutral-500 px-6">Tindakan ini tidak dapat dibatalkan!</p>
                <div class="mt-8 flex justify-center gap-x-3">
                    <button type="button" class="py-2.5 px-6 rounded-xl border border-gray-200" data-hs-overlay="#delete-modal">Batal</button>
                    <form action="{{ route('superadmin.programs.forceDelete', $program->id) }}" method="POST" navigate-form>
                        @csrf @method('DELETE')
                        <button type="submit" class="py-2.5 px-6 rounded-xl bg-rose-600 text-white font-bold">Ya, Hapus Permanen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
