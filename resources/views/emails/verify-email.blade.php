<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verifikasi Email</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
        .button { display: inline-block; padding: 12px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Verifikasi Email Anda</h1>
        </div>
        <div class="content">
            <p>Halo {{ $user->name }},</p>
            <p>Terima kasih telah mendaftar di {{ config('app.name') }}!</p>
            <p>Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda:</p>
            <center>
                <a href="{{ $verificationUrl }}" class="button">Verifikasi Email</a>
            </center>
            <p>Atau copy dan paste link berikut ke browser Anda:</p>
            <p style="word-break: break-all; color: #667eea;">{{ $verificationUrl }}</p>
            <p>Link ini akan kadaluarsa dalam 60 menit.</p>
            <p>Jika Anda tidak mendaftar akun, abaikan email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>