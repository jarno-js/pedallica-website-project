<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pedallica')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

@include('layouts.navigation')

<!-- Main Content -->
<main class="min-h-screen">
    @yield('content')
</main>

<script>
    // Mobile menu toggle
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const openIcon = document.getElementById('menu-open-icon');
    const closeIcon = document.getElementById('menu-close-icon');

    menuButton.addEventListener('click', () => {
        const isOpen = mobileMenu.style.display === 'block';
        mobileMenu.style.display = isOpen ? 'none' : 'block';
        openIcon.style.display = isOpen ? 'block' : 'none';
        closeIcon.style.display = isOpen ? 'none' : 'block';
    });

    // Account dropdown toggle
    const accountButton = document.getElementById('account-button');
    const accountDropdown = document.getElementById('account-dropdown');

    if (accountButton) {
        accountButton.addEventListener('click', (e) => {
            e.stopPropagation();
            accountDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!accountButton.contains(e.target) && !accountDropdown.contains(e.target)) {
                accountDropdown.classList.add('hidden');
            }
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        const logoWrapper = document.querySelector('.logo-wrapper');
        const logoImg = logoWrapper.querySelector('.logo-img');
        const originalSrc = logoImg.src;
        const hoverSrc = logoImg.getAttribute('data-hover');

        // Verander logo bij hover op de hele wrapper (dus tekst of afbeelding)
        logoWrapper.addEventListener('mouseenter', () => {
            logoImg.src = hoverSrc;
        });
        logoWrapper.addEventListener('mouseleave', () => {
            logoImg.src = originalSrc;
        });
    });
</script>

@stack('popups')
</body>
</html>
