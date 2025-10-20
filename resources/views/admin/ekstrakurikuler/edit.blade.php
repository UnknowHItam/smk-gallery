@extends('admin.layout')

@section('title','Edit Ekstrakurikuler')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Ekstrakurikuler</h1>
    
    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white border rounded p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium mb-1">Nama Ekstrakurikuler <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $ekstrakurikuler->nama) }}" 
                       class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Masukkan nama ekstrakurikuler" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Pembina</label>
                <input type="text" name="pembina" value="{{ old('pembina', $ekstrakurikuler->pembina) }}" 
                       class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Nama pembina ekstrakurikuler">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="deskripsi" rows="4" 
                      class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                      placeholder="Masukkan deskripsi ekstrakurikuler" required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium mb-1">Hari Kegiatan</label>
                <select name="hari_kegiatan" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Hari</option>
                    <option value="Senin" {{ old('hari_kegiatan', $ekstrakurikuler->hari_kegiatan) == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ old('hari_kegiatan', $ekstrakurikuler->hari_kegiatan) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ old('hari_kegiatan', $ekstrakurikuler->hari_kegiatan) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ old('hari_kegiatan', $ekstrakurikuler->hari_kegiatan) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ old('hari_kegiatan', $ekstrakurikuler->hari_kegiatan) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option value="Sabtu" {{ old('hari_kegiatan', $ekstrakurikuler->hari_kegiatan) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    <option value="Minggu" {{ old('hari_kegiatan', $ekstrakurikuler->hari_kegiatan) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $ekstrakurikuler->jam_mulai) }}" 
                       class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $ekstrakurikuler->jam_selesai) }}" 
                       class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tempat</label>
            <input type="text" name="tempat" value="{{ old('tempat', $ekstrakurikuler->tempat) }}" 
                   class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   placeholder="Tempat kegiatan ekstrakurikuler">
        </div>

        <!-- Existing Photo -->
        @if($ekstrakurikuler->foto)
            <div>
                <label class="block text-sm font-medium mb-2">Foto yang ada:</label>
                <img src="{{ asset('storage/ekstrakurikuler/' . $ekstrakurikuler->foto) }}" 
                     alt="{{ $ekstrakurikuler->nama }}" 
                     class="w-32 h-32 object-cover rounded-lg border">
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium mb-1">{{ $ekstrakurikuler->foto ? 'Ganti Foto' : 'Foto' }}</label>
            <input type="file" name="foto" accept="image/*" 
                   class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <p class="text-sm text-gray-500 mt-1">Pilih foto ekstrakurikuler (maksimal 12MB)</p>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="status" value="1" {{ old('status', $ekstrakurikuler->status) ? 'checked' : '' }} 
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label class="ml-2 block text-sm text-gray-900">
                Status Aktif
            </label>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.ekstrakurikuler.index') }}" 
               class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                Update Ekstrakurikuler
            </button>
        </div>
    </form>
@endsection
