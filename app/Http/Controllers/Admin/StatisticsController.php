<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Kategori;
use App\Models\PublicUser;
use App\Models\GalleryLike;
use App\Models\GalleryShare;
use App\Models\GalleryDownload;
use App\Models\KritikSaran;
use App\Models\Galery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $months = (int)($request->get('months', 6));
        $months = max(1, min(6, $months));

        $labels = [];
        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $start = Carbon::now()->subMonths($i)->startOfMonth();
            $end = (clone $start)->endOfMonth();
            $labels[] = $start->isoFormat('MMM Y');
            $data[] = Posts::whereBetween('created_at', [$start, $end])->count();
        }

        // Get category statistics
        $categories = Kategori::withCount('posts')->get();
        $categoryData = [];
        $categoryMap = [];
        
        // Group by category name to avoid duplicates
        foreach ($categories as $category) {
            $name = $category->judul;
            if (!isset($categoryMap[$name])) {
                $categoryMap[$name] = 0;
            }
            $categoryMap[$name] += $category->posts_count;
        }
        
        // Convert to array and calculate percentages
        $totalPosts = Posts::count();
        foreach ($categoryMap as $name => $count) {
            $categoryData[] = [
                'name' => $name,
                'count' => $count,
                'percentage' => $totalPosts > 0 ? round(($count / $totalPosts) * 100, 1) : 0
            ];
        }
        
        // Sort by count descending
        usort($categoryData, function($a, $b) {
            return $b['count'] - $a['count'];
        });

        // Get additional statistics
        $startPeriod = Carbon::now()->subMonths($months);
        $previousPeriodStart = Carbon::now()->subMonths($months * 2);
        $previousPeriodEnd = $startPeriod->copy();
        
        $stats = [
            'total_users' => PublicUser::count(),
            'users_this_period' => PublicUser::where('created_at', '>=', $startPeriod)->count(),
            'users_previous_period' => PublicUser::whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])->count(),
            'total_likes' => GalleryLike::count(),
            'likes_this_period' => GalleryLike::where('created_at', '>=', $startPeriod)->count(),
            'likes_previous_period' => GalleryLike::whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])->count(),
            'total_shares' => GalleryShare::count(),
            'shares_this_period' => GalleryShare::where('created_at', '>=', $startPeriod)->count(),
            'shares_previous_period' => GalleryShare::whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])->count(),
            'total_downloads' => GalleryDownload::count(),
            'downloads_this_period' => GalleryDownload::where('created_at', '>=', $startPeriod)->count(),
            'downloads_previous_period' => GalleryDownload::whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])->count(),
            'total_feedback' => KritikSaran::count(),
            'feedback_this_period' => KritikSaran::where('created_at', '>=', $startPeriod)->count(),
            'feedback_previous_period' => KritikSaran::whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])->count(),
            'average_rating' => round(KritikSaran::whereNotNull('rating')->avg('rating'), 1),
            'total_ratings' => KritikSaran::whereNotNull('rating')->count(),
            'total_posts' => Posts::count(),
            'posts_this_period' => Posts::where('created_at', '>=', $startPeriod)->count(),
            'posts_previous_period' => Posts::whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])->count(),
            'total_galleries' => Galery::count(),
        ];
        
        // Calculate growth rates
        $stats['users_growth'] = $stats['users_previous_period'] > 0 
            ? round((($stats['users_this_period'] - $stats['users_previous_period']) / $stats['users_previous_period']) * 100, 1) 
            : 0;
        $stats['likes_growth'] = $stats['likes_previous_period'] > 0 
            ? round((($stats['likes_this_period'] - $stats['likes_previous_period']) / $stats['likes_previous_period']) * 100, 1) 
            : 0;
        $stats['shares_growth'] = $stats['shares_previous_period'] > 0 
            ? round((($stats['shares_this_period'] - $stats['shares_previous_period']) / $stats['shares_previous_period']) * 100, 1) 
            : 0;
        $stats['downloads_growth'] = $stats['downloads_previous_period'] > 0 
            ? round((($stats['downloads_this_period'] - $stats['downloads_previous_period']) / $stats['downloads_previous_period']) * 100, 1) 
            : 0;
        $stats['posts_growth'] = $stats['posts_previous_period'] > 0 
            ? round((($stats['posts_this_period'] - $stats['posts_previous_period']) / $stats['posts_previous_period']) * 100, 1) 
            : 0;
        
        // Calculate engagement rate
        $totalInteractions = $stats['total_likes'] + $stats['total_shares'] + $stats['total_downloads'];
        $stats['engagement_rate'] = $stats['total_posts'] > 0 
            ? round($totalInteractions / $stats['total_posts'], 2) 
            : 0;
        
        // Get top 5 most liked posts
        $topLikedPosts = Posts::with(['kategori', 'galery.likes'])
            ->withCount(['galery as total_likes' => function($query) {
                $query->join('gallery_likes', 'galery.id', '=', 'gallery_likes.gallery_id');
            }])
            ->orderBy('total_likes', 'desc')
            ->take(5)
            ->get();
        
        // Get top 5 most downloaded posts
        $topDownloadedPosts = Posts::with(['kategori', 'galery.downloads'])
            ->withCount(['galery as total_downloads' => function($query) {
                $query->join('gallery_downloads', 'galery.id', '=', 'gallery_downloads.gallery_id');
            }])
            ->orderBy('total_downloads', 'desc')
            ->take(5)
            ->get();
        
        // Get recent feedback with ratings
        $recentFeedback = KritikSaran::whereNotNull('rating')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Rating distribution
        $ratingDistribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $count = KritikSaran::where('rating', $i)->count();
            $ratingDistribution[$i] = [
                'count' => $count,
                'percentage' => $stats['total_ratings'] > 0 ? round(($count / $stats['total_ratings']) * 100, 1) : 0
            ];
        }

        return view('admin.statistics.index', [
            'labels' => $labels,
            'data' => $data,
            'months' => $months,
            'categories' => $categoryData,
            'stats' => $stats,
            'topLikedPosts' => $topLikedPosts,
            'topDownloadedPosts' => $topDownloadedPosts,
            'recentFeedback' => $recentFeedback,
            'ratingDistribution' => $ratingDistribution,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $months = (int)($request->get('months', 6));
        $months = max(1, min(6, $months));

        $labels = [];
        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $start = Carbon::now()->subMonths($i)->startOfMonth();
            $end = (clone $start)->endOfMonth();
            $labels[] = $start->isoFormat('MMM Y');
            $data[] = Posts::whereBetween('created_at', [$start, $end])->count();
        }

        // Get category statistics
        $categories = Kategori::withCount('posts')->get();
        $categoryData = [];
        $categoryMap = [];
        
        // Group by category name to avoid duplicates
        foreach ($categories as $category) {
            $name = $category->judul;
            if (!isset($categoryMap[$name])) {
                $categoryMap[$name] = 0;
            }
            $categoryMap[$name] += $category->posts_count;
        }
        
        // Convert to array and calculate percentages
        $totalPosts = Posts::count();
        foreach ($categoryMap as $name => $count) {
            $categoryData[] = [
                'name' => $name,
                'count' => $count,
                'percentage' => $totalPosts > 0 ? round(($count / $totalPosts) * 100, 1) : 0
            ];
        }
        
        // Sort by count descending
        usort($categoryData, function($a, $b) {
            return $b['count'] - $a['count'];
        });
        
        // Get additional statistics for PDF
        $startPeriod = Carbon::now()->subMonths($months);
        $stats = [
            'total_users' => PublicUser::count(),
            'users_this_period' => PublicUser::where('created_at', '>=', $startPeriod)->count(),
            'total_likes' => GalleryLike::count(),
            'likes_this_period' => GalleryLike::where('created_at', '>=', $startPeriod)->count(),
            'total_shares' => GalleryShare::count(),
            'shares_this_period' => GalleryShare::where('created_at', '>=', $startPeriod)->count(),
            'total_downloads' => GalleryDownload::count(),
            'downloads_this_period' => GalleryDownload::where('created_at', '>=', $startPeriod)->count(),
            'total_feedback' => KritikSaran::count(),
            'average_rating' => round(KritikSaran::whereNotNull('rating')->avg('rating'), 1),
            'total_ratings' => KritikSaran::whereNotNull('rating')->count(),
            'total_posts' => Posts::count(),
            'total_galleries' => Galery::count(),
        ];
        
        // Get top posts
        $topLikedPosts = Posts::with(['kategori'])
            ->withCount(['galery as total_likes' => function($query) {
                $query->join('gallery_likes', 'galery.id', '=', 'gallery_likes.gallery_id');
            }])
            ->orderBy('total_likes', 'desc')
            ->take(5)
            ->get();
        
        // Rating distribution
        $ratingDistribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $count = KritikSaran::where('rating', $i)->count();
            $ratingDistribution[$i] = [
                'count' => $count,
                'percentage' => $stats['total_ratings'] > 0 ? round(($count / $stats['total_ratings']) * 100, 1) : 0
            ];
        }

        $html = view('admin.statistics.pdf', compact('labels', 'data', 'months', 'categoryData', 'stats', 'topLikedPosts', 'ratingDistribution'))->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->download('statistik-postingan.pdf');
    }
}


