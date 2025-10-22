# 🚀 Quick Start - Cara Cepat Setup Project

## ⚠️ PENTING: Baca Ini Dulu!

Jika Anda **clone project dari GitHub** atau **pindah device**, foto akan broken jika tidak setup storage dengan benar.

## 📝 Langkah Setup (5 Menit)

### 1. Clone Project
```bash
git clone <repository-url>
cd smk-gallery
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
# Copy file .env
cp .env.example .env

# Generate key
php artisan key:generate
```

Edit file `.env` untuk database:
```env
DB_DATABASE=smk-gallery
DB_USERNAME=root
DB_PASSWORD=
```

### 4. ⚠️ WAJIB! Setup Storage (Agar Foto Tidak Broken!)

**Windows:**
```bash
# Cara 1: Double click file ini
setup-storage.bat

# Atau cara 2: Manual
php artisan storage:link
```

**Linux/Mac:**
```bash
# Cara 1: Jalankan script
bash setup-storage.sh

# Atau cara 2: Manual
php artisan storage:link
chmod -R 775 storage
```

> **💡 INGAT:** Setiap kali clone/pull project di device baru, WAJIB jalankan `php artisan storage:link`!

### 5. Setup Database
```bash
# Buat database dulu di phpMyAdmin atau MySQL
# Nama database: smk-gallery

# Jalankan migration
php artisan migrate

# (Optional) Isi data contoh
php artisan db:seed
```

### 6. Jalankan Server
```bash
php artisan serve
```

Buka browser: `http://127.0.0.1:8000`

## ✅ Verifikasi

Cek apakah setup berhasil:
- [ ] Website bisa dibuka tanpa error
- [ ] Bisa login ke admin panel
- [ ] Upload foto baru → foto muncul
- [ ] Foto lama (jika ada) juga muncul

## ❌ Troubleshooting

### Foto Broken/Tidak Muncul
```bash
# Jalankan ini:
php artisan storage:link

# Verifikasi folder public/storage ada
# Windows: dir public\storage
# Linux/Mac: ls -la public/storage
```

### Error: "The link already exists"
```bash
# Hapus symlink lama
# Windows:
rmdir public\storage

# Linux/Mac:
rm -rf public/storage

# Buat ulang
php artisan storage:link
```

### Permission Denied (Linux/Mac)
```bash
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
```

## 📚 Dokumentasi Lengkap

- [README.md](README.md) - Dokumentasi lengkap
- [STORAGE_SETUP.md](STORAGE_SETUP.md) - Detail setup storage & troubleshooting
- [AGENDA_DOCUMENTATION.md](AGENDA_DOCUMENTATION.md) - Dokumentasi fitur agenda

## 🆘 Butuh Bantuan?

Jika masih ada masalah:
1. Baca [STORAGE_SETUP.md](STORAGE_SETUP.md) untuk troubleshooting detail
2. Pastikan symbolic link sudah dibuat: `php artisan storage:link`
3. Cek permission folder storage (Linux/Mac)
4. Verifikasi file foto ada di `storage/app/public/posts/`

---

**Selamat! Project sudah siap digunakan! 🎉**
