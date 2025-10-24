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
                        
                        <button type="button"
                                class="inline-flex items-center px-3 py-1 border border-red-300 rounded-md text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100"
                                onclick="confirmDeleteKS({{ $item->id }}, '{{ addslashes($item->nama) }}')">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
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

    <!-- Delete Confirmation Modal for Kritik & Saran -->
    <div id="ksDeleteModal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 max-w-sm w-full mx-4">
            <div class="flex items-center justify-between p-6 pb-4">
                <h3 class="text-xl font-bold text-gray-900">Hapus Pesan</h3>
                <button type="button" onclick="hideKSModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="px-6 pb-6">
                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    Apakah Anda yakin ingin menghapus pesan dari <strong id="ksSenderName" class="text-gray-900"></strong>?
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="mb-6">
                    <input type="text" id="ksDeleteConfirmInput" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 transition-all" placeholder="Ketik 'Delete' untuk konfirmasi" autocomplete="off">
                    <div id="ksDeleteError" class="text-red-500 text-xs mt-2 hidden">
                        <i class="fas fa-exclamation-circle mr-1"></i>Ketik "Delete" untuk melanjutkan
                    </div>
                </div>
                <form id="ksDeleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all font-medium" onclick="hideKSModal()">Batal</button>
                        <button type="button" id="ksDeleteButton" class="flex-1 px-4 py-3 bg-gray-300 text-gray-500 rounded-xl focus:outline-none transition-all font-medium disabled:cursor-not-allowed" onclick="submitKSDelete()" disabled>Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="ksDeleteModalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    @push('scripts')
    <script>
        let currentKSId = null;
        function confirmDeleteKS(id, senderName) {
            currentKSId = id;
            document.getElementById('ksSenderName').textContent = senderName;
            const input = document.getElementById('ksDeleteConfirmInput');
            const btn = document.getElementById('ksDeleteButton');
            const err = document.getElementById('ksDeleteError');
            if (input) { input.value = ''; input.classList.remove('border-red-500'); input.classList.add('border-gray-200'); }
            if (btn) { btn.disabled = true; btn.className = 'flex-1 px-4 py-3 bg-gray-300 text-gray-500 rounded-xl focus:outline-none transition-all font-medium disabled:cursor-not-allowed'; }
            if (err) err.classList.add('hidden');
            const form = document.getElementById('ksDeleteForm');
            if (form) form.action = `/admin/kritik-saran/${id}`;
            document.getElementById('ksDeleteModal').classList.remove('hidden');
            document.getElementById('ksDeleteModalBackdrop').classList.remove('hidden');
            setTimeout(() => input && input.focus(), 100);
        }
        function hideKSModal() {
            document.getElementById('ksDeleteModal').classList.add('hidden');
            document.getElementById('ksDeleteModalBackdrop').classList.add('hidden');
        }
        function submitKSDelete() {
            const input = document.getElementById('ksDeleteConfirmInput');
            const err = document.getElementById('ksDeleteError');
            if (!input || input.value !== 'Delete') {
                if (err) err.classList.remove('hidden');
                input.classList.remove('border-gray-200');
                input.classList.add('border-red-500');
                input.focus();
                return;
            }
            const form = document.getElementById('ksDeleteForm');
            if (form && form.action) form.submit();
        }
        // Backdrop click to close
        document.addEventListener('click', function(e){ if (e.target && e.target.id === 'ksDeleteModalBackdrop') hideKSModal(); });
        // Enable delete button when typing 'Delete'
        document.addEventListener('DOMContentLoaded', function(){
            const input = document.getElementById('ksDeleteConfirmInput');
            if (!input) return;
            input.addEventListener('input', function(){
                const btn = document.getElementById('ksDeleteButton');
                const err = document.getElementById('ksDeleteError');
                if (err) err.classList.add('hidden');
                this.classList.remove('border-red-500');
                this.classList.add('border-gray-200');
                if (btn) {
                    if (this.value === 'Delete') {
                        btn.disabled = false;
                        btn.className = 'flex-1 px-4 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 transition-all font-medium';
                    } else {
                        btn.disabled = true;
                        btn.className = 'flex-1 px-4 py-3 bg-gray-300 text-gray-500 rounded-xl focus:outline-none transition-all font-medium disabled:cursor-not-allowed';
                    }
                }
            });
            input.addEventListener('keypress', function(e){ if (e.key === 'Enter' && this.value === 'Delete') { e.preventDefault(); submitKSDelete(); } });
        });
    </script>
        function showFullMessage(id) {
            // This would open a modal or expand the message
            // For now, we'll redirect to the show page
            window.location.href = `/admin/kritik-saran/${id}`;
        }
    </script>
    @endpush
@endsection
