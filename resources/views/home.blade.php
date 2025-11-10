@extends('layouts.app')

@section('content')
    <!-- Hero Section - Modern Card Layout -->
    <section class="py-8 md:py-16 bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 relative overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-pulse"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-2xl opacity-15 animate-pulse animation-delay-2000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center min-h-[600px]">
                <!-- Left Content - Welcome Text -->
                <div class="lg:col-span-5 space-y-8">
                    <div class="space-y-6">
                        <div class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm rounded-full shadow-lg border border-white/20">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                            <span class="text-sm font-medium text-gray-700">Welcome KR4B4T at</span>
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                            Sekolah Pusat
                            <br>
                            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent font-serif">
                                Keunggulan
                            </span>
                        </h1>
                        
                        <p class="text-lg md:text-xl text-gray-600 leading-relaxed max-w-lg">
                            Membangun generasi unggul dengan pendidikan berkualitas, teknologi terdepan, dan karakter yang kuat.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('gallery') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl font-semibold shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                                Lihat Gallery
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Hero Cards -->
                <div class="lg:col-span-7">
                    <div class="relative">
                        <!-- Main Hero Card -->
                        <div class="relative group">
                            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform group-hover:-translate-y-2 transition-all duration-500">
                                <div class="aspect-[4/3] relative overflow-hidden">
                                    <img src="{{ asset('images/hero-campus.jpg') }}" alt="SMK Negeri 4 Bogor" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                                    
                                    <!-- Floating Info Card -->
                                    <div class="absolute bottom-6 left-6 right-6">
                                        <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-4 shadow-xl border border-white/20">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h3 class="font-bold text-gray-900 text-lg">SMK Negeri 4 Bogor</h3>
                                                    <p class="text-gray-600 text-sm">Sekolah Menengah Kejuruan Unggulan</p>
                                                </div>
                                                <div class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <span class="text-sm font-semibold text-gray-700">4.9</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Achievement Cards -->
                        <div class="absolute -top-4 -right-4 bg-white rounded-2xl p-4 shadow-xl border border-gray-100 animate-bounce animation-delay-1000">
                            <div class="text-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <p class="text-xs font-semibold text-gray-700">Terakreditasi A</p>
                            </div>
                        </div>

                        <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl p-4 shadow-xl border border-gray-100 animate-bounce animation-delay-2000">
                            <div class="text-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-xs font-semibold text-gray-700">2000+ Alumni</p>
                            </div>
                        </div>

                        <!-- Decorative Elements -->
                        <div class="absolute top-1/2 -right-8 w-16 h-16 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full opacity-20 animate-pulse animation-delay-3000"></div>
                        <div class="absolute -top-8 left-1/2 w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full opacity-30 animate-pulse animation-delay-1500"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section - Enhanced Design -->
    <section id="visi" class="py-16 md:py-20 bg-gradient-to-br from-blue-50 via-white to-purple-50 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
            <div class="absolute -bottom-10 -right-10 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-15 animate-pulse animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900">
                    VISI & MISI
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left side - Enhanced Image Grid -->
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4 md:gap-6">
                        <div class="space-y-4 md:space-y-6">
                            <div class="group aspect-square rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                                <img src="{{ asset('images/visi-1.jpg') }}" alt="Visi 1" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="group aspect-square rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animation-delay-200">
                                <img src="{{ asset('images/visi-3.jpg') }}" alt="Visi 3" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        <div class="space-y-4 md:space-y-6 mt-8">
                            <div class="group aspect-square rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animation-delay-100">
                                <img src="{{ asset('images/visi-2.jpg') }}" alt="Visi 2" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="group aspect-square rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animation-delay-300">
                                <img src="{{ asset('images/visi-4.jpg') }}" alt="Visi 4" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Decorative Elements -->
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full opacity-20 animate-bounce animation-delay-1000"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full opacity-30 animate-bounce animation-delay-2000"></div>
                </div>
                
                <!-- Right side - Enhanced Content -->
                <div class="space-y-8">
                    <!-- Visi Card -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-xl border border-white/20 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">VISI</h3>
                        </div>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            Menjadi SMK unggul yang menghasilkan lulusan berkarakter, kompeten, dan siap bersaing di era global dengan berlandaskan nilai-nilai Pancasila.
                        </p>
                    </div>

                    <!-- Misi Card -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-xl border border-white/20 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">MISI</h3>
                        </div>
                        <ul class="space-y-4">
                            <li class="flex items-start group">
                                <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center mr-4 mt-1 shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 leading-relaxed">Menyelenggarakan pendidikan berkualitas dengan kurikulum yang relevan dan up-to-date</span>
                            </li>
                            <li class="flex items-start group">
                                <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center mr-4 mt-1 shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 leading-relaxed">Mengembangkan kompetensi siswa melalui pembelajaran praktik dan teori yang seimbang</span>
                            </li>
                            <li class="flex items-start group">
                                <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-purple-400 to-purple-500 rounded-full flex items-center justify-center mr-4 mt-1 shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 leading-relaxed">Menciptakan lingkungan belajar yang kondusif, inovatif, dan berkarakter</span>
                            </li>
                            <li class="flex items-start group">
                                <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-orange-400 to-orange-500 rounded-full flex items-center justify-center mr-4 mt-1 shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 leading-relaxed">Membangun kemitraan dengan industri untuk menjamin kesiapan kerja lulusan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section with Tabs - Exact match to mockup -->
    <section id="berita" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Tab Navigation -->
            <div class="flex justify-center mb-8">
                <div class="flex bg-white rounded-lg shadow-sm border">
                    <button id="tab-berita" class="tab-btn px-6 py-3 text-sm font-medium text-blue-600 bg-blue-50 border-b-2 border-blue-600 rounded-l-lg" data-tab="berita">
                        🎯 Kegiatan
                    </button>
                    <button id="tab-kejuaraan" class="tab-btn px-6 py-3 text-sm font-medium text-gray-600 hover:text-blue-600" data-tab="kejuaraan">
                        🏆 Kejuaraan
                    </button>
                    <button id="tab-eskul" class="tab-btn px-6 py-3 text-sm font-medium text-gray-600 hover:text-blue-600" data-tab="eskul">
                        ⚽ Eskul
                    </button>
                    <button id="tab-agenda" class="tab-btn px-6 py-3 text-sm font-medium text-gray-600 hover:text-blue-600 rounded-r-lg" data-tab="agenda">
                        📅 Agenda
                    </button>
                </div>
            </div>
            
            <!-- Tab Content -->
            <div id="tab-content">
                <!-- Berita Content -->
                <div id="content-berita" class="tab-content active">
                    <!-- View All News Button -->
                    <div class="text-center mb-8">
                        <a href="{{ route('gallery') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            Lihat Semua Kegiatan →
                        </a>
                    </div>
                    
                    @if($kegiatan->count() > 0)
                        @foreach($kegiatan as $index => $post)
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center {{ $index > 0 ? 'mt-8' : '' }}">
                                <div class="aspect-video rounded-2xl overflow-hidden">
                                    @if($post->galery->count() > 0 && $post->galery->first()->foto->count() > 0)
                                        @php
                                            $fotoUtama = $post->galery->first()->foto->where('judul', 'Foto Utama')->first() ?? $post->galery->first()->foto->first();
                                        @endphp
                                        <img src="{{ asset('storage/posts/' . $fotoUtama->file) }}" 
                                             alt="{{ $post->judul }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-100 to-green-100 flex items-center justify-center">
                                            <span class="text-gray-500 text-lg">Tidak ada foto</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                        {{ $post->judul }}
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ Str::limit($post->isi, 200) }}
                                    </p>
                                    <div class="mt-4 text-sm text-gray-500">
                                        {{ $post->created_at ? $post->created_at->format('d M Y') : '' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <div class="aspect-video bg-gradient-to-br from-blue-100 to-green-100 rounded-2xl flex items-center justify-center">
                                <div class="text-center">
                                    <p class="text-gray-500 text-lg mb-2">Belum ada kegiatan</p>
                                    <p class="text-gray-400 text-sm">Silakan tambahkan kegiatan melalui admin panel</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Kejuaraan Content -->
                <div id="content-kejuaraan" class="tab-content hidden">
                    <div class="text-center mb-8">
                        <a href="{{ route('gallery', ['category' => 'Kejuaraan']) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            Lihat Semua Kejuaraan →
                        </a>
                    </div>
                    
                    @if($kejuaraanPosts->count() > 0)
                        @foreach($kejuaraanPosts as $index => $post)
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center {{ $index > 0 ? 'mt-8' : '' }}">
                                <div class="aspect-video rounded-2xl overflow-hidden">
                                    @if($post->galery->count() > 0 && $post->galery->first()->foto->count() > 0)
                                        @php
                                            $fotoUtama = $post->galery->first()->foto->where('judul', 'Foto Utama')->first() ?? $post->galery->first()->foto->first();
                                        @endphp
                                        <img src="{{ asset('storage/posts/' . $fotoUtama->file) }}" 
                                             alt="{{ $post->judul }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-yellow-100 to-orange-100 flex items-center justify-center">
                                            <span class="text-gray-500 text-lg">Tidak ada foto</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                        {{ $post->judul }}
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ Str::limit($post->isi, 200) }}
                                    </p>
                                    <div class="mt-4 text-sm text-gray-500">
                                        {{ $post->created_at ? $post->created_at->format('d M Y') : '' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <div class="aspect-video bg-gradient-to-br from-yellow-100 to-orange-100 rounded-2xl flex items-center justify-center">
                                <div class="text-center">
                                    <p class="text-gray-500 text-lg mb-2">Belum ada kejuaraan</p>
                                    <p class="text-gray-400 text-sm">Silakan tambahkan kejuaraan melalui admin panel</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Eskul Content -->
                <div id="content-eskul" class="tab-content hidden">
                    <div class="text-center mb-8">
                        <a href="{{ route('gallery', ['category' => 'Ekstrakurikuler']) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            Lihat Semua Ekstrakurikuler →
                        </a>
                    </div>
                    
                    @if($eskulPosts->count() > 0)
                        @foreach($eskulPosts as $index => $post)
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center {{ $index > 0 ? 'mt-8' : '' }}">
                                <div class="aspect-video rounded-2xl overflow-hidden">
                                    @if($post->galery->count() > 0 && $post->galery->first()->foto->count() > 0)
                                        @php
                                            $fotoUtama = $post->galery->first()->foto->where('judul', 'Foto Utama')->first() ?? $post->galery->first()->foto->first();
                                        @endphp
                                        <img src="{{ asset('storage/posts/' . $fotoUtama->file) }}" 
                                             alt="{{ $post->judul }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-green-100 to-blue-100 flex items-center justify-center">
                                            <span class="text-gray-500 text-lg">Tidak ada foto</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                        {{ $post->judul }}
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ Str::limit($post->isi, 200) }}
                                    </p>
                                    <div class="mt-4 text-sm text-gray-500">
                                        {{ $post->created_at ? $post->created_at->format('d M Y') : '' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <div class="aspect-video bg-gradient-to-br from-green-100 to-blue-100 rounded-2xl flex items-center justify-center">
                                <div class="text-center">
                                    <p class="text-gray-500 text-lg mb-2">Belum ada ekstrakurikuler</p>
                                    <p class="text-gray-400 text-sm">Silakan tambahkan ekstrakurikuler melalui admin panel</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Agenda Content -->
                <div id="content-agenda" class="tab-content hidden">
                    <div class="text-center mb-8">
                        <a href="{{ route('gallery', ['category' => 'Agenda']) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            Lihat Semua Agenda →
                        </a>
                    </div>
                    
                    @if($agendaPosts->count() > 0)
                        @foreach($agendaPosts as $index => $post)
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center {{ $index > 0 ? 'mt-8' : '' }}">
                                <div class="aspect-video rounded-2xl overflow-hidden">
                                    @if($post->galery->count() > 0 && $post->galery->first()->foto->count() > 0)
                                        @php
                                            $fotoUtama = $post->galery->first()->foto->where('judul', 'Foto Utama')->first() ?? $post->galery->first()->foto->first();
                                        @endphp
                                        <img src="{{ asset('storage/posts/' . $fotoUtama->file) }}" 
                                             alt="{{ $post->judul }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                                            <span class="text-gray-500 text-lg">Tidak ada foto</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                        {{ $post->judul }}
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ Str::limit($post->isi, 200) }}
                                    </p>
                                    <div class="mt-4 text-sm text-gray-500">
                                        {{ $post->created_at ? $post->created_at->format('d M Y') : '' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <div class="aspect-video bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl flex items-center justify-center">
                                <div class="text-center">
                                    <p class="text-gray-500 text-lg mb-2">Belum ada agenda</p>
                                    <p class="text-gray-400 text-sm">Silakan tambahkan agenda melalui admin panel</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Kejuaraan Section - Dynamic content from database -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">KEJUARAAN</h2>
            
            @if($kejuaraanPosts->count() > 0)
                <div class="flex items-center">
                    <!-- Left Button -->
                    <button id="prevBtn" class="flex-shrink-0 mr-4 bg-white shadow-lg rounded-full p-3 hover:bg-gray-50 transition-colors border border-gray-200 z-10">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Carousel Container -->
                    <div class="flex-1 overflow-hidden">
                        <div id="carouselTrack" class="flex transition-transform duration-300 ease-in-out pb-4">
                        @foreach($kejuaraanPosts as $index => $post)
                            <div class="w-full md:w-1/3 flex-shrink-0 px-3 mb-4">
                                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <!-- Image Container -->
                                    <div class="aspect-[4/3] relative overflow-hidden">
                                        @if($post->galery->count() > 0 && $post->galery->first()->foto->count() > 0)
                                            @php
                                                $fotoUtamaRecent = $post->galery->first()->foto->where('judul', 'Foto Utama')->first() ?? $post->galery->first()->foto->first();
                                            @endphp
                                            <img src="{{ asset('storage/posts/' . $fotoUtamaRecent->file) }}" 
                                                 alt="{{ $post->judul }}" 
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br 
                                                @if($index % 5 == 0) from-blue-100 to-blue-200
                                                @elseif($index % 5 == 1) from-green-100 to-green-200
                                                @elseif($index % 5 == 2) from-indigo-100 to-indigo-200
                                                @elseif($index % 5 == 3) from-purple-100 to-purple-200
                                                @else from-pink-100 to-pink-200
                                                @endif
                                                flex items-center justify-center">
                                                <div class="w-16 h-16 bg-white/30 rounded-full flex items-center justify-center">
                                                    <span class="text-2xl">🏆</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Content Container -->
                                    <div class="p-6 h-48 flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center justify-between mb-3">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    🏆 Kejuaraan
                                                </span>
                                                <span class="text-gray-500 text-xs">
                                                    {{ $post->created_at ? $post->created_at->format('d M Y') : '' }}
                                                </span>
                                            </div>
                                            
                                            <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2 leading-tight">
                                                {{ $post->judul }}
                                            </h3>
                                            
                                            <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed mb-3">
                                                {{ Str::limit($post->isi, 100) }}
                                            </p>
                                        </div>
                                        
                                        <div class="flex items-center justify-between mt-auto">
                                            <a href="#berita" onclick="showKejuaraanTab()" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors">
                                                Baca Selengkapnya →
                                            </a>
                                            <div class="flex items-center text-gray-400 text-xs">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Lihat Detail
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    
                    <!-- Right Button -->
                    <button id="nextBtn" class="flex-shrink-0 ml-4 bg-white shadow-lg rounded-full p-3 hover:bg-gray-50 transition-colors border border-gray-200 z-10">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Placeholder Card 1 -->
                        <div class="aspect-[4/3] bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-end p-6">
                            <p class="text-gray-800 font-medium">Belum ada data kejuaraan</p>
                        </div>
                        <!-- Placeholder Card 2 -->
                        <div class="aspect-[4/3] bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-end p-6">
                            <p class="text-gray-800 font-medium">Silakan tambahkan melalui admin panel</p>
                        </div>
                        <!-- Placeholder Card 3 -->
                        <div class="aspect-[4/3] bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-2xl flex items-end p-6">
                            <p class="text-gray-800 font-medium">Kategori: Kejuaraan</p>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- View All Button -->
            <div class="text-center mt-8">
                <a href="{{ route('gallery', ['category' => 'Kejuaraan']) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Lihat Semua Kejuaraan →
                </a>
            </div>
        </div>
    </section>

    <!-- Ekstrakurikuler Section - Exact match to mockup -->
    <section id="ekskul" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">EKSTRAKULIKULER</h2>
            
            @if($ekstrakurikulers->count() > 0)
                <div class="flex items-center">
                    <!-- Left Button -->
                    <button id="prevBtnEkskul" class="flex-shrink-0 mr-4 bg-white shadow-lg rounded-full p-3 hover:bg-gray-50 transition-colors border border-gray-200 z-10">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Carousel Container -->
                    <div class="flex-1 overflow-hidden">
                        <div id="carouselTrackEkskul" class="flex transition-transform duration-300 ease-in-out pb-4">
                            @foreach($ekstrakurikulers as $ekstrakurikuler)
                                <div class="w-1/2 md:w-1/3 lg:w-1/5 flex-shrink-0 px-2 mb-4">
                                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                        <div class="aspect-square relative">
                                            @if($ekstrakurikuler->foto)
                                                <img src="{{ asset('storage/ekstrakurikuler/' . $ekstrakurikuler->foto) }}" 
                                                     alt="{{ $ekstrakurikuler->nama }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                                        <span class="text-white text-lg">⚽</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-4 h-40 flex flex-col justify-between">
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1">{{ $ekstrakurikuler->nama }}</h3>
                                                <p class="text-gray-600 text-xs mb-2 line-clamp-2">{{ Str::limit($ekstrakurikuler->deskripsi, 50) }}</p>
                                                @if($ekstrakurikuler->pembina)
                                                    <p class="text-gray-500 text-xs mb-1 line-clamp-1">Pembina: {{ $ekstrakurikuler->pembina }}</p>
                                                @endif
                                                @if($ekstrakurikuler->hari_kegiatan)
                                                    <p class="text-gray-500 text-xs mb-2 line-clamp-1">{{ $ekstrakurikuler->hari_kegiatan }} 
                                                        @if($ekstrakurikuler->jam_mulai)
                                                            {{ $ekstrakurikuler->jam_mulai }}
                                                            @if($ekstrakurikuler->jam_selesai)
                                                                - {{ $ekstrakurikuler->jam_selesai }}
                                                            @endif
                                                        @endif
                                                    </p>
                                                @endif
                                            </div>
                                            <button onclick="showEkstrakurikulerModal({{ json_encode($ekstrakurikuler) }})" class="text-blue-600 hover:text-blue-800 font-medium text-xs mt-auto text-left">Read More →</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Right Button -->
                    <button id="nextBtnEkskul" class="flex-shrink-0 ml-4 bg-white shadow-lg rounded-full p-3 hover:bg-gray-50 transition-colors border border-gray-200 z-10">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="text-gray-500 text-lg mb-2">Belum ada ekstrakurikuler</div>
                    <div class="text-gray-400 text-sm">Silakan tambahkan ekstrakurikuler melalui admin panel</div>
                </div>
            @endif
            
        </div>
    </section>

    <!-- Agenda Section - Modern Minimalist Clean -->
    <section id="agenda" class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-3">Agenda Sekolah</h2>
                <p class="text-gray-600">Jadwal kegiatan dan acara sekolah bulan ini</p>
            </div>

            <!-- Main Container -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Agenda List - Left Side (50%) -->
                <div>
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            Agenda Bulan Ini
                        </h4>
                        <div id="agendaList" class="space-y-3 max-h-[600px] overflow-y-auto pr-2">
                            <!-- Populated by JavaScript -->
                        </div>
                    </div>
                </div>

                <!-- Calendar - Right Side (50%) -->
                <div>
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <!-- Calendar Header -->
                        <div class="px-6 py-5 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <button id="prevMonth" class="p-2 hover:bg-gray-100 rounded-lg transition">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <div class="text-center">
                                    <h3 id="calendarTitle" class="text-xl font-bold text-gray-900">OKTOBER 2025</h3>
                                    <p class="text-xs text-gray-500 mt-1">Kalender Akademik</p>
                                </div>
                                <button id="nextMonth" class="p-2 hover:bg-gray-100 rounded-lg transition">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Calendar Body -->
                        <div class="p-6">
                            <!-- Days Header -->
                            <div class="grid grid-cols-7 gap-1 mb-2">
                                <div class="text-center text-xs font-medium text-gray-500 py-2">Min</div>
                                <div class="text-center text-xs font-medium text-gray-500 py-2">Sen</div>
                                <div class="text-center text-xs font-medium text-gray-500 py-2">Sel</div>
                                <div class="text-center text-xs font-medium text-gray-500 py-2">Rab</div>
                                <div class="text-center text-xs font-medium text-gray-500 py-2">Kam</div>
                                <div class="text-center text-xs font-medium text-gray-500 py-2">Jum</div>
                                <div class="text-center text-xs font-medium text-gray-500 py-2">Sab</div>
                            </div>

                            <!-- Calendar Grid -->
                            <div id="calendarDates" class="grid grid-cols-7 gap-1">
                                <!-- Populated by JavaScript -->
                            </div>

                            <!-- Legend -->
                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <div class="flex items-center justify-center text-xs text-gray-600">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 bg-green-200 rounded mr-2"></div>
                                        <span>Hari Ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alumni Testimonials Section - Enhanced -->
    <section id="testimonials" class="py-16 md:py-20 bg-gradient-to-br from-blue-50 to-gray-50 overflow-hidden relative">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -left-4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
            <div class="absolute -bottom-8 -right-4 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse" style="animation-delay: 4s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    TESTIMONI ALUMNI
                </h2>
            </div>
            

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <!-- Testimonial Card 1 -->
                <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-green-200 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-100 to-transparent rounded-bl-full opacity-50"></div>
                    
                    <!-- Profile Section -->
                    <div class="relative z-10 text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                            <span class="text-white font-bold text-lg">SP</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-base mb-1">Sari Permata</h4>
                        <p class="text-sm text-green-600 font-medium">Alumni 2020</p>
                    </div>
                    
                    <!-- Rating -->
                    <div class="flex justify-center space-x-1 mb-4">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    
                    <!-- Testimonial -->
                    <blockquote class="text-gray-700 text-sm leading-relaxed italic text-center mb-4 relative">
                        <span class="text-green-400 text-2xl absolute -top-2 -left-2">"</span>
                        Guru-guru di SMKN 4 Bogor tidak hanya mengajar teori, tapi juga praktik langsung.
                        <span class="text-green-400 text-2xl absolute -bottom-2 -right-2">"</span>
                    </blockquote>
                    
                    <!-- Job Title -->
                    <div class="text-center">
                        <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Digital Marketing</span>
                    </div>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-purple-200 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-100 to-transparent rounded-bl-full opacity-50"></div>
                    
                    <!-- Profile Section -->
                    <div class="relative z-10 text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                            <span class="text-white font-bold text-lg">RH</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-base mb-1">Rizki Hamdani</h4>
                        <p class="text-sm text-purple-600 font-medium">Alumni 2018</p>
                    </div>
                    
                    <!-- Rating -->
                    <div class="flex justify-center space-x-1 mb-4">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    
                    <!-- Testimonial -->
                    <blockquote class="text-gray-700 text-sm leading-relaxed italic text-center mb-4 relative">
                        <span class="text-purple-400 text-2xl absolute -top-2 -left-2">"</span>
                        Berkat pendidikan di SMKN 4 Bogor, saya memiliki keberanian untuk memulai bisnis sendiri.
                        <span class="text-purple-400 text-2xl absolute -bottom-2 -right-2">"</span>
                    </blockquote>
                    
                    <!-- Job Title -->
                    <div class="text-center">
                        <span class="inline-block bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-medium">CEO & Founder</span>
                    </div>
                </div>

                <!-- Testimonial Card 3 -->
                <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-orange-200 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-orange-100 to-transparent rounded-bl-full opacity-50"></div>
                    
                    <!-- Profile Section -->
                    <div class="relative z-10 text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                            <span class="text-white font-bold text-lg">DF</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-base mb-1">Dina Fitriani</h4>
                        <p class="text-sm text-orange-600 font-medium">Alumni 2021</p>
                    </div>
                    
                    <!-- Rating -->
                    <div class="flex justify-center space-x-1 mb-4">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    
                    <!-- Testimonial -->
                    <blockquote class="text-gray-700 text-sm leading-relaxed italic text-center mb-4 relative">
                        <span class="text-orange-400 text-2xl absolute -top-2 -left-2">"</span>
                        Fasilitas lab komputer dan software design terbaru membuat saya siap terjun ke dunia kerja.
                        <span class="text-orange-400 text-2xl absolute -bottom-2 -right-2">"</span>
                    </blockquote>
                    
                    <!-- Job Title -->
                    <div class="text-center">
                        <span class="inline-block bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-medium">Graphic Designer</span>
                    </div>
                </div>

                <!-- Testimonial Card 4 -->
                <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 hover:border-blue-200 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-100 to-transparent rounded-bl-full opacity-50"></div>
                    
                    <!-- Profile Section -->
                    <div class="relative z-10 text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                            <span class="text-white font-bold text-lg">BP</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-base mb-1">Bayu Pratama</h4>
                        <p class="text-sm text-blue-600 font-medium">Alumni 2021</p>
                    </div>
                    
                    <!-- Rating -->
                    <div class="flex justify-center space-x-1 mb-4">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    
                    <!-- Testimonial -->
                    <blockquote class="text-gray-700 text-sm leading-relaxed italic text-center mb-4 relative">
                        <span class="text-blue-400 text-2xl absolute -top-2 -left-2">"</span>
                        Networking dengan sesama alumni SMKN 4 Bogor sangat membantu dalam pengembangan karir saya.
                        <span class="text-blue-400 text-2xl absolute -bottom-2 -right-2">"</span>
                    </blockquote>
                    
                    <!-- Job Title -->
                    <div class="text-center">
                        <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">Network Engineer</span>
                    </div>
                </div>
            </div>

            <!-- Moving Testimonials Section -->
            <div class="mt-16">
                <div class="relative overflow-hidden">
                    <!-- Gradient masks for smooth fade effect -->
                    <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-gray-50 to-transparent z-10"></div>
                    <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-gray-50 to-transparent z-10"></div>
                    
                    <!-- Moving testimonials track -->
                    <div class="flex animate-scroll-infinite space-x-6 py-4">
                        <!-- Testimonial 1 -->
                        <div class="flex-shrink-0 w-80 bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-sm">AN</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm">Andi Nugraha</h4>
                                    <p class="text-xs text-gray-600">Alumni 2019 • Web Developer</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm italic leading-relaxed">
                                "Kurikulum yang selalu update dengan teknologi terbaru membuat saya mudah beradaptasi di dunia kerja."
                            </p>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="flex-shrink-0 w-80 bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-sm">MW</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm">Maya Wulandari</h4>
                                    <p class="text-xs text-gray-600">Alumni 2020 • UI/UX Designer</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm italic leading-relaxed">
                                "Pengalaman di SMKN 4 Bogor mengajarkan tidak hanya skill teknis, tapi juga soft skill penting."
                            </p>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="flex-shrink-0 w-80 bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-sm">FH</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm">Farid Hidayat</h4>
                                    <p class="text-xs text-gray-600">Alumni 2018 • System Analyst</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm italic leading-relaxed">
                                "Praktik industri selama sekolah memberi pengalaman nyata yang tidak bisa didapat dari buku."
                            </p>
                        </div>

                        <!-- Testimonial 4 -->
                        <div class="flex-shrink-0 w-80 bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-sm">NS</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm">Novi Sari</h4>
                                    <p class="text-xs text-gray-600">Alumni 2021 • Content Creator</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm italic leading-relaxed">
                                "Ekstrakurikuler multimedia membantu mengembangkan kreativitas dan skill editing saya."
                            </p>
                        </div>

                        <!-- Testimonial 5 -->
                        <div class="flex-shrink-0 w-80 bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-sm">LM</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm">Lisa Maharani</h4>
                                    <p class="text-xs text-gray-600">Alumni 2020 • Entrepreneur</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm italic leading-relaxed">
                                "Program magang membuka peluang karir luar biasa. Sekarang punya bisnis kuliner sendiri."
                            </p>
                        </div>

                        <!-- Testimonial 6 -->
                        <div class="flex-shrink-0 w-80 bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-sm">RK</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm">Raka Kusuma</h4>
                                    <p class="text-xs text-gray-600">Alumni 2019 • Mobile Developer</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm italic leading-relaxed">
                                "Fasilitas lab yang lengkap dan guru yang kompeten membuat pembelajaran sangat efektif."
                            </p>
                        </div>

                        <!-- Duplicate testimonials for seamless loop -->
                        <div class="flex-shrink-0 w-80 bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-sm">AN</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm">Andi Nugraha</h4>
                                    <p class="text-xs text-gray-600">Alumni 2019 • Web Developer</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm italic leading-relaxed">
                                "Kurikulum yang selalu update dengan teknologi terbaru membuat saya mudah beradaptasi di dunia kerja."
                            </p>
                        </div>

                        <div class="flex-shrink-0 w-80 bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-sm">MW</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm">Maya Wulandari</h4>
                                    <p class="text-xs text-gray-600">Alumni 2020 • UI/UX Designer</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm italic leading-relaxed">
                                "Pengalaman di SMKN 4 Bogor mengajarkan tidak hanya skill teknis, tapi juga soft skill penting."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CSS for smooth scrolling animation -->
    <style>
        @keyframes scroll-infinite {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .animate-scroll-infinite {
            animation: scroll-infinite 40s linear infinite;
        }

        .animate-scroll-infinite:hover {
            animation-play-state: paused;
        }

        /* Animation delays for staggered effects */
        .animation-delay-100 {
            animation-delay: 0.1s;
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-300 {
            animation-delay: 0.3s;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .animation-delay-1500 {
            animation-delay: 1.5s;
        }

        .animation-delay-3000 {
            animation-delay: 3s;
        }
        
        /* Mobile Responsive Fixes */
        @media (max-width: 768px) {
            .min-h-\[600px\] {
                min-height: 400px !important;
            }
            
            .text-6xl {
                font-size: 2.5rem !important;
            }
            
            .text-5xl {
                font-size: 2rem !important;
            }
            
            .text-4xl {
                font-size: 1.75rem !important;
            }
            
            .text-3xl {
                font-size: 1.5rem !important;
            }
            
            .aspect-video {
                aspect-ratio: 16/9;
            }
            
            .aspect-square {
                aspect-ratio: 1/1;
            }
        }
        
        @media (max-width: 640px) {
            .px-6 {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            
            .py-12 {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
            
            .gap-8 {
                gap: 1rem !important;
            }
            
            .space-y-8 > * + * {
                margin-top: 1rem !important;
            }
        }

        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .animate-scroll-infinite {
                animation: scroll-infinite 30s linear infinite;
            }
        }
    </style>

    <!-- Contact Section - Exact match to mockup -->
    <section id="kontak" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">CONTACT</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left side - Contact Form -->
                <div>
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('kritik-saran.store') }}" method="POST" class="space-y-6" id="kritikSaranForm">
                        @csrf
                        <input type="hidden" name="recaptcha_token" id="recaptchaToken">
                        <div>
                            <input type="text" name="nama" placeholder="Nama" value="{{ old('nama') }}" 
                                   class="w-full border-0 border-b-2 border-gray-300 focus:border-blue-600 focus:ring-0 bg-transparent py-3 text-gray-900 placeholder-gray-500 @error('nama') border-red-500 @enderror">
                            @error('nama')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="E-Mail" value="{{ old('email') }}" 
                                   class="w-full border-0 border-b-2 border-gray-300 focus:border-blue-600 focus:ring-0 bg-transparent py-3 text-gray-900 placeholder-gray-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <textarea name="pesan" placeholder="Pesan" rows="4" 
                                      class="w-full border-0 border-b-2 border-gray-300 focus:border-blue-600 focus:ring-0 bg-transparent py-3 text-gray-900 placeholder-gray-500 resize-none @error('pesan') border-red-500 @enderror">{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 italic mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Dilindungi oleh Google reCAPTCHA
                            </p>
                            <button type="submit" id="submitBtn" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-3 rounded-lg font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                <span id="submitText">Kirim</span>
                                <span id="loadingText" class="hidden">
                                    <svg class="animate-spin inline-block w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Mengirim...
                                </span>
                            </button>
                        </div>

                        </div>
                    </form>

                    <!-- Rating Modal -->
                    <div id="ratingContainer" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden ml-4">
                        <div class="bg-white rounded-xl p-3 max-w-[280px] w-full shadow-xl border border-gray-200">
                            <div class="text-center">
                                <div class="mb-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Pesan Berhasil Dikirim!</h3>
                                    <p class="text-gray-600 text-sm">Bagaimana pengalaman Anda menggunakan website kami?</p>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="flex justify-center space-x-1" id="starRating">
                                        <button class="star text-2xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none" data-rating="1">★</button>
                                        <button class="star text-2xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none" data-rating="2">★</button>
                                        <button class="star text-2xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none" data-rating="3">★</button>
                                        <button class="star text-2xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none" data-rating="4">★</button>
                                        <button class="star text-2xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none" data-rating="5">★</button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Klik bintang untuk memberikan rating</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thank You Modal -->
                    <div id="thankYouContainer" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden ml-4">
                        <div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-xl border border-gray-200">
                            <div class="text-center">
                                <div class="mb-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Terima Kasih!</h3>
                                    <p class="text-gray-600 text-sm mb-3">Terima kasih telah memberikan kritik, saran, ataupun masukan kepada kami.</p>
                                    <div id="ratingDisplay" class="flex justify-center space-x-1 mb-3">
                                        <!-- Stars will be displayed here -->
                                    </div>
                                    <p class="text-xs text-gray-500 mb-4">Rating Anda sangat berharga untuk perbaikan website kami.</p>
                                </div>
                                
                                <button id="closeThankYou" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right side - Contact Info -->
                <div class="space-y-8">
                    <!-- School Info -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">SMK NEGERI 4 BOGOR</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-6 h-6 text-blue-600 mt-1">
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-700">Jl. Raya Tajur, Kp. Buntar RT.02/RW.08</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-6 h-6 text-blue-600 mt-1">
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-700">928-9889-7646</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-6 h-6 text-blue-600 mt-1">
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-700">smkn4bogor@sch.id</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Google Maps Embed -->
                    <div class="rounded-2xl h-64 overflow-hidden shadow-lg">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.404147982842!2d106.83285731477394!3d-6.595621995336804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor!5e0!3m2!1sid!2sid!4v1695000000000!5m2!1sid!2sid"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="rounded-2xl">
                        </iframe>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="flex space-x-4">
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/smkn4kotabogor?igsh=ZWxvdWl2NzY1Y2w5" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gradient-to-br from-purple-600 via-pink-600 to-orange-500 rounded-full flex items-center justify-center text-white hover:shadow-lg hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <!-- TikTok -->
                        <a href="https://www.tiktok.com/@smkn4kotabogor?_t=ZS-90JZOUXmJhB&_r=1" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-black rounded-full flex items-center justify-center text-white hover:bg-gray-800 hover:shadow-lg hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <a href="https://youtube.com/@smknegeri4bogor905?si=KEki5jTVoIW_-ofZ" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white hover:bg-red-700 hover:shadow-lg hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Google reCAPTCHA v3 Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('kritikSaranForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingText = document.getElementById('loadingText');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Disable button and show loading
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');
                
                // Set timeout untuk fallback jika reCAPTCHA terlalu lama
                const timeoutId = setTimeout(function() {
                    console.warn('reCAPTCHA timeout, submitting without token');
                    document.getElementById('recaptchaToken').value = 'timeout';
                    form.submit();
                }, 5000); // 5 detik timeout
                
                // Execute reCAPTCHA
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.ready(function() {
                        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit_kritik_saran'})
                            .then(function(token) {
                                clearTimeout(timeoutId);
                                
                                // Set token to hidden input
                                document.getElementById('recaptchaToken').value = token;
                                
                                // Submit form
                                form.submit();
                            })
                            .catch(function(error) {
                                clearTimeout(timeoutId);
                                console.error('reCAPTCHA error:', error);
                                
                                // Submit anyway dengan token kosong
                                document.getElementById('recaptchaToken').value = 'error';
                                form.submit();
                            });
                    });
                } else {
                    // Jika grecaptcha tidak loaded, submit langsung
                    clearTimeout(timeoutId);
                    console.warn('grecaptcha not loaded, submitting without token');
                    document.getElementById('recaptchaToken').value = 'not_loaded';
                    form.submit();
                }
            });
        });
    </script>

    <!-- Tab Navigation JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            function switchTab(targetTab) {
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => {
                    btn.classList.remove('text-blue-600', 'bg-blue-50', 'border-b-2', 'border-blue-600');
                    btn.classList.add('text-gray-600');
                });
                
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('active');
                });

                // Add active class to clicked button
                const activeButton = document.getElementById(`tab-${targetTab}`);
                activeButton.classList.remove('text-gray-600');
                activeButton.classList.add('text-blue-600', 'bg-blue-50', 'border-b-2', 'border-blue-600');

                // Show corresponding content
                const activeContent = document.getElementById(`content-${targetTab}`);
                activeContent.classList.remove('hidden');
                activeContent.classList.add('active');
            }

            // Add click event listeners to all tab buttons
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');
                    switchTab(targetTab);
                });
            });
        });
    </script>

    <!-- Carousel JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simple carousel for Kejuaraan
            setupSimpleCarousel('carouselTrack', 'prevBtn', 'nextBtn');
            
            // Simple carousel for Ekstrakurikuler  
            setupSimpleCarousel('carouselTrackEkskul', 'prevBtnEkskul', 'nextBtnEkskul');
        });

        function setupSimpleCarousel(trackId, prevBtnId, nextBtnId) {
            const track = document.getElementById(trackId);
            const prevBtn = document.getElementById(prevBtnId);
            const nextBtn = document.getElementById(nextBtnId);
            
            if (!track || !prevBtn || !nextBtn) {
                console.log('Elements not found:', trackId, prevBtnId, nextBtnId);
                return;
            }
            
            let currentPosition = 0;
            const cardWidth = track.children[0] ? track.children[0].offsetWidth + 16 : 300; // card width + gap
            
            function updateButtons() {
                const maxScroll = track.scrollWidth - track.parentElement.offsetWidth;
                prevBtn.style.opacity = currentPosition <= 0 ? '0.5' : '1';
                nextBtn.style.opacity = currentPosition >= maxScroll ? '0.5' : '1';
                prevBtn.disabled = currentPosition <= 0;
                nextBtn.disabled = currentPosition >= maxScroll;
            }
            
            function moveCarousel() {
                track.style.transform = `translateX(-${currentPosition}px)`;
                updateButtons();
            }
            
            prevBtn.onclick = function() {
                currentPosition = Math.max(0, currentPosition - cardWidth);
                moveCarousel();
                console.log('Prev clicked, position:', currentPosition);
            };
            
            nextBtn.onclick = function() {
                const maxScroll = track.scrollWidth - track.parentElement.offsetWidth;
                currentPosition = Math.min(maxScroll, currentPosition + cardWidth);
                moveCarousel();
                console.log('Next clicked, position:', currentPosition);
            };
            
            // Initialize
            setTimeout(() => {
                updateButtons();
                console.log(`${trackId} setup complete. Cards:`, track.children.length);
            }, 100);
        }


        // Function to show kejuaraan tab
        function showKejuaraanTab() {
            // Switch to kejuaraan tab
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('text-blue-600', 'bg-blue-50', 'border-b-2', 'border-blue-600');
                btn.classList.add('text-gray-600');
            });
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            
            const kejuaraanBtn = document.getElementById('tab-kejuaraan');
            const kejuaraanContent = document.getElementById('content-kejuaraan');
            
            if (kejuaraanBtn && kejuaraanContent) {
                kejuaraanBtn.classList.add('text-blue-600', 'bg-blue-50', 'border-b-2', 'border-blue-600');
                kejuaraanBtn.classList.remove('text-gray-600');
                
                kejuaraanContent.classList.remove('hidden');
                kejuaraanContent.classList.add('active');
            }
        }

        // Rating and Container functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Check if form was successfully submitted
            @if(session('success'))
                document.getElementById('ratingContainer').classList.remove('hidden');
            @endif

            let selectedRating = 0;
            const stars = document.querySelectorAll('.star');
            const ratingContainer = document.getElementById('ratingContainer');
            const thankYouContainer = document.getElementById('thankYouContainer');
            const ratingDisplay = document.getElementById('ratingDisplay');

            // Star rating functionality
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    selectedRating = parseInt(this.dataset.rating);
                    updateStars(selectedRating);
                    
                    // Send rating to server via AJAX
                    const kritikSaranId = '{{ session("kritik_saran_id") }}';
                    if (kritikSaranId) {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        
                        fetch(`/kritik-saran/${kritikSaranId}/rating`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                rating: selectedRating
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('✅ Rating saved successfully:', data.data.rating);
                            }
                        })
                        .catch(error => {
                            console.error('❌ Error saving rating:', error);
                        });
                    }
                    
                    // Show thank you container after short delay
                    setTimeout(() => {
                        showThankYouContainer(selectedRating);
                    }, 500);
                });

                star.addEventListener('mouseenter', function() {
                    const rating = parseInt(this.dataset.rating);
                    updateStars(rating, true);
                });

                star.addEventListener('mouseleave', function() {
                    updateStars(selectedRating);
                });
            });

            // Skip rating functionality removed since button was removed

            // Close thank you container
            document.getElementById('closeThankYou').addEventListener('click', function() {
                thankYouContainer.classList.add('hidden');
                resetForm();
                // Scroll back to contact section
                document.getElementById('contact').scrollIntoView({ behavior: 'smooth' });
            });

            function updateStars(rating, isHover = false) {
                stars.forEach((star, index) => {
                    const starRating = parseInt(star.dataset.rating);
                    star.classList.remove('text-yellow-400', 'text-gray-300');
                    
                    if (starRating <= rating) {
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.add('text-gray-300');
                    }
                });
            }

            function showThankYouContainer(rating) {
                ratingContainer.classList.add('hidden');
                
                // Display rating in thank you container
                ratingDisplay.innerHTML = '';
                if (rating > 0) {
                    for (let i = 1; i <= 5; i++) {
                        const star = document.createElement('span');
                        star.textContent = '★';
                        star.className = i <= rating ? 'text-yellow-400 text-lg' : 'text-gray-300 text-lg';
                        ratingDisplay.appendChild(star);
                    }
                } else {
                    ratingDisplay.innerHTML = '<span class="text-gray-500 text-sm">Tidak ada rating</span>';
                }
                
                thankYouContainer.classList.remove('hidden');
            }

            function resetForm() {
                // Reset form
                document.getElementById('kritikSaranForm').reset();
                
                // Reset stars
                selectedRating = 0;
                updateStars(0);
                
                // Scroll to contact section smoothly
                document.getElementById('kontak').scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            // Close modals when clicking outside
            [ratingModal, thankYouModal].forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        if (modal === ratingModal) {
                            showThankYouModal(0);
                        } else {
                            modal.classList.add('hidden');
                            resetForm();
                        }
                    }
                });
            });
        });
    </script>

    <!-- Ekstrakurikuler Modal -->
    <div id="ekstrakurikulerModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full max-h-[85vh] overflow-y-auto">
                <div class="bg-white px-6 pt-6 pb-4">
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-4">
                        <h3 id="modalTitle" class="text-xl font-bold text-gray-900"></h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content Row -->
                    <div class="flex flex-row gap-6 items-start">
                        <!-- Thumbnail Image - Ukuran diperbesar -->
                        <div class="w-48 h-64 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden shadow-md">
                            <img id="modalImage" src="" alt="" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Text Content -->
                        <div class="flex-1">
                            <!-- Description Section -->
                            <div class="mb-4">
                                <h4 class="text-base font-semibold mb-2">Deskripsi</h4>
                                <p id="modalDescription" class="text-gray-700 text-sm leading-relaxed"></p>
                            </div>
                            
                            <!-- Info Section -->
                            <div class="space-y-3">
                            <!-- Tempat -->
                            <div class="flex items-start space-x-2 text-sm">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <span class="text-gray-500 block">Tempat:</span>
                                    <span id="modalTempat" class="font-medium text-gray-900"></span>
                                </div>
                            </div>
                            
                            <!-- Pembina -->
                            <div class="flex items-start space-x-2 text-sm">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <div>
                                    <span class="text-gray-500 block">Pembina:</span>
                                    <span id="modalPembina" class="font-medium text-gray-900"></span>
                                </div>
                            </div>
                            
                            <!-- Schedule -->
                            <div class="flex items-start space-x-2 text-sm">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <span class="text-gray-500 block">Jadwal:</span>
                                    <span id="modalSchedule" class="font-medium text-gray-900"></span>
                                </div>
                            </div>

                            <!-- Social Media -->
                            <div class="flex items-center space-x-4 pt-3">
                                <div id="modalInstagram" class="flex items-center space-x-2 text-sm">
                                    <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                                    </svg>
                                    <a id="modalInstagramLink" href="#" target="_blank" class="text-pink-600 hover:text-pink-800 font-medium"></a>
                                </div>
                                <div id="modalEmail" class="flex items-center space-x-2 text-sm">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <a id="modalEmailLink" href="#" class="text-blue-600 hover:text-blue-800 font-medium"></a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showEkstrakurikulerModal(ekstrakurikuler) {
            const modal = document.getElementById('ekstrakurikulerModal');
            const title = document.getElementById('modalTitle');
            const schedule = document.getElementById('modalSchedule');
            const pembina = document.getElementById('modalPembina');
            const tempat = document.getElementById('modalTempat');
            const description = document.getElementById('modalDescription');
            const mainImage = document.getElementById('modalImage');
            const instagramDiv = document.getElementById('modalInstagram');
            const emailDiv = document.getElementById('modalEmail');
            const instagramLink = document.getElementById('modalInstagramLink');
            const emailLink = document.getElementById('modalEmailLink');
            
            // Set the main content
            title.textContent = ekstrakurikuler.nama;
            pembina.textContent = ekstrakurikuler.pembina || 'Belum ada data pembina';
            tempat.textContent = ekstrakurikuler.tempat || 'Belum ada data tempat';
            description.textContent = ekstrakurikuler.deskripsi || 'Tidak ada deskripsi yang tersedia.';
            
            // Set schedule
            let scheduleText = '';
            if (ekstrakurikuler.hari_kegiatan) {
                scheduleText += ekstrakurikuler.hari_kegiatan;
                if (ekstrakurikuler.jam_mulai) {
                    scheduleText += `, ${ekstrakurikuler.jam_mulai}`;
                    if (ekstrakurikuler.jam_selesai) {
                        scheduleText += ` - ${ekstrakurikuler.jam_selesai}`;
                    }
                }
            } else {
                scheduleText = 'Jadwal belum ditentukan';
            }
            schedule.textContent = scheduleText;
            
            // Set main image
            if (ekstrakurikuler.foto) {
                mainImage.src = `{{ asset('storage/ekstrakurikuler/') }}/${ekstrakurikuler.foto}`;
                mainImage.alt = ekstrakurikuler.nama;
            } else {
                // Default image if no photo
                mainImage.src = '{{ asset('images/default-ekstrakurikuler.svg') }}';
                mainImage.alt = 'Gambar tidak tersedia';
            }
            
            // Handle social media
            if (ekstrakurikuler.instagram) {
                instagramLink.textContent = '@' + ekstrakurikuler.instagram;
                instagramLink.href = 'https://instagram.com/' + ekstrakurikuler.instagram;
                instagramDiv.style.display = 'flex';
            } else {
                instagramDiv.style.display = 'none';
            }
            
            if (ekstrakurikuler.email) {
                emailLink.textContent = ekstrakurikuler.email;
                emailLink.href = 'mailto:' + ekstrakurikuler.email;
                emailDiv.style.display = 'flex';
            } else {
                emailDiv.style.display = 'none';
            }
            
            // Show the modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            const modal = document.getElementById('ekstrakurikulerModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside the modal content
        window.onclick = function(event) {
            const modal = document.getElementById('ekstrakurikulerModal');
            if (event.target === modal) {
                closeModal();
            }
        }
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            const modal = document.getElementById('ekstrakurikulerModal');
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>

    <!-- Agenda Calendar JavaScript - Modern Clean -->
    <script>
        let currentYear = new Date().getFullYear();
        let currentMonth = new Date().getMonth() + 1;
        let isLoading = false;

        document.addEventListener('DOMContentLoaded', function() {
            loadAgenda(currentYear, currentMonth);
            
            document.getElementById('prevMonth').addEventListener('click', function() {
                if (isLoading) return;
                currentMonth--;
                if (currentMonth < 1) {
                    currentMonth = 12;
                    currentYear--;
                }
                loadAgenda(currentYear, currentMonth);
            });
            
            document.getElementById('nextMonth').addEventListener('click', function() {
                if (isLoading) return;
                currentMonth++;
                if (currentMonth > 12) {
                    currentMonth = 1;
                    currentYear++;
                }
                loadAgenda(currentYear, currentMonth);
            });
        });

        // Load agenda from database
        function loadAgenda(year, month) {
            if (isLoading) return;
            isLoading = true;

            const monthNames = ['', 'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'];
            
            // Update title immediately
            document.getElementById('calendarTitle').textContent = `${monthNames[month]} ${year}`;
            
            // Show loading
            document.getElementById('calendarDates').innerHTML = '<div class="col-span-7 text-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div></div>';
            document.getElementById('agendaList').innerHTML = '<div class="text-center py-4"><div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mx-auto"></div></div>';

            fetch(`/api/agenda/month?year=${year}&month=${month}`)
                .then(res => res.json())
                .then(data => {
                    renderCalendar(data.calendar);
                    renderAgendaList(data.agendas);
                })
                .catch(err => {
                    console.error('Error:', err);
                    document.getElementById('agendaList').innerHTML = '<p class="text-center text-gray-500 py-4 text-sm">Tidak ada agenda</p>';
                    generateStaticCalendar(year, month);
                })
                .finally(() => {
                    isLoading = false;
                });
        }

        // Render calendar - Simple Clean Style
        function renderCalendar(calendar) {
            const grid = document.getElementById('calendarDates');
            grid.innerHTML = '';
            
            calendar.forEach(day => {
                const div = document.createElement('div');
                div.className = 'aspect-square flex items-center justify-center text-sm rounded-lg transition cursor-pointer';
                
                if (!day.is_current_month) {
                    // Tanggal bulan lain - abu-abu muda
                    div.className += ' text-gray-300';
                } else if (day.is_today) {
                    // Hari ini - hijau soft/transparan
                    div.className += ' bg-green-200 text-green-800 font-semibold';
                } else if (day.has_events && day.events.length > 0) {
                    // Tanggal dengan agenda - gunakan warna dari admin
                    const eventColor = day.events[0].warna || '#3b82f6';
                    div.style.backgroundColor = eventColor + '20'; // Light background
                    div.style.color = '#1f2937'; // Dark text
                    div.className += ' font-medium';
                } else {
                    // Tanggal biasa
                    div.className += ' text-gray-700 hover:bg-gray-50';
                }
                
                div.textContent = day.day;
                
                // Tooltip untuk tanggal dengan agenda
                if (day.has_events && day.events.length > 0) {
                    div.title = day.events.map(e => e.judul).join(', ');
                }
                
                grid.appendChild(div);
            });
        }

        // Render agenda list
        function renderAgendaList(agendas) {
            const list = document.getElementById('agendaList');
            
            if (!agendas || agendas.length === 0) {
                list.innerHTML = '<p class="text-center text-gray-500 py-4 text-sm">Tidak ada agenda bulan ini</p>';
                return;
            }
            
            list.innerHTML = '';
            agendas.forEach(agenda => {
                const div = document.createElement('div');
                div.className = 'bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition';
                // Determine status badge
                let statusBadge = '';
                if (agenda.is_berlangsung) {
                    statusBadge = '<span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium flex items-center gap-1"><span class="w-1.5 h-1.5 bg-green-600 rounded-full animate-pulse"></span>Sedang Berlangsung</span>';
                } else if (agenda.is_selesai) {
                    statusBadge = '<span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-full font-medium">✓ Selesai</span>';
                } else if (agenda.is_akan_datang) {
                    statusBadge = '<span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-medium">📅 Akan Datang</span>';
                }
                
                div.innerHTML = `
                    <div class="flex items-start justify-between mb-2 gap-2">
                        <h5 class="font-semibold text-gray-900 text-sm flex-1">${agenda.judul}</h5>
                        ${statusBadge}
                    </div>
                    <p class="text-xs text-gray-600 mb-1">📅 ${agenda.tanggal_formatted}${agenda.waktu ? ' • ⏰ ' + agenda.waktu : ''}</p>
                    ${agenda.lokasi ? '<p class="text-xs text-gray-600 mb-2">📍 ' + agenda.lokasi + '</p>' : ''}
                    <p class="text-xs text-gray-700 leading-relaxed">${agenda.deskripsi.substring(0, 100)}${agenda.deskripsi.length > 100 ? '...' : ''}</p>
                `;
                list.appendChild(div);
            });
        }

        // Generate static calendar fallback
        function generateStaticCalendar(year, month) {
            const firstDay = new Date(year, month - 1, 1);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay());
            
            const grid = document.getElementById('calendarDates');
            grid.innerHTML = '';
            
            for (let i = 0; i < 42; i++) {
                const currentDate = new Date(startDate);
                currentDate.setDate(startDate.getDate() + i);
                
                const div = document.createElement('div');
                div.className = 'aspect-square flex items-center justify-center text-sm rounded-lg transition cursor-pointer';
                
                if (currentDate.getMonth() !== month - 1) {
                    div.className += ' text-gray-300';
                } else {
                    const today = new Date();
                    if (currentDate.toDateString() === today.toDateString()) {
                        div.className += ' bg-green-200 text-green-800 font-semibold';
                    } else {
                        div.className += ' text-gray-700 hover:bg-gray-50';
                    }
                }
                
                div.textContent = currentDate.getDate();
                grid.appendChild(div);
            }
        }
    </script>
@endsection
