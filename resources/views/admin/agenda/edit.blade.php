@extends('admin.layout')

@section('title', 'Edit Agenda')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('admin.agenda.index') }}" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Agenda</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi agenda</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow">
        <form action="{{ route('admin.agenda.update', $agenda) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Agenda <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="judul" 
                       id="judul" 
                       value="{{ old('judul', $agenda->judul) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @enderror"
                       placeholder="Contoh: Ujian Tengah Semester"
                       required>
                @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea name="deskripsi" 
                          id="deskripsi" 
                          rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror"
                          placeholder="Jelaskan detail agenda..."
                          required>{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="tanggal_mulai" 
                           id="tanggal_mulai" 
                           value="{{ old('tanggal_mulai', $agenda->tanggal_mulai->format('Y-m-d')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_mulai') border-red-500 @enderror"
                           required>
                    @error('tanggal_mulai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="tanggal_selesai" 
                           id="tanggal_selesai" 
                           value="{{ old('tanggal_selesai', $agenda->tanggal_selesai->format('Y-m-d')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_selesai') border-red-500 @enderror"
                           required>
                    @error('tanggal_selesai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Waktu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                        Waktu Mulai (Opsional)
                    </label>
                    <input type="time" 
                           name="waktu_mulai" 
                           id="waktu_mulai" 
                           value="{{ old('waktu_mulai', $agenda->waktu_mulai ? \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') : '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('waktu_mulai') border-red-500 @enderror">
                    @error('waktu_mulai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="waktu_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                        Waktu Selesai (Opsional)
                    </label>
                    <input type="time" 
                           name="waktu_selesai" 
                           id="waktu_selesai" 
                           value="{{ old('waktu_selesai', $agenda->waktu_selesai ? \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') : '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('waktu_selesai') border-red-500 @enderror">
                    @error('waktu_selesai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Lokasi -->
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Lokasi (Opsional)
                </label>
                <input type="text" 
                       name="lokasi" 
                       id="lokasi" 
                       value="{{ old('lokasi', $agenda->lokasi) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('lokasi') border-red-500 @enderror"
                       placeholder="Contoh: Aula Sekolah">
                @error('lokasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status & Warna -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" 
                            id="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                            required>
                        <option value="aktif" {{ old('status', $agenda->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ old('status', $agenda->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ old('status', $agenda->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="warna" class="block text-sm font-medium text-gray-700 mb-2">
                        Warna Label
                    </label>
                    <div class="flex items-center space-x-3">
                        <input type="color" 
                               name="warna" 
                               id="warna" 
                               value="{{ old('warna', $agenda->warna) }}"
                               class="h-10 w-20 border border-gray-300 rounded-lg cursor-pointer">
                        <span class="text-sm text-gray-600">Pilih warna untuk label agenda</span>
                    </div>
                    @error('warna')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status Info -->
            @if($agenda->isKadaluwarsa())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Agenda Kadaluwarsa</h3>
                            <p class="mt-1 text-sm text-red-700">
                                Agenda ini sudah melewati tanggal selesai dan tidak akan ditampilkan di halaman utama.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-600"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Informasi</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            @if($agenda->user)
                                <p>Dibuat oleh: <strong>{{ $agenda->user->name }}</strong></p>
                            @endif
                            <p>Dibuat pada: {{ $agenda->created_at->format('d M Y H:i') }}</p>
                            @if($agenda->updated_at != $agenda->created_at)
                                <p>Terakhir diupdate: {{ $agenda->updated_at->format('d M Y H:i') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.agenda.index') }}" class="btn-secondary">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    Update Agenda
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
