# Kategori Posts - Changed to Hardcoded Values

## ✅ Change Summary

Kategori dropdown di halaman admin "Tambah Postingan" diubah dari **dynamic** (dari database) menjadi **hardcoded** dengan 2 pilihan tetap.

## 🔄 Before (Dynamic dari Database)
```php
<select name="kategori_id" class="form-select" required>
    <option value="">Pilih Kategori</option>
    @foreach($kategoris as $kategori)
        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
            {{ $kategori->judul }}
        </option>
    @endforeach
</select>
```

**Masalah**:
- Bergantung pada data dari database
- Jika tabel `kategoris` kosong, dropdown akan kosong
- Sulit untuk mengkontrol pilihan kategori

## ✅ After (Hardcoded)
```php
<select name="kategori_id" class="form-select" required>
    <option value="">Pilih Kategori</option>
    <option value="kegiatan" {{ old('kategori_id') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
    <option value="kejuaraan" {{ old('kategori_id') == 'kejuaraan' ? 'selected' : '' }}>Kejuaraan</option>
</select>
```

**Keuntungan**:
- ✅ Selalu ada 2 pilihan: Kegiatan dan Kejuaraan
- ✅ Tidak bergantung database
- ✅ Mudah diatur dan diprediksi
- ✅ Form validation lebih mudah

## 📝 Kategori yang Tersedia

| Value | Label |
|-------|-------|
| `kegiatan` | Kegiatan |
| `kejuaraan` | Kejuaraan |

## 🔧 Implementation Notes

### Nilai yang Disimpan ke Database
Ketika user memilih kategori, nilai yang disimpan adalah:
- `kegiatan` (untuk kategori Kegiatan)
- `kejuaraan` (untuk kategori Kejuaraan)

### Validation di Controller
```php
// resources/views/admin/posts/create.blade.php
protected $fillable = [
    'kategori_id', // Menyimpan string: 'kegiatan' atau 'kejuaraan'
    // ...
];
```

### Query Filter (Jika Diperlukan)
```php
// Ambil semua postingan kategori Kegiatan
$posts = Post::where('kategori_id', 'kegiatan')->get();

// Ambil semua postingan kategori Kejuaraan
$posts = Post::where('kategori_id', 'kejuaraan')->get();
```

## 📁 File Changed

**File**: `resources/views/admin/posts/create.blade.php`
- **Lines**: 50-61
- **Type**: View change
- **Impact**: Admin panel post creation form

## ⚠️ Important Notes

### 1. Database Migration
Tidak perlu migration baru - field `kategori_id` di tabel `posts` cukup menyimpan string.

### 2. Edit Post
Jika ada halaman edit post, pastikan juga update dropdown-nya:
```bash
grep -r "Pilih Kategori" resources/views/
```

**Cari file**:
- `resources/views/admin/posts/edit.blade.php` (jika ada)
- Terapkan perubahan yang sama

### 3. Display Posts
Ketika menampilkan postingan, gunakan string value:
```php
// Dalam view untuk menampilkan kategori
@if($post->kategori_id == 'kegiatan')
    <span class="badge-info">Kegiatan</span>
@elseif($post->kategori_id == 'kejuaraan')
    <span class="badge-success">Kejuaraan</span>
@endif
```

## 🧪 Testing

1. **Login ke Admin Panel**
   ```
   Email: admin@example.com
   Password: password
   ```

2. **Buka Halaman Tambah Postingan**
   - Menu: Admin → Postingan → Tambah Postingan
   - URL: `/admin/posts/create`

3. **Verifikasi Dropdown Kategori**
   - ✅ Hanya ada 2 pilihan: Kegiatan dan Kejuaraan
   - ✅ Tidak ada pilihan lain

4. **Buat Postingan Test**
   - Pilih Kategori: Kegiatan
   - Isi form lainnya
   - Klik Simpan
   - Verifikasi kategori tersimpan dengan benar

## 🚀 Deploy

```bash
# Commit changes
git add resources/views/admin/posts/create.blade.php
git commit -m "Fix: Change kategori dropdown to hardcoded values (Kegiatan, Kejuaraan)"

# Push ke production
git push
```

## 📊 Related Files to Check

Cek apakah ada file lain yang menampilkan kategori:
```bash
grep -r "kategori_id" resources/views/
grep -r "@foreach(\$kategoris" resources/views/
```

**Possible files**:
- `resources/views/admin/posts/edit.blade.php`
- `resources/views/admin/posts/index.blade.php`
- `resources/views/gallery.blade.php`
- `resources/views/home.blade.php`

## ✅ Checklist

- [x] Update `create.blade.php` dropdown
- [ ] Check if `edit.blade.php` needs same change
- [ ] Test creation with new dropdown
- [ ] Verify data saved correctly
- [ ] Deploy to production

---

**Status**: ✅ **DONE** - Kategori dropdown sekarang hanya menampilkan Kegiatan dan Kejuaraan
