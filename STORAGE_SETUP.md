# 🔧 Panduan Setup Storage untuk Mengatasi Broken Image

## ⚠️ Masalah: Foto Broken Setiap Ganti Device

### Kenapa Ini Terjadi?

Ketika Anda:
1. ✅ Upload foto lewat panel admin → **Foto muncul normal**
2. 📤 Push project ke GitHub
3. 💻 Clone/Pull di device lain
4. ❌ **SEMUA FOTO JADI BROKEN!**

### Penyebab Utama

Laravel menyimpan file upload di folder `storage/app/public`, namun untuk mengaksesnya dari web, diperlukan **symbolic link** dari `public/storage` ke `storage/app/public`.

**Masalahnya:**
- Symbolic link `public/storage` **TIDAK** di-commit ke Git (ada di `.gitignore`)
- Setiap clone project, symbolic link **HILANG**
- Foto tetap ada di `storage/app/public/posts/` tapi tidak bisa diakses
- Browser mencari foto di `public/storage/posts/` → **404 Not Found**

## ✅ Solusi: Buat Symbolic Link Storage

### 🚀 Cara Cepat (Recommended)

Setiap kali clone/pull project di device baru, jalankan script otomatis:

```bash
# Windows - Double click file ini:
setup-storage.bat

# Linux/Mac - Jalankan di terminal:
bash setup-storage.sh
```

Script ini akan otomatis:
- ✅ Membuat symbolic link
- ✅ Membuat folder yang diperlukan
- ✅ Set permission (Linux/Mac)
- ✅ Verifikasi setup berhasil

### Cara 1: Menggunakan Artisan Command

Jalankan command berikut di terminal/command prompt dari root folder project:

```bash
php artisan storage:link
```

Jika berhasil, akan muncul pesan:
```
The [public/storage] link has been connected to [storage/app/public].
```

### Cara 2: Manual (Jika Cara 1 Gagal)

#### Untuk Windows (XAMPP):
1. Buka Command Prompt sebagai **Administrator**
2. Masuk ke folder project:
   ```cmd
   cd C:\xampp\htdocs\smk-gallery
   ```
3. Jalankan command:
   ```cmd
   mklink /D public\storage storage\app\public
   ```

#### Untuk Linux/Mac:
```bash
ln -s ../storage/app/public public/storage
```

## 📋 Workflow GitHub yang Benar

### Saat Push ke GitHub (Device Pertama)

```bash
# 1. Pastikan foto sudah terupload dan muncul normal
# 2. Push project seperti biasa
git add .
git commit -m "Update project"
git push origin main

# 3. File yang di-push:
# ✅ storage/app/public/posts/*.jpg (foto-foto)
# ✅ storage/app/public/ekstrakurikuler/*.jpg
# ❌ public/storage (TIDAK di-push, ada di .gitignore)
```

### Saat Clone/Pull di Device Baru

```bash
# 1. Clone repository
git clone <repository-url>
cd smk-gallery

# 2. Install dependencies
composer install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. ⚠️ WAJIB! Setup Storage
# Windows:
setup-storage.bat

# Linux/Mac:
bash setup-storage.sh

# Atau manual:
php artisan storage:link

# 5. Setup database
php artisan migrate

# 6. Jalankan server
php artisan serve

# ✅ Sekarang semua foto akan muncul!
```

### Checklist Setiap Ganti Device

- [ ] Clone/Pull project dari GitHub
- [ ] `composer install`
- [ ] Copy `.env` dan setup database
- [ ] **⚠️ WAJIB: `php artisan storage:link`** ← JANGAN LUPA INI!
- [ ] `php artisan migrate`
- [ ] Test upload foto baru
- [ ] Verifikasi foto lama dan baru muncul

## Verifikasi

Setelah membuat symbolic link, pastikan:

1. Folder `public/storage` sudah ada dan merupakan symbolic link
2. Isi folder `public/storage` sama dengan `storage/app/public`
3. Coba upload foto baru dari panel admin
4. Foto harus muncul dengan benar
5. Foto lama (yang sudah ada di `storage/app/public/`) juga harus muncul

## Catatan Penting

- **Symbolic link harus dibuat ulang** setiap kali:
  - Clone repository ke device baru
  - Pindah folder project
  - Reset/reinstall project
  
- Jangan commit folder `public/storage` ke Git (sudah ada di .gitignore)

- Jika masih broken image setelah symbolic link dibuat, cek:
  1. Permission folder storage (harus writable)
  2. Path di database (harus hanya nama file, bukan full path)
  3. File benar-benar ada di `storage/app/public/posts/` atau `storage/app/public/ekstrakurikuler/`

## Validasi Ukuran File

Sistem sekarang memiliki validasi ukuran file:

- **Maksimal ukuran file: 5MB**
- Validasi dilakukan di:
  - Frontend (JavaScript) - mencegah upload sebelum submit
  - Backend (Laravel) - validasi final sebelum simpan
  
Jika file terlalu besar, akan muncul pesan error yang jelas dengan ukuran file dan batas maksimal.

## Troubleshooting

### Error: "symlink(): Protocol error"
- Jalankan Command Prompt/Terminal sebagai Administrator
- Pastikan tidak ada folder `public/storage` yang sudah ada (hapus dulu jika ada)

### Error: Permission Denied
```bash
# Linux/Mac
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache

# Atau ubah ownership
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
```

### Gambar Lama Masih Broken
- Gambar yang diupload sebelum symbolic link dibuat akan tetap broken
- Solusi: Upload ulang gambar tersebut dari panel admin
