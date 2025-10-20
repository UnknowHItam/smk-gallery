@extends('admin.layout')

@section('title', 'Manajemen Pengguna')

@section('content')
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengguna</h1>
        <p class="text-gray-600">Kelola dan pantau aktivitas pengguna sistem</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $users->total() }}</p>
                    <p class="text-sm text-gray-600">Total Pengguna</p>
                </div>
            </div>
        </div>

        <!-- Active Accounts -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-green-100">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $users->where('verification_status', 'VERIFIED')->count() }}</p>
                    <p class="text-sm text-gray-600">Akun Aktif</p>
                </div>
            </div>
        </div>

        <!-- Pending Verification -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-orange-100">
                    <i class="fas fa-clock text-orange-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $users->where('verification_status', 'PENDING_VERIFICATION')->count() }}</p>
                    <p class="text-sm text-gray-600">Pending Verifikasi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Daftar Pengguna</h2>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    {{ $users->total() }} Pengguna
                </span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terakhir Login</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terdaftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $index => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $users->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                            <span class="text-sm font-medium text-blue-600">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->verification_status === 'VERIFIED')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($user->last_login_at)
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $user->last_login_at->diffForHumans() }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->last_login_at->format('d M Y, H:i') }}</div>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">Belum login</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $user->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $user->created_at->format('H:i') }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button type="button" 
                                        class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors" 
                                        onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')"
                                        title="Hapus Pengguna">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-users text-gray-400 text-4xl mb-4"></i>
                                    <p class="text-gray-500 text-sm">Belum ada pengguna terdaftar</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 max-w-sm w-full mx-4">
            <!-- Header with close button -->
            <div class="flex items-center justify-between p-6 pb-4">
                <h3 class="text-xl font-bold text-gray-900">Hapus Akun</h3>
                <button type="button" onclick="hideModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Content -->
            <div class="px-6 pb-6">
                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    Apakah Anda yakin ingin menghapus akun <strong id="userName" class="text-gray-900"></strong>? 
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

    <!-- Security Notice Modal -->
    <div id="securityModal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden">
        <div class="bg-white rounded-xl p-6 max-w-md w-full shadow-xl border border-gray-200">
            <div class="flex items-start gap-3 mb-4">
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-shield-alt text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Catatan Keamanan</h5>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Admin tidak memiliki akses untuk melihat atau mereset kata sandi pengguna. 
                        Manajemen kata sandi sepenuhnya dikelola oleh pengguna melalui fitur "Forgot Password".
                    </p>
                </div>
            </div>
            <button type="button" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" onclick="hideSecurityModal()">
                Mengerti
            </button>
        </div>
    </div>

    <!-- Security Modal Backdrop -->
    <div id="securityModalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <script>
    let currentUserId = null;
    let currentUserName = null;

    // Show security notice modal on first visit
    document.addEventListener('DOMContentLoaded', function() {
        // Check if user has seen the security notice
        if (!sessionStorage.getItem('securityNoticeSeen')) {
            showSecurityModal();
            sessionStorage.setItem('securityNoticeSeen', 'true');
        }
    });

    function showSecurityModal() {
        const modalEl = document.getElementById('securityModal');
        const backdropEl = document.getElementById('securityModalBackdrop');
        
        if (modalEl && backdropEl) {
            modalEl.classList.remove('hidden');
            backdropEl.classList.remove('hidden');
        }
    }

    function confirmDelete(userId, userName) {
        console.log('confirmDelete called with:', userId, userName);
        
        currentUserId = userId;
        currentUserName = userName;
        
        // Set user name in modal
        const userNameEl = document.getElementById('userName');
        if (userNameEl) {
            userNameEl.textContent = userName;
            console.log('User name set to:', userName);
        }
        
        // Reset input
        const inputEl = document.getElementById('deleteConfirmInput');
        if (inputEl) {
            inputEl.value = '';
            inputEl.classList.remove('border-red-500');
        }
        
        // Hide error
        const errorEl = document.getElementById('deleteError');
        if (errorEl) errorEl.classList.add('hidden');
        
        // Set form action
        const formEl = document.getElementById('deleteForm');
        if (formEl) {
            formEl.action = `/admin/users/${userId}`;
            console.log('Form action set to:', formEl.action);
        }
        
        // Show modal
        const modalEl = document.getElementById('deleteModal');
        const backdropEl = document.getElementById('deleteModalBackdrop');
        
        console.log('Modal element found:', modalEl);
        
        if (modalEl && backdropEl) {
            modalEl.classList.remove('hidden');
            backdropEl.classList.remove('hidden');
            
            // Auto-focus input after modal shown
            setTimeout(() => {
                if (inputEl) inputEl.focus();
            }, 100);
        } else {
            console.error('Modal elements not found!');
        }
    }

    function submitDelete() {
        const input = document.getElementById('deleteConfirmInput');
        const errorMsg = document.getElementById('deleteError');
        
        if (input.value.toLowerCase() !== 'delete') {
            errorMsg.classList.remove('hidden');
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

    function hideSecurityModal() {
        const modalEl = document.getElementById('securityModal');
        const backdropEl = document.getElementById('securityModalBackdrop');
        
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
        if (e.target.id === 'securityModalBackdrop') {
            hideSecurityModal();
        }
    });

    function confirmDelete(userId, userName) {
        console.log('confirmDelete called with:', userId, userName);
        
        currentUserId = userId;
        currentUserName = userName;
        
        // Set user name in modal
        const userNameEl = document.getElementById('userName');
        if (userNameEl) {
            userNameEl.textContent = userName;
            console.log('User name set to:', userName);
        }
        
        // Reset input and button state
        const inputEl = document.getElementById('deleteConfirmInput');
        const deleteButton = document.getElementById('deleteButton');
        const errorEl = document.getElementById('deleteError');
        
        if (inputEl) {
            inputEl.value = '';
            inputEl.classList.remove('border-red-500');
        }
        
        if (deleteButton) {
            deleteButton.disabled = true;
            deleteButton.className = 'flex-1 px-4 py-3 bg-gray-300 text-gray-500 rounded-xl focus:outline-none transition-all font-medium disabled:cursor-not-allowed';
        }
        
        if (errorEl) errorEl.classList.add('hidden');
        
        // Set form action
        const formEl = document.getElementById('deleteForm');
        if (formEl) {
            formEl.action = `/admin/users/${userId}`;
            console.log('Form action set to:', formEl.action);
        }
        
        // Show modal
        const modalEl = document.getElementById('deleteModal');
        const backdropEl = document.getElementById('deleteModalBackdrop');
        
        console.log('Modal element found:', modalEl);
        
        if (modalEl && backdropEl) {
            modalEl.classList.remove('hidden');
            backdropEl.classList.remove('hidden');
            
            // Auto-focus input after modal shown
            setTimeout(() => {
                if (inputEl) inputEl.focus();
            }, 100);
        } else {
            console.error('Modal elements not found!');
        }
    }

    function submitDelete() {
        const input = document.getElementById('deleteConfirmInput');
        const errorMsg = document.getElementById('deleteError');
        
        if (input.value !== 'Delete') {
            errorMsg.classList.remove('hidden');
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

    function hideSecurityModal() {
        const modalEl = document.getElementById('securityModal');
        const backdropEl = document.getElementById('securityModalBackdrop');
        
        if (modalEl && backdropEl) {
            modalEl.classList.add('hidden');
            backdropEl.classList.add('hidden');
        }
    }

    // Real-time validation for delete button
    document.getElementById('deleteConfirmInput')?.addEventListener('input', function() {
        const deleteButton = document.getElementById('deleteButton');
        const errorEl = document.getElementById('deleteError');
        
        // Clear error
        errorEl.classList.add('hidden');
        this.classList.remove('border-red-500');
        
        // Enable/disable delete button based on input
        if (this.value === 'Delete') {
            deleteButton.disabled = false;
            deleteButton.className = 'flex-1 px-4 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all font-medium';
        } else {
            deleteButton.disabled = true;
            deleteButton.className = 'flex-1 px-4 py-3 bg-gray-300 text-gray-500 rounded-xl focus:outline-none transition-all font-medium disabled:cursor-not-allowed';
        }
    });

    // Allow Enter key to submit
    document.getElementById('deleteConfirmInput')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && this.value === 'Delete') {
            e.preventDefault();
            submitDelete();
        }
    });
    </script>
@endsection