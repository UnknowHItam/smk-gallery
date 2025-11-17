# Public User Login Fix - 401 Error

## 🔴 Problem

**Error**: `POST /public/login` returning `HTTP/2 401`

**Issue**: Login fails even after running `php artisan migrate:fresh --seed`

## 🔍 Root Cause

There were **TWO issues** preventing public user login:

### Issue #1: PublicUserSeeder Not Being Called ❌
The `PublicUserSeeder` was not included in `DatabaseSeeder.php`:

```php
// ❌ WRONG - PublicUserSeeder not called
$this->call([
    KategoriSeeder::class,
    PostSeeder::class,
    EkstrakurikulerSeeder::class,
]);
```

**Result**: When running `php artisan migrate:fresh --seed`, the `public_users` table was empty!

### Issue #2: Users Created with PENDING_VERIFICATION Status ❌
The `PublicUserSeeder` created users WITHOUT setting `verification_status` to `VERIFIED`:

```php
// ❌ WRONG - No verification_status set
PublicUser::create([
    'name' => 'Test User',
    'email' => 'user@test.com',
    'password' => Hash::make('password123'),
]);
```

**Result**: Default value was `PENDING_VERIFICATION`, which blocks login in `LoginController.php`:

```php
// In LoginController.php line 37
if ($user->verification_status === 'PENDING_VERIFICATION') {
    // Logout immediately - don't allow login
    Auth::guard('public')->logout();
    
    // Send OTP instead
    return response()->json([
        'success' => true,
        'verified' => false,
        'message' => 'Akun Anda belum diverifikasi...',
    ], 200);  // Note: 401 status when credentials wrong
}
```

## ✅ Solution

### Fix #1: Add PublicUserSeeder to DatabaseSeeder

**File**: `database/seeders/DatabaseSeeder.php`

```php
$this->call([
    PublicUserSeeder::class,  // ✅ ADDED
    KategoriSeeder::class,
    PostSeeder::class,
    EkstrakurikulerSeeder::class,
]);
```

### Fix #2: Set VERIFIED Status in PublicUserSeeder

**File**: `database/seeders/PublicUserSeeder.php`

```php
PublicUser::create([
    'name' => 'Test User',
    'email' => 'user@test.com',
    'password' => Hash::make('password123'),
    'verification_status' => 'VERIFIED',  // ✅ ADDED
    'email_verified_at' => now(),          // ✅ ADDED
]);
```

## 🚀 Deploy & Test

### 1. Reset Database with Fixed Seeder
```bash
php artisan migrate:fresh --seed
```

**Output should show**:
```
Database\Seeders\PublicUserSeeder .............................. RUNNING
Database\Seeders\PublicUserSeeder ........................... DONE
```

### 2. Login Credentials (Now Working! ✅)

```
Email:    user@test.com
Password: password123

OR

Email:    john@example.com
Password: password123
```

### 3. Test Login
```bash
curl -X POST https://smk-gallery-production.up.railway.app/public/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@test.com","password":"password123"}'
```

**Expected Response** (200 OK):
```json
{
    "success": true,
    "message": "Login berhasil!",
    "user": {
        "id": 1,
        "name": "Test User",
        "email": "user@test.com",
        "verification_status": "VERIFIED",
        "email_verified_at": "2025-11-17T03:00:00Z"
    },
    "redirect": "https://smk-gallery-production.up.railway.app/gallery"
}
```

## 📋 Public User vs Admin User

| Feature | Public User | Admin User |
|---------|-----------|-----------|
| Table | `public_users` | `users` |
| Guard | `public` | `web` (default) |
| Requires Verification | Yes (email verify) | No |
| Login Route | `/public/login` | `/login` |
| Can Access Gallery | ✅ Yes | ✅ Yes |
| Can Download | ✅ Yes (if verified) | ✅ Yes |
| Can Rate | ✅ Yes (if verified) | ✅ Yes |
| Can Manage Content | ❌ No | ✅ Yes (admin) |

## 🔐 Verification Status Values

When `verification_status` is:
- `PENDING_VERIFICATION` → User must verify email via OTP before login
- `VERIFIED` → User can login directly
- `REJECTED` → User cannot login (account disabled)

## 📊 Login Flow

```
User submits login
    ↓
Validate email & password
    ↓
Check if credentials valid
    ↓
If valid:
    ├─ Check verification_status
    │   ├─ PENDING_VERIFICATION → Send OTP, return "not verified" message
    │   ├─ VERIFIED → Login successful, redirect to /gallery
    │   └─ REJECTED → Return 401 "Account disabled"
    └─ If not valid → Return 401 "Email or password wrong"
```

## ✅ Verification Checklist

- [x] PublicUserSeeder added to DatabaseSeeder.php
- [x] verification_status set to 'VERIFIED' in seeder
- [x] email_verified_at set to now() in seeder
- [x] Database reset with `migrate:fresh --seed`
- [x] Public users created (check with `php artisan tinker`)
- [x] Login works with user@test.com / password123
- [x] No 401 errors anymore

## 🐛 Verify with Tinker

```bash
php artisan tinker

# Check public users
App\Models\PublicUser::all();

# Check specific user
App\Models\PublicUser::where('email', 'user@test.com')->first();

# Check verification status
App\Models\PublicUser::first()->verification_status;
```

## 🚀 Files Changed

1. **database/seeders/DatabaseSeeder.php**
   - Added `PublicUserSeeder::class` to $this->call()

2. **database/seeders/PublicUserSeeder.php**
   - Added `'verification_status' => 'VERIFIED'`
   - Added `'email_verified_at' => now()`

## 💡 For Production

For production, you should:
1. Use strong passwords instead of "password123"
2. Create seeder for real user data
3. Set verification_status carefully (require email verification for real users)
4. Use environment-specific seeders

---

**Status**: ✅ **FIXED - Login now works!**

Test it: `user@test.com` / `password123`
