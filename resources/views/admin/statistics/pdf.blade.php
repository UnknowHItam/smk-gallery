<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Statistika</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #000;
            padding: 40px 50px;
            background: #ffffff;
        }
        
        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h1 {
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 10px;
            letter-spacing: -1.5px;
            color: #000;
        }
        
        .header .subtitle {
            font-size: 10px;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 12px;
        }
        
        .header .divider {
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #0ea5e9 0%, #06b6d4 100%);
            margin: 0 auto;
        }
        
        /* Stats Boxes */
        .stats-section {
            margin: 30px 0;
        }
        
        .stats-boxes {
            display: table;
            width: 100%;
            margin-bottom: 30px;
            table-layout: fixed;
        }
        
        .stat-box {
            display: table-cell;
            width: 31%;
            height: 110px;
            background: #e0f2fe;
            border-radius: 8px;
            text-align: center;
            vertical-align: middle;
            padding: 20px 10px;
        }
        
        .stat-box:nth-child(2) {
            padding-left: 2%;
            padding-right: 2%;
        }
        
        .stat-box-title {
            font-size: 9px;
            font-weight: 900;
            color: #000;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            line-height: 1.3;
        }
        
        .stat-box-value {
            font-size: 28px;
            font-weight: 900;
            color: #000;
        }
        
        /* Info Section */
        .info-section {
            background: #ffffff;
            padding: 18px 20px;
            margin: 25px 0;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        
        .info-title {
            font-size: 13px;
            font-weight: 700;
            color: #000;
            margin-bottom: 10px;
        }
        
        .info-text {
            font-size: 11px;
            color: #374151;
            line-height: 1.7;
            margin-bottom: 6px;
        }
        
        /* Section Title */
        .section-title {
            font-size: 15px;
            font-weight: 900;
            color: #000;
            margin: 25px 0 15px 0;
        }
        
        /* Table Styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }
        
        .data-table thead {
            background: #0891b2;
            color: white;
        }
        
        .data-table th {
            padding: 14px 20px;
            text-align: left;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.3px;
        }
        
        .data-table th:last-child {
            text-align: center;
        }
        
        .data-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }
        
        .data-table tbody tr:last-child {
            border-bottom: none;
        }
        
        .data-table td {
            padding: 13px 20px;
            font-size: 12px;
            color: #000;
            font-weight: 600;
        }
        
        .data-table td:last-child {
            text-align: center;
            font-weight: 700;
            color: #000;
        }
        
        /* Badge for numbers */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 11px;
        }
        
        .badge-primary {
            background: #dbeafe;
            color: #1d4ed8;
        }
        
        .badge-success {
            background: #dcfce7;
            color: #15803d;
        }
        
        .badge-zero {
            background: #f1f5f9;
            color: #94a3b8;
        }
        
        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 11px;
            color: #6b7280;
        }
        
        .footer .generated {
            margin-bottom: 6px;
            line-height: 1.6;
        }
        
        .footer .copyright {
            font-weight: 600;
            color: #000;
        }
        
        /* Insights Section */
        .insights {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        
        .insights .title {
            font-weight: bold;
            color: #92400e;
            margin-bottom: 8px;
            font-size: 12px;
        }
        
        .insights ul {
            list-style: none;
            padding-left: 0;
        }
        
        .insights li {
            padding: 4px 0;
            color: #78350f;
            font-size: 10px;
        }
        
        .insights li:before {
            content: "• ";
            color: #f59e0b;
            font-weight: bold;
            margin-right: 5px;
        }
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
        <h1>Laporan Statistika</h1>
        <div class="subtitle">
            Analisis Data Postingan Website SMKN 4 Bogor Periode: {{ $months }} Bulan<br>
            Terakhir | Tanggal Cetak: {{ $currentDateTime }} WIB
        </div>
        <div class="divider"></div>
    </div>
    
    <!-- Stats Boxes -->
    <div class="stats-section">
        <table style="width: 100%; border-spacing: 15px 0;">
            <tr>
                <td style="width: 33%; background: #e0f2fe; border-radius: 8px; text-align: center; padding: 20px 10px; height: 110px; vertical-align: middle;">
                    <div class="stat-box-title">TOTAL<br>POSTINGAN</div>
                    <div class="stat-box-value">{{ $totalPosts }}</div>
                </td>
                <td style="width: 33%; background: #e0f2fe; border-radius: 8px; text-align: center; padding: 20px 10px; height: 110px; vertical-align: middle;">
                    <div class="stat-box-title">RATA-RATA<br>PER BULAN</div>
                    <div class="stat-box-value">{{ number_format($avgPosts, 0) }}</div>
                </td>
                <td style="width: 33%; background: #e0f2fe; border-radius: 8px; text-align: center; padding: 20px 10px; height: 110px; vertical-align: middle;">
                    <div class="stat-box-title">BULAN<br>TERTINGGI</div>
                    <div class="stat-box-value">{{ $maxValue }}</div>
                </td>
            </tr>
        </table>
    </div>
    
    <!-- Info Section -->
    <div class="info-section">
        <div class="info-title">Bulan Terbaik: {{ $bestMonth }} dengan {{ $maxValue }} postingan</div>
        <div class="info-text"><strong>Produktivitas:</strong> Rata-rata {{ number_format($avgPosts, 1) }} postingan per bulan</div>
        @if($zeroMonths > 0)
            <div class="info-text"><strong>Perhatian:</strong> Terdapat {{ $zeroMonths }} bulan tanpa postingan</div>
        @endif
        <div class="info-text"><strong>total Konten:</strong> {{ $totalPosts }} postingan dalam {{ $months }} bulan terakhir</div>
    </div>
    
    <!-- Data Table -->
    <div class="section-title">Detail Data Perbulan</div>
    <table class="data-table">
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
    <div class="section-title" style="margin-top: 30px;">Distribusi Postingan per Kategori</div>
    <table class="data-table">
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
    <div class="info-section" style="margin-top: 25px;">
        <div class="info-title">Ringkasan Kategori</div>
        @php
            $maxCategory = collect($categoryData)->sortByDesc('count')->first();
            $totalCategories = count($categoryData);
        @endphp
        <div class="info-text"><strong>Kategori Terpopuler:</strong> {{ $maxCategory['name'] ?? 'N/A' }} dengan {{ $maxCategory['count'] ?? 0 }} postingan ({{ $maxCategory['percentage'] ?? 0 }}%)</div>
        <div class="info-text"><strong>Total Kategori:</strong> {{ $totalCategories }} kategori aktif</div>
        <div class="info-text"><strong>Distribusi:</strong> 
            @foreach($categoryData as $index => $cat)
                {{ $cat['name'] }}: {{ $cat['count'] }} postingan{{ $index < count($categoryData) - 1 ? ', ' : '' }}
            @endforeach
        </div>
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


