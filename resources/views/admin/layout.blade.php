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
            width: 100%;
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            overflow: visible;
            z-index: 1000;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            display: block !important;
        }
        
        /* Mobile Responsive Styles */
        @media (max-width: 1024px) {
            .max-w-7xl {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .navbar-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
                scrollbar-color: #cbd5e1 transparent;
            }
            
            .navbar-container::-webkit-scrollbar {
                height: 4px;
            }
            
            .navbar-container::-webkit-scrollbar-track {
                background: transparent;
            }
            
            .navbar-container::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 2px;
            }
            
            .nav-item {
                white-space: nowrap;
                font-size: 0.875rem;
            }
            
            .nav-section {
                padding: 0 8px;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                height: auto;
                min-height: 70px;
            }
            
            .navbar-container {
                flex-wrap: wrap;
            }
            
            .sidebar-brand {
                padding: 12px 16px;
                flex: 1;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .sidebar-brand h1 {
                font-size: 0.875rem;
            }
            
            .sidebar-brand p {
                font-size: 0.75rem;
            }
            
            /* Show Hamburger Menu Button */
            .mobile-menu-toggle {
                display: flex !important;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                background: none;
                border: none;
                cursor: pointer;
                color: #374151;
                border-radius: 0.5rem;
                transition: background-color 0.2s;
            }
            
            .mobile-menu-toggle:hover {
                background-color: #f3f4f6;
            }
            
            .mobile-menu-toggle i {
                font-size: 1.25rem;
            }
            
            /* Hide desktop menu, show as mobile dropdown */
            .nav-section {
                display: none !important;
                width: 100%;
                flex-direction: column !important;
                border-top: 1px solid #e5e7eb;
                border-left: none !important;
                background: white;
                padding: 0 !important;
                height: auto !important;
                max-height: calc(100vh - 70px);
                overflow-y: auto;
                position: relative;
            }
            
            .nav-section.mobile-open {
                display: flex !important;
            }
            
            /* Reset nav-item for mobile */
            .nav-section .nav-item {
                display: flex !important;
                width: 100% !important;
                padding: 12px 16px !important;
                border-bottom: 1px solid #f3f4f6 !important;
            }
            
            .nav-item {
                font-size: 0.875rem;
                padding: 12px 16px;
                border-bottom: 1px solid #f3f4f6;
                width: 100%;
                display: flex;
                align-items: center;
            }
            
            .nav-item i {
                font-size: 1.125rem;
                margin-right: 12px;
                width: 20px;
            }
            
            .nav-item span {
                display: inline !important;
            }
            
            /* Dropdown in mobile */
            .dropdown {
                width: 100%;
            }
            
            .dropdown button.nav-item {
                width: 100% !important;
                text-align: left;
                justify-content: space-between;
                display: flex !important;
            }
            
            .dropdown-menu {
                position: static !important;
                width: 100% !important;
                margin: 0 !important;
                box-shadow: none !important;
                border: none !important;
                background: #f9fafb !important;
            }
            
            .dropdown-menu .dropdown-item {
                padding-left: 3rem !important;
            }
            
            #notificationDropdown {
                position: fixed;
                left: 0.5rem;
                right: 0.5rem;
                width: auto;
                top: 75px;
                max-height: calc(100vh - 100px);
                overflow-y: auto;
            }
            
            .main-content {
                padding: 0;
                margin-top: 70px;
            }
            
            .main-content .p-6 {
                padding: 1rem !important;
            }
            
            .main-content .max-w-7xl {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            
            /* Fix content width */
            .max-w-7xl {
                max-width: 100% !important;
            }
            
            /* Fix cards and containers */
            .bg-white {
                border-radius: 0.5rem;
                overflow: hidden;
            }
            
            /* Fix images */
            img {
                max-width: 100%;
                height: auto;
            }
        }
        
        @media (max-width: 640px) {
            .sidebar-brand {
                min-width: 120px;
            }
            
            .sidebar-brand h1 {
                font-size: 0.75rem;
            }
            
            .sidebar-brand p {
                display: none;
            }
            
            .nav-item span {
                font-size: 0.75rem;
            }
            
            .nav-item i {
                font-size: 1.125rem;
            }
            
            /* Hide notification bell icon text on very small screens */
            .relative[style*="border-left"] {
                padding: 0 8px;
            }
        }
        
        .main-content {
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            background: #f9fafb;
        }
        
        .sidebar-brand {
            display: flex !important;
            align-items: center;
            padding: 12px 24px;
            border-right: 1px solid #e5e7eb;
            height: 70px;
        }
        
        .mobile-menu-toggle {
            display: none;
        }
        
        /* Show brand always */
        @media (max-width: 768px) {
            .sidebar-brand {
                display: flex !important;
                width: 100%;
                justify-content: space-between;
                border-right: none;
            }
        }
        
        .navbar-container {
            display: flex;
            align-items: center;
            height: 70px;
            overflow: visible;
        }
        
        .dropdown {
            position: relative;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 200px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            margin-top: 8px;
        }
        
        .dropdown-item {
            display: block;
            padding: 10px 16px;
            color: #374151;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: #f3f4f6;
        }
        
        .dropdown-item:first-child {
            border-radius: 8px 8px 0 0;
        }
        
        .dropdown-item:last-child {
            border-radius: 0 0 8px 8px;
        }
        
        /* Desktop Navbar - Always visible */
        .nav-section {
            display: inline-flex;
            align-items: center;
            border-left: 1px solid #e5e7eb;
            height: 70px;
        }
        
        /* Hide mobile menu button on desktop */
        .mobile-menu-toggle {
            display: none;
        }
        
        /* Desktop - Force show navbar */
        @media (min-width: 769px) {
            .nav-section {
                display: inline-flex !important;
            }
            
            .mobile-menu-toggle {
                display: none !important;
            }
        }
        
        .nav-section-title {
            display: inline-flex;
            align-items: center;
            padding: 0 16px;
            font-size: 11px;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            height: 70px;
            background: #f9fafb;
        }
        
        .admin-profile-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            margin-left: auto;
            border-left: 1px solid #e5e7eb;
            height: 70px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .admin-profile-btn:hover {
            background-color: #f9fafb;
        }
        
        .nav-item {
            display: inline-flex;
            align-items: center;
            padding: 12px 20px;
            margin: 0;
            color: #374151;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }
        
        .nav-item:hover {
            background-color: #f9fafb;
            color: #1f2937;
            border-bottom-color: #d1d5db;
        }
        
        .nav-item i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }
        
        .nav-item.active {
            background-color: transparent;
            color: #3b82f6;
            border-bottom-color: #3b82f6;
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
        
        .sidebar-user {
            padding: 20px;
            border-top: 1px solid #e5e7eb;
            margin-top: auto;
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
        
        /* Responsive Tables */
        @media (max-width: 768px) {
            /* Table wrapper for horizontal scroll */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: 0 -0.5rem;
                padding: 0 0.5rem;
            }
            
            table {
                font-size: 0.8125rem;
                min-width: 600px;
            }
            
            table th, table td {
                padding: 0.5rem;
                white-space: nowrap;
            }
            
            /* Alternative: Card-style tables */
            .table-card-view thead {
                display: none;
            }
            
            .table-card-view, .table-card-view tbody, .table-card-view tr, .table-card-view td {
                display: block;
                width: 100%;
            }
            
            .table-card-view {
                min-width: auto !important;
            }
            
            .table-card-view tr {
                margin-bottom: 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 0.5rem;
                padding: 0.75rem;
                background: white;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }
            
            .table-card-view td {
                text-align: right;
                padding: 0.5rem 0;
                border-bottom: 1px solid #f3f4f6;
                position: relative;
                padding-left: 50%;
                white-space: normal;
            }
            
            .table-card-view td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 0.5rem;
                font-weight: 600;
                text-align: left;
                color: #374151;
            }
            
            .table-card-view td:last-child {
                border-bottom: 0;
            }
            
            /* Responsive Cards */
            .card {
                margin-bottom: 1rem;
                border-radius: 0.5rem;
            }
            
            .grid.grid-cols-2,
            .grid.grid-cols-3,
            .grid.grid-cols-4 {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }
            
            /* Responsive Buttons */
            .btn-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .btn-group > * {
                width: 100%;
            }
            
            /* Keep inline buttons for actions */
            .action-buttons {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            
            .action-buttons > * {
                flex: 1;
                min-width: 80px;
            }
            
            /* Responsive Forms */
            .form-row {
                flex-direction: column;
            }
            
            .form-group {
                width: 100% !important;
                margin-bottom: 1rem;
            }
            
            /* Form inputs */
            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="number"],
            input[type="date"],
            select,
            textarea {
                font-size: 16px !important; /* Prevent zoom on iOS */
            }
            
            /* Responsive spacing */
            .mb-6 {
                margin-bottom: 1rem !important;
            }
            
            .mt-6 {
                margin-top: 1rem !important;
            }
            
            .space-y-6 > * + * {
                margin-top: 1rem !important;
            }
        }
        
        @media (max-width: 640px) {
            /* Extra compact for small phones */
            table {
                font-size: 0.75rem;
            }
            
            .card {
                padding: 0.75rem !important;
            }
            
            h1 {
                font-size: 1.25rem !important;
            }
            
            h2 {
                font-size: 1.125rem !important;
            }
            
            h3 {
                font-size: 1rem !important;
            }
            
            .text-sm {
                font-size: 0.8125rem !important;
            }
            
            .action-buttons > * {
                min-width: 70px;
                font-size: 0.8125rem;
                padding: 0.375rem 0.5rem;
            }
        }
        
        /* Additional Mobile Fixes */
        @media (max-width: 768px) {
            /* Alert messages */
            .alert {
                padding: 0.75rem !important;
                font-size: 0.875rem !important;
                margin-bottom: 1rem !important;
            }
            
            /* Badges */
            .badge {
                font-size: 0.75rem !important;
                padding: 0.25rem 0.5rem !important;
            }
            
            /* Modal */
            .modal-content {
                margin: 1rem !important;
                max-height: calc(100vh - 2rem) !important;
                overflow-y: auto !important;
            }
            
            /* Stats cards */
            .stat-card {
                padding: 1rem !important;
            }
            
            .stat-card h3 {
                font-size: 1.5rem !important;
            }
            
            .stat-card p {
                font-size: 0.875rem !important;
            }
            
            /* Image previews */
            .image-preview {
                max-width: 100% !important;
                height: auto !important;
            }
            
            /* Pagination */
            .pagination {
                font-size: 0.875rem !important;
            }
            
            .pagination li {
                margin: 0 2px !important;
            }
            
            /* Breadcrumb */
            .breadcrumb {
                font-size: 0.8125rem !important;
                flex-wrap: wrap !important;
            }
            
            /* Tabs */
            .nav-tabs {
                overflow-x: auto !important;
                flex-wrap: nowrap !important;
                -webkit-overflow-scrolling: touch !important;
            }
            
            .nav-tabs li {
                white-space: nowrap !important;
            }
        }
        
        /* Utility Classes */
        .mobile-hidden {
            display: block;
        }
        
        @media (max-width: 768px) {
            .mobile-hidden {
                display: none !important;
            }
            
            .mobile-only {
                display: block !important;
            }
            
            .mobile-full-width {
                width: 100% !important;
            }
        }
        
        @media (min-width: 769px) {
            .mobile-only {
                display: none !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar (Horizontal) -->
    <div class="sidebar">
        <div class="max-w-7xl mx-auto">
            <div class="navbar-container">
            <!-- Brand Section -->
            <div class="sidebar-brand">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-lg overflow-hidden bg-white border border-gray-200 flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain p-1">
                    </div>
                    <div class="ml-2">
                        <h1 class="text-sm font-bold text-gray-900">SMK Gallery</h1>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle Menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Navigation - Menu Utama -->
            <div class="nav-section">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <!-- Dropdown Manajemen -->
                <div class="dropdown" style="display: inline-block;">
                    <button onclick="toggleDropdown('manajemenDropdown')" class="nav-item {{ request()->routeIs('admin.posts.*') || request()->routeIs('admin.users.*') ? 'active' : '' }}" style="cursor: pointer; background: none; border: none;">
                        <i class="fas fa-tasks"></i>
                        <span>Manajemen</span>
                        <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <div id="manajemenDropdown" class="dropdown-menu hidden">
                        <a href="{{ route('admin.posts.index') }}" class="dropdown-item">
                            <i class="fas fa-newspaper mr-2"></i>
                            Manajemen Konten
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="dropdown-item flex items-center justify-between">
                            <span>
                                <i class="fas fa-user-shield mr-2"></i>
                                Manajemen Pengguna
                            </span>
                            @php
                                $newUsers = \App\Models\PublicUser::where('created_at', '>=', now()->subDays(7))->count();
                            @endphp
                            @if($newUsers > 0)
                                <span class="bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $newUsers }}</span>
                            @endif
                        </a>
                    </div>
                </div>
                
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="nav-item {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Ekstrakurikuler</span>
                </a>
                
                <a href="{{ route('admin.agenda.index') }}" class="nav-item {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Agenda Sekolah</span>
                </a>
                
                <a href="{{ route('admin.kritik-saran.index') }}" class="nav-item {{ request()->routeIs('admin.kritik-saran.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    <span>Kritik & Saran</span>
                    @php
                        $unreadFeedback = \App\Models\KritikSaran::where('status', 'unread')->count();
                    @endphp
                    @if($unreadFeedback > 0)
                        <span class="ml-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadFeedback }}</span>
                    @endif
                </a>
                
                <a href="{{ route('admin.statistics.index') }}" class="nav-item {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Statistik</span>
                </a>
                
                <!-- Dropdown Pengaturan -->
                <div class="dropdown" style="display: inline-block;">
                    <button onclick="toggleDropdown('pengaturanDropdown')" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" style="cursor: pointer; background: none; border: none;">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan</span>
                        <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <div id="pengaturanDropdown" class="dropdown-menu hidden" style="min-width: 250px;">
                        <!-- Profile Info -->
                        <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                            <p class="text-xs text-gray-500">Logged in as</p>
                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
                        </div>
                        
                        <a href="{{ route('admin.settings.index') }}" class="dropdown-item">
                            <i class="fas fa-cog mr-2"></i>
                            Pengaturan Sistem
                        </a>
                        
                        <!-- Logout -->
                        <div class="border-t border-gray-200">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-red-600 hover:bg-red-50 w-full text-left">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification Bell -->
            <div class="relative" style="height: 70px; display: inline-flex; align-items: center; padding: 0 16px; border-left: 1px solid #e5e7eb;">
                <button onclick="toggleNotifications()" class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-bell text-lg"></i>
                    @php
                        $totalNotifications = \App\Models\KritikSaran::where('status', 'unread')->count() + 
                                              \App\Models\PublicUser::where('created_at', '>=', now()->subDays(7))->count();
                    @endphp
                    @if($totalNotifications > 0)
                        <span class="absolute top-1 right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                            {{ $totalNotifications > 9 ? '9+' : $totalNotifications }}
                        </span>
                    @endif
                </button>
            </div>

            </div>
        </div>
        
        <!-- Notification Dropdown (Absolute positioned) -->
        <div id="notificationDropdown" class="hidden absolute right-20 top-16 w-80 bg-white rounded-lg shadow-xl border border-gray-200" style="z-index: 9999;">
            <div class="p-4 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900">Notifikasi</h3>
            </div>
            <div class="max-h-96 overflow-y-auto">
                @php
                    $unreadFeedback = \App\Models\KritikSaran::where('status', 'unread')->latest()->take(5)->get();
                    $newUsers = \App\Models\PublicUser::where('created_at', '>=', now()->subDays(7))->latest()->take(5)->get();
                @endphp
                
                @if($unreadFeedback->count() > 0)
                    @foreach($unreadFeedback as $feedback)
                    <a href="{{ route('admin.kritik-saran.show', $feedback->id) }}" 
                       class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors notification-item"
                       data-type="feedback"
                       onclick="markNotificationAsRead(event)">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-red-600 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">Kritik & Saran Baru</p>
                                <p class="text-xs text-gray-600 truncate">{{ $feedback->nama }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $feedback->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @endif
                
                @if($newUsers->count() > 0)
                    @foreach($newUsers as $user)
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-plus text-blue-600 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">User Baru Terdaftar</p>
                                <p class="text-xs text-gray-600 truncate">{{ $user->name }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @endif
                
                @if($unreadFeedback->count() == 0 && $newUsers->count() == 0)
                    <div class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-bell-slash text-3xl mb-2"></i>
                        <p class="text-sm">Tidak ada notifikasi baru</p>
                    </div>
                @endif
            </div>
            <div class="p-3 border-t border-gray-200 text-center">
                <button onclick="closeNotifications()" class="text-sm text-gray-600 hover:text-gray-700 font-medium">
                    Tutup
                </button>
            </div>
        </div>
        
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="p-6">
            <!-- Max Width Container -->
            <div class="max-w-7xl mx-auto">
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
    </div>

    <script>
        function toggleMobileMenu() {
            const navSection = document.querySelector('.nav-section');
            const menuToggle = document.querySelector('.mobile-menu-toggle i');
            
            navSection.classList.toggle('mobile-open');
            
            // Toggle icon between bars and times
            if (navSection.classList.contains('mobile-open')) {
                menuToggle.classList.remove('fa-bars');
                menuToggle.classList.add('fa-times');
            } else {
                menuToggle.classList.remove('fa-times');
                menuToggle.classList.add('fa-bars');
            }
        }
        
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            
            // Close other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu.id !== dropdownId) {
                    menu.classList.add('hidden');
                }
            });
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }
        
        function toggleNotifications() {
            const dropdown = document.getElementById('notificationDropdown');
            
            // Close other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu.id !== 'notificationDropdown') {
                    menu.classList.add('hidden');
                }
            });
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }

        function closeNotifications() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.classList.add('hidden');
        }

        function markNotificationAsRead(event) {
            // Remove the notification item from dropdown
            const notifItem = event.currentTarget;
            notifItem.style.opacity = '0.5';
            
            // Update badge counter
            setTimeout(() => {
                const badge = document.querySelector('.fa-bell').parentElement.querySelector('span');
                if (badge) {
                    const currentCount = parseInt(badge.textContent);
                    const newCount = Math.max(0, currentCount - 1);
                    
                    if (newCount > 0) {
                        badge.textContent = newCount > 9 ? '9+' : newCount;
                    } else {
                        badge.remove();
                    }
                }
                
                // Update sidebar badge for Kritik & Saran
                const sidebarBadge = document.querySelector('a[href*="kritik-saran"] span.bg-red-500');
                if (sidebarBadge && notifItem.dataset.type === 'feedback') {
                    const currentCount = parseInt(sidebarBadge.textContent);
                    const newCount = Math.max(0, currentCount - 1);
                    
                    if (newCount > 0) {
                        sidebarBadge.textContent = newCount;
                    } else {
                        sidebarBadge.remove();
                    }
                }
            }, 100);
        }

        // Close all dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            // Check if click is outside all dropdowns
            if (!event.target.closest('.dropdown') && 
                !event.target.closest('button[onclick="toggleNotifications()"]') &&
                !event.target.closest('.mobile-menu-toggle')) {
                
                // Close all dropdown menus
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
                document.getElementById('notificationDropdown').classList.add('hidden');
                
                // Close mobile menu if click outside
                const navSection = document.querySelector('.nav-section');
                const menuToggle = document.querySelector('.mobile-menu-toggle i');
                
                if (navSection && !event.target.closest('.nav-section') && window.innerWidth <= 768) {
                    if (navSection.classList.contains('mobile-open')) {
                        navSection.classList.remove('mobile-open');
                        if (menuToggle) {
                            menuToggle.classList.remove('fa-times');
                            menuToggle.classList.add('fa-bars');
                        }
                    }
                }
            }
        });
        
        // Original click handler
        document.addEventListener('click', function(event) {
            const notifDropdown = document.getElementById('notificationDropdown');
            const notifButton = event.target.closest('button[onclick="toggleNotifications()"]');
            
            if (!notifButton && !notifDropdown.contains(event.target) && !notifDropdown.classList.contains('hidden')) {
                notifDropdown.classList.add('hidden');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>


