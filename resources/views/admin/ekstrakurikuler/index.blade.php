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
                        
                        <button type="button" 
                                class="inline-flex items-center px-3 py-1 border border-red-300 rounded-md text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100"
                                onclick="confirmDelete({{ $ekstrakurikuler->id }}, '{{ addslashes($ekstrakurikuler->nama) }}')">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 max-w-sm w-full mx-4">
            <!-- Header with close button -->
            <div class="flex items-center justify-between p-6 pb-4">
                <h3 class="text-xl font-bold text-gray-900">Hapus Ekstrakurikuler</h3>
                <button type="button" onclick="hideModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Content -->
            <div class="px-6 pb-6">
                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    Apakah Anda yakin ingin menghapus ekstrakurikuler <strong id="ekstrakurikulerName" class="text-gray-900"></strong>? 
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                
                <!-- Confirmation input -->
                <div class="mb-6">
                    <input type="text" 
                           id="deleteConfirmInput" 
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all" 
                           placeholder="Ketik 'Delete' untuk konfirmasi"
                           autocomplete="off">
                    <div id="deleteError" class="text-red-500 text-xs mt-2 hidden">
                        <i class="fas fa-exclamation-circle mr-1"></i>Ketik "Delete" untuk melanjutkan
                    </div>
                </div>
                
                <!-- Action buttons -->
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" 
                                class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all font-medium" 
                                onclick="hideModal()">
                            Batal
                        </button>
                        <button type="button" 
                                id="deleteButton"
                                class="flex-1 px-4 py-3 bg-gray-300 text-gray-500 rounded-xl focus:outline-none transition-all font-medium disabled:cursor-not-allowed" 
                                onclick="submitDelete()" 
                                disabled>
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Backdrop -->
    <div id="deleteModalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <script>
        let currentEkstrakurikulerId = null;
        let currentEkstrakurikulerName = null;

        function confirmDelete(ekstrakurikulerId, ekstrakurikulerName) {
            console.log('confirmDelete called with:', ekstrakurikulerId, ekstrakurikulerName);
            currentEkstrakurikulerId = ekstrakurikulerId;
            currentEkstrakurikulerName = ekstrakurikulerName;
            
            // Set ekstrakurikuler name in modal
            const ekstrakurikulerNameEl = document.getElementById('ekstrakurikulerName');
            if (ekstrakurikulerNameEl) {
                ekstrakurikulerNameEl.textContent = ekstrakurikulerName;
            }
            
            // Reset input and button state
            const inputEl = document.getElementById('deleteConfirmInput');
            const deleteButton = document.getElementById('deleteButton');
            const errorEl = document.getElementById('deleteError');
            
            if (inputEl) {
                inputEl.value = '';
                inputEl.classList.remove('border-red-500');
                inputEl.classList.add('border-gray-200');
            }
            
            if (deleteButton) {
                deleteButton.disabled = true;
                deleteButton.className = 'flex-1 px-4 py-3 bg-gray-300 text-gray-500 rounded-xl focus:outline-none transition-all font-medium disabled:cursor-not-allowed';
            }
            
            if (errorEl) errorEl.classList.add('hidden');
            
            // Set form action
            const formEl = document.getElementById('deleteForm');
            if (formEl) {
                formEl.action = `/admin/ekstrakurikuler/${ekstrakurikulerId}`;
            }
            
            // Show modal
            const modalEl = document.getElementById('deleteModal');
            const backdropEl = document.getElementById('deleteModalBackdrop');
            
            if (modalEl && backdropEl) {
                modalEl.classList.remove('hidden');
                backdropEl.classList.remove('hidden');
                
                // Auto-focus input after modal shown
                setTimeout(() => {
                    if (inputEl) inputEl.focus();
                }, 100);
            }
        }

        function submitDelete() {
            const input = document.getElementById('deleteConfirmInput');
            const errorMsg = document.getElementById('deleteError');
            
            if (input.value !== 'Delete') {
                errorMsg.classList.remove('hidden');
                input.classList.remove('border-gray-200');
                input.classList.add('border-red-500');
                input.focus();
                return;
            }
            
            // Submit form
            const form = document.getElementById('deleteForm');
            if (form && form.action) {
                form.submit();
            }
        }

        function hideModal() {
            const modalEl = document.getElementById('deleteModal');
            const backdropEl = document.getElementById('deleteModalBackdrop');
            
            if (modalEl && backdropEl) {
                modalEl.classList.add('hidden');
                backdropEl.classList.add('hidden');
            }
        }

        // Close modal when clicking on backdrop
        document.addEventListener('click', function(e) {
            if (e.target.id === 'deleteModalBackdrop') {
                hideModal();
            }
        });

        // Wait for DOM to be ready
        document.addEventListener('DOMContentLoaded', function() {
            // Real-time validation for delete button
            const deleteInput = document.getElementById('deleteConfirmInput');
            if (deleteInput) {
                deleteInput.addEventListener('input', function() {
                    const deleteButton = document.getElementById('deleteButton');
                    const errorEl = document.getElementById('deleteError');
                    
                    // Clear error
                    if (errorEl) errorEl.classList.add('hidden');
                    this.classList.remove('border-red-500');
                    this.classList.add('border-gray-200');
                    
                    // Enable/disable delete button based on input
                    if (deleteButton) {
                        if (this.value === 'Delete') {
                            deleteButton.disabled = false;
                            deleteButton.className = 'flex-1 px-4 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all font-medium';
                        } else {
                            deleteButton.disabled = true;
                            deleteButton.className = 'flex-1 px-4 py-3 bg-gray-300 text-gray-500 rounded-xl focus:outline-none transition-all font-medium disabled:cursor-not-allowed';
                        }
                    }
                });

                // Allow Enter key to submit
                deleteInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' && this.value === 'Delete') {
                        e.preventDefault();
                        submitDelete();
                    }
                });
            }
        });
    </script>
@endsection
