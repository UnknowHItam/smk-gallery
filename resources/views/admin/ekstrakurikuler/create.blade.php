@extends('admin.layout')

@section('title','Tambah Ekstrakurikuler')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Ekstrakurikuler</h1>
            <p class="text-gray-600 mt-1">Buat kegiatan ekstrakurikuler baru</p>
        </div>
        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>
    
    @if($errors->any())
        <div class="alert alert-error">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 mr-3"></i>
                <div>
                    <h4 class="font-medium text-red-800 mb-2">Terdapat kesalahan pada form:</h4>
                    <ul class="list-disc list-inside text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        
        <div class="space-y-6">
            <!-- Basic Information -->
            <div class="form-section">
                <h3 class="form-section-title">Informasi Dasar</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Nama Ekstrakurikuler <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" 
                               class="form-input" 
                               placeholder="Masukkan nama ekstrakurikuler" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pembina</label>
                        <input type="text" name="pembina" value="{{ old('pembina') }}" 
                               class="form-input" 
                               placeholder="Nama pembina ekstrakurikuler">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="4" 
                              class="form-textarea" 
                              placeholder="Masukkan deskripsi ekstrakurikuler" required>{{ old('deskripsi') }}</textarea>
                    <p class="form-help">Jelaskan tujuan, kegiatan, dan manfaat ekstrakurikuler</p>
                </div>
            </div>

            <!-- Schedule & Location -->
            <div class="form-section">
                <h3 class="form-section-title">Jadwal & Lokasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="form-group">
                        <label class="form-label">Hari Kegiatan</label>
                        <select name="hari_kegiatan" class="form-select">
                            <option value="">Pilih Hari</option>
                            <option value="Senin" {{ old('hari_kegiatan') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari_kegiatan') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari_kegiatan') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari_kegiatan') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari_kegiatan') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('hari_kegiatan') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ old('hari_kegiatan') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" 
                               class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" 
                               class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tempat</label>
                    <input type="text" name="tempat" value="{{ old('tempat') }}" 
                           class="form-input" 
                           placeholder="Tempat kegiatan ekstrakurikuler">
                </div>
            </div>

            <!-- Media & Status -->
            <div class="form-section">
                <h3 class="form-section-title">Media & Status</h3>
                <div class="form-group">
                    <label class="form-label">Foto Ekstrakurikuler</label>
                    <div class="file-upload-area" onclick="document.getElementById('foto-input').click()">
                        <div class="text-center py-8">
                            <i class="fas fa-camera text-4xl text-gray-400 mb-4"></i>
                            <p class="text-lg font-medium text-gray-700 mb-2">Klik untuk upload foto</p>
                            <p class="text-sm text-gray-500">atau drag & drop file di sini</p>
                            <p class="text-xs text-gray-400 mt-2">Maksimal 12MB, format: JPG, PNG, GIF</p>
                        </div>
                    </div>
                    <input type="file" id="foto-input" name="foto" accept="image/*" class="hidden">
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="radio-card {{ old('status', true) ? 'ring-2 ring-green-500 border-green-500' : 'border-gray-200' }}">
                            <input type="radio" name="status" value="1" {{ old('status', true) ? 'checked' : '' }} class="sr-only">
                            <div class="radio-card-content">
                                <i class="fas fa-check-circle text-green-500 text-xl mb-2"></i>
                                <span class="font-medium">Aktif</span>
                                <p class="text-xs text-gray-500 mt-1">Ekstrakurikuler berjalan</p>
                            </div>
                        </label>
                        <label class="radio-card {{ !old('status', true) ? 'ring-2 ring-red-500 border-red-500' : 'border-gray-200' }}">
                            <input type="radio" name="status" value="0" {{ !old('status', true) ? 'checked' : '' }} class="sr-only">
                            <div class="radio-card-content">
                                <i class="fas fa-times-circle text-red-500 text-xl mb-2"></i>
                                <span class="font-medium">Tidak Aktif</span>
                                <p class="text-xs text-gray-500 mt-1">Ekstrakurikuler dihentikan</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn-secondary">
                <i class="fas fa-times mr-2"></i>
                Batal
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i>
                Simpan Ekstrakurikuler
            </button>
        </div>
    </form>
</div>

<script>
    // Radio card selection
    document.querySelectorAll('.radio-card input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.radio-card').forEach(card => {
                card.classList.remove('ring-2', 'ring-green-500', 'border-green-500', 'ring-red-500', 'border-red-500');
                card.classList.add('border-gray-200');
            });
            
            if (this.checked) {
                const color = this.value === '1' ? 'green' : 'red';
                this.closest('.radio-card').classList.remove('border-gray-200');
                this.closest('.radio-card').classList.add('ring-2', `ring-${color}-500`, `border-${color}-500`);
            }
        });
    });
</script>
@endsection
