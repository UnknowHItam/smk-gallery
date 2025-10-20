@extends('admin.layout')

@section('title', 'Detail Kritik dan Saran')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Kritik dan Saran</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $kritikSaran->created_at->format('d M Y, H:i') }} WIB</p>
        </div>
        <a href="{{ route('admin.kritik-saran.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Main Card -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
        <!-- Sender Info -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-start justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">{{ strtoupper(substr($kritikSaran->nama, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $kritikSaran->nama }}</h3>
                        <a href="mailto:{{ $kritikSaran->email }}" class="text-sm text-blue-600 hover:text-blue-700">{{ $kritikSaran->email }}</a>
                    </div>
                </div>
                @if($kritikSaran->status === 'unread')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                        <i class="fas fa-circle text-yellow-500 mr-2" style="font-size: 6px;"></i>
                        Belum Dibaca
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-2"></i>
                        Sudah Dibaca
                    </span>
                @endif
            </div>
        </div>

        <!-- Message -->
        <div class="p-6 border-b border-gray-200">
            <h4 class="text-sm font-semibold text-gray-500 uppercase mb-3">Pesan</h4>
            <p class="text-gray-700 leading-relaxed">{{ $kritikSaran->pesan }}</p>
        </div>

        <!-- Rating -->
        @if($kritikSaran->rating)
        <div class="p-6 border-b border-gray-200 bg-amber-50">
            <h4 class="text-sm font-semibold text-gray-700 uppercase mb-3">Rating Website</h4>
            <div class="flex items-center space-x-3">
                <div class="flex space-x-1">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $kritikSaran->rating ? 'text-amber-400' : 'text-gray-300' }}" style="font-size: 1.25rem;"></i>
                    @endfor
                </div>
                <span class="text-2xl font-bold text-amber-600">{{ $kritikSaran->rating }}<span class="text-base text-gray-500">/5</span></span>
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="p-6 bg-gray-50">
            <h4 class="text-sm font-semibold text-gray-700 uppercase mb-3">Aksi</h4>
            <div class="flex flex-wrap gap-3">
                @if($kritikSaran->status === 'unread')
                    <form action="{{ route('admin.kritik-saran.mark-read', $kritikSaran->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-check mr-2"></i>Tandai Dibaca
                        </button>
                    </form>
                @endif
                <a href="mailto:{{ $kritikSaran->email }}?subject=Re: Kritik dan Saran - SMK Gallery" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-reply mr-2"></i>Balas Email
                </a>
                <form action="{{ route('admin.kritik-saran.destroy', $kritikSaran->id) }}" 
                      method="POST" 
                      class="inline-block"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
