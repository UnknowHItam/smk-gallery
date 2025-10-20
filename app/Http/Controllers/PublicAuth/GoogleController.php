<?php

namespace App\Http\Controllers\PublicAuth;

use App\Http\Controllers\Controller;
use App\Models\PublicUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user exists with this Google ID
            $user = PublicUser::where('google_id', $googleUser->id)->first();

            if ($user) {
                // User exists, login - update status and timestamp
                $user->verification_status = 'VERIFIED';
                $user->email_verified_at = now();
                $user->last_login_at = now();
                $user->save();
                
                Auth::guard('public')->login($user, true);
                return redirect()->route('gallery')->with('success', 'Login berhasil!');
            }

            // Check if user exists with this email
            $user = PublicUser::where('email', $googleUser->email)->first();

            if ($user) {
                // Link Google account to existing user - update status
                $user->google_id = $googleUser->id;
                $user->avatar = $googleUser->avatar;
                $user->email_verified_at = now();
                $user->verification_status = 'VERIFIED';
                $user->last_login_at = now();
                $user->save();

                Auth::guard('public')->login($user, true);
                return redirect()->route('gallery')->with('success', 'Akun Google berhasil ditautkan!');
            }

            // Create new user with VERIFIED status
            $user = PublicUser::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'email_verified_at' => now(),
                'verification_status' => 'VERIFIED',
                'last_login_at' => now(),
                'password' => Hash::make(Str::random(24))
            ]);

            Auth::guard('public')->login($user, true);
            return redirect()->route('gallery')->with('success', 'Akun berhasil dibuat!');

        } catch (\Exception $e) {
            return redirect()->route('gallery')->with('error', 'Terjadi kesalahan saat login dengan Google');
        }
    }
}