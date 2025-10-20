@extends('admin.layout')

@section('title', 'Ekstrakurikuler')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Ekstrakurikuler</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola semua kegiatan ekstrakurikuler sekolah</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.ekstrakurikuler.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-plus mr-2"></i> Tambah Ekstrakurikuler
            </a>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-6">
        <div class="p-4 border-b border-gray-200">
            <form action="{{ route('admin.ekstrakurikuler.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                               placeholder="Cari ekstrakurikuler...">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <select name="status" 
                            onchange="this.form.submit()" 
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                @if(request()->has('search') || request()->has('status'))
                    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Ekstrakurikuler Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($ekstrakurikulers as $ekstrakurikuler)
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <!-- Image -->
                <div class="aspect-video bg-gray-100">
                    @if($ekstrakurikuler->foto)
                        <img src="{{ asset('storage/ekstrakurikuler/' . $ekstrakurikuler->foto) }}" alt="{{ $ekstrakurikuler->nama }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-users text-3xl"></i>
                        </div>
                    @endif
                </div>
                
                <!-- Content -->
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $ekstrakurikuler->nama }}</h3>
                        
                        @if($ekstrakurikuler->status)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i> Tidak Aktif
                            </span>
                        @endif
                    </div>
                    
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($ekstrakurikuler->deskripsi, 100) }}</p>
                    
                    <div class="space-y-2 mb-4">
                        @if($ekstrakurikuler->pembina)
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-user mr-2 w-4"></i>
                                <span>{{ $ekstrakurikuler->pembina }}</span>
                            </div>
                        @endif
                        
                        @if($ekstrakurikuler->hari_kegiatan && $ekstrakurikuler->jam_mulai)
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-clock mr-2 w-4"></i>
                                <span>{{ $ekstrakurikuler->hari_kegiatan }}, {{ $ekstrakurikuler->jam_mulai }} - {{ $ekstrakurikuler->jam_selesai }}</span>
                            </div>
                        @endif
                        
                        @if($ekstrakurikuler->tempat)
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-map-marker-alt mr-2 w-4"></i>
                                <span>{{ $ekstrakurikuler->tempat }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.ekstrakurikuler.show', $ekstrakurikuler) }}" 
                               class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                            <a href="{{ route('admin.ekstrakurikuler.edit', $ekstrakurikuler) }}" 
                               class="inline-flex items-center px-3 py-1 border border-blue-300 rounded-md text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        </div>
                        
                        <form action="{{ route('admin.ekstrakurikuler.destroy', $ekstrakurikuler) }}" 
                              method="POST" 
                              class="inline" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1 border border-red-300 rounded-md text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada ekstrakurikuler</h3>
                    <p class="text-gray-500 mb-4">Belum ada ekstrakurikuler yang dibuat</p>
                    @if(request()->anyFilled(['search', 'status']))
                        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Tampilkan semua ekstrakurikuler
                        </a>
                    @else
                        <a href="{{ route('admin.ekstrakurikuler.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i> Tambah Ekstrakurikuler Pertama
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($ekstrakurikulers->hasPages())
        <div class="mt-6">
            {{ $ekstrakurikulers->withQueryString()->links() }}
        </div>
    @endif
@endsection
