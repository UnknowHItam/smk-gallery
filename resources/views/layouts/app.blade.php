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
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-9 object-contain">
                    <a href="{{ route('home') }}" class="text-lg sm:text-xl font-semibold tracking-wide">SMKN 4 BOGOR</a>
                </div>

                <div class="flex items-center gap-3">
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

                    @guest
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-4 py-2 rounded-full">
                            <span>Login</span>
                        </a>
                    @endguest

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-full">Logout</button>
                        </form>
                    @endauth
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

</body>
</html>

