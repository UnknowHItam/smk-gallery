@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600">Selamat datang kembali, {{ auth()->user()->name }}</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Posts -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100">
                    <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_posts'] }}</p>
                    <p class="text-sm text-gray-600">Total Postingan</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-green-600 font-medium">+{{ $stats['posts_this_month'] }}</span> bulan ini
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-indigo-100">
                    <i class="fas fa-users text-indigo-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    <p class="text-sm text-gray-600">Total Pengguna</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-green-600 font-medium">+{{ $stats['users_this_month'] }}</span> bulan ini
            </div>
        </div>

        <!-- Total Likes -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-red-100">
                    <i class="fas fa-heart text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_likes'] }}</p>
                    <p class="text-sm text-gray-600">Total Likes</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-green-600 font-medium">+{{ $stats['likes_this_month'] }}</span> bulan ini
            </div>
        </div>

        <!-- Total Shares -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100">
                    <i class="fas fa-share-alt text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_shares'] }}</p>
                    <p class="text-sm text-gray-600">Total Shares</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-green-600 font-medium">+{{ $stats['shares_this_month'] }}</span> bulan ini
            </div>
        </div>

        <!-- Total Downloads -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-green-100">
                    <i class="fas fa-download text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_downloads'] }}</p>
                    <p class="text-sm text-gray-600">Total Downloads</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-green-600 font-medium">+{{ $stats['downloads_this_month'] }}</span> bulan ini
            </div>
        </div>

        <!-- Total Ekstrakurikuler -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-purple-100">
                    <i class="fas fa-running text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_ekstrakurikuler'] }}</p>
                    <p class="text-sm text-gray-600">Ekstrakurikuler</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-purple-600 font-medium">{{ $stats['active_ekstrakurikuler'] }}</span> aktif
            </div>
        </div>

        <!-- Unread Feedback -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg {{ $stats['unread_feedback'] > 0 ? 'bg-orange-100' : 'bg-gray-100' }}">
                    <i class="fas fa-envelope {{ $stats['unread_feedback'] > 0 ? 'text-orange-600' : 'text-gray-600' }} text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['unread_feedback'] }}</p>
                    <p class="text-sm text-gray-600">Pesan Masuk</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                @if($stats['unread_feedback'] > 0)
                    <span class="text-orange-600 font-medium">Perlu ditinjau</span>
                @else
                    <span class="text-gray-500">Semua terbaca</span>
                @endif
            </div>
        </div>

        <!-- Posts This Month -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-teal-100">
                    <i class="fas fa-calendar-alt text-teal-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['posts_this_month'] }}</p>
                    <p class="text-sm text-gray-600">Post Bulan Ini</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-teal-600 font-medium">{{ now()->format('F Y') }}</span>
            </div>
        </div>

        <!-- Total Kritik & Saran -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-yellow-100">
                    <i class="fas fa-comments text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_feedback'] }}</p>
                    <p class="text-sm text-gray-600">Total Kritik & Saran</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-green-600 font-medium">+{{ $stats['feedback_this_month'] }}</span> bulan ini
            </div>
        </div>

        <!-- Rating Rata-rata -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-amber-100">
                    <i class="fas fa-star text-amber-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['average_rating'] ?? 0 }}<span class="text-base text-gray-500">/5</span></p>
                    <p class="text-sm text-gray-600">Rating Rata-rata</p>
                </div>
            </div>
            <div class="mt-3 text-xs text-gray-500">
                <span class="text-amber-600 font-medium">{{ $stats['total_ratings'] }}</span> rating diberikan
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Posts -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Postingan Terbaru</h2>
                    <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                        Lihat Semua
                    </a>
                </div>
            </div>
            <div class="p-6">
                @forelse($recentPosts as $post)
                    <div class="flex items-center space-x-4 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        @if($post->galery && $post->galery->count() > 0 && $post->galery->first()->foto && $post->galery->first()->foto->count() > 0)
                            @php
                                $fotoUtamaDashboard = $post->galery->first()->foto->where('judul', 'Foto Utama')->first() ?? $post->galery->first()->foto->first();
                            @endphp
                            <div class="w-12 h-12 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/posts/' . $fotoUtamaDashboard->file) }}" alt="{{ $post->judul }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-medium text-gray-900 truncate">{{ $post->judul }}</h3>
                            <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs {{ $post->status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $post->status ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-newspaper text-gray-400 text-2xl mb-2"></i>
                        <p class="text-gray-500 text-sm">Belum ada postingan</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Aksi Cepat</h2>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('admin.posts.create') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-plus text-blue-600 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Buat Postingan Baru</span>
                    </a>
                    
                    <a href="{{ route('admin.ekstrakurikuler.create') }}" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-purple-600 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Tambah Ekstrakurikuler</span>
                    </a>
                    
                    <a href="{{ route('admin.kritik-saran.index') }}" class="flex items-center p-3 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-envelope text-orange-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <span class="text-sm font-medium text-gray-900">Pesan Masuk</span>
                            @if($stats['unread_feedback'] > 0)
                                <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs bg-red-100 text-red-800">
                                    {{ $stats['unread_feedback'] }} baru
                                </span>
                            @endif
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.statistics.index') }}" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-chart-bar text-green-600 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Lihat Statistik</span>
                    </a>

                    <a href="{{ route('admin.agenda.index') }}" class="flex items-center p-3 bg-teal-50 hover:bg-teal-100 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-teal-600 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Kelola Agenda</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user-cog text-indigo-600 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Manajemen Pengguna</span>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-cog text-gray-600 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Pengaturan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
