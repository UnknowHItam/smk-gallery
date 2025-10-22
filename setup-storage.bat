@echo off
echo ========================================
echo Setup Storage untuk SMK Gallery
echo ========================================
echo.

echo [1/3] Membuat symbolic link storage...
php artisan storage:link

echo.
echo [2/3] Memeriksa permission folder storage...
if not exist "storage\app\public\posts" mkdir storage\app\public\posts
if not exist "storage\app\public\ekstrakurikuler" mkdir storage\app\public\ekstrakurikuler

echo.
echo [3/3] Verifikasi...
if exist "public\storage" (
    echo [OK] Symbolic link berhasil dibuat!
    echo.
    echo ========================================
    echo Setup selesai! Foto sekarang bisa muncul.
    echo ========================================
) else (
    echo [ERROR] Symbolic link gagal dibuat!
    echo Coba jalankan Command Prompt sebagai Administrator
)

echo.
pause
