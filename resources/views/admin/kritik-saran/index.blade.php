@extends('admin.layout')

@section('title', 'Kritik & Saran')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kritik & Saran</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola masukan dan saran dari pengunjung website</p>
        </div>
        <div class="mt-4 md:mt-0">
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    <i class="fas fa-envelope mr-1"></i>
                    {{ $unreadCount }} Belum Dibaca
                </span>
            </div>
        </div>
    </div>

    <!-- Filter Status -->
    <div class="card mb-6">
        <div class="p-4 border-b border-gray-200">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.kritik-saran.index') }}" 
                   class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium transition-colors
                          {{ $status === 'all' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                    <i class="fas fa-list mr-2"></i>
                    Semua
                </a>
                <a href="{{ route('admin.kritik-saran.index', ['status' => 'unread']) }}" 
                   class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium transition-colors
                          {{ $status === 'unread' ? 'bg-yellow-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                    <i class="fas fa-envelope mr-2"></i>
                    Belum Dibaca ({{ $unreadCount }})
                </a>
                <a href="{{ route('admin.kritik-saran.index', ['status' => 'read']) }}" 
                   class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium transition-colors
                          {{ $status === 'read' ? 'bg-green-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                    <i class="fas fa-envelope-open mr-2"></i>
                    Sudah Dibaca
                </a>
            </div>
        </div>
    </div>

    <!-- Messages Grid -->
    @if($kritikSaran->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kritikSaran as $item)
                <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow {{ $item->status === 'unread' ? 'border-yellow-300 bg-yellow-50' : '' }}">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-500"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">{{ $item->nama }}</h3>
                                <p class="text-xs text-gray-500">{{ $item->email }}</p>
                            </div>
                        </div>
                        
                        @if($item->status === 'unread')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-envelope mr-1"></i> Baru
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Dibaca
                            </span>
                        @endif
                    </div>
                    
                    <!-- Message -->
                    <div class="mb-4">
                        <p class="text-sm text-gray-700 line-clamp-3">{{ $item->pesan }}</p>
                    </div>
                    
                    <!-- Date -->
                    <div class="text-xs text-gray-500 mb-4">
                        {{ $item->created_at->format('d M Y, H:i') }}
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.kritik-saran.show', $item->id) }}" 
                               class="inline-flex items-center px-3 py-1 border border-blue-300 rounded-md text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                            
                            @if($item->status === 'unread')
                                <form action="{{ route('admin.kritik-saran.mark-read', $item->id) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-1 border border-green-300 rounded-md text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100">
                                        <i class="fas fa-check mr-1"></i> Tandai Dibaca
                                    </button>
                                </form>
                            @endif
                        </div>
                        
                        <!-- Rating Display (Center) -->
                        <div class="flex items-center">
                            @if($item->rating)
                                <div class="flex items-center space-x-1 px-3 py-1 bg-yellow-50 rounded-md border border-yellow-200">
                                    @for($i = 1; $i <= $item->rating; $i++)
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    @endfor
                                    <span class="text-xs font-semibold text-yellow-700 ml-1">{{ $item->rating }}/5</span>
                                </div>
                            @else
                                <span class="text-xs text-gray-400 italic">No rating</span>
                            @endif
                        </div>
                        
                        <form action="{{ route('admin.kritik-saran.destroy', $item->id) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1 border border-red-300 rounded-md text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($kritikSaran->hasPages())
            <div class="mt-6">
                {{ $kritikSaran->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-inbox text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada pesan</h3>
            <p class="text-gray-500">
                @if($status === 'unread')
                    Tidak ada pesan yang belum dibaca.
                @elseif($status === 'read')
                    Tidak ada pesan yang sudah dibaca.
                @else
                    Belum ada kritik dan saran yang masuk.
                @endif
            </p>
        </div>
    @endif

    @push('scripts')
    <script>
        function showFullMessage(id) {
            // This would open a modal or expand the message
            // For now, we'll redirect to the show page
            window.location.href = `/admin/kritik-saran/${id}`;
        }
    </script>
    @endpush
@endsection
