<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - SMK Gallery</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .left-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            position: relative;
            overflow: hidden;
        }
        
        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }
        
        .circle-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            top: -100px;
            right: -100px;
        }
        
        .circle-2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(225deg, #3b82f6, #8b5cf6);
            bottom: -80px;
            left: -80px;
        }
        
        .circle-3 {
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            top: 50%;
            left: 10%;
        }
        
        .input-field {
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
        }
        
        .input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex">
        <!-- Left Section - Welcome -->
        <div class="hidden lg:flex lg:w-1/2 left-section items-center justify-center p-12 relative">
            <!-- Decorative Circles -->
            <div class="decorative-circle circle-1"></div>
            <div class="decorative-circle circle-2"></div>
            <div class="decorative-circle circle-3"></div>
            
            <div class="relative z-10 max-w-md">
                <div class="mb-8">
                    <h1 class="text-5xl font-bold text-gray-900 mb-4">Welcome Admin!</h1>
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mb-6"></div>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Portal khusus administrator untuk mengelola konten website sekolah dengan mudah dan efisien.
                    </p>
                </div>
                
                <div class="space-y-4 text-gray-600">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 shadow-sm">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span>Manajemen konten yang mudah</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 shadow-sm">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span>Dashboard yang intuitif</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 shadow-sm">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span>Keamanan terjamin</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="max-w-md w-full fade-in">
                <!-- Title -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Admin Login</h2>
                    <p class="text-gray-600">Portal khusus administrator</p>
                </div>

                <!-- Warning Box -->
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <h3 class="text-sm font-bold text-red-800 mb-1">⚠️ AKSES TERBATAS</h3>
                            <p class="text-sm text-red-700">
                                Halaman ini <strong>khusus untuk administrator</strong>. Akses tidak sah akan dicatat dan dilaporkan. Jika Anda bukan admin, silakan kembali ke <a href="{{ route('home') }}" class="underline font-semibold hover:text-red-900">halaman utama</a>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            class="input-field w-full px-4 py-3 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none"
                            placeholder="admin@example.com"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="input-field w-full px-4 py-3 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none"
                            placeholder="••••••••"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="btn-login w-full py-3 px-4 rounded-lg text-white font-semibold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Sign In
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-8 text-center text-sm text-gray-500">
                    © {{ date('Y') }} SMK Gallery. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
