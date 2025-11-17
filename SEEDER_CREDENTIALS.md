# Database Seeder Credentials

## 📋 User Account Credentials

Ketika menjalankan `php artisan migrate:fresh --seed`, aplikasi akan membuat akun default dengan credentials berikut:

### 1. **Admin Account** 👨‍💼
```
Name:     Administrator
Email:    admin@example.com
Password: password
Role:     Admin (is_admin = true)
```

### 2. **Regular User Account** 👤
```
Name:     Test User
Email:    test@example.com
Password: password
Role:     Regular User
```

---

## 🔐 Password Hash Information

- **Password Default**: `password` (plain text)
- **Hashed As**: `Hash::make('password')` (bcrypt)
- **Location**: `database/factories/UserFactory.php` line 24

Ketika seed berjalan, password `password` akan di-hash otomatis menggunakan Laravel's Hash facade.

---

## 🌱 Seeder Files

### DatabaseSeeder.php
File utama yang mengatur semua seeding:
- Membuat 1 Admin User
- Membuat 1 Regular User
- Memanggil seeder lainnya:
  - `KategoriSeeder` - Kategori gallery
  - `PostSeeder` - Konten posts
  - `EkstrakurikulerSeeder` - Data ekstrakurikuler

### UserFactory.php
Factory untuk membuat user dengan data random:
- `name` - Nama random
- `email` - Email unique random
- `password` - Default: `password` (di-hash)
- `email_verified_at` - Default: now()
- `remember_token` - Random string

### Seeder Lainnya
1. **KategoriSeeder** - Membuat kategori untuk gallery
2. **PostSeeder** - Membuat post/konten gallery
3. **EkstrakurikulerSeeder** - Membuat data ekstrakurikuler
4. **PublicUserSeeder** - Membuat public user untuk non-authenticated users

---

## 🚀 Cara Menggunakan

### Jalankan Seeder (Fresh Database)
```bash
php artisan migrate:fresh --seed
```

**Output:**
- Database di-reset
- Semua migrations di-run
- Seeder dijalankan
- Data default tersimpan

### Hanya Jalankan Seeders (Keep Existing Data)
```bash
php artisan db:seed
```

### Jalankan Seeder Tertentu
```bash
php artisan db:seed --class=DatabaseSeeder
php artisan db:seed --class=KategoriSeeder
php artisan db:seed --class=PostSeeder
```

---

## 💡 Tips & Tricks

### 1. Ubah Password Default
Edit `database/factories/UserFactory.php`:
```php
'password' => static::$password ??= Hash::make('your-password'),
```

### 2. Ubah Credentials Seeder
Edit `database/seeders/DatabaseSeeder.php`:
```php
User::factory()->create([
    'name' => 'Your Admin Name',
    'email' => 'your-email@example.com',
    'is_admin' => true,
]);
```

### 3. Tambah User Lebih Banyak
```php
User::factory(10)->create(); // 10 random users
User::factory()->create(['email' => 'custom@example.com']);
```

---

## ⚠️ Penting untuk Production

### JANGAN gunakan seeder default di production!
1. **Ubah semua credentials** sebelum deploy
2. **Ganti password default** dengan password yang kuat
3. **Hapus atau disable seeder** di production environment
4. **Jangan commit credentials asli** ke git

### Cara Aman untuk Production:
```bash
# Hanya run migrations, JANGAN seed
php artisan migrate

# Atau untuk environment-specific:
php artisan migrate --env=production
```

---

## 🔄 Reset Database dengan Seeder

### Development:
```bash
# Fresh database dengan seeder
php artisan migrate:fresh --seed

# Atau lebih cepat
php artisan migrate:refresh --seed
```

### Production (HATI-HATI!):
```bash
# Jangan pernah jalankan ini di production!
# Akan menghapus semua data!
php artisan migrate:fresh --seed  # ❌ JANGAN!
```

---

## 📊 Data yang Dibuat Seeder

Ketika `php artisan migrate:fresh --seed` dijalankan:

| Item | Jumlah | Dari Seeder |
|------|--------|-------------|
| Users | 2 (Admin + Regular) | DatabaseSeeder |
| Categories | ~ | KategoriSeeder |
| Posts | ~ | PostSeeder |
| Ekstrakurikuler | ~ | EkstrakurikulerSeeder |
| Public Users | ~ | PublicUserSeeder |

---

## 🧪 Test Login

### Login dengan Admin:
```
Email: admin@example.com
Password: password
```

### Login dengan Regular User:
```
Email: test@example.com
Password: password
```

### Verify di Database:
```bash
php artisan tinker
> App\Models\User::where('email', 'admin@example.com')->first();
```

---

## 🐛 Troubleshooting

### Password Tidak Sesuai?
Pastikan:
1. Hash::make() digunakan di UserFactory
2. Tidak ada custom password hashing
3. Auth guard menggunakan user table yang benar

### Seeder Gagal?
```bash
# Clear aplikasi
php artisan cache:clear
php artisan config:clear

# Jalankan seeder lagi
php artisan migrate:fresh --seed
```

### Database Error?
```bash
# Check database connection
php artisan tinker
> DB::connection()->getPdo();

# Jika error, check .env file
cat .env | grep DB_
```

---

## 📝 Checklist Setup Awal

- [ ] Run `php artisan migrate:fresh --seed`
- [ ] Verify admin account dengan credentials di atas
- [ ] Login ke admin panel
- [ ] Test semua menu dan features
- [ ] Check database dengan `php artisan tinker`
- [ ] Update credentials untuk production (JANGAN gunakan default)

---

**Status:** ✅ Seeder siap digunakan untuk development
