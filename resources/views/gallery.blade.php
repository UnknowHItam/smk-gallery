<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galeri Kegiatan SMKN 4 Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Enhanced Gallery Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }
            100% {
                background-position: 200% center;
            }
        }

        @keyframes floatUp {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes floatDown {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(15px);
            }
        }

        @keyframes floatLeft {
            0%, 100% {
                transform: translateX(0px);
            }
            50% {
                transform: translateX(-10px);
            }
        }

        @keyframes floatRight {
            0%, 100% {
                transform: translateX(0px);
            }
            50% {
                transform: translateX(10px);
            }
        }

        #galleryPopup {
            animation: fadeIn 0.3s ease-out;
        }

        #galleryPopup > div > div {
            animation: slideIn 0.3s ease-out;
        }

        /* Enhanced gallery item animations */
        [data-gallery-item] {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        [data-gallery-item]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.5s;
        }

        [data-gallery-item]:hover::before {
            left: 100%;
        }

        [data-gallery-item]:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        [data-gallery-item] .aspect-\[4\/3\] {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-gallery-item]:hover .aspect-\[4\/3\] {
            transform: scale(1.05);
        }

        /* Masonry Grid Enhancements */
        #galleryGrid {
            column-fill: balance;
        }

        /* Simple Fade In */
        [data-gallery-item] {
            animation: fadeIn 0.4s ease-out forwards;
            opacity: 0;
        }

        [data-gallery-item]:nth-child(n) { animation-delay: calc(0.05s * var(--item-index, 0)); }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Custom scrollbar for thumbnails */
        #galleryThumbnails::-webkit-scrollbar {
            height: 6px;
        }

        #galleryThumbnails::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #galleryThumbnails::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        #galleryThumbnails::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* Enhanced pagination styling */
        .pagination {
            display: flex;
            gap: 0.5rem;
        }

        .pagination .page-item {
            display: inline-block;
        }

        .pagination .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
            background: white;
            color: #6b7280;
            text-decoration: none;
        }

        .pagination .page-link:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.2);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            #galleryPopup .sm\:w-64 {
                width: 100%;
            }

            #galleryPopup .sm\:flex-row {
                flex-direction: column;
            }

            #galleryPopup .sm\:max-w-4xl {
                max-width: 95%;
            }

            [data-gallery-item]:hover {
                transform: translateY(-4px) scale(1.01);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen">
    <!-- Header / Navbar - Sticky -->
    <header class="fixed top-0 left-0 right-0 z-50 w-full bg-white/90 backdrop-blur border-b border-gray-200 transition-colors duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-9 object-contain">
                    <a href="{{ route('home') }}" class="text-lg sm:text-xl font-semibold tracking-wide text-gray-900">SMKN 4 BOGOR</a>
                </div>

                <div class="flex items-center gap-3">
                    <nav class="hidden md:flex items-center gap-6 text-sm mr-4">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-700 flex items-center gap-2 transition-colors"><span class="inline-block">🏠</span> Beranda</a>
                        <a href="{{ route('gallery') }}" class="text-blue-700 font-medium flex items-center gap-2"><span class="inline-block">🖼️</span> Gallery</a>
                        <a href="{{ route('home') }}#berita" class="text-gray-700 hover:text-blue-700 flex items-center gap-2 transition-colors"><span class="inline-block">🎯</span> Kegiatan</a>
                        <a href="{{ route('home') }}#kontak" class="text-gray-700 hover:text-blue-700 flex items-center gap-2 transition-colors"><span class="inline-block">✉️</span> Kontak</a>
                    </nav>
                    <form method="GET" action="{{ route('gallery') }}" class="hidden sm:flex items-center gap-2 rounded-full border border-gray-300 px-3 py-1 text-sm bg-white">
                        <span>🔍</span>
                        <input type="text" name="search" id="searchInput" value="{{ $search ?? '' }}" placeholder="Cari gallery..." class="outline-none border-0 focus:ring-0 p-0 text-sm placeholder-gray-400 bg-transparent w-40">
                        @if(isset($category) && $category)
                            <input type="hidden" name="category" value="{{ $category }}">
                        @endif
                    </form>
                    <button id="searchBtn" class="sm:hidden bg-blue-700 hover:bg-blue-800 text-white p-2 rounded-full transition-colors">
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
        </div>
    </header>

    <!-- Spacer untuk mengkompensasi fixed navbar -->
    <div class="h-16"></div>


    <!-- Enhanced Hero Section - Half Page with Popular Posts -->
    <section class="relative bg-white overflow-hidden" style="min-height: 50vh;">
        <!-- Subtle Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/20"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Main Hero Section - 2/3 width -->
                <div class="lg:col-span-2">
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl overflow-hidden shadow-xl h-full">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-0 items-center h-full min-h-[400px]">
                            <!-- Left Content -->
                            <div class="p-8 md:p-10 text-white space-y-6">
                                <!-- Title -->
                                <div>
                                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-2">
                                        GALLERY
                                    </h1>
                                    <p class="text-blue-100 text-lg">Dokumentasi Kegiatan Sekolah</p>
                                </div>

                                <!-- Stats -->
                                <div class="flex gap-4">
                                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl px-5 py-3 min-w-[80px] text-center">
                                        <div class="text-3xl font-bold">{{ $posts->total() }}</div>
                                        <div class="text-xs opacity-90 mt-1">Total Posts</div>
                                    </div>
                                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl px-5 py-3 min-w-[80px] text-center">
                                        <div class="text-3xl font-bold">{{ $categories->count() }}</div>
                                        <div class="text-xs opacity-90 mt-1">Categories</div>
                                    </div>
                                </div>

                                <!-- Category Pills -->
                                <div class="flex flex-wrap gap-2 pt-2">
                                    <a href="{{ route('gallery') }}" class="px-4 py-2 {{ !$category || $category == 'all' ? 'bg-white text-blue-700' : 'bg-white/20 text-white hover:bg-white/30' }} rounded-full text-sm font-medium transition-all duration-300">
                                        Semua
                                    </a>
                                    <a href="{{ route('gallery', ['category' => 'Kejuaraan']) }}" class="px-4 py-2 {{ $category == 'Kejuaraan' ? 'bg-white text-blue-700' : 'bg-white/20 text-white hover:bg-white/30' }} rounded-full text-sm font-medium transition-all duration-300">
                                        Kejuaraan
                                    </a>
                                    <a href="{{ route('gallery', ['category' => 'Kegiatan']) }}" class="px-4 py-2 {{ $category == 'Kegiatan' ? 'bg-white text-blue-700' : 'bg-white/20 text-white hover:bg-white/30' }} rounded-full text-sm font-medium transition-all duration-300">
                                        Kegiatan
                                    </a>
                                </div>
                            </div>

                            <!-- Right Content - Image -->
                            <div class="relative h-[300px] md:h-full">
                                <img src="{{ asset('images/hero-campus.jpg') }}" alt="Gallery Hero" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-l from-transparent to-blue-700/40"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Posts Sidebar - 1/3 width -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl p-6 h-full">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span>Terpopuler</span>
                            </h3>
                            <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Top 3</span>
                        </div>

                        <div class="space-y-4">
                            @forelse($popularPosts as $index => $popular)
                                <div class="group cursor-pointer" onclick="openGalleryDetail({{ $popular->id }})">
                                    <div class="flex gap-3 p-3 rounded-2xl hover:bg-gray-50 transition-all duration-300">
                                        <!-- Rank Badge -->
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 rounded-xl {{ $index == 0 ? 'bg-gradient-to-br from-yellow-400 to-yellow-600' : ($index == 1 ? 'bg-gradient-to-br from-gray-300 to-gray-500' : 'bg-gradient-to-br from-orange-400 to-orange-600') }} flex items-center justify-center text-white font-bold shadow-md">
                                                {{ $index + 1 }}
                                            </div>
                                        </div>

                                        <!-- Thumbnail -->
                                        <div class="flex-shrink-0 w-16 h-16 rounded-xl overflow-hidden bg-gray-100">
                                            @if($popular->galery->count() > 0 && $popular->galery->first()->foto->count() > 0)
                                                <img src="{{ asset('storage/posts/' . $popular->galery->first()->foto->first()->file) }}" 
                                                     alt="{{ $popular->judul }}" 
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-sm text-gray-900 line-clamp-2 mb-1 group-hover:text-blue-600 transition-colors">
                                                {{ $popular->judul }}
                                            </h4>
                                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                                <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="font-medium">{{ $popular->total_likes ?? 0 }} likes</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                    </div>
                                    <p class="text-sm text-gray-500">Belum ada postingan populer</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Enhanced Main Content with Masonry Layout -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        @if($posts->count() > 0)
            <!-- Modern Masonry Grid -->
            <div id="galleryGrid" class="columns-1 md:columns-2 lg:columns-3 xl:columns-4 gap-6 lg:gap-8 space-y-6 lg:space-y-8">
                @foreach($posts as $post)
                    <article
                        class="group break-inside-avoid mb-6 lg:mb-8"
                        data-gallery-item
                        data-post-id="{{ $post->id }}"
                        data-post-json='@json($post)'
                        style="cursor: pointer;"
                    >
                        <div class="bg-white rounded-2xl overflow-hidden transform hover:-translate-y-1 transition-all duration-300 shadow-sm hover:shadow-xl border border-gray-100">
                            <!-- Enhanced Image Container with Dynamic Height -->
                            <div class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-50">
                                @if($post->galery->count() > 0 && $post->galery->first()->foto->count() > 0)
                                    <img src="{{ asset('storage/posts/' . $post->galery->first()->foto->first()->file) }}"
                                         alt="{{ $post->judul }}"
                                         class="w-full h-auto object-cover group-hover:scale-110 transition-transform duration-700"
                                         loading="lazy">
                                @else
                                    <div class="w-full aspect-[4/3] bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Photo Count Badge with Icon -->
                                @if($post->galery->count() > 0)
                                    <div class="absolute top-4 right-4 z-10">
                                        <span class="photo-count-badge px-3 py-1.5 bg-white/90 backdrop-blur-sm text-gray-900 text-xs font-semibold rounded-full flex items-center space-x-1.5 shadow-lg">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ $post->galery->sum(fn($g) => $g->foto->count()) }}</span>
                                        </span>
                                    </div>
                                @endif

                                <!-- Simple Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <!-- Clean Content Card -->
                            <div class="p-5">
                                <!-- Title -->
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 text-base leading-snug group-hover:text-blue-600 transition-colors duration-300">
                                    {{ $post->judul }}
                                </h3>

                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($post->isi), 80) }}
                                </p>

                                <!-- Meta Information -->
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ $post->created_at->format('d M Y') }}</span>
                                    <span class="text-blue-600 font-medium">Read More →</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            <div class="mt-12 lg:mt-16">
                <div class="flex justify-center">
                    {{ $posts->appends(request()->query())->links() }}
                </div>
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16 lg:py-20">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Tidak ada kegiatan ditemukan</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto leading-relaxed">
                    @if($search)
                        Tidak ada hasil untuk pencarian "{{ $search }}"
                    @elseif($category && $category !== 'all')
                        Tidak ada kegiatan dalam kategori "{{ $category }}"
                    @else
                        Belum ada kegiatan yang dipublikasikan saat ini
                    @endif
                </p>
                @if($search || ($category && $category !== 'all'))
                    <a href="{{ route('gallery') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-2xl font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        Lihat Semua Kegiatan
                    </a>
                @endif
            </div>
        @endif
    </main>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Custom Pagination Styling */
        .pagination {
            display: flex;
            gap: 0.5rem;
        }
        
        .pagination .page-item {
            display: inline-block;
        }
        
        .pagination .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
            background: white;
            color: #6b7280;
            text-decoration: none;
        }
        
        .pagination .page-link:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .pagination .page-item.active .page-link {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
    </style>
    <!-- OLD POPUP - DISABLED (Using new modal instead) -->
    <div id="galleryPopup" class="fixed inset-0 z-50 hidden overflow-y-auto" style="display: none !important;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Enhanced Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900/80 backdrop-blur-sm"></div>
            </div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full max-h-[90vh] overflow-y-auto">
                <div class="bg-white px-6 pt-6 pb-4">
                    <!-- Enhanced Header -->
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex-1">
                            <h3 id="popupTitle" class="text-2xl font-bold text-gray-900 mb-2 leading-tight"></h3>
                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                <span id="popupCategory" class="px-3 py-1 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 rounded-full font-medium"></span>
                                <span id="popupDate" class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0v10a2 2 0 002 2h4a2 2 0 002-2V7m-6 0H6a2 2 0 00-2 2v10a2 2 0 002 2h4"/>
                                    </svg>
                                </span>
                                <span id="popupPhotoCount" class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <button onclick="closeGalleryPopup()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Enhanced Main Image -->
                    <div class="mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl overflow-hidden shadow-lg">
                        <img id="popupMainImage" src="" alt="" class="w-full h-72 sm:h-96 object-cover">
                    </div>

                    <!-- Enhanced Content Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left Column - Description -->
                        <div class="lg:col-span-2">
                            <div class="mb-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-3 flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span>Deskripsi Kegiatan</span>
                                </h4>
                                <div id="popupDescription" class="text-gray-700 text-base leading-relaxed bg-gray-50 rounded-xl p-4 border border-gray-100"></div>
                            </div>
                        </div>

                        <!-- Right Column - Info & Actions -->
                        <div class="space-y-4">
                            <!-- Info Cards -->
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-4 border border-blue-100">
                                <h5 class="text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wider">Informasi</h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Kategori</span>
                                        <span id="popupCategory2" class="text-sm font-medium text-gray-900 bg-white px-2 py-1 rounded-lg"></span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Tanggal</span>
                                        <span id="popupDate2" class="text-sm font-medium text-gray-900 bg-white px-2 py-1 rounded-lg"></span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Total Foto</span>
                                        <span id="popupPhotoCount2" class="text-sm font-medium text-gray-900 bg-white px-2 py-1 rounded-lg"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <button onclick="downloadCurrentImage()" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Download Gambar
                                </button>

                                <button onclick="openAllPhotosPopup()" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Lihat Semua Foto
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Gallery Navigation -->
                    <div class="mt-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            <span>Galeri Lainnya</span>
                        </h4>
                        <div id="galleryThumbnails" class="flex space-x-3 overflow-x-auto pb-2">
                            <!-- Thumbnails will be added here by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- OLD ALL PHOTOS POPUP - DISABLED -->
    <div id="allPhotosPopup" class="fixed inset-0 z-50 hidden overflow-y-auto" style="display: none !important;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900/90 backdrop-blur-sm"></div>
            </div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full max-h-[90vh] overflow-y-auto">
                <div class="bg-white px-6 pt-6 pb-6">
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-6 pb-4 border-b border-gray-200">
                        <div>
                            <h3 id="allPhotosTitle" class="text-2xl font-bold text-gray-900 mb-2"></h3>
                            <p id="allPhotosCount" class="text-sm text-gray-600"></p>
                        </div>
                        <button onclick="closeAllPhotosPopup()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Photos Grid -->
                    <div id="allPhotosGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- Photos will be inserted here by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let currentImageUrl = '';
        let currentPostData = null;

        // Function to open gallery popup
        function openGalleryPopup(post) {
            currentPostData = post; // Store current post data
            const popup = document.getElementById('galleryPopup');
            const popupTitle = document.getElementById('popupTitle');
            const popupDescription = document.getElementById('popupDescription');
            const popupCategory = document.getElementById('popupCategory');
            const popupCategory2 = document.getElementById('popupCategory2');
            const popupDate = document.getElementById('popupDate');
            const popupDate2 = document.getElementById('popupDate2');
            const popupPhotoCount = document.getElementById('popupPhotoCount');
            const popupPhotoCount2 = document.getElementById('popupPhotoCount2');
            const popupMainImage = document.getElementById('popupMainImage');
            const galleryThumbnails = document.getElementById('galleryThumbnails');

            // Set basic information
            popupTitle.textContent = post.judul;
            popupDescription.innerHTML = post.isi || 'Tidak ada deskripsi yang tersedia.';

            // Set category
            const categoryText = post.kategori ? post.kategori.judul : 'Tidak ada kategori';
            popupCategory.textContent = categoryText;
            popupCategory2.textContent = categoryText;

            // Set date
            const dateText = new Date(post.created_at).toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            popupDate.textContent = dateText;
            popupDate2.textContent = dateText;

            // Count total photos
            let photoCount = 0;
            if (post.galery && post.galery.length > 0) {
                photoCount = post.galery.reduce((total, gallery) => total + (gallery.foto ? gallery.foto.length : 0), 0);

                // Set main image (first photo of first gallery)
                const firstPhoto = post.galery[0].foto[0];
                if (firstPhoto) {
                    const imageUrl = `{{ asset('storage/posts/') }}/${firstPhoto.file}`;
                    popupMainImage.src = imageUrl;
                    popupMainImage.alt = post.judul;
                    currentImageUrl = imageUrl; // Track current image URL
                }

                // Add thumbnails
                galleryThumbnails.innerHTML = '';
                post.galery.forEach(gallery => {
                    if (gallery.foto && gallery.foto.length > 0) {
                        gallery.foto.forEach(photo => {
                            const thumb = document.createElement('button');
                            thumb.className = 'flex-shrink-0 w-20 h-20 rounded-xl overflow-hidden border-2 border-transparent hover:border-blue-500 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105';
                            thumb.innerHTML = `
                                <img src="{{ asset('storage/posts/') }}/${photo.file}"
                                     alt=""
                                     class="w-full h-full object-cover"
                                     onclick="changeMainImage(this, '{{ asset('storage/posts/') }}/${photo.file}')">
                            `;
                            galleryThumbnails.appendChild(thumb);
                        });
                    }
                });

                // Highlight first thumbnail
                if (galleryThumbnails.firstChild) {
                    galleryThumbnails.firstChild.classList.add('border-blue-500');
                }
            } else {
                // No photos available
                popupMainImage.src = '{{ asset('images/default-image.jpg') }}';
                popupMainImage.alt = 'Gambar tidak tersedia';
                currentImageUrl = '{{ asset('images/default-image.jpg') }}';
                galleryThumbnails.innerHTML = '<p class="text-sm text-gray-500 py-4">Tidak ada foto tersedia</p>';
            }

            popupPhotoCount.textContent = `${photoCount} Foto`;
            popupPhotoCount2.textContent = `${photoCount} Foto`;

            // Show the popup
            popup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Function to close gallery popup
        function closeGalleryPopup() {
            const popup = document.getElementById('galleryPopup');
            popup.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Function to change main image when thumbnail is clicked
        function changeMainImage(thumb, imageSrc) {
            const popupMainImage = document.getElementById('popupMainImage');
            const thumbnails = document.querySelectorAll('#galleryThumbnails button');

            // Update main image
            popupMainImage.src = imageSrc;
            currentImageUrl = imageSrc; // Update current image URL

            // Update active thumbnail
            thumbnails.forEach(btn => {
                btn.classList.remove('border-blue-500');
            });
            thumb.parentElement.classList.add('border-blue-500');
        }

        // Function to download current image
        function downloadCurrentImage() {
            if (!isPublicUserAuthenticated) {
                pendingDownloadAction = () => downloadCurrentImage();
                showAuthModal();
                return;
            }

            if (currentImageUrl) {
                const link = document.createElement('a');
                link.href = currentImageUrl;
                link.download = currentImageUrl.split('/').pop();
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                showNotification('Download dimulai!', 'success');
            }
        }

        // Function to download individual photo
        function downloadPhoto(imageUrl, filename) {
            if (!isPublicUserAuthenticated) {
                pendingDownloadAction = () => downloadPhoto(imageUrl, filename);
                showAuthModal();
                return;
            }

            const link = document.createElement('a');
            link.href = imageUrl;
            link.download = filename || imageUrl.split('/').pop();
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            showNotification('Download dimulai!', 'success');
        }

        // Function to open all photos popup
        function openAllPhotosPopup() {
            if (!currentPostData) return;

            const popup = document.getElementById('allPhotosPopup');
            const title = document.getElementById('allPhotosTitle');
            const count = document.getElementById('allPhotosCount');
            const grid = document.getElementById('allPhotosGrid');

            // Set title
            title.textContent = currentPostData.judul;

            // Collect all photos
            let allPhotos = [];
            if (currentPostData.galery && currentPostData.galery.length > 0) {
                currentPostData.galery.forEach(gallery => {
                    if (gallery.foto && gallery.foto.length > 0) {
                        gallery.foto.forEach(photo => {
                            allPhotos.push({
                                file: photo.file,
                                judul: photo.judul || 'Foto'
                            });
                        });
                    }
                });
            }

            // Set count
            count.textContent = `Total ${allPhotos.length} foto dalam galeri ini`;

            // Clear and populate grid
            grid.innerHTML = '';
            allPhotos.forEach((photo, index) => {
                const imageUrl = `{{ asset('storage/posts/') }}/${photo.file}`;
                const photoCard = document.createElement('div');
                photoCard.className = 'group relative bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1';
                photoCard.innerHTML = `
                    <div class="aspect-square overflow-hidden">
                        <img src="${imageUrl}" 
                             alt="${photo.judul}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <p class="text-white text-sm font-medium mb-2">${photo.judul}</p>
                        <button onclick="downloadPhoto('${imageUrl}', '${photo.file}')" 
                                class="flex items-center justify-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download
                        </button>
                    </div>
                `;
                grid.appendChild(photoCard);
            });

            // Show popup
            popup.classList.remove('hidden');
        }

        // Function to close all photos popup
        function closeAllPhotosPopup() {
            const popup = document.getElementById('allPhotosPopup');
            popup.classList.add('hidden');
        }

        // Close popup when clicking outside the content
        document.addEventListener('click', function(event) {
            const popup = document.getElementById('galleryPopup');
            const popupContent = document.querySelector('#galleryPopup > div');

            if (event.target === popup) {
                closeGalleryPopup();
            }
        });

        // Close popup with Escape key
        document.addEventListener('keydown', function(event) {
            const popup = document.getElementById('galleryPopup');
            if (event.key === 'Escape' && !popup.classList.contains('hidden')) {
                closeGalleryPopup();
            }
        });

        // Initialize gallery items
        document.addEventListener('DOMContentLoaded', function() {
            // Add click handlers to gallery items
            document.querySelectorAll('[data-gallery-item]').forEach(item => {
                item.addEventListener('click', function() {
                    const postId = this.dataset.postId;
                    if (postId) {
                        openGalleryDetail(postId);
                    }
                });
            });

            // Smooth Scroll Behavior
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Removed parallax effect for cleaner performance

            // Lazy Load Images with Intersection Observer
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px'
            });

            document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                imageObserver.observe(img);
            });

            // Add hover effect sound (optional - can be removed)
            galleryItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)';
                });
            });
        });

        // Keyboard Navigation for Popup
        document.addEventListener('keydown', function(event) {
            const popup = document.getElementById('galleryPopup');
            if (!popup.classList.contains('hidden')) {
                if (event.key === 'ArrowLeft') {
                    // Navigate to previous image
                    const thumbnails = document.querySelectorAll('#galleryThumbnails button');
                    const activeIndex = Array.from(thumbnails).findIndex(btn => 
                        btn.classList.contains('border-blue-500')
                    );
                    if (activeIndex > 0) {
                        thumbnails[activeIndex - 1].querySelector('img').click();
                    }
                } else if (event.key === 'ArrowRight') {
                    // Navigate to next image
                    const thumbnails = document.querySelectorAll('#galleryThumbnails button');
                    const activeIndex = Array.from(thumbnails).findIndex(btn => 
                        btn.classList.contains('border-blue-500')
                    );
                    if (activeIndex < thumbnails.length - 1) {
                        thumbnails[activeIndex + 1].querySelector('img').click();
                    }
                }
            }
        });
    </script>

    <!-- Auth Modal for Public Users - Simple Clean Design -->
    <div id="authModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="closeAuthModal()">
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
            </div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full" onclick="event.stopPropagation()">
                <div class="bg-white px-8 pt-8 pb-8">
                    <!-- Close button -->
                    <button onclick="closeAuthModal()" class="absolute top-4 right-4 p-1 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="text-center mb-6">
                        <h3 id="authModalTitle" class="text-2xl font-bold text-gray-900 mb-2">Welcome Back!</h3>
                        <p id="authModalSubtitle" class="text-sm text-gray-500">We missed you! Please enter your details.</p>
                    </div>

                    <!-- Login Form -->
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

                    <!-- Register Form -->
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

    <!-- Reset Password Modal -->
    <div id="resetPasswordModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
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
                    <button onclick="closeResetPasswordModal()" class="absolute top-4 right-4 p-1 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 rounded-full mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Reset Password</h3>
                        <p class="text-sm text-gray-500">Enter your new password below.</p>
                    </div>

                    <!-- Reset Password Form -->
                    <form onsubmit="handleResetPassword(event)" class="space-y-4">
                        <input type="hidden" id="resetToken" name="token">
                        <input type="hidden" id="resetEmail" name="email">
                        
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">New Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="newPassword" required minlength="8" placeholder="Enter new password (min. 8 characters)" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all pr-10">
                                <button type="button" onclick="togglePassword('newPassword')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
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
                                <input type="password" name="password_confirmation" id="confirmNewPassword" required minlength="8" placeholder="Confirm new password" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all pr-10">
                                <button type="button" onclick="togglePassword('confirmNewPassword')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <div id="resetPasswordError" class="hidden p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                            <span></span>
                        </div>
                        <div id="resetPasswordSuccess" class="hidden p-3 bg-green-50 border border-green-200 text-green-600 rounded-lg text-sm">
                            <span></span>
                        </div>
                        
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors duration-200">
                            Reset Password
                        </button>
                    </form>
                    
                    <div class="mt-5 text-center">
                        <button onclick="closeResetPasswordModal()" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold">
                            Back to Gallery
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

    <!-- Auth Modal Scripts -->
    <script>
        // Global auth variables (accessible from other scripts)
        window.isPublicUserAuthenticated = false;
        window.publicUserData = null;
        let pendingDownloadAction = null;
        let otpResendTimeout = 60;
        let otpResendInterval = null;

        // Check authentication status on page load
        async function checkPublicAuth() {
            try {
                const response = await fetch('{{ route("public.user") }}');
                const data = await response.json();
                window.isPublicUserAuthenticated = data.authenticated;
                window.publicUserData = data.user;
                console.log('Auth check complete:', window.isPublicUserAuthenticated, window.publicUserData);
                updateAuthUI();
            } catch (error) {
                console.error('Auth check error:', error);
            }
        }

        // Update UI based on auth status
        function updateAuthUI() {
            const userAuthStatus = document.getElementById('userAuthStatus');
            const userNameDisplay = document.getElementById('userNameDisplay');

            if (window.isPublicUserAuthenticated && window.publicUserData) {
                userAuthStatus.classList.remove('hidden');
                userAuthStatus.classList.add('flex');
                userNameDisplay.textContent = window.publicUserData.name;
            } else {
                userAuthStatus.classList.add('hidden');
            }
        }

        // Handle logout
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
                    isPublicUserAuthenticated = false;
                    publicUserData = null;
                    // refresh so navbar state reflects immediately
                    window.location.reload();
                }
            } catch (error) {
                console.error('Logout error:', error);
                showNotification('Terjadi kesalahan saat logout', 'error');
            }
        }

        // Show auth modal
        function showAuthModal() {
            document.getElementById('authModal').classList.remove('hidden');
            showLoginForm();
        }

        // Close auth modal
        function closeAuthModal() {
            document.getElementById('authModal').classList.add('hidden');
            document.getElementById('loginError').classList.add('hidden');
            document.getElementById('registerError').classList.add('hidden');
            pendingDownloadAction = null;
        }

        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }

        // Show login form
        function showLoginForm() {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('authModalTitle').textContent = 'Welcome Back!';
            document.getElementById('authModalSubtitle').textContent = 'We missed you! Please enter your details.';
        }

        // Show register form
        function showRegisterForm() {
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerForm').classList.remove('hidden');
            document.getElementById('authModalTitle').textContent = 'Create Account';
            document.getElementById('authModalSubtitle').textContent = 'Join us today! Please fill in your details.';
        }

        // Show forgot password modal
        function showForgotPasswordModal() {
            closeAuthModal();
            document.getElementById('forgotPasswordModal').classList.remove('hidden');
        }

        // Close forgot password modal
        function closeForgotPasswordModal() {
            document.getElementById('forgotPasswordModal').classList.add('hidden');
            document.getElementById('forgotPasswordError').classList.add('hidden');
            document.getElementById('forgotPasswordSuccess').classList.add('hidden');
        }

        // Handle forgot password
        async function handleForgotPassword(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const errorDiv = document.getElementById('forgotPasswordError');
            const successDiv = document.getElementById('forgotPasswordSuccess');
            const emailInput = formData.get('email');
            
            console.log('Forgot password - Email:', emailInput);
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            
            try {
                console.log('Sending request to:', '{{ route("password.email") }}');
                
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
                
                console.log('Response status:', response.status);
                console.log('Response ok:', response.ok);
                
                // Try to get response text first
                const responseText = await response.text();
                console.log('Response text:', responseText);
                
                // Parse JSON
                let data;
                try {
                    data = JSON.parse(responseText);
                } catch (parseError) {
                    console.error('JSON parse error:', parseError);
                    errorDiv.querySelector('span').textContent = 'Server error: Invalid response format';
                    errorDiv.classList.remove('hidden');
                    return;
                }
                
                console.log('Parsed data:', data);
                
                // Check if response is ok (status 200-299)
                if (!response.ok) {
                    errorDiv.querySelector('span').textContent = data.message || 'Email tidak ditemukan';
                    errorDiv.classList.remove('hidden');
                    return;
                }
                
                if (data.success) {
                    console.log('Success! Show OTP modal:', data.show_otp_modal);
                    
                    // Show OTP modal instead of redirecting
                    if (data.show_otp_modal) {
                        console.log('Closing forgot password modal...');
                        closeForgotPasswordModal();
                        
                        console.log('Showing OTP modal with email:', data.email, 'type:', data.type);
                        showOtpModal(data.email, data.type);
                        
                        form.reset();
                        return;
                    }
                    successDiv.querySelector('span').textContent = data.message;
                    successDiv.classList.remove('hidden');
                    form.reset();
                    setTimeout(() => { closeForgotPasswordModal(); }, 2000);
                } else {
                    console.error('Request failed:', data.message);
                    errorDiv.querySelector('span').textContent = data.message || 'Terjadi kesalahan';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Forgot password error:', error);
                console.error('Error stack:', error.stack);
                errorDiv.querySelector('span').textContent = 'Error: ' + error.message;
                errorDiv.classList.remove('hidden');
            }
        }

        // Resend verification email
        async function resendVerificationEmail() {
            try {
                const response = await fetch('{{ route("verification.resend") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'error');
                }
            } catch (error) {
                showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
            }
        }

        // Handle login
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

        // Handle register
        async function handleRegister(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const errorDiv = document.getElementById('registerError');

            try {
                const response = await fetch('{{ route("public.register") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: formData.get('name'),
                        email: formData.get('email'),
                        password: formData.get('password'),
                        password_confirmation: formData.get('password_confirmation')
                    })
                });

                const data = await response.json();

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
                }
            } catch (error) {
                const errorMessage = error.message || 'Terjadi kesalahan';
                errorDiv.querySelector('span').textContent = errorMessage;
                errorDiv.classList.remove('hidden');
            }
        }

        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-2xl transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-600' : 'bg-red-600'
            } text-white`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
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
            
            // Auto-focus OTP input
            setTimeout(() => {
                document.getElementById('otpInput').focus();
            }, 100);
            
            // Start resend timer
            startOtpResendTimer();
        }

        function closeOtpModal() {
            document.getElementById('otpModal').classList.add('hidden');
            if (otpResendInterval) {
                clearInterval(otpResendInterval);
            }
        }

        // Only allow numbers in OTP input
        document.getElementById('otpInput').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Handle OTP verification
        async function handleOtpVerify(event) {
            event.preventDefault();
            
            const email = document.getElementById('otpEmail').value;
            const otp = document.getElementById('otpInput').value;
            const type = document.getElementById('otpType').value;
            
            const errorDiv = document.getElementById('otpError');
            const successDiv = document.getElementById('otpSuccess');
            const verifyBtn = document.getElementById('otpVerifyBtn');
            
            console.log('Verifying OTP:', { email, otp, type });
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            verifyBtn.disabled = true;
            verifyBtn.textContent = 'Memverifikasi...';
            
            try {
                console.log('Sending OTP verify request...');
                const startTime = Date.now();
                
                const response = await fetch('{{ route("otp.verify") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email, otp, type })
                });
                
                console.log('Response received in', Date.now() - startTime, 'ms');
                console.log('Response status:', response.status);
                
                const data = await response.json();
                console.log('Response data:', data);
                
                if (data.success) {
                    successDiv.querySelector('span').textContent = data.message;
                    successDiv.classList.remove('hidden');
                    
                    // Reduce delay from 1500ms to 500ms for faster UX
                    setTimeout(() => {
                        // For reset password, show modal instead of redirect
                        if (type === 'reset' && data.redirect) {
                            // Extract token and email from redirect URL
                            const url = new URL(data.redirect, window.location.origin);
                            const token = url.searchParams.get('token');
                            const email = url.searchParams.get('email');
                            
                            closeOtpModal();
                            showResetPasswordModal(token, email);
                        } else if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.reload();
                        }
                    }, 500);
                } else {
                    errorDiv.querySelector('span').textContent = data.message;
                    errorDiv.classList.remove('hidden');
                    verifyBtn.disabled = false;
                    verifyBtn.textContent = 'Verifikasi';
                }
            } catch (error) {
                errorDiv.querySelector('span').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
                verifyBtn.disabled = false;
                verifyBtn.textContent = 'Verifikasi';
            }
        }

        // Resend OTP code
        async function resendOtpCode() {
            const resendBtn = document.getElementById('resendOtpBtn');
            const errorDiv = document.getElementById('otpError');
            const successDiv = document.getElementById('otpSuccess');
            const email = document.getElementById('otpEmail').value;
            const type = document.getElementById('otpType').value;
            
            if (otpResendTimeout > 0) {
                return;
            }
            
            resendBtn.disabled = true;
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            
            try {
                const response = await fetch('{{ route("otp.resend") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email, type })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    successDiv.querySelector('span').textContent = data.message;
                    successDiv.classList.remove('hidden');
                    startOtpResendTimer();
                } else {
                    errorDiv.querySelector('span').textContent = data.message;
                    errorDiv.classList.remove('hidden');
                    resendBtn.disabled = false;
                }
            } catch (error) {
                errorDiv.querySelector('span').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
                resendBtn.disabled = false;
            }
        }

        // Start OTP resend timer
        function startOtpResendTimer() {
            const resendBtn = document.getElementById('resendOtpBtn');
            const timerDiv = document.getElementById('resendOtpTimer');
            
            otpResendTimeout = 60;
            resendBtn.disabled = true;
            
            if (otpResendInterval) {
                clearInterval(otpResendInterval);
            }
            
            otpResendInterval = setInterval(() => {
                otpResendTimeout--;
                timerDiv.textContent = `Kirim ulang dalam ${otpResendTimeout} detik`;
                
                if (otpResendTimeout <= 0) {
                    clearInterval(otpResendInterval);
                    resendBtn.disabled = false;
                    timerDiv.textContent = '';
                }
            }, 1000);
        }

        // Reset Password Modal Functions
        function showResetPasswordModal(token, email) {
            document.getElementById('resetPasswordModal').classList.remove('hidden');
            document.getElementById('resetToken').value = token;
            document.getElementById('resetEmail').value = email;
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmNewPassword').value = '';
            document.getElementById('resetPasswordError').classList.add('hidden');
            document.getElementById('resetPasswordSuccess').classList.add('hidden');
        }

        function closeResetPasswordModal() {
            document.getElementById('resetPasswordModal').classList.add('hidden');
        }

        // Handle Reset Password
        async function handleResetPassword(event) {
            event.preventDefault();
            
            const form = event.target;
            const formData = new FormData(form);
            const errorDiv = document.getElementById('resetPasswordError');
            const successDiv = document.getElementById('resetPasswordSuccess');
            
            console.log('Resetting password...');
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            
            try {
                console.log('Sending reset password request to:', '{{ route("password.update") }}');
                
                const response = await fetch('{{ route("password.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        token: formData.get('token'),
                        email: formData.get('email'),
                        password: formData.get('password'),
                        password_confirmation: formData.get('password_confirmation')
                    })
                });
                
                console.log('Reset password response status:', response.status);
                
                // Get response text first
                const responseText = await response.text();
                console.log('Response text:', responseText);
                
                // Parse JSON
                let data;
                try {
                    data = JSON.parse(responseText);
                } catch (parseError) {
                    console.error('JSON parse error:', parseError);
                    errorDiv.querySelector('span').textContent = 'Server error: Invalid response';
                    errorDiv.classList.remove('hidden');
                    return;
                }
                
                console.log('Parsed data:', data);
                
                if (data.success) {
                    successDiv.querySelector('span').textContent = data.message;
                    successDiv.classList.remove('hidden');
                    
                    setTimeout(() => {
                        closeResetPasswordModal();
                        showNotification('Password berhasil direset! Silakan login dengan password baru.', 'success');
                        showAuthModal();
                    }, 2000);
                } else {
                    errorDiv.querySelector('span').textContent = data.message || 'Terjadi kesalahan';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Reset password error:', error);
                errorDiv.querySelector('span').textContent = 'Error: ' + error.message;
                errorDiv.classList.remove('hidden');
            }
        }

        // Check auth on page load
        checkPublicAuth();
    </script>

    <!-- Include Gallery Detail Modal -->
    <x-gallery-detail-modal />

    <!-- Include Gallery Detail Modal JavaScript -->
    <script src="{{ asset('js/gallery-detail-modal.js') }}?v={{ time() }}"></script>
</body>
</html>
