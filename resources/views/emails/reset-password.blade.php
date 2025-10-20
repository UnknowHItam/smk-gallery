<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
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
            <h1>Reset Password</h1>
        </div>
        <div class="content">
            <p>Halo {{ $user->name }},</p>
            <p>Kami menerima permintaan untuk mereset password akun Anda.</p>
            <p>Silakan klik tombol di bawah ini untuk mereset password:</p>
            <center>
                <a href="{{ $resetLink }}" class="button">Reset Password</a>
            </center>
            <p>Atau copy dan paste link berikut ke browser Anda:</p>
            <p style="word-break: break-all; color: #667eea;">{{ $resetLink }}</p>
            <p>Link ini akan kadaluarsa dalam 30 menit.</p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>