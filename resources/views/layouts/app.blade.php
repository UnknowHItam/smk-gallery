<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMKN 4 Bogor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Preconnect untuk Google reCAPTCHA (faster loading) -->
    <link rel="preconnect" href="https://www.google.com">
    <link rel="preconnect" href="https://www.gstatic.com" crossorigin>
    
    <!-- Google reCAPTCHA v3 -->
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}" async defer></script>
</head>
<body class="font-sans antialiased text-black dark:text-white dark:bg-gray-900 transition-colors duration-300">

    <!-- Header / Navbar sesuai desain - Sticky -->
    <header class="fixed top-0 left-0 right-0 z-50 w-full bg-white/90 backdrop-blur border-b border-gray-200 transition-colors duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}?v={{ file_exists(public_path('images/logo.png')) ? filemtime(public_path('images/logo.png')) : '' }}" alt="Logo" class="h-9 w-9 object-contain">
                    <a href="{{ route('home') }}" class="text-lg sm:text-xl font-semibold tracking-wide">SMKN 4 BOGOR</a>
                </div>

                <div class="flex items-center gap-3">
                    <!-- Mobile Menu Button -->
                    <button id="mobileNavToggle" class="md:hidden p-2 hover:bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <nav class="hidden md:flex items-center gap-6 text-sm mr-4">
                        <a href="{{ route('home') }}" class="hover:text-blue-700 flex items-center gap-2"><span class="inline-block">🏠</span> Beranda</a>
                        <a href="{{ route('gallery') }}" class="hover:text-blue-700 flex items-center gap-2"><span class="inline-block">🖼️</span> Gallery</a>
                        <a href="#berita" class="hover:text-blue-700 flex items-center gap-2"><span class="inline-block">🎯</span> Kegiatan</a>
                        <a href="#kontak" class="hover:text-blue-700 flex items-center gap-2"><span class="inline-block">✉️</span> Kontak</a>
                    </nav>
                    <div class="hidden sm:flex items-center gap-2 rounded-full border px-3 py-1 text-sm">
                        <span>🔍</span>
                        <input type="text" id="searchInput" placeholder="Search" class="outline-none border-0 focus:ring-0 p-0 text-sm placeholder-gray-400">
                    </div>
                    <button id="searchBtn" class="sm:hidden bg-blue-700 hover:bg-blue-800 text-white p-2 rounded-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    @guest('public')
                        <button onclick="showAuthModal()" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-4 py-2 rounded-full transition-colors">
                            <span>Login</span>
                        </button>
                    @endguest

                    @auth('public')
                        <div class="flex items-center gap-3">
                            <button onclick="window.location.href='{{ route('profile') }}'" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-full transition-colors">
                                <span class="w-5 h-5 bg-gray-100 rounded-md flex items-center justify-center text-base">{{ Auth::guard('public')->user()->avatar ?? '🐼' }}</span>
                                <span class="hidden md:inline">{{ Auth::guard('public')->user()->name }}</span>
                                <span class="md:hidden">Profile</span>
                            </button>
                            <button onclick="handleLogout()" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-full transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span class="hidden md:inline">Logout</span>
                            </button>
                        </div>
                    @endauth
                </div>
            </div>
            
            <!-- Mobile Menu Dropdown -->
            <div id="mobileNavMenu" class="hidden md:hidden bg-white border-t border-gray-200">
                <div class="px-4 py-4 space-y-2">
                    <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-100 rounded-lg flex items-center gap-2">
                        <span class="inline-block">🏠</span> Beranda
                    </a>
                    <a href="{{ route('gallery') }}" class="block px-4 py-2 hover:bg-gray-100 rounded-lg flex items-center gap-2">
                        <span class="inline-block">🖼️</span> Gallery
                    </a>
                    <a href="#berita" class="block px-4 py-2 hover:bg-gray-100 rounded-lg flex items-center gap-2">
                        <span class="inline-block">🎯</span> Kegiatan
                    </a>
                    <a href="#kontak" class="block px-4 py-2 hover:bg-gray-100 rounded-lg flex items-center gap-2">
                        <span class="inline-block">✉️</span> Kontak
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Spacer untuk mengkompensasi fixed navbar -->
    <div class="h-16"></div>

    <!-- Floating Burger Menu -->
    <div class="fixed left-4 top-1/2 transform -translate-y-1/2 z-50">
        <button id="burgerMenu" class="w-14 h-14 bg-blue-700 hover:bg-blue-800 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
            <svg id="burgerIcon" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg id="closeIcon" class="w-6 h-6 transition-transform duration-300 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- Menu Items -->
        <div id="floatingMenu" class="absolute left-16 top-0 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 py-4 min-w-[200px] transform scale-0 opacity-0 transition-all duration-300 origin-left">
            <!-- Accessibility Mode Toggle -->
            <button id="accessibilityToggle" class="w-full px-6 py-3 text-left hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center space-x-3 transition-colors">
                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center">
                    <svg id="lightIcon" class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="darkIcon" class="w-4 h-4 text-gray-700 dark:text-gray-300 hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Mode Aksesibilitas</p>
                    <p id="modeText" class="text-xs text-gray-500 dark:text-gray-400">Tema Terang</p>
                </div>
            </button>
            
            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>
            
            <!-- Search Button -->
            <button id="floatingSearch" class="w-full px-6 py-3 text-left hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center space-x-3 transition-colors">
                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Search</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Cari konten</p>
                </div>
            </button>
            
            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>
            
            <!-- Beranda Button -->
            <a href="{{ route('home') }}" class="w-full px-6 py-3 text-left hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center space-x-3 transition-colors">
                <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Beranda</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Halaman Utama</p>
                </div>
            </a>
            
            <!-- Gallery Button -->
            <a href="{{ route('gallery') }}" class="w-full px-6 py-3 text-left hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center space-x-3 transition-colors">
                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Gallery</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Galeri Foto</p>
                </div>
            </a>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- Footer warna krem -->
    <footer class="bg-[#f5deb3] text-black text-center py-6">
        <p>2025 - 2030 SMK Negeri 4 Bogor . All Right Reserved • Privacy • Cookie Policy • Terms of Service</p>
    </footer>

    <!-- Floating Menu & Theme Toggle JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Floating Menu Elements
            const burgerMenu = document.getElementById('burgerMenu');
            const floatingMenu = document.getElementById('floatingMenu');
            const burgerIcon = document.getElementById('burgerIcon');
            const closeIcon = document.getElementById('closeIcon');
            const accessibilityToggle = document.getElementById('accessibilityToggle');
            const lightIcon = document.getElementById('lightIcon');
            const darkIcon = document.getElementById('darkIcon');
            const modeText = document.getElementById('modeText');
            const floatingSearch = document.getElementById('floatingSearch');
            
            // Search Elements
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');

            // Theme Management
            let isDarkMode = localStorage.getItem('darkMode') === 'true';
            
            // Initialize theme
            function initTheme() {
                if (isDarkMode) {
                    // Apply dark theme to body
                    document.body.style.backgroundColor = '#1f2937';
                    document.body.style.color = '#f9fafb';
                    
                    // Apply dark theme to header/navbar
                    const header = document.querySelector('header');
                    if (header) {
                        header.style.backgroundColor = '#374151';
                        header.style.color = '#f9fafb';
                        
                        // Apply dark theme to navbar elements
                        const navElements = header.querySelectorAll('*');
                        navElements.forEach(element => {
                            if (!element.classList.contains('text-blue-700') && 
                                !element.classList.contains('bg-blue-700') &&
                                !element.classList.contains('bg-red-600') &&
                                !element.classList.contains('bg-green-600')) {
                                element.style.color = '#f9fafb';
                            }
                        });
                        
                        // Special handling for navbar links
                        const navLinks = header.querySelectorAll('a');
                        navLinks.forEach(link => {
                            if (!link.classList.contains('text-blue-700')) {
                                link.style.color = '#f9fafb';
                            }
                        });
                        
                        // Apply dark theme to search input
                        const searchInput = header.querySelector('input');
                        if (searchInput) {
                            searchInput.style.backgroundColor = '#4b5563';
                            searchInput.style.color = '#f9fafb';
                            searchInput.style.borderColor = '#6b7280';
                        }
                        
                        // Apply dark theme to search container
                        const searchContainer = header.querySelector('.rounded-full.border');
                        if (searchContainer) {
                            searchContainer.style.backgroundColor = '#4b5563';
                            searchContainer.style.borderColor = '#6b7280';
                        }
                    }
                    
                    // Apply dark theme to all sections with comprehensive styling
                    const sections = document.querySelectorAll('section');
                    sections.forEach(section => {
                        section.style.backgroundColor = '#1f2937';
                        section.style.color = '#f9fafb';
                        
                        // Apply dark theme to all elements within sections
                        const allElements = section.querySelectorAll('*');
                        allElements.forEach(element => {
                            // Skip elements that should maintain their colors
                            if (!element.classList.contains('text-blue-600') && 
                                !element.classList.contains('text-green-600') && 
                                !element.classList.contains('text-red-600') &&
                                !element.classList.contains('text-yellow-500') &&
                                !element.classList.contains('text-purple-600') &&
                                !element.classList.contains('text-orange-500')) {
                                element.style.color = '#f9fafb';
                            }
                        });
                        
                        // Special handling for specific elements
                        const headings = section.querySelectorAll('h1, h2, h3, h4, h5, h6');
                        headings.forEach(heading => {
                            heading.style.color = '#f9fafb';
                        });
                        
                        const links = section.querySelectorAll('a');
                        links.forEach(link => {
                            if (!link.classList.contains('text-blue-600')) {
                                link.style.color = '#60a5fa';
                            }
                        });
                        
                        const buttons = section.querySelectorAll('button');
                        buttons.forEach(button => {
                            if (!button.classList.contains('bg-blue-700') && 
                                !button.classList.contains('bg-red-600') &&
                                !button.classList.contains('bg-green-600')) {
                                button.style.backgroundColor = '#374151';
                                button.style.color = '#f9fafb';
                                button.style.borderColor = '#4b5563';
                            }
                        });
                    });
                    
                    // Apply dark theme to main content
                    const main = document.querySelector('main');
                    if (main) {
                        main.style.backgroundColor = '#1f2937';
                        main.style.color = '#f9fafb';
                        
                        const mainElements = main.querySelectorAll('*');
                        mainElements.forEach(element => {
                            if (!element.classList.contains('text-blue-600') && 
                                !element.classList.contains('text-green-600') && 
                                !element.classList.contains('text-red-600') &&
                                !element.classList.contains('text-yellow-500') &&
                                !element.classList.contains('text-purple-600') &&
                                !element.classList.contains('text-orange-500')) {
                                element.style.color = '#f9fafb';
                            }
                        });
                    }
                    
                    // Apply dark theme to cards and containers with better styling
                    const cards = document.querySelectorAll('.bg-white, .bg-gray-50, .bg-gray-100, .bg-gradient-to-r, .bg-gradient-to-br, .bg-gradient-to-br.from-gray-50, .bg-gradient-to-br.from-blue-50');
                    cards.forEach(card => {
                        // Check if this card or any child contains an image
                        const hasImage = card.querySelector('img');
                        const isImageContainer = card.classList.contains('aspect-video') || 
                                                card.classList.contains('aspect-square') ||
                                                card.classList.contains('aspect-\\[4\\/3\\]') ||
                                                card.classList.contains('overflow-hidden');
                        
                        // Check if this is hero section (has rounded-3xl with image inside)
                        const isHeroCard = card.classList.contains('rounded-3xl') && hasImage;
                        
                        // SKIP completely if it has image or is hero card
                        if (hasImage || isImageContainer || isHeroCard) {
                            return; // Don't apply ANY styling
                        }
                        
                        // Only apply to cards WITHOUT images
                        card.style.setProperty('background-color', '#374151', 'important');
                        card.style.setProperty('background-image', 'none', 'important');
                        card.style.color = '#f9fafb';
                        card.style.borderColor = '#4b5563';
                        
                        const cardElements = card.querySelectorAll('*');
                        cardElements.forEach(element => {
                            // Skip gradient text elements
                            if (!element.classList.contains('bg-clip-text') &&
                                !element.classList.contains('text-transparent') &&
                                !element.classList.contains('text-blue-600') && 
                                !element.classList.contains('text-green-600') && 
                                !element.classList.contains('text-red-600') &&
                                !element.classList.contains('text-yellow-500') &&
                                !element.classList.contains('text-yellow-400') &&
                                !element.classList.contains('text-purple-600') &&
                                !element.classList.contains('text-orange-500') &&
                                !element.classList.contains('text-white')) {
                                element.style.color = '#f9fafb';
                            }
                        });
                    });
                    
                    // Special handling for calendar in agenda section
                    const calendarElements = document.querySelectorAll('.grid.grid-cols-7, .text-center, .text-sm, .text-xs');
                    calendarElements.forEach(element => {
                        element.style.color = '#f9fafb';
                    });
                    
                    // Target specific calendar text elements
                    const calendarTexts = document.querySelectorAll('h3, h4, p, span, div');
                    calendarTexts.forEach(element => {
                        // Check if element is within agenda section
                        const agendaSection = element.closest('#agenda');
                        if (agendaSection) {
                            // Skip colored elements but apply to all other text
                            if (!element.classList.contains('text-blue-600') && 
                                !element.classList.contains('text-green-600') && 
                                !element.classList.contains('text-red-600') &&
                                !element.classList.contains('text-yellow-500') &&
                                !element.classList.contains('text-purple-600') &&
                                !element.classList.contains('text-orange-500') &&
                                !element.classList.contains('text-white')) {
                                element.style.color = '#f9fafb';
                            }
                        }
                    });
                    
                    // Force calendar container text to be visible
                    const calendarContainers = document.querySelectorAll('.bg-gradient-to-br, .bg-white');
                    calendarContainers.forEach(container => {
                        const agendaSection = container.closest('#agenda');
                        if (agendaSection) {
                            container.style.backgroundColor = '#374151';
                            container.style.color = '#f9fafb';
                            
                            // Apply to all child elements
                            const childElements = container.querySelectorAll('*');
                            childElements.forEach(child => {
                                if (!child.classList.contains('text-blue-600') && 
                                    !child.classList.contains('text-green-600') && 
                                    !child.classList.contains('text-red-600') &&
                                    !child.classList.contains('text-yellow-500') &&
                                    !child.classList.contains('text-purple-600') &&
                                    !child.classList.contains('text-orange-500') &&
                                    !child.classList.contains('text-white')) {
                                    child.style.color = '#f9fafb';
                                }
                            });
                        }
                    });
                    
                    // Additional aggressive targeting for agenda section
                    const agendaSection = document.querySelector('#agenda');
                    if (agendaSection) {
                        // Force all text elements in agenda to be visible
                        const allAgendaElements = agendaSection.querySelectorAll('*');
                        allAgendaElements.forEach(element => {
                            // Skip elements with specific color classes
                            if (!element.classList.contains('text-blue-600') && 
                                !element.classList.contains('text-green-600') && 
                                !element.classList.contains('text-red-600') &&
                                !element.classList.contains('text-yellow-500') &&
                                !element.classList.contains('text-purple-600') &&
                                !element.classList.contains('text-orange-500') &&
                                !element.classList.contains('text-white') &&
                                !element.classList.contains('text-gray-900') &&
                                !element.classList.contains('text-gray-700')) {
                                
                                // Force text color for all text-containing elements
                                if (element.tagName === 'H1' || element.tagName === 'H2' || 
                                    element.tagName === 'H3' || element.tagName === 'H4' || 
                                    element.tagName === 'H5' || element.tagName === 'H6' ||
                                    element.tagName === 'P' || element.tagName === 'SPAN' || 
                                    element.tagName === 'DIV' || element.tagName === 'TD' || 
                                    element.tagName === 'TH' || element.tagName === 'LI') {
                                    element.style.color = '#f9fafb';
                                }
                            }
                        });
                    }
                    
                    // Apply dark theme to specific Tailwind classes
                    const whiteElements = document.querySelectorAll('.bg-white');
                    whiteElements.forEach(element => {
                        element.style.setProperty('background-color', '#374151', 'important');
                        element.style.setProperty('background-image', 'none', 'important');
                    });
                    
                    const grayElements = document.querySelectorAll('.bg-gray-50, .bg-gray-100');
                    grayElements.forEach(element => {
                        element.style.setProperty('background-color', '#4b5563', 'important');
                        element.style.setProperty('background-image', 'none', 'important');
                    });
                    
                    const borderElements = document.querySelectorAll('.border-gray-200, .border-gray-300, .border-gray-100, .border-white');
                    borderElements.forEach(element => {
                        element.style.borderColor = '#4b5563';
                    });
                    
                    // Force all text-gray classes to light color
                    const textGrayElements = document.querySelectorAll('.text-gray-900, .text-gray-800, .text-gray-700, .text-gray-600, .text-gray-500');
                    textGrayElements.forEach(element => {
                        // Skip gradient text elements
                        if (!element.classList.contains('bg-clip-text') && !element.classList.contains('text-transparent')) {
                            element.style.setProperty('color', '#f9fafb', 'important');
                        }
                    });
                    
                    // Handle all gradient backgrounds
                    const gradientElements = document.querySelectorAll('[class*="bg-gradient"]');
                    gradientElements.forEach(element => {
                        // Don't override button gradients
                        if (!element.classList.contains('bg-blue-600') && 
                            !element.classList.contains('bg-blue-700') &&
                            !element.classList.contains('from-blue-600') &&
                            !element.classList.contains('from-blue-700')) {
                            element.style.setProperty('background-color', '#374151', 'important');
                            element.style.setProperty('background-image', 'none', 'important');
                        }
                    });
                    
                    // Ensure all images remain visible and unaffected
                    const allImages = document.querySelectorAll('img');
                    allImages.forEach(img => {
                        img.style.opacity = '1';
                        img.style.visibility = 'visible';
                        img.style.display = '';
                        img.style.filter = '';
                        img.style.zIndex = '10'; // Make sure image is on top
                        
                        // FORCE: Reset parent containers of images
                        let parent = img.parentElement;
                        let depth = 0;
                        while (parent && depth < 5) { // Check up to 5 levels
                            // Reset background for image parents
                            if (parent.classList.contains('bg-white') || 
                                parent.classList.contains('rounded-3xl') ||
                                parent.classList.contains('rounded-2xl') ||
                                parent.classList.contains('overflow-hidden') ||
                                parent.classList.contains('shadow-lg') ||
                                parent.classList.contains('shadow-xl') ||
                                parent.classList.contains('relative')) {
                                parent.style.removeProperty('background-color');
                                parent.style.removeProperty('background-image');
                                parent.style.backgroundColor = '';
                                parent.style.backgroundImage = '';
                                
                                // Reset all text inside to original color
                                const textElements = parent.querySelectorAll('h3, p, span, div');
                                textElements.forEach(text => {
                                    text.style.color = '';
                                });
                                
                                // Remove any overlay divs (gradient overlays)
                                const overlays = parent.querySelectorAll('.absolute.inset-0');
                                overlays.forEach(overlay => {
                                    // Check if it's a gradient overlay
                                    if (overlay.classList.contains('bg-gradient-to-t') || 
                                        overlay.classList.contains('bg-gradient-to-l') ||
                                        overlay.classList.contains('bg-black')) {
                                        overlay.style.display = 'none'; // Hide overlay
                                    }
                                });
                            }
                            parent = parent.parentElement;
                            depth++;
                        }
                    });
                    
                    // Apply dark theme to floating menu
                    if (floatingMenu) {
                        floatingMenu.classList.add('dark');
                    }
                    
                    // Update icons and text
                    lightIcon.classList.add('hidden');
                    darkIcon.classList.remove('hidden');
                    modeText.textContent = 'Tema Gelap';
                } else {
                    // Apply light theme to body
                    document.body.style.backgroundColor = '#ffffff';
                    document.body.style.color = '#000000';
                    
                    // Reset header/navbar
                    const header = document.querySelector('header');
                    if (header) {
                        header.style.backgroundColor = '';
                        header.style.color = '';
                        
                        const navElements = header.querySelectorAll('*');
                        navElements.forEach(element => {
                            element.style.color = '';
                        });
                        
                        const searchInput = header.querySelector('input');
                        if (searchInput) {
                            searchInput.style.backgroundColor = '';
                            searchInput.style.color = '';
                            searchInput.style.borderColor = '';
                        }
                        
                        const searchContainer = header.querySelector('.rounded-full.border');
                        if (searchContainer) {
                            searchContainer.style.backgroundColor = '';
                            searchContainer.style.borderColor = '';
                        }
                    }
                    
                    // Reset all sections
                    const sections = document.querySelectorAll('section');
                    sections.forEach(section => {
                        section.style.backgroundColor = '';
                        section.style.color = '';
                        
                        const allElements = section.querySelectorAll('*');
                        allElements.forEach(element => {
                            element.style.color = '';
                        });
                        
                        const buttons = section.querySelectorAll('button');
                        buttons.forEach(button => {
                            button.style.backgroundColor = '';
                            button.style.color = '';
                            button.style.borderColor = '';
                        });
                    });
                    
                    // Reset main content
                    const main = document.querySelector('main');
                    if (main) {
                        main.style.backgroundColor = '';
                        main.style.color = '';
                        
                        const mainElements = main.querySelectorAll('*');
                        mainElements.forEach(element => {
                            element.style.color = '';
                        });
                    }
                    
                    // Reset cards and containers
                    const cards = document.querySelectorAll('.bg-white, .bg-gray-50, .bg-gray-100, .bg-gradient-to-r, .bg-gradient-to-br, .bg-gradient-to-br.from-gray-50, .bg-gradient-to-br.from-blue-50');
                    cards.forEach(card => {
                        card.style.removeProperty('background-color');
                        card.style.removeProperty('background-image');
                        card.style.color = '';
                        card.style.borderColor = '';
                        
                        const cardElements = card.querySelectorAll('*');
                        cardElements.forEach(element => {
                            element.style.color = '';
                        });
                    });
                    
                    // Reset calendar elements
                    const calendarElements = document.querySelectorAll('.grid.grid-cols-7, .text-center, .text-sm, .text-xs');
                    calendarElements.forEach(element => {
                        element.style.color = '';
                    });
                    
                    // Reset specific calendar text elements
                    const calendarTexts = document.querySelectorAll('h3, h4, p, span, div');
                    calendarTexts.forEach(element => {
                        const agendaSection = element.closest('#agenda');
                        if (agendaSection) {
                            element.style.color = '';
                        }
                    });
                    
                    // Reset calendar containers
                    const calendarContainers = document.querySelectorAll('.bg-gradient-to-br, .bg-white');
                    calendarContainers.forEach(container => {
                        const agendaSection = container.closest('#agenda');
                        if (agendaSection) {
                            container.style.backgroundColor = '';
                            container.style.color = '';
                            
                            const childElements = container.querySelectorAll('*');
                            childElements.forEach(child => {
                                child.style.color = '';
                            });
                        }
                    });
                    
                    // Reset agenda section elements
                    const agendaSection = document.querySelector('#agenda');
                    if (agendaSection) {
                        const allAgendaElements = agendaSection.querySelectorAll('*');
                        allAgendaElements.forEach(element => {
                            element.style.color = '';
                        });
                    }
                    
                    // Reset specific elements
                    const whiteElements = document.querySelectorAll('.bg-white');
                    whiteElements.forEach(element => {
                        element.style.removeProperty('background-color');
                        element.style.removeProperty('background-image');
                    });
                    
                    const grayElements = document.querySelectorAll('.bg-gray-50, .bg-gray-100');
                    grayElements.forEach(element => {
                        element.style.removeProperty('background-color');
                        element.style.removeProperty('background-image');
                    });
                    
                    const borderElements = document.querySelectorAll('.border-gray-200, .border-gray-300, .border-gray-100, .border-white');
                    borderElements.forEach(element => {
                        element.style.borderColor = '';
                    });
                    
                    // Reset all text-gray classes
                    const textGrayElements = document.querySelectorAll('.text-gray-900, .text-gray-800, .text-gray-700, .text-gray-600, .text-gray-500');
                    textGrayElements.forEach(element => {
                        element.style.removeProperty('color');
                    });
                    
                    // Reset all gradient backgrounds
                    const gradientElements = document.querySelectorAll('[class*="bg-gradient"]');
                    gradientElements.forEach(element => {
                        element.style.removeProperty('background-color');
                        element.style.removeProperty('background-image');
                    });
                    
                    // Remove dark theme from floating menu
                    if (floatingMenu) {
                        floatingMenu.classList.remove('dark');
                    }
                    
                    // Update icons and text
                    lightIcon.classList.remove('hidden');
                    darkIcon.classList.add('hidden');
                    modeText.textContent = 'Tema Terang';
                }
            }

            // Toggle theme
            function toggleTheme() {
                isDarkMode = !isDarkMode;
                localStorage.setItem('darkMode', isDarkMode);
                initTheme();
            }

            // Toggle floating menu
            function toggleFloatingMenu() {
                const isOpen = floatingMenu.classList.contains('scale-0');
                
                if (isOpen) {
                    floatingMenu.classList.remove('scale-0', 'opacity-0');
                    floatingMenu.classList.add('scale-100', 'opacity-100');
                    burgerIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                } else {
                    floatingMenu.classList.add('scale-0', 'opacity-0');
                    floatingMenu.classList.remove('scale-100', 'opacity-100');
                    burgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            }

            // Close menu when clicking outside
            function closeMenuOnOutsideClick(event) {
                if (!burgerMenu.contains(event.target) && !floatingMenu.contains(event.target)) {
                    floatingMenu.classList.add('scale-0', 'opacity-0');
                    floatingMenu.classList.remove('scale-100', 'opacity-100');
                    burgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            }

            // Search functionality
            async function performSearch() {
                let query = '';
                
                // Get query from input or create attractive search modal
                if (searchInput && searchInput.value.trim()) {
                    query = searchInput.value.trim();
                } else {
                    query = await showSearchModal();
                }
                
                if (query) {
                    const sections = document.querySelectorAll('section');
                    let found = false;
                    let foundSection = null;
                    
                    // Search through all sections
                    sections.forEach(section => {
                        const text = section.textContent.toLowerCase();
                        if (text.includes(query.toLowerCase())) {
                            found = true;
                            foundSection = section;
                        }
                    });
                    
                    if (found && foundSection) {
                        // Scroll to the found section
                        foundSection.scrollIntoView({ 
                            behavior: 'smooth',
                            block: 'start'
                        });
                        
                        // Create attractive highlight effect
                        const originalBg = foundSection.style.backgroundColor;
                        const originalBorder = foundSection.style.border;
                        
                        // Add glowing effect
                        foundSection.style.backgroundColor = '#fef3c7';
                        foundSection.style.border = '3px solid #f59e0b';
                        foundSection.style.boxShadow = '0 0 20px rgba(245, 158, 11, 0.5)';
                        foundSection.style.transition = 'all 0.3s ease';
                        
                        // Show success notification
                        showNotification('✅ Ditemukan: "' + query + '"', 'success');
                        
                        // Remove highlight after 3 seconds
                        setTimeout(() => {
                            foundSection.style.backgroundColor = originalBg;
                            foundSection.style.border = originalBorder;
                            foundSection.style.boxShadow = '';
                        }, 3000);
                        
                        // Clear search input if it exists
                        if (searchInput) {
                            searchInput.value = '';
                        }
                    } else {
                        showNotification('❌ Tidak ditemukan: "' + query + '"', 'error');
                    }
                }
            }
            
            // Show minimalist search input
            function showSearchModal() {
                // Create simple search input that appears near the floating menu
                const searchContainer = document.createElement('div');
                searchContainer.style.cssText = `
                    position: fixed;
                    left: 80px;
                    top: 50%;
                    transform: translateY(-50%);
                    z-index: 9999;
                    background: white;
                    border: 2px solid #e5e7eb;
                    border-radius: 0.5rem;
                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                    padding: 0.5rem;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    min-width: 250px;
                `;
                
                searchContainer.innerHTML = `
                    <svg style="width: 1rem; height: 1rem; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" id="searchModalInput" placeholder="Cari konten..." style="
                        border: none;
                        outline: none;
                        flex: 1;
                        font-size: 0.875rem;
                        padding: 0.25rem;
                    ">
                    <button id="searchModalBtn" style="
                        background: #3b82f6;
                        color: white;
                        border: none;
                        padding: 0.25rem 0.5rem;
                        border-radius: 0.25rem;
                        font-size: 0.75rem;
                        cursor: pointer;
                        transition: background-color 0.2s;
                    " onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
                        Cari
                    </button>
                    <button id="cancelModalBtn" style="
                        background: #6b7280;
                        color: white;
                        border: none;
                        padding: 0.25rem 0.5rem;
                        border-radius: 0.25rem;
                        font-size: 0.75rem;
                        cursor: pointer;
                        transition: background-color 0.2s;
                    " onmouseover="this.style.backgroundColor='#4b5563'" onmouseout="this.style.backgroundColor='#6b7280'">
                        ✕
                    </button>
                `;
                
                document.body.appendChild(searchContainer);
                
                // Focus on input
                const input = searchContainer.querySelector('#searchModalInput');
                input.focus();
                
                // Return promise for search result
                return new Promise((resolve) => {
                    const searchBtn = searchContainer.querySelector('#searchModalBtn');
                    const cancelBtn = searchContainer.querySelector('#cancelModalBtn');
                    
                    const cleanup = () => {
                        if (document.body.contains(searchContainer)) {
                            document.body.removeChild(searchContainer);
                        }
                    };
                    
                    searchBtn.addEventListener('click', () => {
                        const query = input.value.trim();
                        cleanup();
                        resolve(query);
                    });
                    
                    cancelBtn.addEventListener('click', () => {
                        cleanup();
                        resolve('');
                    });
                    
                    input.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter') {
                            const query = input.value.trim();
                            cleanup();
                            resolve(query);
                        }
                    });
                    
                    // Close on escape key
                    const handleEscape = (e) => {
                        if (e.key === 'Escape') {
                            cleanup();
                            resolve('');
                            document.removeEventListener('keydown', handleEscape);
                        }
                    };
                    document.addEventListener('keydown', handleEscape);
                });
            }
            
            // Show notification
            function showNotification(message, type) {
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${type === 'success' ? '#10b981' : '#ef4444'};
                    color: white;
                    padding: 1rem 1.5rem;
                    border-radius: 0.5rem;
                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                    z-index: 10000;
                    font-weight: 600;
                    animation: slideIn 0.3s ease;
                `;
                
                notification.textContent = message;
                document.body.appendChild(notification);
                
                // Add animation
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes slideIn {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                `;
                document.head.appendChild(style);
                
                // Remove after 3 seconds
                setTimeout(() => {
                    notification.style.animation = 'slideIn 0.3s ease reverse';
                    setTimeout(() => {
                        if (document.body.contains(notification)) {
                            document.body.removeChild(notification);
                        }
                    }, 300);
                }, 3000);
            }

            // Mobile Nav Toggle
            const mobileNavToggle = document.getElementById('mobileNavToggle');
            const mobileNavMenu = document.getElementById('mobileNavMenu');
            
            if (mobileNavToggle) {
                mobileNavToggle.addEventListener('click', function() {
                    mobileNavMenu.classList.toggle('hidden');
                });
            }
            
            // Close mobile nav when clicking outside
            document.addEventListener('click', function(event) {
                if (mobileNavMenu && !mobileNavMenu.classList.contains('hidden')) {
                    if (!event.target.closest('#mobileNavToggle') && !event.target.closest('#mobileNavMenu')) {
                        mobileNavMenu.classList.add('hidden');
                    }
                }
            });
            
            // Event Listeners
            if (burgerMenu) {
                burgerMenu.addEventListener('click', toggleFloatingMenu);
            }
            
            if (accessibilityToggle) {
                accessibilityToggle.addEventListener('click', toggleTheme);
            }
            
            if (floatingSearch) {
                floatingSearch.addEventListener('click', performSearch);
            }
            
            document.addEventListener('click', closeMenuOnOutsideClick);

            // Search functionality for header search
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        performSearch();
                    }
                });
            }

            if (searchBtn) {
                searchBtn.addEventListener('click', function() {
                    performSearch();
                });
            }

            // Initialize theme on page load
            initTheme();
            
            // Reapply theme when new content is loaded (for dynamic content)
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                        // Reapply theme to new elements
                        setTimeout(initTheme, 100);
                    }
                });
            });
            
            // Start observing
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });

            // Simple client-side image uploader for Visi Misi cards
            for (let i = 1; i <= 4; i++) {
                const input = document.getElementById('visiUpload' + i);
                const preview = document.getElementById('visiPreview' + i);
                const label = input ? input.closest('label') : null;
                const trigger = label || (preview ? preview.parentElement : null);
                if (!input || !preview || !trigger) continue;
                trigger.addEventListener('click', function() { input.click(); });
                input.addEventListener('change', function(e) {
                    const file = e.target.files && e.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = function(ev) { preview.src = ev.target.result; };
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>

    <!-- Auth Modal for Public Users -->
    <div id="authModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="closeAuthModal()">
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full" onclick="event.stopPropagation()">
                <div class="bg-white px-8 pt-8 pb-8">
                    <button onclick="closeAuthModal()" class="absolute top-4 right-4 p-1 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="text-center mb-6">
                        <h3 id="authModalTitle" class="text-2xl font-bold text-gray-900 mb-2">Welcome Back!</h3>
                        <p id="authModalSubtitle" class="text-sm text-gray-500">We missed you! Please enter your details.</p>
                    </div>
                    <div id="loginForm">
                        <form onsubmit="handleLogin(event)" class="space-y-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Email</label>
                                <input type="email" name="email" required placeholder="Enter your Email" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="loginPassword" required placeholder="Enter your Password" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all pr-10">
                                    <button type="button" onclick="togglePassword('loginPassword')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center">
                                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label for="remember" class="ml-2 text-gray-600">Remember me</label>
                                </div>
                                <a href="#" onclick="event.preventDefault(); showForgotPasswordModal();" class="text-indigo-600 hover:text-indigo-700 font-medium">Forgot password?</a>
                            </div>
                            <div id="loginError" class="hidden p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                                <span></span>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors duration-200">
                                Sign in
                            </button>
                        </form>
                        <div class="mt-5">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200"></div>
                                </div>
                                <div class="relative flex justify-center text-xs">
                                    <span class="px-2 bg-white text-gray-500">or</span>
                                </div>
                            </div>
                            <button type="button" onclick="window.location.href='{{ route('auth.google') }}'" class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <svg class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Sign in with google</span>
                            </button>
                            <p class="mt-5 text-center text-sm text-gray-600">
                                Don't have an account? 
                                <button onclick="showRegisterForm()" class="text-indigo-600 hover:text-indigo-700 font-semibold">Sign up</button>
                            </p>
                        </div>
                    </div>
                    <div id="registerForm" class="hidden">
                        <form onsubmit="handleRegister(event)" class="space-y-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Full Name</label>
                                <input type="text" name="name" required placeholder="Enter your full name" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Email</label>
                                <input type="email" name="email" required placeholder="Enter your Email" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="registerPassword" required minlength="8" placeholder="Enter your Password (min. 8 characters)" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all pr-10">
                                    <button type="button" onclick="togglePassword('registerPassword')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Confirm Password</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="confirmPassword" required minlength="8" placeholder="Confirm your Password" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all pr-10">
                                    <button type="button" onclick="togglePassword('confirmPassword')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div id="registerError" class="hidden p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                                <span></span>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors duration-200">
                                Sign up
                            </button>
                        </form>
                        <div class="mt-5">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200"></div>
                                </div>
                                <div class="relative flex justify-center text-xs">
                                    <span class="px-2 bg-white text-gray-500">or</span>
                                </div>
                            </div>
                            <button type="button" onclick="window.location.href='{{ route('auth.google') }}'" class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <svg class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Sign up with google</span>
                            </button>
                            <p class="mt-5 text-center text-sm text-gray-600">
                                Already have an account? 
                                <button onclick="showLoginForm()" class="text-indigo-600 hover:text-indigo-700 font-semibold">Sign in</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgotPasswordModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="closeForgotPasswordModal()">
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
            </div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full" onclick="event.stopPropagation()">
                <div class="bg-white px-8 pt-8 pb-8">
                    <!-- Close button -->
                    <button onclick="closeForgotPasswordModal()" class="absolute top-4 right-4 p-1 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 rounded-full mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Forgot Password?</h3>
                        <p class="text-sm text-gray-500">Enter your email and we'll send you a reset link.</p>
                    </div>

                    <!-- Forgot Password Form -->
                    <form onsubmit="handleForgotPassword(event)" class="space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Email</label>
                            <input type="email" name="email" required placeholder="Enter your Email" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        </div>
                        <div id="forgotPasswordError" class="hidden p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                            <span></span>
                        </div>
                        <div id="forgotPasswordSuccess" class="hidden p-3 bg-green-50 border border-green-200 text-green-600 rounded-lg text-sm">
                            <span></span>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors duration-200">
                            Send Reset Link
                        </button>
                    </form>
                    <div class="mt-5 text-center">
                        <button onclick="closeForgotPasswordModal(); showAuthModal();" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold">
                            Back to Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reusable OTP Modal -->
    <div id="otpModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
            </div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full" onclick="event.stopPropagation()">
                <div class="bg-white px-8 pt-8 pb-8">
                    <!-- Close button -->
                    <button onclick="closeOtpModal()" class="absolute top-4 right-4 p-1 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 rounded-full mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Verifikasi OTP</h3>
                        <p class="text-sm text-gray-500 mb-1">Masukkan kode OTP yang telah dikirim ke:</p>
                        <p id="otpEmailDisplay" class="text-sm font-medium text-indigo-600"></p>
                    </div>

                    <!-- OTP Form -->
                    <form onsubmit="handleOtpVerify(event)" class="space-y-4">
                        <input type="hidden" id="otpEmail" name="email">
                        <input type="hidden" id="otpType" name="type">
                        
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Kode OTP (6 digit)</label>
                            <input 
                                type="text" 
                                id="otpInput" 
                                name="otp" 
                                required 
                                maxlength="6" 
                                pattern="[0-9]{6}"
                                placeholder="000000" 
                                class="w-full px-4 py-3 text-center text-2xl font-bold tracking-widest border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                autocomplete="off">
                        </div>
                        
                        <div id="otpError" class="hidden p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                            <span></span>
                        </div>
                        <div id="otpSuccess" class="hidden p-3 bg-green-50 border border-green-200 text-green-600 rounded-lg text-sm">
                            <span></span>
                        </div>
                        
                        <button type="submit" id="otpVerifyBtn" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors duration-200">
                            Verifikasi
                        </button>
                    </form>
                    
                    <!-- Resend OTP -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600 mb-2">Tidak menerima kode?</p>
                        <button onclick="resendOtpCode()" id="resendOtpBtn" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold">
                            Kirim Ulang Kode
                        </button>
                        <p id="resendOtpTimer" class="text-xs text-gray-500 mt-1"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Public User Auth JavaScript -->
    <script>
        // Global variables for OTP
        let otpResendTimeout = 60;
        let otpResendInterval = null;

        // Auth Modal Functions
        function showAuthModal() {
            document.getElementById('authModal').classList.remove('hidden');
            showLoginForm();
        }

        function closeAuthModal() {
            document.getElementById('authModal').classList.add('hidden');
            document.getElementById('loginError').classList.add('hidden');
            document.getElementById('registerError').classList.add('hidden');
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }

        function showLoginForm() {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('authModalTitle').textContent = 'Welcome Back!';
            document.getElementById('authModalSubtitle').textContent = 'We missed you! Please enter your details.';
        }

        function showRegisterForm() {
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerForm').classList.remove('hidden');
            document.getElementById('authModalTitle').textContent = 'Create Account';
            document.getElementById('authModalSubtitle').textContent = 'Join us today! Please fill in your details.';
        }

        function showForgotPasswordModal() {
            closeAuthModal();
            document.getElementById('forgotPasswordModal').classList.remove('hidden');
        }

        function closeForgotPasswordModal() {
            document.getElementById('forgotPasswordModal').classList.add('hidden');
            document.getElementById('forgotPasswordError').classList.add('hidden');
            document.getElementById('forgotPasswordSuccess').classList.add('hidden');
        }

        async function handleLogin(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const errorDiv = document.getElementById('loginError');

            try {
                const response = await fetch('{{ route("public.login") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: formData.get('email'),
                        password: formData.get('password'),
                        remember: formData.get('remember') === 'on'
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Check if user needs OTP verification
                    if (data.show_otp_modal) {
                        closeAuthModal();
                        showOtpModal(data.email, data.type);
                        return;
                    }
                    // User is verified, reload page
                    window.location.reload();
                } else {
                    errorDiv.querySelector('span').textContent = data.message || 'Login gagal';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                errorDiv.querySelector('span').textContent = error.message || 'Terjadi kesalahan';
                errorDiv.classList.remove('hidden');
            }
        }

        async function handleRegister(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const errorDiv = document.getElementById('registerError');

            // Get form values
            const name = formData.get('name');
            const email = formData.get('email');
            const password = formData.get('password');
            const password_confirmation = formData.get('password_confirmation');

            // Client-side validation
            if (!name || name.trim().length === 0) {
                errorDiv.querySelector('span').textContent = 'Nama tidak boleh kosong';
                errorDiv.classList.remove('hidden');
                return;
            }

            if (!email || email.trim().length === 0) {
                errorDiv.querySelector('span').textContent = 'Email tidak boleh kosong';
                errorDiv.classList.remove('hidden');
                return;
            }

            if (!password || password.length < 8) {
                errorDiv.querySelector('span').textContent = 'Password minimal 8 karakter';
                errorDiv.classList.remove('hidden');
                return;
            }

            if (password !== password_confirmation) {
                errorDiv.querySelector('span').textContent = 'Password tidak cocok';
                errorDiv.classList.remove('hidden');
                return;
            }

            try {
                const response = await fetch('{{ route("public.register") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        password: password,
                        password_confirmation: password_confirmation
                    })
                });

                const data = await response.json();
                console.log('Register response:', data);

                if (data.success) {
                    // Show OTP modal for verification
                    if (data.show_otp_modal) {
                        closeAuthModal();
                        showOtpModal(data.email, data.type);
                        form.reset();
                        return;
                    }
                    window.location.reload();
                } else {
                    errorDiv.querySelector('span').textContent = data.message || 'Registrasi gagal';
                    errorDiv.classList.remove('hidden');
                    console.error('Register error:', data);
                }
            } catch (error) {
                const errorMessage = error.message || 'Terjadi kesalahan';
                errorDiv.querySelector('span').textContent = errorMessage;
                errorDiv.classList.remove('hidden');
                console.error('Register exception:', error);
            }
        }

        async function handleLogout() {
            try {
                const response = await fetch('{{ route("public.logout") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    window.location.reload();
                }
            } catch (error) {
                console.error('Logout error:', error);
            }
        }

        async function handleForgotPassword(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const errorDiv = document.getElementById('forgotPasswordError');
            const successDiv = document.getElementById('forgotPasswordSuccess');
            const emailInput = formData.get('email');
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            
            try {
                const response = await fetch('{{ route("password.email") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: emailInput
                    })
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    errorDiv.querySelector('span').textContent = data.message || 'Email tidak ditemukan';
                    errorDiv.classList.remove('hidden');
                    return;
                }
                
                if (data.success) {
                    // Show OTP modal instead of success message
                    if (data.show_otp_modal) {
                        closeForgotPasswordModal();
                        showOtpModal(data.email, data.type);
                        form.reset();
                        return;
                    }
                    successDiv.querySelector('span').textContent = data.message || 'Link reset password telah dikirim ke email Anda';
                    successDiv.classList.remove('hidden');
                    form.reset();
                    setTimeout(() => { closeForgotPasswordModal(); }, 3000);
                } else {
                    errorDiv.querySelector('span').textContent = data.message || 'Terjadi kesalahan';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                errorDiv.querySelector('span').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
            }
        }

        // OTP Modal Functions
        function showOtpModal(email, type) {
            document.getElementById('otpModal').classList.remove('hidden');
            document.getElementById('otpEmail').value = email;
            document.getElementById('otpType').value = type;
            document.getElementById('otpEmailDisplay').textContent = email;
            document.getElementById('otpInput').value = '';
            document.getElementById('otpError').classList.add('hidden');
            document.getElementById('otpSuccess').classList.add('hidden');
            
            // Start resend timer
            startOtpResendTimer();
        }

        function closeOtpModal() {
            document.getElementById('otpModal').classList.add('hidden');
            if (otpResendInterval) {
                clearInterval(otpResendInterval);
            }
        }

        function startOtpResendTimer() {
            const resendBtn = document.getElementById('resendOtpBtn');
            const timerDisplay = document.getElementById('resendOtpTimer');
            let timeLeft = otpResendTimeout;
            
            resendBtn.disabled = true;
            resendBtn.classList.add('opacity-50', 'cursor-not-allowed');
            
            otpResendInterval = setInterval(() => {
                timeLeft--;
                timerDisplay.textContent = `Kirim ulang dalam ${timeLeft} detik`;
                
                if (timeLeft <= 0) {
                    clearInterval(otpResendInterval);
                    resendBtn.disabled = false;
                    resendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    timerDisplay.textContent = '';
                }
            }, 1000);
        }

        async function resendOtpCode() {
            const email = document.getElementById('otpEmail').value;
            const type = document.getElementById('otpType').value;
            const errorDiv = document.getElementById('otpError');
            
            try {
                const route = type === 'register' ? '{{ route("public.register.resend") }}' : '{{ route("password.email") }}';
                
                const response = await fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email: email })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    startOtpResendTimer();
                    alert('Kode OTP baru telah dikirim ke email Anda');
                } else {
                    errorDiv.querySelector('span').textContent = data.message || 'Gagal mengirim ulang kode';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                errorDiv.querySelector('span').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
            }
        }

        async function handleOtpVerify(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const errorDiv = document.getElementById('otpError');
            const successDiv = document.getElementById('otpSuccess');
            const email = formData.get('email');
            const otp = formData.get('otp');
            const type = formData.get('type');
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            
            try {
                const route = type === 'register' ? '{{ route("public.register.verify") }}' : '{{ route("password.verify-otp") }}';
                
                const response = await fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: email,
                        otp: otp
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    successDiv.querySelector('span').textContent = data.message;
                    successDiv.classList.remove('hidden');
                    
                    setTimeout(() => {
                        closeOtpModal();
                        if (type === 'register') {
                            window.location.reload();
                        } else {
                            // Redirect to reset password page or show reset form
                            window.location.href = data.redirect || '/';
                        }
                    }, 1500);
                } else {
                    errorDiv.querySelector('span').textContent = data.message || 'Kode OTP tidak valid';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                errorDiv.querySelector('span').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
            }
        }
    </script>

</body>
</html>

