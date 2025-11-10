# 🚨 Quick Fix: Image Broken

## Masalah: Image tidak muncul setelah clone/pull dari GitHub

### ⚡ Solusi Cepat (1 Menit):

```bash
# 1. Hapus link lama
rmdir public\storage

# 2. Buat link baru
php artisan storage:link

# 3. Refresh browser (Ctrl + Shift + R)
```

### 🚀 Atau Pakai Script Otomatis:

```bash
setup-storage.bat
```

---

## ❓ Kenapa Ini Terjadi?

**Ada 2 masalah:**

### 1. Symbolic link `public/storage` tidak bisa di-push ke Git
- Link bersifat lokal per device
- Setiap device harus buat link sendiri
- Link lama tidak valid di device baru

### 2. File foto di-ignore oleh Git (SUDAH DIPERBAIKI)
- File `storage/app/public/.gitignore` default Laravel ignore semua file
- Sudah diubah agar file foto bisa di-commit
- Sekarang foto akan ter-push ke Git

---

## ✅ Verifikasi Berhasil:

```bash
# Cek apakah link ada
dir public\storage

# Output seharusnya:
# <SYMLINKD> storage [storage\app\public]
```

---

## 🔄 Workflow Benar:

### Device A (Upload):
1. Upload foto via admin
2. Commit & push

### Device B (Pull):
1. `git pull`
2. **`php artisan storage:link`** ← WAJIB!
3. Refresh browser
4. ✅ Semua foto muncul

---

## 📝 Catatan Penting:

- ⚠️ **SELALU** jalankan `php artisan storage:link` setelah clone/pull
- ⚠️ Jangan commit folder `public/storage` (sudah di .gitignore)
- ⚠️ File image tetap aman di `storage/app/public/`
- ✅ Hanya link yang perlu dibuat ulang

---

## 🆘 Masih Error?

Lihat: [SETUP_DEVICE_BARU.md](SETUP_DEVICE_BARU.md) untuk troubleshooting lengkap
