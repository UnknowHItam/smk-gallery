# 🚀 Panduan Setup di Device Baru

## ⚠️ PENTING! Baca Ini Dulu

Setiap kali Anda **clone** atau **pull** project ini di device baru, foto-foto yang sudah diupload **AKAN BROKEN** jika Anda tidak menjalankan setup ini!

### Kenapa Foto Broken?

- ✅ Foto tersimpan di `storage/app/public/posts/` (ikut ter-push ke GitHub)
- ❌ Symbolic link `public/storage` TIDAK ikut ter-push (ada di .gitignore)
- 🔗 Browser butuh link dari `public/storage` → `storage/app/public`
- ❌ Tanpa link ini, semua foto akan 404 Not Found!

---

## 📋 Checklist Setup Device Baru

Ikuti langkah ini **SETIAP KALI** clone/pull di device baru:

### 1️⃣ Clone Repository
```bash
git clone <repository-url>
cd smk-gallery
```

### 2️⃣ Install Dependencies
```bash
composer install
npm install
```

### 3️⃣ Setup Environment
```bash
# Copy file .env
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 4️⃣ **⚠️ WAJIB! Setup Storage (JANGAN SKIP INI!)**

**🚀 CARA TERCEPAT - Setup Otomatis Semua:**
```
setup-after-clone.bat
```
Script ini akan otomatis:
- Copy .env.example ke .env
- Install composer dependencies
- Generate app key
- Setup storage link
- Buat folder storage yang diperlukan
- Set permission

**Atau Manual Step by Step:**

**Setup Storage Link:**
```
setup-storage.bat
```

**Atau dengan Command:**
```bash
php artisan storage:link
```

**Atau dengan Path Lengkap (jika php tidak ditemukan):**
```bash
C:\xampp\php\php.exe artisan storage:link
# atau
C:\xamppp\php\php.exe artisan storage:link
```

**⚠️ PENTING untuk Image:**
Setiap kali clone/pull dari GitHub, **WAJIB** jalankan ulang:
```bash
# Hapus link lama
rmdir public\storage

# Buat link baru
php artisan storage:link
```

**Kenapa Image Broken Setelah Clone?**
- Symbolic link `public/storage` tidak bisa di-push ke Git
- Setiap device harus buat link sendiri
- Link lama tidak valid di device baru

### 5️⃣ Setup Database
```bash
# Buat database di phpMyAdmin dulu
# Lalu jalankan:
php artisan migrate
php artisan db:seed
```

### 6️⃣ Build Assets (Opsional)
```bash
npm run build
```

### 7️⃣ Jalankan Server
```bash
php artisan serve
```

---

## ✅ Verifikasi Setup Berhasil

Setelah setup, cek:

1. ✅ Folder `public/storage` sudah ada (symbolic link)
2. ✅ Buka website, foto-foto lama muncul
3. ✅ Upload foto baru dari admin panel
4. ✅ Foto baru langsung muncul

---

## 🔄 Workflow Sehari-hari

### Di Device A (Upload Foto)
```bash
# 1. Upload foto lewat admin panel
# 2. Commit & push seperti biasa
git add .
git commit -m "Upload foto baru"
git push origin main
```

### Di Device B (Pull Update)
```bash
# 1. Pull update
git pull origin main

# 2. ⚠️ WAJIB! Setup storage lagi
setup-storage.bat

# 3. Refresh browser
# 4. Semua foto (lama + baru) muncul! ✅
```

---

## 🚨 Troubleshooting - Image Broken

### ❌ Problem: Image Broken Setelah Clone/Pull

**Gejala:**
- Foto tidak muncul (broken image icon)
- URL foto: `http://localhost:8000/storage/posts/xxx.jpg`
- Error 404 Not Found

**Penyebab:**
Symbolic link `public/storage` tidak valid karena:
1. Link tidak bisa di-push ke Git (sudah di `.gitignore`)
2. Link bersifat lokal per device
3. Path absolute berbeda di setiap device

