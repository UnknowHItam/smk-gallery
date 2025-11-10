@echo off
echo ========================================
echo   Setup Setelah Clone dari GitHub
echo   SMK Gallery Project
echo ========================================
echo.

echo [1/6] Memeriksa file .env...
if not exist ".env" (
    echo [INFO] File .env tidak ada, copy dari .env.example...
    copy .env.example .env
    echo [SUCCESS] File .env berhasil dibuat
) else (
    echo [OK] File .env sudah ada
)
echo.

echo [2/6] Install dependencies...
echo [INFO] Menjalankan composer install...
call composer install --no-interaction
echo.

echo [3/6] Generate application key...
php artisan key:generate --force
echo.

echo [4/6] Setup storage link...
echo [INFO] Menghapus storage link lama jika ada...
if exist "public\storage" (
    rmdir "public\storage" 2>nul
    del /F /Q "public\storage" 2>nul
)

echo [INFO] Membuat storage link baru...
php artisan storage:link

if %errorlevel% neq 0 (
    echo [WARN] Gagal dengan php di PATH, mencoba XAMPP...
    if exist "C:\xampp\php\php.exe" (
        C:\xampp\php\php.exe artisan storage:link
    ) else if exist "C:\xamppp\php\php.exe" (
        C:\xamppp\php\php.exe artisan storage:link
    )
)
echo.

echo [5/6] Membuat folder storage yang diperlukan...
if not exist "storage\app\public\posts" mkdir storage\app\public\posts
if not exist "storage\app\public\ekstrakurikuler" mkdir storage\app\public\ekstrakurikuler
if not exist "storage\app\public\agenda" mkdir storage\app\public\agenda
if not exist "storage\app\public\gallery" mkdir storage\app\public\gallery
if not exist "storage\framework\cache" mkdir storage\framework\cache
if not exist "storage\framework\sessions" mkdir storage\framework\sessions
if not exist "storage\framework\views" mkdir storage\framework\views
echo [SUCCESS] Folder storage berhasil dibuat
echo.

echo [6/6] Set permission (Windows)...
echo [INFO] Memberikan permission ke folder storage dan bootstrap/cache...
icacls storage /grant Everyone:(OI)(CI)F /T >nul 2>&1
icacls bootstrap\cache /grant Everyone:(OI)(CI)F /T >nul 2>&1
echo [SUCCESS] Permission berhasil diset
echo.

echo ========================================
echo   SETUP SELESAI!
echo ========================================
echo.
echo Langkah selanjutnya:
echo 1. Edit file .env (database config)
echo 2. Buat database di phpMyAdmin
echo 3. Jalankan: php artisan migrate
echo 4. Jalankan: php artisan db:seed
echo 5. Jalankan: npm install
echo 6. Jalankan: npm run build (opsional)
echo.
echo Jika image masih broken:
echo - Pastikan folder storage/app/public/posts ada
echo - Jalankan ulang: setup-storage.bat
echo - Cek permission folder storage
echo.

pause
