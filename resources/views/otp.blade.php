<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi OTP - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Verifikasi OTP</h1>
                <p class="text-sm text-gray-500 mb-1">Masukkan kode OTP yang telah dikirim ke:</p>
                <p class="text-sm font-medium text-indigo-600">{{ $email }}</p>
            </div>

            <!-- OTP Form -->
            <form id="otpForm" class="space-y-4">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="type" value="{{ $type }}">
                
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Kode OTP (6 digit)</label>
                    <input 
                        type="text" 
                        name="otp" 
                        id="otpInput" 
                        required 
                        maxlength="6" 
                        pattern="[0-9]{6}"
                        placeholder="000000" 
                        class="w-full px-4 py-3 text-center text-2xl font-bold tracking-widest border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                        autocomplete="off">
                </div>
                
                <div id="otpError" class="hidden p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm"></div>
                <div id="otpSuccess" class="hidden p-3 bg-green-50 border border-green-200 text-green-600 rounded-lg text-sm"></div>
                
                <button type="submit" id="verifyBtn" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 rounded-lg transition-colors duration-200">
                    Verifikasi
                </button>
            </form>
            
            <!-- Resend OTP -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 mb-2">Tidak menerima kode?</p>
                <button onclick="resendOtp()" id="resendBtn" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold">
                    Kirim Ulang Kode
                </button>
                <p id="resendTimer" class="text-xs text-gray-500 mt-1"></p>
            </div>

            <!-- Back to Gallery -->
            <div class="mt-6 text-center">
                <a href="{{ route('gallery') }}" class="text-sm text-gray-600 hover:text-gray-700">
                    Kembali ke Gallery
                </a>
            </div>
        </div>
    </div>

    <script>
        let resendTimeout = 60;
        let resendInterval = null;

        // Auto-focus OTP input
        document.getElementById('otpInput').focus();

        // Only allow numbers in OTP input
        document.getElementById('otpInput').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Handle OTP form submission
        document.getElementById('otpForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            const errorDiv = document.getElementById('otpError');
            const successDiv = document.getElementById('otpSuccess');
            const verifyBtn = document.getElementById('verifyBtn');
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            verifyBtn.disabled = true;
            verifyBtn.textContent = 'Memverifikasi...';
            
            try {
                const response = await fetch('{{ route("otp.verify") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    successDiv.textContent = result.message;
                    successDiv.classList.remove('hidden');
                    
                    setTimeout(() => {
                        if (result.redirect) {
                            window.location.href = result.redirect;
                        } else {
                            window.location.href = '{{ route("gallery") }}';
                        }
                    }, 1500);
                } else {
                    errorDiv.textContent = result.message;
                    errorDiv.classList.remove('hidden');
                    verifyBtn.disabled = false;
                    verifyBtn.textContent = 'Verifikasi';
                }
            } catch (error) {
                errorDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
                verifyBtn.disabled = false;
                verifyBtn.textContent = 'Verifikasi';
            }
        });

        // Resend OTP
        async function resendOtp() {
            const resendBtn = document.getElementById('resendBtn');
            const errorDiv = document.getElementById('otpError');
            const successDiv = document.getElementById('otpSuccess');
            
            if (resendTimeout > 0) {
                return;
            }
            
            resendBtn.disabled = true;
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            
            // Show loading state
            resendBtn.innerHTML = '<svg class="animate-spin h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            
            try {
                const response = await fetch('{{ route("otp.resend") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: '{{ $email }}',
                        type: '{{ $type }}'
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    successDiv.textContent = result.message;
                    successDiv.classList.remove('hidden');
                    resendBtn.innerHTML = 'Kirim Ulang Kode';
                    startResendTimer();
                } else {
                    errorDiv.textContent = result.message;
                    errorDiv.classList.remove('hidden');
                    resendBtn.innerHTML = 'Kirim Ulang Kode';
                    resendBtn.disabled = false;
                }
            } catch (error) {
                errorDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorDiv.classList.remove('hidden');
                resendBtn.innerHTML = 'Kirim Ulang Kode';
                resendBtn.disabled = false;
            }
        }

        // Start resend timer
        function startResendTimer() {
            const resendBtn = document.getElementById('resendBtn');
            const timerDiv = document.getElementById('resendTimer');
            
            resendTimeout = 60;
            resendBtn.disabled = true;
            
            if (resendInterval) {
                clearInterval(resendInterval);
            }
            
            resendInterval = setInterval(() => {
                resendTimeout--;
                timerDiv.textContent = `Kirim ulang dalam ${resendTimeout} detik`;
                
                if (resendTimeout <= 0) {
                    clearInterval(resendInterval);
                    resendBtn.disabled = false;
                    timerDiv.textContent = '';
                }
            }, 1000);
        }

        // Start timer on page load
        startResendTimer();
    </script>
</body>
</html>
