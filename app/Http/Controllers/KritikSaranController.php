<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KritikSaranController extends Controller
{
    // Method untuk menyimpan kritik dan saran dari form contact
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string|max:1000',
            'recaptcha_token' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'pesan.required' => 'Pesan wajib diisi',
            'pesan.max' => 'Pesan maksimal 1000 karakter',
            'recaptcha_token.required' => 'Verifikasi reCAPTCHA gagal',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verify reCAPTCHA token (skip jika timeout/error/not_loaded)
        $token = $request->recaptcha_token;
        
        if (!in_array($token, ['timeout', 'error', 'not_loaded'])) {
            $recaptchaResponse = $this->verifyRecaptcha($token);
            
            if (!$recaptchaResponse['success']) {
                \Log::warning('reCAPTCHA verification failed', [
                    'token' => substr($token, 0, 20) . '...',
                    'response' => $recaptchaResponse
                ]);
                
                // Jangan block user, hanya log
                // return redirect()->back()
                //     ->with('error', 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.')
                //     ->withInput();
            }

            // Check reCAPTCHA score (0.0 to 1.0, higher is better)
            if (isset($recaptchaResponse['score']) && $recaptchaResponse['score'] < 0.5) {
                \Log::warning('Low reCAPTCHA score detected', [
                    'score' => $recaptchaResponse['score'],
                    'nama' => $request->nama,
                    'email' => $request->email
                ]);
                
                // Jangan block user dengan score rendah, hanya log untuk monitoring
                // return redirect()->back()
                //     ->with('error', 'Aktivitas mencurigakan terdeteksi. Silakan coba lagi.')
                //     ->withInput();
            }
        } else {
            // Log jika reCAPTCHA timeout/error/not_loaded
            \Log::info('reCAPTCHA bypassed', [
                'reason' => $token,
                'nama' => $request->nama,
                'email' => $request->email
            ]);
        }

        try {
            $kritikSaran = KritikSaran::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'pesan' => $request->pesan,
                'status' => 'unread'
            ]);

            return redirect()->back()
                ->with('success', 'Terima kasih! Kritik dan saran Anda telah berhasil dikirim.')
                ->with('kritik_saran_id', $kritikSaran->id)
                ->withFragment('kontak');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    // Method untuk verifikasi reCAPTCHA token
    private function verifyRecaptcha($token)
    {
        $secretKey = config('services.recaptcha.secret_key');
        
        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$token}"
        );
        
        return json_decode($response, true);
    }

    // Method untuk update rating
    public function updateRating(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Rating tidak valid'
            ], 400);
        }

        try {
            $kritikSaran = KritikSaran::findOrFail($id);
            $kritikSaran->update(['rating' => $request->rating]);

            return response()->json([
                'success' => true,
                'message' => 'Rating berhasil disimpan',
                'data' => [
                    'id' => $kritikSaran->id,
                    'rating' => $kritikSaran->rating
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan rating'
            ], 500);
        }
    }

    // Method untuk admin - menampilkan semua kritik dan saran
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = KritikSaran::query()->orderBy('created_at', 'desc');
        
        if ($status === 'unread') {
            $query->unread();
        } elseif ($status === 'read') {
            $query->read();
        }
        
        $kritikSaran = $query->paginate(10);
        $unreadCount = KritikSaran::unread()->count();
        
        return view('admin.kritik-saran.index', compact('kritikSaran', 'status', 'unreadCount'));
    }

    // Method untuk admin - melihat detail kritik dan saran
    public function show($id)
    {
        $kritikSaran = KritikSaran::findOrFail($id);
        
        // Tandai sebagai sudah dibaca jika masih unread
        if ($kritikSaran->status === 'unread') {
            $kritikSaran->markAsRead();
        }
        
        return view('admin.kritik-saran.show', compact('kritikSaran'));
    }

    // Method untuk admin - menandai sebagai sudah dibaca
    public function markAsRead($id)
    {
        $kritikSaran = KritikSaran::findOrFail($id);
        $kritikSaran->markAsRead();
        
        return redirect()->back()->with('success', 'Pesan telah ditandai sebagai sudah dibaca.');
    }

    // Method untuk admin - menghapus kritik dan saran
    public function destroy($id)
    {
        $kritikSaran = KritikSaran::findOrFail($id);
        $kritikSaran->delete();
        
        return redirect()->back()->with('success', 'Kritik dan saran berhasil dihapus.');
    }
}
