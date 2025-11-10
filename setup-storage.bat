@echo off
echo ========================================
echo   Setup Storage Link untuk SMK Gallery
echo ========================================
echo.

REM Cek apakah storage link sudah ada
if exist "public\storage" (
    echo [INFO] Storage link sudah ada, menghapus yang lama...
    rmdir "public\storage" 2>nul
    if exist "public\storage" (
        echo [WARN] Tidak bisa hapus dengan rmdir, mencoba del...
        del /F /Q "public\storage" 2>nul
    )
)

echo [INFO] Membuat storage link baru...

REM Coba dengan php di PATH
php artisan storage:link 2>nul

if %errorlevel% neq 0 (
    echo [WARN] PHP tidak ditemukan di PATH, mencoba lokasi XAMPP...
    
    REM Coba XAMPP di C:\xampp
    if exist "C:\xampp\php\php.exe" (
        echo [INFO] Menggunakan C:\xampp\php\php.exe
        C:\xampp\php\php.exe artisan storage:link
    ) else if exist "C:\xamppp\php\php.exe" (
        echo [INFO] Menggunakan C:\xamppp\php\php.exe
        C:\xamppp\php\php.exe artisan storage:link
    ) else (
        echo [ERROR] PHP tidak ditemukan!
        echo Pastikan XAMPP terinstall di C:\xampp atau C:\xamppp
        pause
        exit /b 1
    )
)

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
