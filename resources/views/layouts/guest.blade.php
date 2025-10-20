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
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">
            <!-- Left Section - Welcome -->
            <div class="hidden lg:flex lg:w-1/2 left-section items-center justify-center p-12 relative">
                <!-- Decorative Circles -->
                <div class="decorative-circle circle-1"></div>
                <div class="decorative-circle circle-2"></div>
                <div class="decorative-circle circle-3"></div>
                
                <div class="relative z-10 max-w-md">
                    <div class="mb-8">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h1 class="text-5xl font-bold text-gray-900 mb-4">Welcome!</h1>
                        <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mb-6"></div>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Kelola konten website sekolah dengan mudah dan efisien melalui dashboard admin yang modern.
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
                    <!-- Logo Mobile -->
                    <div class="lg:hidden flex justify-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Sign In</h2>
                        <p class="text-gray-600">Masuk ke dashboard admin</p>
                    </div>

                    <!-- Form Content -->
                    {{ $slot }}

                    <!-- Footer -->
                    <div class="mt-8 text-center text-sm text-gray-500">
                        © {{ date('Y') }} SMK Gallery. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
