<?php

namespace App\Http\Controllers\PublicAuth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    /**
     * Send verification email
     */
    public function sendVerificationEmail(Request $request)
    {
        $user = Auth::guard('public')->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah terverifikasi'
            ]);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'success' => true,
            'message' => 'Link verifikasi telah dikirim ke email Anda'
        ]);
    }

    /**
     * Verify email
     */
    public function verify(Request $request, $id, $hash)
    {
        $user = \App\Models\PublicUser::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('gallery')->with('error', 'Link verifikasi tidak valid');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('gallery')->with('info', 'Email sudah terverifikasi');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('gallery')->with('success', 'Email berhasil diverifikasi!');
    }

    /**
     * Resend verification email
     */
    public function resend(Request $request)
    {
        $user = Auth::guard('public')->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah terverifikasi'
            ]);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'success' => true,
            'message' => 'Link verifikasi telah dikirim ulang'
        ]);
    }
}