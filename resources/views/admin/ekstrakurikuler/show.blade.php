@extends('admin.layout')

@section('title','Detail Ekstrakurikuler')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Detail Ekstrakurikuler</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.ekstrakurikuler.edit', $ekstrakurikuler) }}" 
               class="px-3 py-2 rounded bg-blue-600 text-white text-sm">Edit</a>
            <a href="{{ route('admin.ekstrakurikuler.index') }}" 
               class="px-3 py-2 rounded border border-gray-300 text-gray-700 text-sm">Kembali</a>
        </div>
    </div>

    <div class="bg-white border rounded-lg p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Photo Section -->
            <div>
                @if($ekstrakurikuler->foto)
                    <img src="{{ asset('storage/ekstrakurikuler/' . $ekstrakurikuler->foto) }}" 
                         alt="{{ $ekstrakurikuler->nama }}" 
                         class="w-full h-64 object-cover rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400 text-lg">Tidak ada foto</span>
                    </div>
                @endif
            </div>

            <!-- Details Section -->
            <div class="space-y-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $ekstrakurikuler->nama }}</h2>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        {{ $ekstrakurikuler->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $ekstrakurikuler->status ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $ekstrakurikuler->deskripsi }}</p>
                </div>

                @if($ekstrakurikuler->pembina)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Pembina</h3>
                        <p class="text-gray-700">{{ $ekstrakurikuler->pembina }}</p>
                    </div>
                @endif

                @if($ekstrakurikuler->hari_kegiatan || $ekstrakurikuler->jam_mulai)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Jadwal Kegiatan</h3>
                        <div class="space-y-2">
                            @if($ekstrakurikuler->hari_kegiatan)
                                <p class="text-gray-700"><span class="font-medium">Hari:</span> {{ $ekstrakurikuler->hari_kegiatan }}</p>
                            @endif
                            @if($ekstrakurikuler->jam_mulai)
                                <p class="text-gray-700">
                                    <span class="font-medium">Waktu:</span> 
                                    {{ $ekstrakurikuler->jam_mulai }}
                                    @if($ekstrakurikuler->jam_selesai)
                                        - {{ $ekstrakurikuler->jam_selesai }}
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                @endif

                @if($ekstrakurikuler->tempat)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tempat</h3>
                        <p class="text-gray-700">{{ $ekstrakurikuler->tempat }}</p>
                    </div>
                @endif

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Informasi Tambahan</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><span class="font-medium">Dibuat:</span> {{ $ekstrakurikuler->created_at->format('d M Y H:i') }}</p>
                        <p><span class="font-medium">Diperbarui:</span> {{ $ekstrakurikuler->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
