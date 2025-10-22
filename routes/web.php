<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\PublicAuth\EmailVerificationController;
use App\Http\Controllers\PublicAuth\PasswordResetController;
use App\Http\Controllers\PublicAuth\GoogleController;
use App\Http\Controllers\PublicAuth\OtpController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\StatisticsController as AdminStatisticsController;
use App\Http\Controllers\Admin\EkstrakurikulerController as AdminEkstrakurikulerController;
use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\UserManagementController as AdminUserManagementController;
use App\Http\Controllers\PublicAuth\LoginController as PublicLoginController;
use App\Http\Controllers\PublicAuth\RegisterController as PublicRegisterController;
use App\Http\Controllers\GalleryInteractionController;

Route::middleware('auth:public')->group(function () {
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])
        ->name('verification.send');
    Route::post('/email/resend', [EmailVerificationController::class, 'resend'])
        ->name('verification.resend');
});

// Use Laravel Breeze's existing email verification route
Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Password Reset Routes
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');
Route::post('/password/verify-otp', [PasswordResetController::class, 'verifyOtp'])
    ->name('password.verify-otp');
Route::get('/reset-password', function () {
    return view('reset-password');
})->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])
    ->name('password.update');

// Google OAuth Routes
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])
    ->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])
    ->name('auth.google.callback');

// OTP Routes
Route::get('/otp', [OtpController::class, 'show'])->name('otp.show');
Route::post('/otp/verify', [OtpController::class, 'verify'])->name('otp.verify');
Route::post('/otp/resend', [OtpController::class, 'resend'])->name('otp.resend');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// API routes for dynamic calendar and agenda (public access)
Route::get('/api/agenda/month', [HomeController::class, 'getAgendaByMonth'])->name('api.agenda.month');

// Public User Authentication Routes
Route::post('/public/login', [PublicLoginController::class, 'login'])->name('public.login');
Route::post('/public/register', [PublicRegisterController::class, 'register'])->name('public.register');
Route::post('/public/register/verify', [PublicRegisterController::class, 'verifyOtp'])->name('public.register.verify');
Route::post('/public/register/resend', [PublicRegisterController::class, 'resendOtp'])->name('public.register.resend');
Route::post('/public/logout', [PublicLoginController::class, 'logout'])->name('public.logout');
Route::get('/public/user', [PublicLoginController::class, 'user'])->name('public.user');

// Public User Profile Routes
Route::middleware('auth:public')->group(function () {
    Route::get('/profile', [PublicLoginController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [PublicLoginController::class, 'updateProfile'])->name('profile.update.public');
    Route::post('/profile/change-password', [PublicLoginController::class, 'changePassword'])->name('profile.change-password');
});

// Kritik dan Saran routes
Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');
Route::post('/kritik-saran/{id}/rating', [KritikSaranController::class, 'updateRating'])->name('kritik-saran.rating');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', AdminPostController::class)->except(['show']);
    Route::get('posts/{post}/stats', [AdminPostController::class, 'stats'])->name('posts.stats');
    Route::delete('fotos/{foto}', [AdminPostController::class, 'deletePhoto'])->name('fotos.destroy');
    Route::resource('ekstrakurikuler', AdminEkstrakurikulerController::class);
    
    // Agenda routes
    Route::resource('agenda', AdminAgendaController::class);
    
    // Kritik dan Saran admin routes
    Route::get('kritik-saran', [KritikSaranController::class, 'index'])->name('kritik-saran.index');
    Route::get('kritik-saran/{id}', [KritikSaranController::class, 'show'])->name('kritik-saran.show');
    Route::patch('kritik-saran/{id}/mark-read', [KritikSaranController::class, 'markAsRead'])->name('kritik-saran.mark-read');
    Route::delete('kritik-saran/{id}', [KritikSaranController::class, 'destroy'])->name('kritik-saran.destroy');
    
    Route::get('statistics', [AdminStatisticsController::class, 'index'])->name('statistics.index');
    Route::get('statistics/export/pdf', [AdminStatisticsController::class, 'exportPdf'])->name('statistics.export.pdf');
    
    // Settings routes
    Route::get('settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::put('settings/update-password', [AdminSettingsController::class, 'updatePassword'])->name('settings.update-password');
    
    // User Management routes
    Route::get('users', [AdminUserManagementController::class, 'index'])->name('users.index');
    Route::delete('users/{id}', [AdminUserManagementController::class, 'destroy'])->name('users.destroy');
});

// Gallery Interaction Routes (API-like)
Route::prefix('gallery/{galleryId}')->group(function () {
    // Like (requires login)
    Route::post('/like', [GalleryInteractionController::class, 'toggleLike'])->name('gallery.like');
    
    // Share (no login required)
    Route::post('/share', [GalleryInteractionController::class, 'trackShare'])->name('gallery.share');
    
    // Stats
    Route::get('/stats', [GalleryInteractionController::class, 'getStats'])->name('gallery.stats');
});

// Gallery Detail Route (for modal)
Route::get('/gallery/{postId}/detail', [GalleryInteractionController::class, 'getGalleryDetail'])->name('gallery.detail');
