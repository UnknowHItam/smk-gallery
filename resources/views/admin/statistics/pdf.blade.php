<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Statistika</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: DejaVu Sans, sans-serif;
        }
        
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #1f2937;
            padding: 30px 40px;
            background: #ffffff;
        }
        
        /* Header Section */
        .header {
            margin-bottom: 25px;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 15px;
        }
        
        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
            color: #111827;
        }
        
        .header .subtitle {
            font-size: 9px;
            color: #6b7280;
            line-height: 1.4;
            font-weight: 400;
        }
        
        /* Stats Boxes */
        .stats-section {
            margin: 20px 0;
        }
        
        .stat-box-title {
            font-size: 8px;
            font-weight: 600;
            color: #6b7280;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            text-transform: uppercase;
        }
        
        .stat-box-value {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
        }
        
        .stat-box-subtitle {
            font-size: 7px;
            color: #9ca3af;
            margin-top: 3px;
            font-weight: 400;
        }
        
        /* Info Section */
        .info-section {
            background: #f9fafb;
            padding: 12px 15px;
            margin: 15px 0;
            border-radius: 6px;
            border-left: 3px solid #3b82f6;
        }
        
        .info-title {
            font-size: 10px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 6px;
        }
        
        .info-text {
            font-size: 9px;
            color: #4b5563;
            line-height: 1.5;
            margin-bottom: 4px;
        }
        
        /* Section Title */
        .section-title {
            font-size: 12px;
            font-weight: 700;
            color: #111827;
            margin: 20px 0 12px 0;
            padding-bottom: 6px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        /* Table Styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            background: #ffffff;
        }
        
        .data-table thead {
            background: #f3f4f6;
        }
        
        .data-table th {
            padding: 8px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 9px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .data-table th:last-child {
            text-align: center;
        }
        
        .data-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
        }
        
        .data-table tbody tr:last-child {
            border-bottom: none;
        }
        
        .data-table tbody tr:hover {
            background: #f9fafb;
        }
        
        .data-table td {
            padding: 8px 12px;
            font-size: 9px;
            color: #374151;
            font-weight: 500;
        }
        
        .data-table td:last-child {
            text-align: center;
            font-weight: 600;
            color: #111827;
        }
        
        /* Badge for numbers */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 8px;
        }
        
        .badge-primary {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 8px;
            color: #9ca3af;
        }
        
        .footer .generated {
            margin-bottom: 4px;
            line-height: 1.4;
        }
        
        .footer .copyright {
            font-weight: 500;
            color: #6b7280;
        }
        
        /* Insights Section */
        .insights {
            background: #eff6ff;
            border-left: 3px solid #3b82f6;
            padding: 12px 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        
        .insights .title {
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 6px;
            font-size: 10px;
        }
        
        .insights ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }
        
        .insights li {
            padding: 3px 0;
            color: #1e40af;
            font-size: 8px;
            font-weight: 400;
        }
        
        .insights li:before {
            content: "▪ ";
            color: #3b82f6;
            font-weight: bold;
            margin-right: 5px;
        }
        
        /* Page specific */
        .page-break {
            page-break-before: always;
        }
        
        /* Spacing utilities */
        .mt-0 { margin-top: 0; }
        .mt-10 { margin-top: 10px; }
        .mt-15 { margin-top: 15px; }
        .mt-20 { margin-top: 20px; }
        .mb-10 { margin-bottom: 10px; }
        .mb-15 { margin-bottom: 15px; }
        .mb-20 { margin-bottom: 20px; }
    </style>
