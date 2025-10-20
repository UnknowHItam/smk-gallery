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
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <i class="fas fa-file-pdf mr-2"></i>
                Unduh PDF
            </a>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Posts -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-50 text-blue-600 mr-4">
                        <i class="fas fa-newspaper text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Postingan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ array_sum($data) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-50 text-indigo-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                        <p class="text-xs text-gray-500">+{{ $stats['users_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Likes -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-50 text-red-600 mr-4">
                        <i class="fas fa-heart text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Likes</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_likes'] }}</p>
                        <p class="text-xs text-gray-500">+{{ $stats['likes_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Shares -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-50 text-blue-600 mr-4">
                        <i class="fas fa-share-alt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Shares</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_shares'] }}</p>
                        <p class="text-xs text-gray-500">+{{ $stats['shares_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Downloads -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-50 text-green-600 mr-4">
                        <i class="fas fa-download text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Downloads</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_downloads'] }}</p>
                        <p class="text-xs text-gray-500">+{{ $stats['downloads_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kritik & Saran -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-50 text-yellow-600 mr-4">
                        <i class="fas fa-comments text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kritik & Saran</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_feedback'] }}</p>
                        <p class="text-xs text-gray-500">+{{ $stats['feedback_this_period'] }} periode ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Rating -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-amber-50 text-amber-600 mr-4">
                        <i class="fas fa-star text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Rating Rata-rata</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['average_rating'] ?? 0 }}<span class="text-base text-gray-500">/5</span></p>
                        <p class="text-xs text-gray-500">{{ $stats['total_ratings'] }} rating</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Period -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-50 text-purple-600 mr-4">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Periode Analisis</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $months }}</p>
                        <p class="text-xs text-gray-500">bulan terakhir</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="card">
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


