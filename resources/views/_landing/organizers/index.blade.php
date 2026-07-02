@extends('_landing._layout.app')
@section('title', 'Struktur Organisasi')

@section('content')
<div class="bg-neutral-50 dark:bg-neutral-950 py-12 min-h-screen pt-24 sm:pt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-neutral-900 dark:text-white mb-4">Struktur Organisasi</h1>
            <p class="text-sm sm:text-base text-neutral-500 dark:text-neutral-400 max-w-2xl mx-auto">
                Susunan kepengurusan ekstrakurikuler kerohanian Islam yang berdedikasi membangun generasi islami yang berakhlak mulia.
            </p>
        </div>

        <!-- Filter Section -->
        <div class="relative z-50 mb-12 w-full max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            <form action="{{ route('landing.organizers.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3" id="filterForm">
                
                <!-- Search Bar -->
                <div class="w-full md:flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="py-3.5 px-5 block w-full border border-neutral-200 rounded-2xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 shadow-sm"
                        placeholder="Cari Nama atau Jabatan...">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                        <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1116.65 1.65a7.5 7.5 0 010 15z"></path></svg>
                    </div>
                </div>

                <!-- Periode Dropdown (Preline) -->
                <div class="w-full md:w-56">
                    <select id="periode" name="periode"
                        data-hs-select='{
                            "placeholder": "Semua Periode",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3.5 px-5 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-neutral-200 text-neutral-800 rounded-2xl text-start text-sm hover:bg-neutral-50 focus:outline-hidden shadow-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800",
                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-neutral-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-neutral-100 [&::-webkit-scrollbar-thumb]:bg-neutral-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                            "optionClasses": "hs-selected:bg-emerald-100 dark:hs-selected:bg-emerald-900/30 py-2 px-4 w-full text-sm text-neutral-800 dark:text-neutral-200 cursor-pointer hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-emerald-600 dark:text-emerald-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-4 -translate-y-1/2\"><svg class=\"shrink-0 size-4 text-neutral-400 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }'
                        class="hidden">
                        <option value="all" {{ $selectedPeriode === 'all' ? 'selected' : '' }}>Semua Periode</option>
                        @foreach ($periods as $period)
                            <option value="{{ $period }}"
                                {{ ($selectedPeriode == $period) ? 'selected' : '' }}>
                                {{ $period }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white py-3.5 px-6 rounded-2xl text-sm font-medium transition-colors w-full md:w-auto justify-center shadow-sm">
                    Cari
                </button>
            </form>
        </div>

        <!-- Organizers Grid -->
        @if($organizers->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
                @foreach($organizers as $i => $organizer)
                    @php 
                        $isLeader = stripos($organizer->jabatan, 'Pembina') !== false || stripos($organizer->jabatan, 'Ketua') !== false; 
                    @endphp
                    <div class="bg-white dark:bg-neutral-900 rounded-2xl border {{ $isLeader ? 'border-emerald-500 shadow-emerald-500/20 shadow-md' : 'border-neutral-100 dark:border-neutral-800 shadow-sm' }} p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow group relative" data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 50 }}">
                        
                        @if($isLeader)
                            <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-gradient-to-r from-emerald-600 to-emerald-400 text-white text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full shadow-sm z-10">
                                Core Team
                            </div>
                        @endif

                        <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden mb-5 border-4 {{ $isLeader ? 'border-emerald-100 dark:border-emerald-900/50' : 'border-emerald-50 dark:border-neutral-800' }} group-hover:scale-105 transition-transform duration-300">
                            @if($organizer->image)
                                <img src="{{ asset('storage/' . $organizer->image) }}"
                                     alt="{{ $organizer->name }}"
                                     class="w-full h-full object-cover"
                                     onerror="this.src='{{ asset('img/fallbacks/avatar.svg') }}';this.onerror=null;">
                            @else
                                <img src="{{ asset('img/fallbacks/avatar.svg') }}"
                                     alt="{{ $organizer->name }}"
                                     class="w-full h-full object-cover">
                            @endif
                        </div>

                        <h3 class="font-bold text-neutral-900 dark:text-white text-lg mb-1 leading-snug line-clamp-2">
                            {{ $organizer->name }}
                        </h3>
                        
                        <p class="text-sm font-semibold {{ $isLeader ? 'text-emerald-700 dark:text-emerald-400' : 'text-emerald-600 dark:text-emerald-500' }} mb-4 line-clamp-1">
                            {{ $organizer->jabatan }}
                        </p>

                        <div class="mt-auto">
                            <span class="inline-block px-3 py-1 bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 text-xs font-medium rounded-full">
                                Periode {{ $organizer->periode }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-14 flex justify-center">
                {{ $organizers->links('pagination::tailwind') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-100 dark:border-neutral-800 shadow-sm" data-aos="fade-up">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-2">Pengurus Tidak Ditemukan</h3>
                <p class="text-neutral-500 dark:text-neutral-400">Belum ada data pengurus yang sesuai dengan filter pencarian Anda.</p>
                <a href="{{ route('landing.organizers.index') }}" class="inline-block mt-6 text-emerald-600 dark:text-emerald-400 hover:underline font-medium text-sm">
                    Tampilkan Semua Pengurus
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
@endpush
@endsection
