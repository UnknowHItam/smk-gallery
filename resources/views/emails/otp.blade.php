<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Verifikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .otp-box {
            background: #f8f9fa;
            border: 2px dashed #667eea;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }
        .otp-code {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            letter-spacing: 8px;
            margin: 10px 0;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 12px;
            margin: 20px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Kode OTP Verifikasi</h1>
        </div>
        
        <div class="content">
            <p>Halo {{ $user->name }},</p>
            
            @if($type === 'login')
                <p>Anda telah melakukan login. Gunakan kode OTP berikut untuk memverifikasi identitas Anda:</p>
            @elseif($type === 'register')
                <p>Terima kasih telah mendaftar! Gunakan kode OTP berikut untuk memverifikasi akun Anda:</p>
            @elseif($type === 'reset')
                <p>Anda telah meminta reset password. Gunakan kode OTP berikut untuk melanjutkan:</p>
            @else
                <p>Gunakan kode OTP berikut untuk verifikasi:</p>
            @endif
            
            <div class="otp-box">
                <p style="margin: 0; font-size: 14px; color: #666;">Kode OTP Anda:</p>
                <div class="otp-code">{{ $otp }}</div>
                <p style="margin: 0; font-size: 12px; color: #999;">Kode ini berlaku selama 5 menit</p>
            </div>
            
            <div class="warning">
                <strong>⚠️ Perhatian:</strong> Jangan bagikan kode OTP ini kepada siapa pun. Tim kami tidak akan pernah meminta kode OTP Anda.
            </div>
            
            <p>Jika Anda tidak melakukan permintaan ini, abaikan email ini atau hubungi kami segera.</p>
            
            <p>Terima kasih,<br>
            <strong>{{ config('app.name') }}</strong></p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
