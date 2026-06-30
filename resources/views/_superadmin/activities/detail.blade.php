@extends('_superadmin._layout.app')

@section('title', 'Detail Kegiatan')

@section('content')
    <div class="grid grid-cols-1 gap-6">
        <div
            class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center justify-between">
                <div class="flex items-center">
                    <a navigate href="{{ route('superadmin.activities.index') }}"
                        class="p-2 inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
                        <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </a>
                    <div class="ms-4">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                            {{ $page['title'] }}
                        </h2>
                    </div>
                </div>
                <div class="flex items-center gap-x-2">
                    @if ($activity->trashed())
                        <form action="{{ route('superadmin.activities.restore', $activity->id) }}" method="POST"
                            navigate-form>
                            @csrf
                            <button type="submit"
                                class="py-2.5 px-5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-emerald-100 text-emerald-800 hover:bg-emerald-200 focus:outline-none transition-all cursor-pointer shadow-sm">
                                @include('_admin._layout.icons.reset')
                                Pulihkan
                            </button>
                        </form>
                    @else
                        <a navigate href="{{ route('superadmin.activities.update', $activity->id) }}"
                            class="py-2.5 px-5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none transition-all shadow-sm active:scale-95">
                            @include('_admin._layout.icons.pencil')
                            Edit
                        </a>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <!-- Status Badge -->
                <div class="mb-6">
                    @php
                        $statusColors = [
                            'upcoming' => 'bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500',
                            'ongoing' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-500',
                            'done' => 'bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-gray-400',
                        ];
                        $currentColor = $statusColors[$activity->status] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span
                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold uppercase tracking-wider {{ $currentColor }}">
                        {{ $activity->status }}
                    </span>
                    @if ($activity->trashed())
                        <span
                            class="ms-2 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-500 uppercase tracking-wider">
                            Terhapus (Sampah)
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-8">
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-neutral-200 leading-tight">
                                {{ $activity->title }}
                            </h1>
                        </div>

                        @if ($activity->poster)
                            <div
                                class="rounded-2xl overflow-hidden shadow-xl border border-gray-100 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-900">
                                <img src="{{ asset('storage/' . $activity->poster) }}" alt="Poster Kegiatan"
                                    class="w-full object-contain max-h-[600px]">
                            </div>
                        @endif

                        <div class="prose prose-neutral dark:prose-invert max-w-none">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-neutral-200 mb-4">Deskripsi Kegiatan</h3>

                            <div class="prose prose-neutral dark:prose-invert dark:text-white max-w-none">
                                {!! $activity->description !!}
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div
                            class="bg-gray-50 dark:bg-neutral-700/30 rounded-2xl p-6 space-y-5 border border-gray-100 dark:border-neutral-700/50 shadow-sm transition-all hover:shadow-md">
                            <h3
                                class="text-sm font-bold uppercase tracking-widest text-gray-400 dark:text-neutral-500 border-b border-gray-200 dark:border-neutral-700 pb-3">
                                Detail Pelaksanaan
                            </h3>

                            <div class="flex items-start gap-3">
                                <div class="p-2 rounded-lg bg-brand/10 text-brand">
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-gray-400 dark:text-neutral-500 uppercase">Waktu</h4>
                                    <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                        {{ $activity->event_date ? \Carbon\Carbon::parse($activity->event_date)->format('d F Y') : 'Belum ditentukan' }}
                                    </p>
                                    <p class="text-[11px] text-gray-400 italic">
                                        {{ $activity->event_date ? \Carbon\Carbon::parse($activity->event_date)->diffForHumans() : '' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="p-2 rounded-lg bg-brand/10 text-brand">
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-gray-400 dark:text-neutral-500 uppercase">Lokasi</h4>
                                    <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                        {{ $activity->location ?? 'Tidak ada lokasi' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 pt-2 border-t border-gray-200 dark:border-neutral-700">
                                <div
                                    class="size-9 rounded-full bg-brand/10 flex items-center justify-center text-brand font-bold text-xs">
                                    {{ substr($activity->creator->name ?? 'A', 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-gray-400 dark:text-neutral-500 uppercase">
                                        Penyelenggara</h4>
                                    <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                        {{ $activity->creator->name ?? 'Admin' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-1">
                            <button type="button"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent {{ $activity->trashed() ? 'bg-rose-100 text-rose-800 hover:bg-rose-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }} focus:outline-none transition-all cursor-pointer shadow-sm active:scale-95 transition-all"
                                data-hs-overlay="#delete-modal">
                                @include('_admin._layout.icons.trash')
                                {{ $activity->trashed() ? 'Hapus Permanen' : 'Pindahkan ke Sampah' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 inset-s-0 z-80 overflow-x-hidden overflow-y-auto"
        role="dialog" tabindex="-1">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="relative flex flex-col bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden">
                <div class="p-4 sm:p-10 text-center">
                    <span
                        class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700/30 dark:border-red-600 dark:text-red-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>
                    <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        {{ $activity->trashed() ? 'Hapus Permanen' : 'Hapus Kegiatan' }}
                    </h3>
                    <p class="text-gray-500 dark:text-neutral-500 px-6">
                        Apakah Anda yakin ingin menghapus kegiatan <span
                            class="font-bold text-gray-800 dark:text-neutral-200">{{ $activity->title }}</span>?
                        <br>
                        {{ $activity->trashed() ? 'Tindakan ini tidak dapat dibatalkan.' : 'Data akan dipindahkan ke sampah.' }}
                    </p>
                    <div class="mt-8 flex justify-center gap-x-3">
                        <button type="button"
                            class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300"
                            data-hs-overlay="#delete-modal">Batal</button>
                        <form
                            action="{{ $activity->trashed() ? route('superadmin.activities.forceDelete', $activity->id) : route('superadmin.activities.delete', $activity->id) }}"
                            method="POST" class="inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent {{ $activity->trashed() ? 'bg-rose-600 hover:bg-rose-700' : 'bg-red-600 hover:bg-red-700' }} text-white cursor-pointer shadow-md shadow-red-500/20 transition-all active:scale-95">
                                Ya, Hapus Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
