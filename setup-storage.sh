#!/bin/bash

echo "========================================"
echo "Setup Storage untuk SMK Gallery"
echo "========================================"
echo ""

echo "[1/3] Membuat symbolic link storage..."
php artisan storage:link

echo ""
echo "[2/3] Memeriksa permission folder storage..."
mkdir -p storage/app/public/posts
mkdir -p storage/app/public/ekstrakurikuler
chmod -R 775 storage
chmod -R 775 bootstrap/cache

echo ""
echo "[3/3] Verifikasi..."
if [ -L "public/storage" ]; then
    echo "[OK] Symbolic link berhasil dibuat!"
    echo ""
    echo "========================================"
    echo "Setup selesai! Foto sekarang bisa muncul."
    echo "========================================"
else
    echo "[ERROR] Symbolic link gagal dibuat!"
    echo "Coba jalankan dengan sudo: sudo bash setup-storage.sh"
fi

echo ""
