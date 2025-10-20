<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Kategori;
use App\Models\Ekstrakurikuler;
use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil postingan yang sudah published
        $posts = Posts::with(['kategori', 'galery.foto'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Ambil postingan berdasarkan kategori untuk tab
        $beritaPosts = Posts::with(['kategori', 'galery.foto'])
            ->where('status', 'published')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Kegiatan');
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $kejuaraanPosts = Posts::with(['kategori', 'galery.foto'])
            ->where('status', 'published')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Kejuaraan');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $eskulPosts = Posts::with(['kategori', 'galery.foto'])
            ->where('status', 'published')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Ekstrakurikuler');
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $agendaPosts = Posts::with(['kategori', 'galery.foto'])
            ->where('status', 'published')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Agenda');
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Ambil agenda dari tabel agenda (yang belum kadaluwarsa dan aktif)
        $agendas = Agenda::with('user')
            ->aktif()
            ->belumKadaluwarsa()
            ->orderBy('tanggal_mulai', 'asc')
            ->take(6)
            ->get();

        // Ambil data ekstrakurikuler aktif
        $ekstrakurikulers = Ekstrakurikuler::where('status', true)
            ->orderBy('nama')
            ->get();

        return view('home', compact('posts', 'beritaPosts', 'kejuaraanPosts', 'eskulPosts', 'agendaPosts', 'agendas', 'ekstrakurikulers'));
    }

    public function getAgendaByMonth(Request $request)
    {
        try {
            $year = $request->input('year', date('Y'));
            $month = $request->input('month', date('n'));
            
            // Validasi input
            if (!is_numeric($year) || !is_numeric($month) || $month < 1 || $month > 12) {
                return response()->json(['error' => 'Invalid year or month'], 400);
            }
            
            // Ambil agenda dari tabel agenda untuk bulan tersebut - OPTIMIZED
            $agendas = Agenda::select('id', 'judul', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai', 'waktu_mulai', 'waktu_selesai', 'lokasi', 'warna', 'status')
                ->where('status', 'aktif')
                ->bulanIni($year, $month)
                ->orderBy('tanggal_mulai', 'asc')
                ->get();
            
            // Buat struktur kalender - OPTIMIZED
            $calendar = $this->generateCalendarStructure($year, $month, $agendas);
            
            // Nama bulan dalam bahasa Indonesia
            $monthNames = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
        
            return response()->json([
                'success' => true,
                'calendar' => $calendar,
                'agendas' => $agendas->map(function($agenda) {
                    return [
                        'id' => $agenda->id,
                        'judul' => $agenda->judul,
                        'deskripsi' => $agenda->deskripsi,
                        'tanggal_mulai' => $agenda->tanggal_mulai->format('Y-m-d'),
                        'tanggal_selesai' => $agenda->tanggal_selesai->format('Y-m-d'),
                        'tanggal_formatted' => $agenda->getFormattedDateRange(),
                        'waktu' => $agenda->getFormattedTimeRange(),
                        'lokasi' => $agenda->lokasi,
                        'warna' => $agenda->warna ?? '#3b82f6',
                        'status' => $agenda->status,
                        'is_berlangsung' => $agenda->isBerlangsung(),
                        'is_akan_datang' => $agenda->isAkanDatang(),
                    ];
                }),
                'month_name' => $monthNames[$month],
                'year' => $year,
                'month' => $month
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            \Log::error('Calendar API Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Gagal memuat kalender',
                'message' => config('app.debug') ? $e->getMessage() : 'Server error'
            ], 500);
        }
    }
    
    private function generateCalendarStructure($year, $month, $agendas)
    {
        $firstDay = Carbon::createFromDate($year, $month, 1);
        $lastDay = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        $startCalendar = $firstDay->copy()->startOfWeek(Carbon::SUNDAY);
        $endCalendar = $lastDay->copy()->endOfWeek(Carbon::SATURDAY);
        
        $calendar = [];
        $current = $startCalendar->copy();
        
        // Buat array agenda berdasarkan tanggal MULAI saja
        $agendaByDate = [];
        foreach ($agendas as $agenda) {
            // Hanya tandai tanggal mulai kegiatan
            $dateStr = $agenda->tanggal_mulai->format('Y-m-d');
            if (!isset($agendaByDate[$dateStr])) {
                $agendaByDate[$dateStr] = [];
            }
            $agendaByDate[$dateStr][] = $agenda;
        }
        
        while ($current <= $endCalendar) {
            $dateStr = $current->format('Y-m-d');
            $day = $current->day;
            $isCurrentMonth = $current->month == $month;
            $isToday = $current->isToday();
            $hasEvents = isset($agendaByDate[$dateStr]);
            
            $calendar[] = [
                'day' => $day,
                'date' => $dateStr,
                'is_current_month' => $isCurrentMonth,
                'is_today' => $isToday,
                'has_events' => $hasEvents,
                'events' => $hasEvents ? collect($agendaByDate[$dateStr])->map(function($agenda) {
                    return [
                        'id' => $agenda->id,
                        'judul' => $agenda->judul,
                        'deskripsi' => Str::limit($agenda->deskripsi, 100),
                        'warna' => $agenda->warna,
                        'waktu' => $agenda->getFormattedTimeRange(),
                    ];
                })->toArray() : []
            ];
            
            $current->addDay();
        }
        
        return $calendar;
    }
}
