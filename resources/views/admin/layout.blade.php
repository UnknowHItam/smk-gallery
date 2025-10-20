<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title') | SMK Gallery</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        
        .sidebar { 
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            overflow-y: auto;
            z-index: 40;
        }
        
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            background: #f9fafb;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            margin: 4px 12px;
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
        }
        
        .nav-item:hover {
            background-color: #f3f4f6;
            color: #1f2937;
        }
        
        .nav-item i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }
        
        .nav-item.active {
            background-color: #3b82f6;
            color: white;
        }
        
        .btn-primary {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        
        .btn-primary:hover {
            background-color: #2563eb;
        }
        
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background-color: white;
            color: #374151;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .btn-secondary:hover {
            background-color: #f9fafb;
        }
        
        .table-container {
            background: white;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }
        
        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .sidebar-user {
            padding: 20px;
            border-top: 1px solid #e5e7eb;
            margin-top: auto;
        }
        
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        .form-container {
            background: white;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 32px;
        }

        .form-section {
            margin-bottom: 32px;
        }

        .form-section-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-input, .form-select, .form-textarea {
            display: block;
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-help {
            margin-top: 4px;
            font-size: 12px;
            color: #6b7280;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .alert {
            padding: 16px;
            border-radius: 8px;
            border: 1px solid;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .alert-error {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .file-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .file-upload-area:hover {
            border-color: #9ca3af;
        }

        .radio-card {
            padding: 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .radio-card:hover {
            background-color: #f9fafb;
        }

        .radio-card-content {
            text-align: center;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Brand Section -->
        <div class="sidebar-brand">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white"></i>
                </div>
                <div class="ml-3">
                    <h1 class="text-lg font-bold text-gray-900">SMK Gallery</h1>
                    <p class="text-xs text-gray-500">Admin Dashboard</p>
                </div>
            </div>
        </div>

        <!-- Admin Profile Section (Top) -->
        <div class="px-4 py-4 border-b border-gray-200">
            <button onclick="toggleAdminProfile()" class="w-full flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-md">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="ml-3 flex-1 text-left">
                    <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                <i class="fas fa-chevron-down text-gray-400 text-sm transition-transform" id="adminChevron"></i>
            </button>
            
            <!-- Admin Profile Dropdown -->
            <div id="adminProfileDropdown" class="hidden mt-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                <div class="space-y-2 text-sm">
                    <div class="flex items-center justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600">Email</span>
                        <span class="font-medium text-gray-900">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600">Role</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-semibold">Admin</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-gray-600">Login Terakhir</span>
                        <span class="font-medium text-gray-900 text-xs">{{ now()->format('d M Y') }}</span>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-6">
            <div class="mb-6">
                <p class="px-6 text-xs font-semibold text-gray-400 uppercase mb-3">Menu Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.posts.index') }}" class="nav-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Manajemen Konten</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Manajemen Pengguna</span>
                </a>
                
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="nav-item {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Ekstrakurikuler</span>
                </a>
                
                <a href="{{ route('admin.agenda.index') }}" class="nav-item {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Agenda Sekolah</span>
                </a>
                
                <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </div>

            <div class="mb-6">
                <p class="px-6 text-xs font-semibold text-gray-400 uppercase mb-3">Komunikasi</p>
                
                <a href="{{ route('admin.kritik-saran.index') }}" class="nav-item {{ request()->routeIs('admin.kritik-saran.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    <span>Kritik & Saran</span>
                    @php
                        $unreadFeedback = \App\Models\KritikSaran::where('status', 'unread')->count();
                    @endphp
                    @if($unreadFeedback > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadFeedback }}</span>
                    @endif
                </a>
            </div>

            <div>
                <p class="px-6 text-xs font-semibold text-gray-400 uppercase mb-3">Analitik</p>
                
                <a href="{{ route('admin.statistics.index') }}" class="nav-item {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Statistik</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="p-6">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>

    <script>
        function toggleAdminProfile() {
            const dropdown = document.getElementById('adminProfileDropdown');
            const chevron = document.getElementById('adminChevron');
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('adminProfileDropdown');
            const button = event.target.closest('button[onclick="toggleAdminProfile()"]');
            
            if (!button && !dropdown.contains(event.target) && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
                document.getElementById('adminChevron').style.transform = 'rotate(0deg)';
            }
        });
    </script>
</body>
</html>


