<?php

namespace App\Http\Controllers\PublicAuth;

use App\Http\Controllers\Controller;
use App\Models\PublicUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:public_users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = PublicUser::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'verification_status' => 'PENDING_VERIFICATION',
            ]);

            // DO NOT auto-login - user must verify OTP first
            // Generate and send OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            \Illuminate\Support\Facades\Cache::put('otp_' . $user->email, $otp, now()->addMinutes(5));
            
            // Send OTP email - with error handling
            try {
                \Illuminate\Support\Facades\Mail::send('emails.otp', ['otp' => $otp, 'user' => $user, 'type' => 'register'], function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('Kode OTP Verifikasi - ' . config('app.name'));
                });
            } catch (\Exception $mailException) {
                \Illuminate\Support\Facades\Log::error('Failed to send OTP email: ' . $mailException->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil! Silakan verifikasi dengan kode OTP yang dikirim ke email Anda.',
                'show_otp_modal' => true,
                'email' => $user->email,
                'type' => 'register'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Registration error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
