{{-- Landing Page Navbar --}}
<nav id="landing-navbar"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-300 bg-transparent">
    <div class="max-w-screen px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

            {{-- Logo --}}
            <a href="{{ route('landing.index') }}" class="flex items-center gap-x-3 shrink-0" id="navbar-logo">
                <img src="{{ asset('favicon/logo-rohis.png') }}" class="size-9 lg:size-10 object-contain" alt="Logo Rohis">
                <span id="logo-text" class="text-lg font-bold {{ request()->routeIs('landing.index') ? 'text-white' : 'text-gray-900' }} dark:text-gray-900 tracking-wide uppercase">Rohiskalaber</span>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-x-1">

                {{-- Beranda --}}
                <a href="{{ route('landing.index') }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                           {{ request()->routeIs('landing.index') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20' }}">
                    Beranda
                </a>

                {{-- Profil Dropdown --}}
                <div class="relative group">
                    <button type="button"
                        class="flex items-center gap-x-1 px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                               {{ request()->is('profil/*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20' }}">
                        Profil
                        <svg class="size-4 transition-transform duration-200 group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div class="absolute top-full left-0 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 translate-y-2">
                        <div class="w-56 bg-white dark:bg-neutral-800 rounded-xl shadow-xl border border-gray-100 dark:border-neutral-700 overflow-hidden p-2">
                            <a href="{{ route('landing.index') }}#tentang"
                                class="flex items-center gap-x-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 dark:text-neutral-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-emerald-900/20 dark:hover:text-emerald-400 transition-colors duration-150">
                                <span class="flex items-center justify-center size-8 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="font-medium">Tentang Rohis</p>
                                    <p class="text-xs text-gray-500 dark:text-neutral-500">Sejarah & profil organisasi</p>
                                </div>
                            </a>
                            <a href="{{ route('landing.profiles.vision-mission') }}"
                                class="flex items-center gap-x-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 dark:text-neutral-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-emerald-900/20 dark:hover:text-emerald-400 transition-colors duration-150">
                                <span class="flex items-center justify-center size-8 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="font-medium">Visi & Misi</p>
                                    <p class="text-xs text-gray-500 dark:text-neutral-500">Tujuan & arah organisasi</p>
                                </div>
                            </a>
                            <a href="{{ route('landing.organizers.index') }}"
                                class="flex items-center gap-x-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 dark:text-neutral-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-emerald-900/20 dark:hover:text-emerald-400 transition-colors duration-150">
                                <span class="flex items-center justify-center size-8 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="font-medium">Struktur Organisasi</p>
                                    <p class="text-xs text-gray-500 dark:text-neutral-500">Kepengurusan rohis</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Program --}}
                <a href="{{ route('landing.programs.index') }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                           {{ request()->routeIs('landing.programs.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20' }}">
                    Program
                </a>

                {{-- Artikel --}}
                <a href="{{ route('landing.articles.index') }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                           {{ request()->routeIs('landing.articles.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20' }}">
                    Artikel
                </a>

                {{-- Galeri --}}
                <a href="{{ route('landing.galleries.index') }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                           {{ request()->routeIs('landing.galleries.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20' }}">
                    Galeri
                </a>

                {{-- Pengumuman --}}
                <a href="{{ route('landing.announcements.index') }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                           {{ request()->routeIs('landing.announcements.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20' }}">
                    Pengumuman
                </a>

                {{-- Aktivitas --}}
                <a href="{{ route('landing.activities.index') }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                           {{ request()->routeIs('landing.activities.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20' }}">
                    Kegiatan
                </a>
            </div>

            {{-- Mobile Menu Toggle --}}
            <button type="button" id="mobile-menu-toggle"
                class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 dark:text-neutral-300 hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors"
                aria-expanded="false" aria-label="Toggle menu">
                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-white dark:bg-neutral-900 border-t border-gray-100 dark:border-neutral-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">

            <a href="{{ route('landing.index') }}"
                class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('landing.index') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:bg-gray-50 dark:hover:bg-neutral-800' }}">
                Beranda
            </a>

            {{-- Profil Accordion --}}
            <div>
                <button type="button" data-dropdown-toggle="mobile-profil-dropdown"
                    class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-sm font-medium text-gray-700 dark:text-neutral-300 hover:bg-gray-50 dark:hover:bg-neutral-800"
                    aria-expanded="false">
                    Profil
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="mobile-profil-dropdown" class="hidden pl-4 mt-1 space-y-1">
                    <a href="{{ route('landing.index') }}#tentang"
                        class="block px-4 py-2 rounded-lg text-sm text-gray-600 dark:text-neutral-400 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20">
                        Tentang Rohis
                    </a>
                    <a href="#"
                        class="block px-4 py-2 rounded-lg text-sm text-gray-600 dark:text-neutral-400 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20 opacity-60">
                        Visi & Misi (Segera)
                    </a>
                    <a href="{{ route('landing.organizers.index') }}"
                        class="block px-4 py-2 rounded-lg text-sm text-gray-600 dark:text-neutral-400 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20">
                        Struktur Organisasi
                    </a>
                </div>
            </div>

            <a href="{{ route('landing.programs.index') }}"
                class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('landing.programs.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:bg-gray-50 dark:hover:bg-neutral-800' }}">
                Program
            </a>
            <a href="{{ route('landing.articles.index') }}"
                class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('landing.articles.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:bg-gray-50 dark:hover:bg-neutral-800' }}">
                Artikel
            </a>
            <a href="{{ route('landing.galleries.index') }}"
                class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('landing.galleries.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:bg-gray-50 dark:hover:bg-neutral-800' }}">
                Galeri
            </a>
            <a href="{{ route('landing.announcements.index') }}"
                class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('landing.announcements.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:bg-gray-50 dark:hover:bg-neutral-800' }}">
                Pengumuman
            </a>
            <a href="{{ route('landing.activities.index') }}"
                class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('landing.activities.*') ? 'text-emerald-700 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-900/30' : 'text-gray-700 dark:text-neutral-300 hover:bg-gray-50 dark:hover:bg-neutral-800' }}">
                Kegiatan
            </a>
        </div>
    </div>
</nav>
