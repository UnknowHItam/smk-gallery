<?php

namespace App\Http\Controllers\PublicAuth;

use App\Http\Controllers\Controller;
use App\Models\PublicUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Send password reset link
     */
    public function sendResetLink(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'email' => 'required|email'
            ]);

            // Check if user exists
            $user = PublicUser::where('email', $validated['email'])->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email tidak terdaftar'
                ], 404);
            }

            // Generate OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Store OTP in cache with error handling
            try {
                \Illuminate\Support\Facades\Cache::put('otp_' . $user->email, $otp, now()->addMinutes(5));
            } catch (\Exception $cacheException) {
                \Illuminate\Support\Facades\Log::error('Cache error: ' . $cacheException->getMessage());
                // Continue anyway - we'll return the OTP in response for debugging
            }
            
            // Send OTP email - with error handling
            try {
                Mail::send('emails.otp', ['otp' => $otp, 'user' => $user, 'type' => 'reset'], function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('Kode OTP Reset Password - ' . config('app.name'));
                });
            } catch (\Exception $mailException) {
                \Illuminate\Support\Facades\Log::error('Mail error: ' . $mailException->getMessage());
                // Continue anyway
            }

            // Always return success to show OTP modal
            return response()->json([
                'success' => true,
                'message' => 'Kode OTP telah dikirim ke email Anda',
                'show_otp_modal' => true,
                'email' => $validated['email'],
                'type' => 'reset',
                // For debugging - remove in production
                'debug_otp' => config('app.debug') ? $otp : null
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            // Log the actual error for debugging
            \Illuminate\Support\Facades\Log::error('Password reset error: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify OTP for password reset
     */
    public function verifyOtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'otp' => 'required|digits:6'
            ]);

            // Get OTP from cache
            $cachedOtp = \Illuminate\Support\Facades\Cache::get('otp_' . $validated['email']);
            
            if (!$cachedOtp) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode OTP sudah kadaluarsa. Silakan kirim ulang.'
                ], 400);
            }

            if ($cachedOtp !== $validated['otp']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode OTP tidak valid'
                ], 400);
            }

            // OTP is valid, generate reset token and store in cache
            $resetToken = Str::random(60);
            \Illuminate\Support\Facades\Cache::put('reset_verified_' . $validated['email'], $resetToken, now()->addMinutes(15));
            
            // Clear OTP from cache
            \Illuminate\Support\Facades\Cache::forget('otp_' . $validated['email']);

            return response()->json([
                'success' => true,
                'message' => 'OTP berhasil diverifikasi!',
                'token' => $resetToken,
                'redirect' => route('password.reset') . '?token=' . $resetToken . '&email=' . urlencode($validated['email'])
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('OTP verification error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Reset password
     */
    public function reset(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed'
            ]);

            // Verify token from OTP verification (stored in cache)
            $verifiedToken = \Illuminate\Support\Facades\Cache::get('reset_verified_' . $request->email);
            
            if (!$verifiedToken || $verifiedToken !== $request->token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token reset tidak valid atau sudah kadaluarsa'
                ], 400);
            }

            // Update password
            $user = PublicUser::where('email', $request->email)->first();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
            }
            
            $user->password = Hash::make($request->password);
            $user->save();

            // Clear verified token
            \Illuminate\Support\Facades\Cache::forget('reset_verified_' . $request->email);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.'
            ], 500);
        }
    }
}