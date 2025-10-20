<?php

namespace App\Http\Controllers;

use App\Models\GalleryLike;
use App\Models\GalleryShare;
use App\Models\Galery;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryInteractionController extends Controller
{
    /**
     * Toggle like on a gallery (requires login)
     */
    public function toggleLike(Request $request, $galleryId)
    {
        if (!Auth::guard('public')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login untuk menyukai postingan',
                'redirect' => route('public.login')
            ], 401);
        }

        $userId = Auth::guard('public')->id();
        
        $like = GalleryLike::where('gallery_id', $galleryId)
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            // Unlike
            $like->delete();
            $liked = false;
        } else {
            // Like
            GalleryLike::create([
                'gallery_id' => $galleryId,
                'user_id' => $userId,
            ]);
            $liked = true;
        }

        $likesCount = GalleryLike::where('gallery_id', $galleryId)->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }

    /**
     * Get gallery statistics
     */
    public function getStats($galleryId)
    {
        $likesCount = GalleryLike::where('gallery_id', $galleryId)->count();
        $sharesCount = GalleryShare::where('gallery_id', $galleryId)->count();
        
        $isLiked = false;
        if (Auth::guard('public')->check()) {
            $isLiked = GalleryLike::where('gallery_id', $galleryId)
                ->where('user_id', Auth::guard('public')->id())
                ->exists();
        }
        
        return response()->json([
            'success' => true,
            'stats' => [
                'likes_count' => $likesCount,
                'shares_count' => $sharesCount,
                'is_liked' => $isLiked
            ]
        ]);
    }

    /**
     * Track share (no login required)
     */
    public function trackShare(Request $request, $galleryId)
    {
        $request->validate([
            'platform' => 'required|string|in:whatsapp,facebook,twitter,copy_link'
        ]);

        GalleryShare::create([
            'gallery_id' => $galleryId,
            'platform' => $request->platform,
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Share tracked successfully'
        ]);
    }

    /**
     * Get gallery detail for modal (no login required)
     */
    public function getGalleryDetail($postId)
    {
        try {
            $post = Posts::with(['kategori', 'galery.foto'])
                ->where('id', $postId)
                ->where('status', 'published')
                ->firstOrFail();

            // Get gallery stats
            $gallery = $post->galery->first();
            $stats = [
                'likes_count' => 0,
                'shares_count' => 0,
                'is_liked' => false,
            ];

            if ($gallery) {
                $stats['likes_count'] = GalleryLike::where('gallery_id', $gallery->id)->count();
                $stats['shares_count'] = GalleryShare::where('gallery_id', $gallery->id)->count();
                
                if (Auth::guard('public')->check()) {
                    $stats['is_liked'] = GalleryLike::where('gallery_id', $gallery->id)
                        ->where('user_id', Auth::guard('public')->id())
                        ->exists();
                }
            }

            return response()->json([
                'success' => true,
                'gallery' => [
                    'id' => $gallery ? $gallery->id : null,
                    'title' => $post->judul,
                    'description' => $post->isi,
                    'category' => $post->kategori ? $post->kategori->judul : 'Tidak ada kategori',
                    'created_at' => $post->created_at,
                    'photos' => $post->galery->flatMap(function($gallery) {
                        return $gallery->foto->map(function($photo) {
                            return [
                                'id' => $photo->id,
                                'file' => $photo->file,
                                'title' => $photo->judul,
                            ];
                        });
                    }),
                    'stats' => $stats
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        }
    }
}
