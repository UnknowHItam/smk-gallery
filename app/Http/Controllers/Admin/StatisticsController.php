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
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $stats = [
            'total_users' => PublicUser::count(),
            'users_this_period' => PublicUser::where('created_at', '>=', Carbon::now()->subMonths($months))->count(),
            'total_likes' => GalleryLike::count(),
            'likes_this_period' => GalleryLike::where('created_at', '>=', Carbon::now()->subMonths($months))->count(),
            'total_shares' => GalleryShare::count(),
            'shares_this_period' => GalleryShare::where('created_at', '>=', Carbon::now()->subMonths($months))->count(),
            'total_downloads' => GalleryDownload::count(),
            'downloads_this_period' => GalleryDownload::where('created_at', '>=', Carbon::now()->subMonths($months))->count(),
            'total_feedback' => KritikSaran::count(),
            'feedback_this_period' => KritikSaran::where('created_at', '>=', Carbon::now()->subMonths($months))->count(),
            'average_rating' => round(KritikSaran::whereNotNull('rating')->avg('rating'), 1),
            'total_ratings' => KritikSaran::whereNotNull('rating')->count(),
        ];

        return view('admin.statistics.index', [
            'labels' => $labels,
            'data' => $data,
            'months' => $months,
            'categories' => $categoryData,
            'stats' => $stats,
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

        $html = view('admin.statistics.pdf', compact('labels', 'data', 'months', 'categoryData'))->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->download('statistik-postingan.pdf');
    }
}


