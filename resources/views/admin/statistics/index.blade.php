@extends('admin.layout')

@section('title', 'Statistik')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Statistik</h1>
            <p class="mt-1 text-sm text-gray-600">Analisis data dan statistik website</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center space-x-3">
            <form method="GET" class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">Periode:</label>
                <select name="months" 
                        class="block pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" 
                        onchange="this.form.submit()">
                    @foreach([1,3,6,12] as $m)
                        <option value="{{ $m }}" @selected($months==$m)>{{ $m }} bulan</option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.statistics.export.pdf', ['months'=>$months]) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <i class="fas fa-file-pdf mr-2"></i>
                Unduh PDF
            </a>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Posts -->
        <div class="card bg-gradient-to-br from-blue-50 to-white hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-newspaper text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Postingan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ array_sum($data) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="card bg-gradient-to-br from-indigo-50 to-white hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-indigo-100 text-indigo-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                        <p class="text-xs text-indigo-600 font-medium">+{{ $stats['users_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Likes -->
        <div class="card bg-gradient-to-br from-rose-50 to-white hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-rose-100 text-rose-600 mr-4">
                        <i class="fas fa-heart text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Likes</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_likes'] }}</p>
                        <p class="text-xs text-rose-600 font-medium">+{{ $stats['likes_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Shares -->
        <div class="card bg-gradient-to-br from-sky-50 to-white hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-sky-100 text-sky-600 mr-4">
                        <i class="fas fa-share-alt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Shares</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_shares'] }}</p>
                        <p class="text-xs text-sky-600 font-medium">+{{ $stats['shares_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Downloads -->
        <div class="card bg-gradient-to-br from-emerald-50 to-white hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-emerald-100 text-emerald-600 mr-4">
                        <i class="fas fa-download text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Downloads</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_downloads'] }}</p>
                        <p class="text-xs text-emerald-600 font-medium">+{{ $stats['downloads_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kritik & Saran -->
        <div class="card bg-gradient-to-br from-amber-50 to-white hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-amber-100 text-amber-600 mr-4">
                        <i class="fas fa-comments text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Kritik & Saran</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_feedback'] }}</p>
                        <p class="text-xs text-amber-600 font-medium">+{{ $stats['feedback_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Rating -->
        <div class="card bg-gradient-to-br from-yellow-50 to-white hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-star text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Rating Rata-rata</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['average_rating'] ?? 0 }}<span class="text-base text-gray-500">/5</span></p>
                        <p class="text-xs text-yellow-600 font-medium">{{ $stats['total_ratings'] }} rating</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Engagement Rate -->
        <div class="card bg-gradient-to-br from-teal-50 to-white hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-teal-100 text-teal-600 mr-4">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Engagement Rate</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['engagement_rate'] }}</p>
                        <p class="text-xs text-teal-600 font-medium">interaksi/post</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Period -->
        <div class="card bg-gradient-to-br from-purple-50 to-white hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Periode Analisis</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $months }}</p>
                        <p class="text-xs text-purple-600 font-medium">bulan terakhir</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Growth Indicators -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="card bg-gradient-to-br from-blue-50 to-blue-100">
            <div class="p-4">
                <p class="text-xs font-medium text-gray-600 mb-1">Pertumbuhan Posts</p>
                <div class="flex items-center justify-between">
                    <p class="text-xl font-bold {{ $stats['posts_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $stats['posts_growth'] > 0 ? '+' : '' }}{{ $stats['posts_growth'] }}%
                    </p>
                    <i class="fas fa-{{ $stats['posts_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }} text-{{ $stats['posts_growth'] >= 0 ? 'green' : 'red' }}-600"></i>
                </div>
            </div>
        </div>
        <div class="card bg-gradient-to-br from-indigo-50 to-indigo-100">
            <div class="p-4">
                <p class="text-xs font-medium text-gray-600 mb-1">Pertumbuhan Users</p>
                <div class="flex items-center justify-between">
                    <p class="text-xl font-bold {{ $stats['users_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $stats['users_growth'] > 0 ? '+' : '' }}{{ $stats['users_growth'] }}%
                    </p>
                    <i class="fas fa-{{ $stats['users_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }} text-{{ $stats['users_growth'] >= 0 ? 'green' : 'red' }}-600"></i>
                </div>
            </div>
        </div>
        <div class="card bg-gradient-to-br from-red-50 to-red-100">
            <div class="p-4">
                <p class="text-xs font-medium text-gray-600 mb-1">Pertumbuhan Likes</p>
                <div class="flex items-center justify-between">
                    <p class="text-xl font-bold {{ $stats['likes_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $stats['likes_growth'] > 0 ? '+' : '' }}{{ $stats['likes_growth'] }}%
                    </p>
                    <i class="fas fa-{{ $stats['likes_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }} text-{{ $stats['likes_growth'] >= 0 ? 'green' : 'red' }}-600"></i>
                </div>
            </div>
        </div>
        <div class="card bg-gradient-to-br from-blue-50 to-cyan-100">
            <div class="p-4">
                <p class="text-xs font-medium text-gray-600 mb-1">Pertumbuhan Shares</p>
                <div class="flex items-center justify-between">
                    <p class="text-xl font-bold {{ $stats['shares_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $stats['shares_growth'] > 0 ? '+' : '' }}{{ $stats['shares_growth'] }}%
                    </p>
                    <i class="fas fa-{{ $stats['shares_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }} text-{{ $stats['shares_growth'] >= 0 ? 'green' : 'red' }}-600"></i>
                </div>
            </div>
        </div>
        <div class="card bg-gradient-to-br from-green-50 to-green-100">
            <div class="p-4">
                <p class="text-xs font-medium text-gray-600 mb-1">Pertumbuhan Downloads</p>
                <div class="flex items-center justify-between">
                    <p class="text-xl font-bold {{ $stats['downloads_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $stats['downloads_growth'] > 0 ? '+' : '' }}{{ $stats['downloads_growth'] }}%
                    </p>
                    <i class="fas fa-{{ $stats['downloads_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }} text-{{ $stats['downloads_growth'] >= 0 ? 'green' : 'red' }}-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="card mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Grafik Postingan per Bulan</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($labels as $i => $label)
                    <div class="flex items-center">
                        <div class="w-24 text-sm font-medium text-gray-700 truncate">{{ $label }}</div>
                        <div class="flex-1 mx-4">
                            <div class="bg-gray-200 rounded-full h-4 relative overflow-hidden">
                                <div class="bg-blue-600 h-4 rounded-full transition-all duration-500" 
                                     style="width: {{ $data[$i] > 0 ? ($data[$i] / max($data)) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="w-12 text-sm font-bold text-gray-900 text-right">{{ $data[$i] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Category Distribution -->
    <div class="card mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Distribusi Kategori</h2>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                @foreach($categories as $category)
                    <div class="flex items-center">
                        <div class="w-32 text-sm font-medium text-gray-700 truncate">{{ $category['name'] }}</div>
                        <div class="flex-1 mx-4">
                            <div class="bg-gray-200 rounded-full h-3 relative overflow-hidden">
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full transition-all duration-500" 
                                     style="width: {{ $category['percentage'] }}%"></div>
                            </div>
                        </div>
                        <div class="w-20 text-sm font-bold text-gray-900 text-right">{{ $category['count'] }} ({{ $category['percentage'] }}%)</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top Posts and Rating Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Top Liked Posts -->
        <div class="card">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-heart text-red-500 mr-2"></i>
                    Top 5 Postingan Terpopuler
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($topLikedPosts as $index => $post)
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $post->judul }}</p>
                                <p class="text-xs text-gray-500">{{ $post->kategori->judul ?? 'N/A' }}</p>
                            </div>
                            <div class="flex-shrink-0 ml-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-heart mr-1"></i>
                                    {{ $post->total_likes ?? 0 }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Rating Distribution -->
        <div class="card">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                    Distribusi Rating
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @for($i = 5; $i >= 1; $i--)
                        <div class="flex items-center">
                            <div class="w-20 flex items-center">
                                @for($j = 1; $j <= $i; $j++)
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                @endfor
                            </div>
                            <div class="flex-1 mx-3">
                                <div class="bg-gray-200 rounded-full h-3 relative overflow-hidden">
                                    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 h-3 rounded-full transition-all duration-500" 
                                         style="width: {{ $ratingDistribution[$i]['percentage'] }}%"></div>
                                </div>
                            </div>
                            <div class="w-24 text-sm font-medium text-gray-700 text-right">
                                {{ $ratingDistribution[$i]['count'] }} ({{ $ratingDistribution[$i]['percentage'] }}%)
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600">Rata-rata Rating:</span>
                        <span class="text-2xl font-bold text-yellow-600">{{ $stats['average_rating'] ?? 0 }}/5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Downloaded Posts -->
    <div class="card mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-download text-green-500 mr-2"></i>
                Top 5 Postingan Paling Banyak Diunduh
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                @forelse($topDownloadedPosts as $index => $post)
                    <div class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg border border-green-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center justify-center w-8 h-8 bg-green-600 text-white rounded-full font-bold text-sm">
                                {{ $index + 1 }}
                            </span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-green-600 text-white">
                                <i class="fas fa-download mr-1"></i>
                                {{ $post->total_downloads ?? 0 }}
                            </span>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 line-clamp-2 mb-1">{{ $post->judul }}</p>
                        <p class="text-xs text-gray-600">{{ $post->kategori->judul ?? 'N/A' }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4 col-span-5">Belum ada data</p>
                @endforelse
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .chart-bar {
            transition: width 0.5s ease-in-out;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Add some animation to the bars
        document.addEventListener('DOMContentLoaded', function() {
            const bars = document.querySelectorAll('.chart-bar');
            bars.forEach((bar, index) => {
                setTimeout(() => {
                    bar.style.width = bar.dataset.width + '%';
                }, index * 100);
            });
        });
    </script>
    @endpush
@endsection


