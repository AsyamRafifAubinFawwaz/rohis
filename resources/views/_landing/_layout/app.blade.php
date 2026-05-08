<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website resmi Rohis - Organisasi Kerohanian Islam. Informasi kegiatan, program, artikel, dan galeri.">

    <title>{{ config('app.name', 'Rohis') }} - @yield('title', 'Beranda')</title>

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

    {{-- Navbar scroll script --}}
    <script>
        (function() {
            const navbar = document.getElementById('landing-navbar');
            if (!navbar) return;

            const handleScroll = () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-white/80', 'dark:bg-neutral-900/80', 'backdrop-blur-xl', 'shadow-sm');
                    navbar.classList.remove('bg-transparent');
                } else {
                    navbar.classList.remove('bg-white/80', 'dark:bg-neutral-900/80', 'backdrop-blur-xl', 'shadow-sm');
                    navbar.classList.add('bg-transparent');
                }
            };

            window.addEventListener('scroll', handleScroll, { passive: true });
            handleScroll();
        })();

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
