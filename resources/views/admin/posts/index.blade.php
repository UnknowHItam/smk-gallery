@extends('admin.layout')

@section('title', 'Manajemen Konten')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Konten</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola semua postingan dan konten website</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-plus mr-2"></i> Buat Postingan Baru
            </a>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-6">
        <div class="p-4 border-b border-gray-200">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                               placeholder="Cari postingan...">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <select name="status" 
                            onchange="this.form.submit()" 
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Publik</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="w-full md:w-48">
                    <select name="category" 
                            onchange="this.form.submit()" 
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="">Semua Kategori</option>
                        @foreach(\App\Models\Kategori::orderBy('judul')->distinct()->get(['id', 'judul']) as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if(request()->has('search') || request()->has('status') || request()->has('category'))
                    <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <!-- Image -->
                <div class="aspect-video bg-gray-100">
                    @if($post->galery && $post->galery->count() > 0 && $post->galery->first()->foto && $post->galery->first()->foto->count() > 0)
                        <img src="{{ asset('storage/posts/' . $post->galery->first()->foto->first()->file) }}" alt="{{ $post->judul }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-image text-3xl"></i>
                        </div>
                    @endif
                </div>
                
                <!-- Content -->
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        @if($post->kategori)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $post->kategori->judul }}
                            </span>
                        @else
                            <span class="text-xs text-gray-500">Tanpa Kategori</span>
                        @endif
                        
                        @if($post->status)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-pen-fancy mr-1"></i> Draft
                            </span>
                        @endif
                    </div>
                    
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $post->judul }}</h3>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit(strip_tags($post->isi), 100) }}</p>
                    
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                        <span>{{ $post->created_at->format('d M Y') }}</span>
                    </div>
                    
                    @php
                        $totalLikes = $post->galery->sum(function($g) { return $g->likes->count(); });
                        $totalShares = $post->galery->sum(function($g) { return $g->shares->count(); });
                        $totalDownloads = $post->galery->sum(function($g) { return $g->downloads->count(); });
                    @endphp
                    
                    <!-- Stats -->
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
                        <div class="flex items-center gap-1">
                            <i class="fas fa-heart text-red-500 text-xs"></i>
                            <span class="text-xs font-semibold text-gray-900">{{ $totalLikes }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <i class="fas fa-share-alt text-blue-500 text-xs"></i>
                            <span class="text-xs font-semibold text-gray-900">{{ $totalShares }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <i class="fas fa-download text-green-500 text-xs"></i>
                            <span class="text-xs font-semibold text-gray-900">{{ $totalDownloads }}</span>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex flex-col space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.posts.edit', $post) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-blue-300 rounded-md text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <a href="{{ route('posts.show', $post) }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <i class="fas fa-external-link-alt mr-1"></i> Lihat
                                </a>
                            </div>
                            
                            <form action="{{ route('admin.posts.destroy', $post) }}" 
                                  method="POST" 
                                  class="inline" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-1 border border-red-300 rounded-md text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                        
                        @if($totalLikes > 0 || $totalShares > 0 || $totalDownloads > 0)
                        <a href="{{ route('admin.posts.stats', $post) }}" 
                           class="inline-flex items-center justify-center px-3 py-1 border border-purple-300 rounded-md text-xs font-medium text-purple-700 bg-purple-50 hover:bg-purple-100 w-full">
                            <i class="fas fa-chart-bar mr-1"></i> Lihat Detail Statistik
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-inbox text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada postingan</h3>
                    <p class="text-gray-500 mb-4">Belum ada postingan yang dibuat</p>
                    @if(request()->anyFilled(['search', 'status', 'category']))
                        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Tampilkan semua postingan
                        </a>
                    @else
                        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i> Buat Postingan Pertama
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($posts->hasPages())
        <div class="mt-6">
            {{ $posts->withQueryString()->links() }}
        </div>
    @endif

    @push('scripts')
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipElements = document.querySelectorAll('[data-tooltip]');
            
            tooltipElements.forEach(element => {
                const tooltipText = element.getAttribute('data-tooltip');
                const tooltip = document.createElement('span');
                tooltip.className = 'hidden md:inline-block absolute z-10 py-1 px-2 text-xs font-medium text-white bg-gray-900 rounded-md shadow-sm opacity-0 group-hover:opacity-100 transition-opacity duration-200';
                tooltip.textContent = tooltipText;
                
                const wrapper = document.createElement('div');
                wrapper.className = 'relative flex items-center group';
                
                // Wrap the element with the wrapper
                element.parentNode.insertBefore(wrapper, element);
                wrapper.appendChild(element);
                wrapper.appendChild(tooltip);
                
                // Position the tooltip
                function positionTooltip() {
                    const rect = element.getBoundingClientRect();
                    tooltip.style.top = `${rect.top - 30}px`;
                    tooltip.style.left = `${rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)}px`;
                }
                
                element.addEventListener('mouseenter', positionTooltip);
                window.addEventListener('resize', positionTooltip);
            });
        });
    </script>
    @endpush
@endsection


