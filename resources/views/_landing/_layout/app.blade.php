<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Website resmi Rohis Eskalaber (SMKN 8 Jember). Temukan profil, program unggulan, artikel islami, galeri kegiatan, dan info terbaru seputar Rohis.')">
    <meta name="keywords" content="@yield('meta_keywords', 'rohis, rohis eskalaber, rohiskalaber, rohis smkn 8 jember, ekstrakurikuler islam, kerohanian islam, dakwah sekolah, remaja masjid')">
    <meta name="author" content="Rohis Eskalaber">
    <meta name="robots" content="index, follow">
    <meta name="google-site-verification" content="2Gf-MPX3iu-N60mZPQh_re5jjKsieAwnox-c_jAbWNk" />

    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical_url', url()->current())" />

    {{-- Default Open Graph / Social Media Meta Tags --}}
    @hasSection('meta')
        @yield('meta')
    @else
        <meta property="og:title" content="{{ config('app.name', 'Rohiskalaber') }} - @yield('title', 'Beranda')">
        <meta property="og:description" content="Website resmi Rohis Eskalaber (SMKN 8 Jember). Temukan profil, program unggulan, artikel islami, galeri kegiatan, dan info terbaru seputar Rohis.">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Rohiskalaber">
        <meta property="og:image" content="{{ asset('favicon/logo-rohis.webp') }}">
        
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ config('app.name', 'Rohiskalaber') }} - @yield('title', 'Beranda')">
        <meta name="twitter:description" content="Website resmi Rohis Eskalaber (SMKN 8 Jember). Temukan profil, program unggulan, artikel islami, galeri kegiatan, dan info terbaru seputar Rohis.">
        <meta name="twitter:image" content="{{ asset('favicon/logo-rohis.webp') }}">
    @endif

    <title>{{ config('app.name', 'Rohiskalaber') }} - @yield('title', 'Beranda')</title>

    {{-- Favicon --}}
    @include('_admin._layout.favicon')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-white dark:bg-neutral-950 text-gray-800 dark:text-neutral-200 antialiased overflow-x-hidden">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('_landing._layout.footer')

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            easing: 'ease-out-cubic',
            once: true,
            offset: 60,
        });
    </script>

    {{-- Navbar scroll script removed as it is no longer needed with the floating pill design --}}
    <script>
        // Mobile menu toggle
        (function() {
            const toggle = document.getElementById('mobile-menu-toggle');
            const menu = document.getElementById('mobile-menu');
            if (!toggle || !menu) return;

            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
                const isOpen = !menu.classList.contains('hidden');
                toggle.setAttribute('aria-expanded', isOpen);
            });

            // Close on link click
            menu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    menu.classList.add('hidden');
                    toggle.setAttribute('aria-expanded', 'false');
                });
            });
        })();

        // Dropdown toggle for mobile
        (function() {
            document.querySelectorAll('[data-dropdown-toggle]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = btn.getAttribute('data-dropdown-toggle');
                    const target = document.getElementById(targetId);
                    if (target) {
                        target.classList.toggle('hidden');
                        const isOpen = !target.classList.contains('hidden');
                        btn.setAttribute('aria-expanded', isOpen);
                    }
                });
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
