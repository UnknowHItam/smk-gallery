<?php

namespace App\Http\Controllers\PublicAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            $remember = $request->boolean('remember');

            if (Auth::guard('public')->attempt($credentials, $remember)) {
                $user = Auth::guard('public')->user();
                
                // Update last login timestamp
                $user->last_login_at = now();
                $user->save();
                
                // Check verification status
                if ($user->verification_status === 'PENDING_VERIFICATION') {
                    // Logout immediately - don't allow login
                    Auth::guard('public')->logout();
                    
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
                        'verified' => false,
                        'message' => 'Akun Anda belum diverifikasi. Kode OTP telah dikirim ke email Anda.',
                        'show_otp_modal' => true,
                        'email' => $user->email,
                        'type' => 'register'
                    ], 200);
                }
                
                // User is verified, allow login
                $request->session()->regenerate();

                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'user' => $user,
                    'redirect' => route('gallery'),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah.'
            ], 401);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Login error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('public')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil!',
        ]);
    }

    /**
     * Get the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        return response()->json([
            'authenticated' => Auth::guard('public')->check(),
            'user' => Auth::guard('public')->user(),
        ]);
    }

    /**
     * Show the user profile page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function profile(Request $request)
    {
        $user = Auth::guard('public')->user();
        return view('public-profile', compact('user'));
    }

    /**
     * Update user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::guard('public')->user();
            
            // If only avatar is being updated
            if ($request->has('avatar') && !$request->has('name') && !$request->has('email')) {
                $user->avatar = $request->avatar;
                $user->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Avatar berhasil diupdate!',
                    'user' => $user,
                ]);
            }
            
            // Otherwise, validate name and email
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:public_users,email,' . $user->id,
            ]);

            $user->name = $request->name;
            
            // If email changed, require verification
            if ($user->email !== $request->email) {
                $user->email = $request->email;
                $user->email_verified_at = null;
            }
            
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diupdate!',
                'user' => $user,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Change user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        try {
            $user = Auth::guard('public')->user();
            
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            // Check if current password is correct
            if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password saat ini tidak sesuai.'
                ], 422);
            }

            $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diubah!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
