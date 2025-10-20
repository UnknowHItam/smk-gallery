<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Kategori;
use App\Models\Ekstrakurikuler;
use App\Models\KritikSaran;
use App\Models\PublicUser;
use App\Models\GalleryLike;
use App\Models\GalleryShare;
use App\Models\GalleryDownload;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'total_posts' => Posts::count(),
            'posts_this_month' => Posts::whereMonth('created_at', now()->month)->count(),
            'total_ekstrakurikuler' => Ekstrakurikuler::count(),
            'active_ekstrakurikuler' => Ekstrakurikuler::where('status', true)->count(),
            'unread_feedback' => KritikSaran::where('status', 'unread')->count(),
            'total_feedback' => KritikSaran::count(),
            'feedback_this_month' => KritikSaran::whereMonth('created_at', now()->month)->count(),
            'average_rating' => round(KritikSaran::whereNotNull('rating')->avg('rating'), 1),
            'total_ratings' => KritikSaran::whereNotNull('rating')->count(),
            'total_users' => PublicUser::count(),
            'users_this_month' => PublicUser::whereMonth('created_at', now()->month)->count(),
            'total_likes' => GalleryLike::count(),
            'likes_this_month' => GalleryLike::whereMonth('created_at', now()->month)->count(),
            'total_shares' => GalleryShare::count(),
            'shares_this_month' => GalleryShare::whereMonth('created_at', now()->month)->count(),
            'total_downloads' => GalleryDownload::count(),
            'downloads_this_month' => GalleryDownload::whereMonth('created_at', now()->month)->count(),
        ];

        // Get recent posts with category
        $recentPosts = Posts::with('kategori')
            ->latest('created_at')
            ->take(5)
            ->get();

        // Get recent activities (combining different types of activities)
        $recentActivities = collect();

        // Add recent posts as activities
        $recentPosts->each(function($post) use (&$recentActivities) {
            $recentActivities->push((object)[
                'type' => 'post',
                'title' => 'Postingan Baru',
                'description' => 'Postingan "' . $post->judul . '" telah dibuat',
                'created_at' => $post->created_at
            ]);
        });

        // Add recent feedback as activities
        $recentFeedback = KritikSaran::latest()
            ->take(3)
            ->get()
            ->each(function($feedback) use (&$recentActivities) {
                $recentActivities->push((object)[
                    'type' => 'feedback',
                    'title' => 'Kritik & Saran Baru',
                    'description' => 'Pesan baru dari ' . $feedback->nama,
                    'created_at' => $feedback->created_at
                ]);
            });

        // Add recent ekstrakurikuler as activities
        $recentEkstra = Ekstrakurikuler::latest()
            ->take(2)
            ->get()
            ->each(function($ekstra) use (&$recentActivities) {
                $recentActivities->push((object)[
                    'type' => 'ekstrakurikuler',
                    'title' => 'Ekstrakurikuler Baru',
                    'description' => 'Ekstrakurikuler ' . $ekstra->nama . ' ditambahkan',
                    'created_at' => $ekstra->created_at
                ]);
            });

        // Sort activities by creation date
        $recentActivities = $recentActivities->sortByDesc('created_at')->take(5);

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentActivities'));
    }
}