**Solusi:**

**1. Hapus Link Lama:**
```bash
# Windows
rmdir public\storage

# Atau jika error
del /F /Q public\storage
```

**2. Buat Link Baru:**
```bash
# Otomatis
setup-storage.bat

# Atau manual
php artisan storage:link
```

**3. Verifikasi:**
```bash
# Cek apakah folder public/storage ada
dir public\storage

# Seharusnya muncul: <SYMLINKD> storage
```

**4. Cek Permission:**
```bash
# Pastikan folder storage/app/public bisa diakses
icacls storage /grant Everyone:(OI)(CI)F /T
```

### ❌ Problem: Storage Link Gagal Dibuat

**Error:** "The [public/storage] link already exists"

**Solusi:**
```bash
# Hapus paksa
rmdir /S /Q public\storage
del /F /Q public\storage

# Buat ulang
php artisan storage:link
```

**Error:** "symlink(): No such file or directory"

**Solusi:**
```bash
# Buat folder storage/app/public dulu
mkdir storage\app\public\posts
mkdir storage\app\public\ekstrakurikuler
mkdir storage\app\public\agenda
mkdir storage\app\public\gallery

# Lalu buat link
php artisan storage:link
```

**Error:** "A required privilege is not held by the client"

**Solusi:**
```bash
# Jalankan Command Prompt sebagai Administrator
# Klik kanan > Run as Administrator
# Lalu jalankan:
php artisan storage:link
```

### ✅ Checklist Jika Image Masih Broken:

- [ ] Sudah jalankan `php artisan storage:link`?
- [ ] Folder `public/storage` sudah ada?
- [ ] Folder `storage/app/public/posts` sudah ada?
- [ ] File image ada di `storage/app/public/posts/`?
- [ ] Permission folder storage sudah benar?
- [ ] Sudah clear cache browser (Ctrl+Shift+R)?

---

## 🚨 Troubleshooting Lainnya

### Foto Masih Broken Setelah Setup?

**1. Cek Symbolic Link:**
```bash
# Di PowerShell:
Test-Path public\storage
# Harus return: True
```

**2. Cek Isi Storage:**
```bash
dir storage\app\public\posts
# Harus ada file .jpg/.png
```

**3. Cek Permission (Linux/Mac):**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

**4. Hapus Cache Browser:**
- Tekan `Ctrl + Shift + Delete`
- Atau `Ctrl + F5` untuk hard refresh

### Error: "symlink(): Protocol error"

**Solusi:**
1. Buka Command Prompt sebagai **Administrator**
2. Jalankan:
   ```bash
   cd C:\xamppp\htdocs\smk-gallery
   mklink /D public\storage storage\app\public
   ```

### Error: "The [public/storage] link already exists"

**Solusi:**
```bash
# Hapus link lama
rmdir public\storage

# Buat link baru
php artisan storage:link
```

---

## 📝 Catatan Penting

### ✅ Yang Ter-Push ke GitHub:
- ✅ Foto di `storage/app/public/posts/*.jpg`
- ✅ Foto di `storage/app/public/ekstrakurikuler/*.jpg`
- ✅ Semua kode aplikasi

### ❌ Yang TIDAK Ter-Push:
- ❌ Folder `public/storage` (symbolic link)
- ❌ File `.env`
- ❌ Folder `vendor/`
- ❌ Folder `node_modules/`

### 🔑 Kunci Sukses:
> **Setiap ganti device = Wajib jalankan `setup-storage.bat`**

Jangan lupa! Simpan file ini dan baca setiap kali setup di device baru.

---

## 🎯 Quick Command

Salin ini dan jalankan setiap kali clone di device baru:

```bash
composer install && npm install && copy .env.example .env && php artisan key:generate && setup-storage.bat && php artisan migrate
```

---

**Selamat coding! 🚀**
