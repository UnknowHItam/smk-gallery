<?php

namespace App\Http\Controllers\PublicAuth;

use App\Http\Controllers\Controller;
use App\Models\PublicUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    /**
     * Show OTP verification page
     */
    public function show(Request $request)
    {
        $email = $request->query('email');
        $type = $request->query('type', 'login'); // login, register, reset
        
        if (!$email) {
            return redirect()->route('gallery');
        }

        // Generate and send OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in cache for 5 minutes
        Cache::put('otp_' . $email, $otp, now()->addMinutes(5));
        
        // Send OTP via email
        $user = PublicUser::where('email', $email)->first();
        if ($user) {
            Mail::send('emails.otp', ['otp' => $otp, 'user' => $user, 'type' => $type], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Kode OTP Verifikasi - ' . config('app.name'));
            });
        }

        return view('otp', [
            'email' => $email,
            'type' => $type
        ]);
    }

    /**
     * Verify OTP
     */
    public function verify(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'otp' => 'required|string|size:6',
                'type' => 'required|string|in:register,login,reset'
            ]);

            $email = $request->email;
            $otp = $request->otp;
            $type = $request->type;
            
            // Get stored OTP from cache
            $storedOtp = Cache::get('otp_' . $email);
            
            if (!$storedOtp) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode OTP telah kadaluarsa. Silakan minta kode baru.'
                ], 400);
            }

            if ($storedOtp !== $otp) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode OTP tidak valid.'
                ], 400);
            }

            // OTP verified, clear cache
            Cache::forget('otp_' . $email);
            
            // Update user verification status for register/login
            if ($type === 'register' || $type === 'login') {
                $user = PublicUser::where('email', $email)->first();
                if ($user) {
                    $user->markAsVerified();
                    
                    // Update last login
                    $user->last_login_at = now();
                    $user->save();
                    
                    // Auto-login after verification
                    Auth::guard('public')->login($user);
                }
                
                return response()->json([
                    'success' => true,
                    'message' => 'Verifikasi berhasil! Anda akan diarahkan ke gallery.',
                    'redirect' => route('gallery')
                ]);
            }
            
            // For reset password, store verified token and redirect to reset form
            if ($type === 'reset') {
                // Store verified token for password reset
                $resetToken = \Illuminate\Support\Str::random(64);
                Cache::put('reset_verified_' . $email, $resetToken, now()->addMinutes(10));
                
                return response()->json([
                    'success' => true,
                    'message' => 'OTP terverifikasi. Silakan masukkan password baru.',
                    'redirect' => route('password.reset') . '?token=' . $resetToken . '&email=' . urlencode($email)
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Verifikasi berhasil!',
                'redirect' => route('gallery')
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('OTP verify error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Resend OTP
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $type = $request->type ?? 'login';
        
        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in cache for 5 minutes
        Cache::put('otp_' . $email, $otp, now()->addMinutes(5));
        
        // Send OTP via email
        $user = PublicUser::where('email', $email)->first();
        if ($user) {
            Mail::send('emails.otp', ['otp' => $otp, 'user' => $user, 'type' => $type], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Kode OTP Verifikasi - ' . config('app.name'));
            });
        }

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP baru telah dikirim ke email Anda.'
        ]);
    }
}
