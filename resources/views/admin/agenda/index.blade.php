@extends('admin.layout')

@section('title', 'Kelola Agenda')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Agenda Sekolah</h1>
                <p class="text-gray-600 mt-1">Kelola agenda dan kegiatan sekolah dengan batas waktu</p>
            </div>
            <a href="{{ route('admin.agenda.create') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Tambah Agenda
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Agenda</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-calendar text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Akan Datang</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['akan_datang'] }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-clock text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Dilaksanakan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['dilaksanakan'] }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-gray-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Selesai</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['selesai'] }}</p>
                    </div>
                    <div class="bg-gray-100 p-3 rounded-full">
                        <i class="fas fa-check-double text-gray-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-lg border border-gray-200 mb-6 p-3">
        <form method="GET" action="{{ route('admin.agenda.index') }}" class="flex flex-wrap items-center gap-2">
            <div class="flex-1 min-w-[200px]">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari agenda..." 
                       class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <select name="status" class="px-3 py-1.5 text-sm border border-gray-200 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-white">
                <option value="all">Semua Status</option>
                <option value="akan_datang" {{ request('status') == 'akan_datang' ? 'selected' : '' }}>Akan Datang</option>
                <option value="dilaksanakan" {{ request('status') == 'dilaksanakan' ? 'selected' : '' }}>Dilaksanakan</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>

            <select name="filter" class="px-3 py-1.5 text-sm border border-gray-200 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-white">
                <option value="">Semua Waktu</option>
                <option value="bulan_ini" {{ request('filter') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
            </select>

            <button type="submit" class="px-4 py-1.5 text-sm font-medium bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                Cari
            </button>

            @if(request('search') || request('status') || request('filter'))
                <a href="{{ route('admin.agenda.index') }}" class="px-3 py-1.5 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Agenda Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($agendas->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Agenda</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($agendas as $agenda)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-start">
                                        <div class="w-3 h-3 rounded-full mt-1 mr-3 flex-shrink-0" style="background-color: {{ $agenda->warna }}"></div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $agenda->judul }}</div>
                                            <div class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($agenda->deskripsi, 100) }}</div>
                                            @if($agenda->isKadaluwarsa())
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 mt-1">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                                    Kadaluwarsa
                                                </span>
                                            @elseif($agenda->isBerlangsung())
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                                    Sedang Berlangsung
                                                </span>
                                            @elseif($agenda->isAkanDatang())
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 mt-1">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Akan Datang
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $agenda->getFormattedDateRange() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $agenda->getFormattedTimeRange() ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $agenda->lokasi ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $agenda->getStatusBadgeColor() }}">
                                        {{ $agenda->getStatusLabel() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.agenda.edit', $agenda) }}" 
                                           class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" 
                                                title="Hapus"
                                                onclick="confirmDelete({{ $agenda->id }}, '{{ addslashes($agenda->judul) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $agendas->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-calendar-times text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada agenda</h3>
                <p class="text-gray-500 mb-4">Belum ada agenda yang ditambahkan</p>
                <a href="{{ route('admin.agenda.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Agenda Pertama
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 max-w-sm w-full mx-4">
        <!-- Header with close button -->
        <div class="flex items-center justify-between p-6 pb-4">
            <h3 class="text-xl font-bold text-gray-900">Hapus Agenda</h3>
            <button type="button" onclick="hideModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Content -->
        <div class="px-6 pb-6">
            <p class="text-gray-600 text-sm leading-relaxed mb-6">
                Apakah Anda yakin ingin menghapus agenda <strong id="agendaTitle" class="text-gray-900"></strong>? 
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

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

    <script>
        let currentAgendaId = null;
        let currentAgendaTitle = null;

        function confirmDelete(agendaId, agendaTitle) {
            console.log('confirmDelete called with:', agendaId, agendaTitle);
            currentAgendaId = agendaId;
            currentAgendaTitle = agendaTitle;
            
            // Set agenda title in modal
            const agendaTitleEl = document.getElementById('agendaTitle');
            if (agendaTitleEl) {
                agendaTitleEl.textContent = agendaTitle;
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
            formEl.action = `/admin/agenda/${agendaId}`;
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
