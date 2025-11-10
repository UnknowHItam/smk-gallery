@extends('admin.layout')

@section('title','Edit Postingan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Postingan</h1>
            <p class="text-gray-600 mt-1">Perbarui konten: {{ $post->judul }}</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn-secondary">
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

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <!-- Basic Information -->
            <div class="form-section">
                <h3 class="form-section-title">Informasi Dasar</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Judul Postingan <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $post->judul) }}" 
                               class="form-input" 
                               placeholder="Masukkan judul postingan yang menarik" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" 
                                        {{ old('kategori_id', $post->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status Publikasi <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="radio-card {{ old('status', $post->status) == 'draft' ? 'ring-2 ring-blue-500 border-blue-500' : 'border-gray-200' }}">
                            <input type="radio" name="status" value="draft" {{ old('status', $post->status) == 'draft' ? 'checked' : '' }} class="sr-only">
                            <div class="radio-card-content">
                                <i class="fas fa-edit text-yellow-500 text-xl mb-2"></i>
                                <span class="font-medium">Draft</span>
                                <p class="text-xs text-gray-500 mt-1">Simpan sebagai draft</p>
                            </div>
                        </label>
                        <label class="radio-card {{ old('status', $post->status) == 'published' ? 'ring-2 ring-blue-500 border-blue-500' : 'border-gray-200' }}">
                            <input type="radio" name="status" value="published" {{ old('status', $post->status) == 'published' ? 'checked' : '' }} class="sr-only">
                            <div class="radio-card-content">
                                <i class="fas fa-globe text-green-500 text-xl mb-2"></i>
                                <span class="font-medium">Published</span>
                                <p class="text-xs text-gray-500 mt-1">Publikasikan langsung</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="form-section">
                <h3 class="form-section-title">Konten</h3>
                <div class="form-group">
                    <label class="form-label">Isi Postingan <span class="text-red-500">*</span></label>
                    <textarea name="isi" rows="10" 
                              class="form-textarea" 
                              placeholder="Tulis konten postingan di sini..." required>{{ old('isi', $post->isi) }}</textarea>
                    <p class="form-help">Gunakan format yang jelas dan mudah dibaca</p>
                </div>
            </div>

            <!-- Media Management -->
            <div class="form-section">
                <h3 class="form-section-title">Media</h3>
                
                @php
                    $fotos = $post->galery->count() > 0 ? $post->galery->first()->foto : collect();
                    // Foto utama adalah yang punya judul 'Foto Utama'
                    $fotoUtama = $fotos->where('judul', 'Foto Utama')->first();
                    // Foto galeri adalah semua foto kecuali foto utama
                    $fotosGaleri = $fotos->where('judul', '!=', 'Foto Utama');
                @endphp

                <!-- Foto Utama Saat Ini -->
                @if($fotoUtama)
                    <div class="form-group">
                        <label class="form-label">Foto Utama Saat Ini</label>
                        <div class="max-w-sm">
                            <div class="relative overflow-hidden rounded-xl border-2 border-blue-300 shadow-md">
                                <img src="{{ asset('storage/posts/' . $fotoUtama->file) }}" 
                                     alt="{{ $fotoUtama->judul }}" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full font-semibold">
                                    Foto Utama
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">{{ $fotoUtama->judul ?: 'Tanpa judul' }}</p>
                            <button type="button" onclick="deleteFoto({{ $fotoUtama->id }})" 
                                    class="mt-2 text-sm text-red-600 hover:text-red-800 font-medium">
                                <i class="fas fa-trash mr-1"></i> Hapus Foto Utama
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Galeri Lainnya Saat Ini -->
                @if($fotosGaleri->count() > 0)
                    <div class="form-group mt-6">
                        <label class="form-label">Galeri Lainnya Saat Ini ({{ $fotosGaleri->count() }} foto)</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($fotosGaleri as $foto)
                                <div class="relative group">
                                    <div class="relative overflow-hidden rounded-xl border-2 border-gray-200">
                                        <img src="{{ asset('storage/posts/' . $foto->file) }}" 
                                             alt="{{ $foto->judul }}" 
                                             class="w-full h-32 object-cover">
                                        <button type="button" onclick="deleteFoto({{ $foto->id }})" 
                                                class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 truncate">{{ $foto->judul ?: 'Tanpa judul' }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Upload Foto - Grid Layout 2 Kolom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Upload Foto Utama -->
                    <div class="form-group">
                        <label class="form-label">{{ $fotoUtama ? 'Ganti Foto Utama' : 'Upload Foto Utama' }}</label>
                        <p class="text-sm text-gray-600 mb-3">Upload 1 foto sebagai thumbnail utama postingan</p>
                        <div class="file-upload-area" onclick="document.getElementById('foto-utama-input').click()">
                            <div class="text-center py-6">
                                <i class="fas fa-image text-3xl text-blue-400 mb-3"></i>
                                <p class="text-base font-medium text-gray-700 mb-1">Klik untuk upload foto utama</p>
                                <p class="text-xs text-gray-400 mt-1">Maksimal 100MB, format: JPG, PNG, GIF</p>
                            </div>
                        </div>
                        <input type="file" id="foto-utama-input" name="foto_utama" accept="image/*" class="hidden">
                        
                        <div id="foto-utama-preview" class="hidden mt-3">
                            <label class="form-label">Preview Foto Utama Baru</label>
                            <div id="preview-utama-container" class="max-w-sm"></div>
                        </div>
                    </div>

                    <!-- Upload Galeri Lainnya -->
                    <div class="form-group">
                        <label class="form-label">Tambah Foto ke Galeri Lainnya</label>
                        <p class="text-sm text-gray-600 mb-3">Upload banyak foto untuk menambah ke galeri (opsional)</p>
                        <div class="file-upload-area" onclick="document.getElementById('foto-galeri-input').click()">
                            <div class="text-center py-6">
                                <i class="fas fa-images text-3xl text-green-400 mb-3"></i>
                                <p class="text-base font-medium text-gray-700 mb-1">Klik untuk upload banyak foto</p>
                                <p class="text-xs text-gray-500">atau drag & drop file di sini</p>
                                <p class="text-xs text-gray-400 mt-1">Bisa pilih banyak foto sekaligus - Maksimal 100MB per foto</p>
                            </div>
                        </div>
                        <input type="file" id="foto-galeri-input" name="fotos_galeri[]" multiple accept="image/*" class="hidden">
                        
                        <div id="foto-galeri-preview" class="hidden mt-3">
                            <label class="form-label">Preview Foto Baru</label>
                            <div id="preview-container" class="grid grid-cols-2 gap-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="{{ route('admin.posts.index') }}" class="btn-secondary">
                <i class="fas fa-times mr-2"></i>
                Batal
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i>
                Update Postingan
            </button>
        </div>
    </form>
</div>

<!-- Modal Konfirmasi Hapus Foto -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4" style="backdrop-filter: blur(4px); background-color: rgba(0, 0, 0, 0.4);">
    <!-- Modal panel -->
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all">
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-900">Hapus Foto</h3>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="mb-5">
                <p class="text-gray-700 leading-relaxed">
                    Apakah Anda yakin ingin menghapus foto ini? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            <!-- Input konfirmasi -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Ketik 'Delete' untuk konfirmasi
                </label>
                <input type="text" id="deleteConfirmInput" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all" 
                       placeholder="Delete">
            </div>

            <!-- Actions -->
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                    Batal
                </button>
                <button id="confirmDeleteBtn" onclick="confirmDelete()" disabled
                        class="flex-1 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

    <script>
        // Validasi ukuran file (maksimal 100MB)
        const MAX_FILE_SIZE = 100 * 1024 * 1024; // 100MB in bytes
        const MAX_FILE_SIZE_TEXT = '100MB';

        function validateFileSize(file, inputElement) {
            if (file.size > MAX_FILE_SIZE) {
                // Show error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'mt-3 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg';
                errorDiv.innerHTML = `
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-red-800">Ukuran File Terlalu Besar!</h4>
                            <p class="text-sm text-red-700 mt-1">
                                File yang Anda pilih berukuran <strong>${(file.size / 1024 / 1024).toFixed(2)} MB</strong>.
                                Ukuran maksimal yang diperbolehkan adalah <strong>${MAX_FILE_SIZE_TEXT}</strong>.
                            </p>
                            <p class="text-sm text-red-600 mt-2">
                                Silakan kompres atau pilih foto dengan ukuran lebih kecil.
                            </p>
                        </div>
                    </div>
                `;
                
                // Insert error message after the input's parent
                const uploadArea = inputElement.closest('.form-group');
                const existingError = uploadArea.querySelector('.file-size-error');
                if (existingError) {
                    existingError.remove();
                }
                errorDiv.classList.add('file-size-error');
                uploadArea.appendChild(errorDiv);
                
                // Clear the input
                inputElement.value = '';
                return false;
            }
            
            // Remove error message if exists
            const uploadArea = inputElement.closest('.form-group');
            const existingError = uploadArea.querySelector('.file-size-error');
            if (existingError) {
                existingError.remove();
            }
            
            return true;
        }

        // Preview Foto Utama
        document.getElementById('foto-utama-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('preview-utama-container');
            const fotoPreview = document.getElementById('foto-utama-preview');
            
            previewContainer.innerHTML = '';
            
            if (file && file.type.startsWith('image/')) {
                // Validate file size
                if (!validateFileSize(file, this)) {
                    fotoPreview.classList.add('hidden');
                    return;
                }
                
                fotoPreview.classList.remove('hidden');
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <div class="relative overflow-hidden rounded-xl border-2 border-blue-300 shadow-md">
                            <img src="${e.target.result}" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full font-semibold">
                                Foto Utama Baru
                            </div>
                        </div>
                        <input type="text" name="foto_utama_judul" 
                               placeholder="Judul foto utama (opsional)" 
                               class="w-full mt-2 text-sm form-input">
                    `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            } else {
                fotoPreview.classList.add('hidden');
            }
        });

        // Store selected files for galeri
        let galeriFiles = [];
        
        // Preview Galeri Lainnya (Multiple) - Support incremental upload
        document.getElementById('foto-galeri-input').addEventListener('change', function(e) {
            const files = e.target.files;
            const previewContainer = document.getElementById('preview-container');
            const fotoPreview = document.getElementById('foto-galeri-preview');
            
            if (files.length > 0) {
                // Validate all files
                let allValid = true;
                let invalidFiles = [];
                
                Array.from(files).forEach((file) => {
                    if (file.size > MAX_FILE_SIZE) {
                        allValid = false;
                        invalidFiles.push({
                            name: file.name,
                            size: (file.size / 1024 / 1024).toFixed(2)
                        });
                    }
                });
                
                if (!allValid) {
                    // Show error for invalid files
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'mt-3 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg';
                    let fileList = invalidFiles.map(f => `<li>${f.name} (${f.size} MB)</li>`).join('');
                    errorDiv.innerHTML = `
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-red-800">Beberapa File Terlalu Besar!</h4>
                                <p class="text-sm text-red-700 mt-1">
                                    File berikut melebihi ukuran maksimal <strong>${MAX_FILE_SIZE_TEXT}</strong>:
                                </p>
                                <ul class="list-disc list-inside text-sm text-red-600 mt-2 ml-2">
                                    ${fileList}
                                </ul>
                                <p class="text-sm text-red-600 mt-2">
                                    Silakan kompres atau pilih foto dengan ukuran lebih kecil.
                                </p>
                            </div>
                        </div>
                    `;
                    
                    const uploadArea = this.closest('.form-group');
                    const existingError = uploadArea.querySelector('.file-size-error');
                    if (existingError) {
                        existingError.remove();
                    }
                    errorDiv.classList.add('file-size-error');
                    uploadArea.appendChild(errorDiv);
                    
                    // Clear the input
                    this.value = '';
                    return;
                }
                
                // Remove error message if exists
                const uploadArea = this.closest('.form-group');
                const existingError = uploadArea.querySelector('.file-size-error');
                if (existingError) {
                    existingError.remove();
                }
                
                fotoPreview.classList.remove('hidden');
                
                // Add new files to existing array
                Array.from(files).forEach((file) => {
                    if (file.type.startsWith('image/')) {
                        galeriFiles.push(file);
                    }
                });
                
                // Re-render all previews
                renderGaleriPreviews();
            }
            
            // Clear input to allow selecting same file again
            this.value = '';
        });
        
        // Function to render galeri previews with delete buttons
        function renderGaleriPreviews() {
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = '';
            
            galeriFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.dataset.fileIndex = index;
                    div.innerHTML = `
                        <div class="relative overflow-hidden rounded-xl border-2 border-gray-200 hover:border-green-300 transition-colors">
                            <img src="${e.target.result}" class="w-full h-32 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200"></div>
                            <div class="absolute top-2 left-2 bg-green-600 text-white text-xs px-2 py-1 rounded-full font-semibold">
                                #${index + 1}
                            </div>
                            <button type="button" onclick="removeGaleriFile(${index})" 
                                    class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full w-6 h-6 flex items-center justify-center transition-colors shadow-lg opacity-0 group-hover:opacity-100">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                        <input type="text" class="galeri-judul-input w-full mt-2 text-sm form-input" 
                               data-index="${index}"
                               placeholder="Judul foto (opsional)">
                    `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
            
            // Update file input with current files
            updateGaleriFileInput();
        }
        
        // Function to remove file from galeri
        function removeGaleriFile(index) {
            galeriFiles.splice(index, 1);
            renderGaleriPreviews();
            
            // Hide preview section if no files
            if (galeriFiles.length === 0) {
                document.getElementById('foto-galeri-preview').classList.add('hidden');
            }
        }
        
        // Function to update file input with current files
        function updateGaleriFileInput() {
            const input = document.getElementById('foto-galeri-input');
            const dt = new DataTransfer();
            
            galeriFiles.forEach(file => {
                dt.items.add(file);
            });
            
            input.files = dt.files;
        }
        
        // Make removeGaleriFile available globally
        window.removeGaleriFile = removeGaleriFile;

        // Modal functions
        let currentFotoId = null;

        function deleteFoto(fotoId) {
            currentFotoId = fotoId;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteConfirmInput').value = '';
            document.getElementById('deleteConfirmInput').focus();
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            currentFotoId = null;
            document.getElementById('deleteConfirmInput').value = '';
        }

        function confirmDelete() {
            const confirmInput = document.getElementById('deleteConfirmInput').value;
            
            if (confirmInput.toLowerCase() !== 'delete') {
                // Show error in input
                const input = document.getElementById('deleteConfirmInput');
                input.classList.add('border-red-500', 'ring-1', 'ring-red-500');
                setTimeout(() => {
                    input.classList.remove('border-red-500', 'ring-1', 'ring-red-500');
                }, 2000);
                return;
            }

            if (!currentFotoId) return;

            // Disable button
            const btn = document.getElementById('confirmDeleteBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menghapus...';

            fetch(`/admin/fotos/${currentFotoId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showNotification('Foto berhasil dihapus!', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showNotification('Gagal menghapus foto: ' + data.message, 'error');
                    btn.disabled = false;
                    btn.innerHTML = 'Hapus';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menghapus foto', 'error');
                btn.disabled = false;
                btn.innerHTML = 'Hapus';
            });
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white font-medium`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-3"></i>
                    <span>${message}</span>
                </div>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Enable delete button only when "Delete" is typed
        document.getElementById('deleteConfirmInput').addEventListener('input', function(e) {
            const btn = document.getElementById('confirmDeleteBtn');
            if (e.target.value.toLowerCase() === 'delete') {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        });

        // Radio card selection
        document.querySelectorAll('.radio-card input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.radio-card').forEach(card => {
                    card.classList.remove('ring-2', 'ring-blue-500', 'border-blue-500');
                    card.classList.add('border-gray-200');
                });
                
                if (this.checked) {
                    this.closest('.radio-card').classList.remove('border-gray-200');
                    this.closest('.radio-card').classList.add('ring-2', 'ring-blue-500', 'border-blue-500');
                }
            });
        });
    </script>
@endsection


