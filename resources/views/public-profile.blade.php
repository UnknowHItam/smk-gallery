<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .avatar-option {
            transition: all 0.3s ease;
        }
        
        .avatar-option:hover {
            transform: scale(1.1);
        }
        
        .avatar-option.selected {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
        }
        
        .profile-avatar {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen">
    <!-- Header / Navbar -->
    <header class="fixed top-0 left-0 right-0 z-50 w-full bg-white/90 backdrop-blur border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-9 object-contain">
                    <a href="{{ route('home') }}" class="text-lg sm:text-xl font-semibold tracking-wide text-gray-900">SMKN 4 BOGOR</a>
                </div>

                <div class="flex items-center gap-3">
                    <nav class="hidden md:flex items-center gap-6 text-sm mr-4">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-700 flex items-center gap-2 transition-colors"><span>🏠</span> Beranda</a>
                        <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-blue-700 flex items-center gap-2 transition-colors"><span>🖼️</span> Gallery</a>
                        <a href="{{ route('home') }}#berita" class="text-gray-700 hover:text-blue-700 flex items-center gap-2 transition-colors"><span>🎯</span> Kegiatan</a>
                        <a href="{{ route('home') }}#kontak" class="text-gray-700 hover:text-blue-700 flex items-center gap-2 transition-colors"><span>✉️</span> Kontak</a>
                    </nav>
                    
                    <button onclick="window.location.href='{{ route('profile') }}'" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-full transition-colors">
                        @if($user->avatar && (str_starts_with($user->avatar, 'http://') || str_starts_with($user->avatar, 'https://')))
                            <img src="{{ $user->avatar }}" alt="Avatar" class="w-5 h-5 rounded-md object-cover">
                        @else
                            <span class="w-5 h-5 bg-gray-100 rounded-md flex items-center justify-center text-base">{{ $user->avatar ?? '🐼' }}</span>
                        @endif
                        <span class="hidden md:inline">{{ $user->name }}</span>
                        <span class="md:hidden">Profile</span>
                    </button>
                    
                    <button onclick="handleLogout()" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-full transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="hidden md:inline">Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Spacer -->
    <div class="h-16"></div>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Profile Header - Minimalist -->
        <div class="mb-12">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-6">
                <div class="profile-avatar w-32 h-32 rounded-2xl bg-gray-100 flex items-center justify-center shadow-lg overflow-hidden">
                    @if($user->avatar && (str_starts_with($user->avatar, 'http://') || str_starts_with($user->avatar, 'https://')))
                        <img src="{{ $user->avatar }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        <span class="text-7xl">{{ $user->avatar ?? '🐼' }}</span>
                    @endif
                </div>
                <div class="text-center md:text-left flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->name }}</h1>
                    <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-2 text-sm text-gray-500">
                        <span>Bergabung {{ $user->created_at->format('d M Y') }}</span>
                        <span>•</span>
                        @if($user->email_verified_at)
                        <span class="text-green-600 font-medium">✓ Terverifikasi</span>
                        @else
                        <span class="text-yellow-600 font-medium">⚠ Belum Terverifikasi</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Choose Avatar Section - Clean -->
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Pilih Avatar</h2>
            
            <div class="grid grid-cols-5 md:grid-cols-10 gap-3 mb-6">
                <button type="button" onclick="selectAvatar('🐼')" class="avatar-option {{ ($user->avatar ?? '🐼') == '🐼' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🐼">
                    🐼
                </button>
                <button type="button" onclick="selectAvatar('🐨')" class="avatar-option {{ ($user->avatar ?? '') == '🐨' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🐨">
                    🐨
                </button>
                <button type="button" onclick="selectAvatar('🦊')" class="avatar-option {{ ($user->avatar ?? '') == '🦊' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🦊">
                    🦊
                </button>
                <button type="button" onclick="selectAvatar('🐱')" class="avatar-option {{ ($user->avatar ?? '') == '🐱' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🐱">
                    🐱
                </button>
                <button type="button" onclick="selectAvatar('🐶')" class="avatar-option {{ ($user->avatar ?? '') == '🐶' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🐶">
                    🐶
                </button>
                <button type="button" onclick="selectAvatar('🐰')" class="avatar-option {{ ($user->avatar ?? '') == '🐰' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🐰">
                    🐰
                </button>
                <button type="button" onclick="selectAvatar('🦁')" class="avatar-option {{ ($user->avatar ?? '') == '🦁' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🦁">
                    🦁
                </button>
                <button type="button" onclick="selectAvatar('🐯')" class="avatar-option {{ ($user->avatar ?? '') == '🐯' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🐯">
                    🐯
                </button>
                <button type="button" onclick="selectAvatar('🐻')" class="avatar-option {{ ($user->avatar ?? '') == '🐻' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🐻">
                    🐻
                </button>
                <button type="button" onclick="selectAvatar('🐸')" class="avatar-option {{ ($user->avatar ?? '') == '🐸' ? 'selected' : '' }} aspect-square rounded-xl border-2 border-gray-200 hover:border-blue-500 flex items-center justify-center text-4xl cursor-pointer bg-white transition-all" data-avatar="🐸">
                    🐸
                </button>
            </div>
            
            <input type="hidden" id="selectedAvatar" value="{{ ($user->avatar && !str_starts_with($user->avatar, 'http')) ? $user->avatar : '🐼' }}">
            
            <button onclick="saveAvatar()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                Simpan Avatar
            </button>
            
            <div id="avatarSuccess" class="hidden mt-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm">
                <span></span>
            </div>
            <div id="avatarError" class="hidden mt-4 p-3 bg-red-50 text-red-700 rounded-lg text-sm">
                <span></span>
            </div>
        </div>

        <!-- Edit Profile Section - Clean -->
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Profile</h2>
            
            <form id="updateProfileForm" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="mt-1.5 text-xs text-gray-500">Jika email diubah, Anda perlu verifikasi ulang</p>
                </div>
                
                <div id="profileError" class="hidden p-3 bg-red-50 text-red-700 rounded-lg text-sm">
                    <span></span>
                </div>
                
                <div id="profileSuccess" class="hidden p-3 bg-green-50 text-green-700 rounded-lg text-sm">
                    <span></span>
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Change Password Section - Clean -->
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Ubah Password</h2>
            
            <form id="changePasswordForm" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                    <input type="password" name="new_password" required minlength="8" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="mt-1.5 text-xs text-gray-500">Minimal 8 karakter</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" required minlength="8" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div id="passwordError" class="hidden p-3 bg-red-50 text-red-700 rounded-lg text-sm">
                    <span></span>
                </div>
                
                <div id="passwordSuccess" class="hidden p-3 bg-green-50 text-green-700 rounded-lg text-sm">
                    <span></span>
                </div>
                
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                    Ubah Password
                </button>
            </form>
        </div>
    </main>

    <script>
        // Select avatar function
        function selectAvatar(emoji) {
            // Remove selected class from all avatars
            document.querySelectorAll('.avatar-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Add selected class to clicked avatar
            event.target.closest('.avatar-option').classList.add('selected');
            
            // Update hidden input
            document.getElementById('selectedAvatar').value = emoji;
        }
        
        // Save avatar function
        async function saveAvatar() {
            const avatar = document.getElementById('selectedAvatar').value;
            const errorDiv = document.getElementById('avatarError');
            const successDiv = document.getElementById('avatarSuccess');
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            
            try {
                const response = await fetch('{{ route("profile.update.public") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ avatar })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    successDiv.querySelector('span').textContent = 'Avatar berhasil disimpan!';
                    successDiv.classList.remove('hidden');
                    
                    // Update avatar in header
                    document.querySelector('.profile-avatar').textContent = avatar;
                    
                    setTimeout(() => {
                        successDiv.classList.add('hidden');
                    }, 3000);
                } else {
                    errorDiv.querySelector('span').textContent = data.message;
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                errorDiv.querySelector('span').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
            }
        }
    </script>
    
    <script>
        // Handle logout
        async function handleLogout() {
            try {
                const response = await fetch('{{ route("public.logout") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    window.location.href = '{{ route("home") }}';
                }
            } catch (error) {
                console.error('Logout error:', error);
            }
        }

        // Handle update profile
        document.getElementById('updateProfileForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const errorDiv = document.getElementById('profileError');
            const successDiv = document.getElementById('profileSuccess');
            const submitBtn = this.querySelector('button[type="submit"]');
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';
            
            try {
                const response = await fetch('{{ route("profile.update.public") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: formData.get('name'),
                        email: formData.get('email')
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    successDiv.querySelector('span').textContent = data.message;
                    successDiv.classList.remove('hidden');
                    
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    errorDiv.querySelector('span').textContent = data.message;
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                errorDiv.querySelector('span').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Simpan Perubahan';
            }
        });

        // Handle change password
        document.getElementById('changePasswordForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const errorDiv = document.getElementById('passwordError');
            const successDiv = document.getElementById('passwordSuccess');
            const submitBtn = this.querySelector('button[type="submit"]');
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mengubah...';
            
            try {
                const response = await fetch('{{ route("profile.change-password") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        current_password: formData.get('current_password'),
                        new_password: formData.get('new_password'),
                        new_password_confirmation: formData.get('new_password_confirmation')
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    successDiv.querySelector('span').textContent = data.message;
                    successDiv.classList.remove('hidden');
                    this.reset();
                } else {
                    errorDiv.querySelector('span').textContent = data.message;
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                errorDiv.querySelector('span').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Ubah Password';
            }
        });
    </script>
</body>
</html>