</head>
<body>
    @php
        $maxValue = max($data);
        $maxIndex = array_search($maxValue, $data);
        $totalPosts = array_sum($data);
        $avgPosts = $totalPosts / count($data);
        $zeroMonths = count(array_filter($data, fn($v) => $v == 0));
        
        // Get best month name
        $bestMonth = $labels[$maxIndex] ?? 'N/A';
        
        // Get current date and time
        $currentDateTime = now()->locale('id')->isoFormat('DD MMMM YYYY, HH:mm');
    @endphp
    
    <!-- Header -->
    <div class="header">
        <h1>Laporan Statistik Galeri</h1>
        <div class="subtitle">
            SMKN 4 Bogor • Periode {{ $months }} Bulan Terakhir • Dicetak: {{ $currentDateTime }} WIB
        </div>
    </div>
    
    <!-- Stats Boxes -->
    <div class="stats-section">
        <table style="width: 100%; border-spacing: 12px 0; font-family: DejaVu Sans, sans-serif;">
            <tr>
                <td style="width: 33%; background: #f0f9ff; border-radius: 6px; text-align: center; padding: 15px 10px; vertical-align: middle; border: 1px solid #e0f2fe; font-family: DejaVu Sans, sans-serif;">
                    <div class="stat-box-title">Total Postingan</div>
                    <div class="stat-box-value">{{ $totalPosts }}</div>
                    <div class="stat-box-subtitle">dalam {{ $months }} bulan</div>
                </td>
                <td style="width: 33%; background: #f0f9ff; border-radius: 6px; text-align: center; padding: 15px 10px; vertical-align: middle; border: 1px solid #e0f2fe; font-family: DejaVu Sans, sans-serif;">
                    <div class="stat-box-title">Rata-rata/Bulan</div>
                    <div class="stat-box-value">{{ number_format($avgPosts, 1) }}</div>
                    <div class="stat-box-subtitle">postingan</div>
                </td>
                <td style="width: 33%; background: #f0f9ff; border-radius: 6px; text-align: center; padding: 15px 10px; vertical-align: middle; border: 1px solid #e0f2fe; font-family: DejaVu Sans, sans-serif;">
                    <div class="stat-box-title">Bulan Terbaik</div>
                    <div class="stat-box-value">{{ $maxValue }}</div>
                    <div class="stat-box-subtitle">{{ $bestMonth }}</div>
                </td>
            </tr>
        </table>
    </div>
    
    <!-- Summary Section -->
    <div class="info-section">
        <div class="info-title">Ringkasan Periode</div>
        <div class="info-text">• Bulan terbaik: <strong>{{ $bestMonth }}</strong> dengan <strong>{{ $maxValue }}</strong> postingan</div>
        <div class="info-text">• Produktivitas rata-rata: <strong>{{ number_format($avgPosts, 1) }}</strong> postingan per bulan</div>
        @if($zeroMonths > 0)
            <div class="info-text">• Perhatian: Terdapat <strong>{{ $zeroMonths }}</strong> bulan tanpa postingan</div>
        @endif
    </div>
    
    <!-- Data Table -->
    <div class="section-title">Detail Data Per Bulan</div>
    <table class="data-table" style="font-family: DejaVu Sans, sans-serif;">
        <thead>
            <tr>
                <th style="width: 50%;">Bulan</th>
                <th style="width: 50%;">Jumlah Postingan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labels as $i => $label)
                <tr>
                    <td>{{ $label }}</td>
                    <td>{{ $data[$i] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Category Statistics -->
    <div class="section-title" style="margin-top: 20px;">Distribusi Postingan Per Kategori</div>
    <table class="data-table" style="font-family: DejaVu Sans, sans-serif;">
        <thead>
            <tr>
                <th style="width: 50%;">Kategori</th>
                <th style="width: 25%; text-align: center;">Jumlah</th>
                <th style="width: 25%; text-align: center;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categoryData as $category)
                <tr>
                    <td>{{ $category['name'] }}</td>
                    <td style="text-align: center;">{{ $category['count'] }}</td>
                    <td style="text-align: center;">{{ $category['percentage'] }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Category Summary -->
    <div class="info-section">
        <div class="info-title">Ringkasan Kategori</div>
        @php
            $maxCategory = collect($categoryData)->sortByDesc('count')->first();
            $totalCategories = count($categoryData);
        @endphp
        <div class="info-text">• Kategori terpopuler: <strong>{{ $maxCategory['name'] ?? 'N/A' }}</strong> dengan <strong>{{ $maxCategory['count'] ?? 0 }}</strong> postingan ({{ $maxCategory['percentage'] ?? 0 }}%)</div>
        <div class="info-text">• Total kategori aktif: <strong>{{ $totalCategories }}</strong> kategori</div>
    </div>

    <!-- Page Break -->
    <div style="page-break-before: always;"></div>

    <!-- Engagement Statistics -->
    <div class="section-title" style="margin-top: 0;">Statistik Engagement & Interaksi</div>
    <table style="width: 100%; border-spacing: 8px 0; margin-bottom: 15px; font-family: DejaVu Sans, sans-serif;">
        <tr>
            <td style="width: 25%; background: #f0f9ff; border-radius: 6px; text-align: center; padding: 12px 8px; vertical-align: middle; border: 1px solid #e0f2fe;">
                <div class="stat-box-title">Total Users</div>
                <div class="stat-box-value">{{ $stats['total_users'] ?? 0 }}</div>
                <div class="stat-box-subtitle">+{{ $stats['users_this_period'] ?? 0 }} periode ini</div>
            </td>
            <td style="width: 25%; background: #fef2f2; border-radius: 6px; text-align: center; padding: 12px 8px; vertical-align: middle; border: 1px solid #fee2e2;">
                <div class="stat-box-title">Total Likes</div>
                <div class="stat-box-value">{{ $stats['total_likes'] ?? 0 }}</div>
                <div class="stat-box-subtitle">+{{ $stats['likes_this_period'] ?? 0 }} periode ini</div>
            </td>
            <td style="width: 25%; background: #eff6ff; border-radius: 6px; text-align: center; padding: 12px 8px; vertical-align: middle; border: 1px solid #dbeafe;">
                <div class="stat-box-title">Total Shares</div>
                <div class="stat-box-value">{{ $stats['total_shares'] ?? 0 }}</div>
                <div class="stat-box-subtitle">+{{ $stats['shares_this_period'] ?? 0 }} periode ini</div>
            </td>
            <td style="width: 25%; background: #f0fdf4; border-radius: 6px; text-align: center; padding: 12px 8px; vertical-align: middle; border: 1px solid #dcfce7;">
                <div class="stat-box-title">Total Downloads</div>
                <div class="stat-box-value">{{ $stats['total_downloads'] ?? 0 }}</div>
                <div class="stat-box-subtitle">+{{ $stats['downloads_this_period'] ?? 0 }} periode ini</div>
            </td>
        </tr>
    </table>

    <!-- Top 5 Most Liked Posts -->
    <div class="section-title">Top 5 Postingan Terpopuler</div>
    <table class="data-table" style="font-family: DejaVu Sans, sans-serif;">
        <thead>
            <tr>
                <th style="width: 8%; text-align: center;">#</th>
                <th style="width: 52%;">Judul Postingan</th>
                <th style="width: 20%;">Kategori</th>
                <th style="width: 20%; text-align: center;">Likes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topLikedPosts as $index => $post)
                <tr>
                    <td style="text-align: center;">
                        <span style="display: inline-block; width: 20px; height: 20px; background: {{ $index == 0 ? '#fbbf24' : ($index == 1 ? '#d1d5db' : '#fb923c') }}; border-radius: 50%; color: white; font-weight: 700; line-height: 20px; text-align: center; font-size: 9px;">
                            {{ $index + 1 }}
                        </span>
                    </td>
                    <td>{{ $post->judul }}</td>
                    <td>{{ $post->kategori->judul ?? 'N/A' }}</td>
                    <td style="text-align: center; font-weight: 700; color: #dc2626;">{{ $post->total_likes ?? 0 }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #9ca3af;">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Rating Distribution -->
    <div class="section-title">Distribusi Rating Pengguna</div>
    <div style="background: #fefce8; padding: 12px 15px; border-radius: 6px; border: 1px solid #fef3c7; margin-bottom: 15px;">
        <table style="width: 100%; border-collapse: collapse; font-family: DejaVu Sans, sans-serif;">
            @for($i = 5; $i >= 1; $i--)
                <tr>
                    <td style="width: 12%; padding: 5px 0; font-family: DejaVu Sans, sans-serif;">
                        <div style="display: inline-block;">
                            @for($j = 1; $j <= $i; $j++)
                                <span style="color: #f59e0b; font-size: 12px; font-family: DejaVu Sans, sans-serif;">★</span>
                            @endfor
                        </div>
                    </td>
                    <td style="width: 63%; padding: 5px 8px;">
                        <div style="background: #fef3c7; height: 10px; border-radius: 5px; overflow: hidden;">
                            <div style="background: #f59e0b; height: 10px; width: {{ $ratingDistribution[$i]['percentage'] }}%; border-radius: 5px;"></div>
                        </div>
                    </td>
                    <td style="width: 25%; padding: 5px 0; text-align: right; font-weight: 600; font-size: 9px; color: #78350f; font-family: DejaVu Sans, sans-serif;">
                        {{ $ratingDistribution[$i]['count'] }} ({{ $ratingDistribution[$i]['percentage'] }}%)
                    </td>
                </tr>
            @endfor
        </table>
        <div style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #fde68a; text-align: center; font-family: DejaVu Sans, sans-serif;">
            <span style="font-size: 9px; color: #78350f; font-weight: 500;">Rata-rata: </span>
            <span style="font-size: 16px; color: #f59e0b; font-weight: 700;">{{ $stats['average_rating'] ?? 0 }}/5</span>
            <span style="font-size: 8px; color: #a16207; margin-left: 8px;">({{ $stats['total_ratings'] ?? 0 }} rating)</span>
        </div>
    </div>

    <!-- Additional Insights -->
    <div class="insights">
        <div class="title">Insight & Rekomendasi</div>
        <ul>
            @php
                $totalInteractions = ($stats['total_likes'] ?? 0) + ($stats['total_shares'] ?? 0) + ($stats['total_downloads'] ?? 0);
                $engagementRate = ($stats['total_posts'] ?? 0) > 0 ? round($totalInteractions / $stats['total_posts'], 2) : 0;
            @endphp
            <li>Engagement rate: <strong>{{ $engagementRate }}</strong> interaksi per postingan</li>
            <li>Total galeri foto: <strong>{{ $stats['total_galleries'] ?? 0 }}</strong> galeri</li>
            <li>Total feedback: <strong>{{ $stats['total_feedback'] ?? 0 }}</strong> kritik & saran</li>
            @if(($stats['average_rating'] ?? 0) >= 4)
                <li>Rating sangat baik! Pertahankan kualitas konten</li>
            @elseif(($stats['average_rating'] ?? 0) >= 3)
                <li>Rating cukup baik, ada ruang untuk peningkatan</li>
            @else
                <li>Perlu peningkatan kualitas konten</li>
            @endif
        </ul>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <div class="generated">
            Dokumen ini dibuat secara otomatis oleh Sistem Manajemen Konten
        </div>
        <div class="copyright">
            © {{ date('Y') }} SMKN 4 Bogor - Sistem Informasi Galeri
        </div>
    </div>
</body>
</html>


