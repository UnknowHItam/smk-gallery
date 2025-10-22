# 🏫 SMK Gallery - School Website

Website galeri dan informasi sekolah yang dibangun dengan Laravel 11, menampilkan kegiatan, agenda, ekstrakurikuler, dan informasi sekolah lainnya.

## ✨ Features

- 📰 **Posts Management** - Kelola berita dan kegiatan sekolah
- 📅 **Agenda Sekolah** - Kalender dan daftar agenda kegiatan
- 🎯 **Ekstrakurikuler** - Informasi lengkap ekstrakurikuler
- 🖼️ **Gallery** - Galeri foto kegiatan sekolah
- 💬 **Kritik & Saran** - Form untuk menerima feedback
- 👥 **User Management** - Sistem admin dan user
- 📊 **Dashboard Admin** - Statistics dan management

## 🚀 Quick Start

### Prerequisites

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM (optional, untuk compile assets)

### Installation

1. **Clone Repository**
```bash
git clone <repository-url>
cd smk-gallery
```

2. **Install Dependencies**
```bash
composer install
```

3. **Setup Environment**
```bash
# Copy .env file
cp .env.example .env

# Generate application key
php artisan key:generate
```

4. **Configure Database**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smk-gallery
DB_USERNAME=root
DB_PASSWORD=
```

5. **⚠️ PENTING: Setup Storage (Agar Foto Tidak Broken!)**

**Cara Cepat (Recommended):**
```bash
# Windows - Double click file ini:
setup-storage.bat

# Linux/Mac - Jalankan:
bash setup-storage.sh
```

**Atau Manual:**
```bash
# Windows
mkdir storage\app\public\posts
mkdir storage\app\public\ekstrakurikuler
php artisan storage:link

# Linux/Mac
mkdir -p storage/app/public/posts
mkdir -p storage/app/public/ekstrakurikuler
php artisan storage:link
chmod -R 775 storage
```

> **💡 CATATAN PENTING:** 
> - **SETIAP KALI** clone project di device baru, WAJIB jalankan `php artisan storage:link`
> - Jika tidak, semua foto yang diupload akan broken/tidak muncul
> - Symbolic link `public/storage` tidak ter-commit ke Git (sudah ada di .gitignore)

6. **Run Migrations**
```bash
php artisan migrate
```

7. **Seed Database (Optional)**
```bash
php artisan db:seed
```

8. **Run Development Server**
```bash
php artisan serve
```

Website akan berjalan di: `http://127.0.0.1:8000`

## 📁 Project Structure

```
smk-gallery/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/          # Admin controllers
│   │       ├── HomeController.php
│   │       └── GalleryController.php
│   └── Models/                 # Eloquent models
├── database/
│   └── migrations/             # Database migrations
├── public/
│   └── storage/                # Symlink to storage/app/public
├── resources/
│   └── views/
│       ├── admin/              # Admin views
│       ├── home.blade.php      # Homepage
│       └── gallery.blade.php   # Gallery page
├── routes/
│   └── web.php                 # Web routes
└── storage/
    └── app/
        └── public/
            ├── posts/          # Uploaded post images
            └── ekstrakurikuler/ # Ekstrakurikuler images
```

## 🔧 Configuration

### Storage Setup (IMPORTANT!)

Setelah clone project di device baru, **WAJIB** jalankan:

```bash
# 1. Buat directory untuk upload
mkdir storage\app\public\posts
mkdir storage\app\public\ekstrakurikuler

# 2. Buat symlink
php artisan storage:link

# 3. Set permissions (Linux/Mac only)
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Admin Access

Default admin credentials (jika menggunakan seeder):
- Email: `admin@smk.com`
- Password: `password`

## 📚 Documentation

- [Agenda Documentation](AGENDA_DOCUMENTATION.md) - Dokumentasi fitur agenda
- [Image Storage Fix](IMAGE_STORAGE_FIX.md) - Troubleshooting gambar broken
- [Database Fix](DATABASE_FIX.md) - Fix untuk tabel galery & foto corrupt
- [Gallery Upgrade](GALLERY_UPGRADE.md) - Modern minimalist gallery design

## 🐛 Troubleshooting

### ❌ Gambar Broken/Tidak Muncul (MASALAH PALING UMUM!)

**Penyebab:** Symbolic link `public/storage` hilang setelah clone/upload project

**✅ Solusi Cepat:**
```bash
# Windows - Double click:
setup-storage.bat

# Linux/Mac:
bash setup-storage.sh
```

**Atau Manual:**
```bash
# 1. Hapus symlink lama (jika ada)
# Windows:
rmdir public\storage

# Linux/Mac:
rm -rf public/storage

# 2. Buat symlink baru
php artisan storage:link

# 3. Verifikasi
# Pastikan folder public/storage sudah ada dan merupakan symlink
```

**Kenapa Ini Terjadi?**
- Symbolic link `public/storage` tidak di-commit ke Git (ada di .gitignore)
- Setiap clone project di device baru, symlink hilang
- Foto disimpan di `storage/app/public/posts/` tapi diakses via `public/storage/posts/`
- Tanpa symlink, path tidak terhubung → foto broken

**Pencegahan:**
- **SELALU** jalankan `php artisan storage:link` setelah clone project
- Atau gunakan script `setup-storage.bat` / `setup-storage.sh`
- Lihat dokumentasi lengkap di [STORAGE_SETUP.md](STORAGE_SETUP.md)

### Permission Denied (Linux/Mac)

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R www-data:www-data storage
```

### Agenda Tidak Muncul

1. Cek console browser (F12) untuk error JavaScript
2. Pastikan API endpoint berfungsi: `/api/agenda/month?year=2025&month=10`
3. Clear cache: `php artisan view:clear`

### Error 500 - Table doesn't exist in engine

**Penyebab:** Tabel `galery` atau `foto` corrupt

**Solusi:**
```bash
# Run migration untuk recreate tabel
php artisan migrate --path=database/migrations/2025_10_06_100000_recreate_galery_and_foto_tables.php

# Atau fresh migration (WARNING: hapus semua data!)
php artisan migrate:fresh
```

Lihat [Database Fix](DATABASE_FIX.md) untuk detail lengkap.

## 🛠️ Development

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Run Tests

```bash
php artisan test
```

## 📝 Changelog

### Version 2.0.0 (2025-10-06)
- ✅ **Gallery Page Upgrade** - Modern minimalist design
- ✅ Masonry grid layout
- ✅ Parallax scroll effects
- ✅ Staggered fade-in animations
- ✅ Enhanced hover effects
- ✅ Lazy loading images
- ✅ Keyboard navigation
- ✅ Performance optimizations

### Version 1.2.0 (2025-10-06)
- ✅ Fixed corrupt galery & foto tables
- ✅ Created proper migration for galery & foto
- ✅ Fixed "Table doesn't exist in engine" error
- ✅ Homepage now loads without error 500

### Version 1.1.0 (2025-10-06)
- ✅ Fixed agenda foreign key constraint
- ✅ Fixed agenda validation
- ✅ Fixed image storage path
- ✅ Added storage symlink setup
- ✅ Improved error handling

### Version 1.0.0 (2025-09-01)
- ✅ Initial release
- ✅ Posts management
- ✅ Gallery system
- ✅ Ekstrakurikuler management
- ✅ Kritik & Saran form

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
