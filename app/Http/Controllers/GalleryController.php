<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Kategori;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');
        
        // Get all categories for navigation (distinct to avoid duplicates, exclude Agenda)
        $categories = Kategori::select('judul')
            ->where('judul', '!=', 'Agenda')
            ->distinct()
            ->get();
        
        // Build query for posts
        $query = Posts::with(['kategori', 'galery.foto'])
            ->where('status', 'published');
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('isi', 'like', '%' . $search . '%');
            });
        }
        
        // Apply category filter
        if ($category && $category !== 'all') {
            $query->whereHas('kategori', function($q) use ($category) {
                $q->where('judul', $category);
            });
        }
        
        // Get posts with pagination
        $posts = $query->orderBy('created_at', 'desc')
                      ->paginate(12);
        
        // Get top 3 most liked posts
        $popularPosts = Posts::with(['kategori', 'galery.foto', 'galery.likes'])
            ->where('status', 'published')
            ->withCount(['galery as total_likes' => function($query) {
                $query->join('gallery_likes', 'galery.id', '=', 'gallery_likes.gallery_id');
            }])
            ->orderBy('total_likes', 'desc')
            ->take(3)
            ->get();
        
        return view('gallery', compact('posts', 'categories', 'search', 'category', 'popularPosts'));
    }
}
