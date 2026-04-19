@php
    use App\Constants\UserConst;
@endphp

<!-- Sidebar -->
<aside id="hs-application-sidebar"
    class="hs-overlay [--auto-close:lg]
  hs-overlay-open:translate-x-0
  -translate-x-full transition-all duration-300 transform
  w-64 h-full
  hidden
  fixed inset-y-0 start-0 z-60
  lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
  dark:bg-neutral-800 dark:border-neutral-700
  bg-gray-50 border-e border-gray-200"
    role="dialog" tabindex="-1" aria-label="Sidebar">
    <div class="relative flex flex-col h-full max-h-full">
        <!-- Sidebar Header -->
        <div class="sidebar-header px-6 pt-4 flex items-center justify-between min-h-[64px]">
            <div class="flex items-center gap-x-3">
                <img src="{{ asset('favicon/logo-rohis.png') }}" class="size-8 object-contain" alt="Logo">
                <span
                    class="sidebar-text text-sm font-bold text-gray-800 dark:text-neutral-200 uppercase tracking-wider">ROHIS</span>
            </div>
            <button type="button" onclick="toggleSidebarMini()"
                class="sidebar-toggle-btn p-1.5 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <span class="sidebar-expand-icon">@include('partials.icons.sidebar.double_chevron_left')</span>
                <span class="sidebar-collapse-icon hidden">@include('partials.icons.sidebar.double_chevron_right')</span>
            </button>
        </div>
        <!-- End Sidebar Header -->

        <!-- Content -->
        <div
            class="flex-1 overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
            <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                <ul class="flex flex-col space-y-1">
                    @php
                        $dashboardRoute = match (Auth::user()->access_type) {
                            UserConst::SUPERADMIN => 'superadmin.dashboard',
                            UserConst::ADMIN => 'admin.dashboard',
                            default => 'admin.dashboard',
                        };
                    @endphp
                    <li>
                        <a navigate
                            class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 {{ request()->routeIs('*.dashboard') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-white' }} text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 font-semibold"
                            href="{{ route($dashboardRoute) }}">
                            <span class="icon">@include('partials.icons.sidebar.dashboard')</span>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li>

                    @if (Auth::user()->access_type == UserConst::ADMIN)
                        <li>
                            <a navigate
                                class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 {{ request()->routeIs('admin.tasks.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-white' }} text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 font-semibold"
                                href="{{ route('admin.tasks.index') }}">
                                <span class="icon">@include('partials.icons.sidebar.task')</span>
                                <span class="sidebar-text">Manajemen Tugas</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->access_type == UserConst::SUPERADMIN)
                        <li>
                            <a navigate
                                class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 {{ request()->routeIs('superadmin.posts.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-white' }} text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 font-semibold"
                                href="{{ route('superadmin.posts.index') }}">
                                <span class="icon">@include('partials.icons.sidebar.post')</span>
                                <span class="sidebar-text">Postingan</span>
                            </a>
                        </li>
                        <li>
                            <a navigate
                                class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 {{ request()->routeIs('superadmin.gallery.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-white' }} text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 font-semibold"
                                href="{{ route('superadmin.galleries.index') }}">
                                <span class="icon">@include('partials.icons.sidebar.gallery')</span>
                                <span class="sidebar-text">Galeri</span>
                            </a>
                        </li>
                        <li>
                            <a navigate
                                class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 {{ request()->routeIs('superadmin.organizer.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-white' }} text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 font-semibold"
                                href="{{ route('superadmin.organizer.index') }}">
                                <span class="icon">@include('partials.icons.sidebar.user-group')</span>
                                <span class="sidebar-text">Panitia</span>
                            </a>
                        </li>
                        <li>
                            <a navigate
                                class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 {{ request()->routeIs('superadmin.activities.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-white' }} text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 font-semibold"
                                href="{{ route('superadmin.activities.index') }}">
                                <span class="icon">@include('partials.icons.sidebar.clipboard-list')</span>
                                <span class="sidebar-text">Kegiatan</span>
                            </a>
                        </li>
                        
                            <a navigate
                                class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 {{ request()->routeIs('superadmin.users.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-white' }} text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 font-semibold"
                                href="{{ route('superadmin.users.index') }}">
                                <span class="icon">@include('partials.icons.sidebar.user')</span>
                                <span class="sidebar-text">Manajemen Akun</span>
                            </a>
                        </li>
                    @endif

                    <li class="hs-accordion {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.task_categories.*') || request()->routeIs('superadmin.announcements.*') || request()->routeIs('superadmin.programs.*') ? 'active' : '' }}"
                        id="projects-accordion">
                        <button type="button"
                            class="hs-accordion-toggle nav-link w-full text-start flex items-center gap-x-3.5  py-2.5 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200 cursor-pointer font-semibold"
                            aria-expanded="true" aria-controls="projects-accordion-child">
                            <span class="icon">@include('partials.icons.sidebar.data_master')</span>
                            <span class="sidebar-text grow">Data Master</span>

                            <span class="sidebar-text">
                                @include('partials.icons.sidebar.chevron_down')
                                @include('partials.icons.sidebar.chevron_up')
                            </span>
                        </button>

                        <div id="projects-accordion-child"
                            class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.task_categories.*') || request()->routeIs('superadmin.announcements.*') || request()->routeIs('superadmin.categories.*') || request()->routeIs('superadmin.programs.*') ? 'block' : 'hidden' }}"
                            role="region" aria-labelledby="projects-accordion">
                            <ul class="ps-8 pt-1 space-y-1">
                                @if (Auth::user()->access_type == UserConst::ADMIN)
                                    <li>
                                        <a navigate
                                            class="flex items-center gap-x-3.5  py-2 px-3 text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 {{ request()->routeIs('admin.task_categories.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-neutral-200' }}"
                                            href="{{ route('admin.task_categories.index') }}">
                                            Kategori Tugas
                                        </a>
                                    </li>
                                    <li>
                                        <a navigate
                                            class="flex items-center gap-x-3.5  py-2 px-3 text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 {{ request()->routeIs('admin.users.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-neutral-200' }}"
                                            href="{{ route('admin.users.index') }}">
                                            Pengguna Aplikasi
                                        </a>
                                    </li>
                                @endif

                                @if (Auth::user()->access_type == UserConst::SUPERADMIN)
                                    <li>
                                        <a navigate
                                            class="flex items-center gap-x-3.5  py-2 px-3 text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 {{ request()->routeIs('superadmin.announcements.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-neutral-200' }}"
                                            href="{{ route('superadmin.announcements.index') }}">
                                            Pengumuman
                                        </a>
                                        <a navigate
                                            class="flex items-center gap-x-3.5  py-2 px-3 text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 {{ request()->routeIs('superadmin.categories.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-neutral-200' }}"
                                            href="{{ route('superadmin.categories.index') }}">
                                            Kategori
                                        </a>
                                    </li>
                                    <li>
                                        <a navigate
                                            class="flex items-center gap-x-3.5  py-2 px-3 text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 {{ request()->routeIs('superadmin.programs.*') ? 'bg-brand-light text-brand dark:bg-neutral-700 dark:text-brand-light' : 'text-gray-800 dark:text-neutral-200' }}"
                                            href="{{ route('superadmin.programs.index') }}">
                                            Program
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>

                <div class="mt-auto pb-6 border-t border-gray-200 dark:border-neutral-700 pt-4">
                    <form action="{{ route('logout') }}" method="POST"
                        onsubmit="return confirm('Apakah anda yakin ingin keluar?');">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-x-3.5 py-2.5 px-3 rounded-lg text-sm text-red-600 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-red-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 font-semibold transition-all">
                            <span class="icon shrink-0">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                            </span>
                            <span class="sidebar-text">Log out</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>
        <!-- End Content -->
    </div>
</aside>
<!-- End Sidebar -->
