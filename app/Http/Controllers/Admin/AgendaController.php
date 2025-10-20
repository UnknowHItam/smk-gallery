<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Agenda::with('user')->orderBy('tanggal_mulai', 'desc');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kadaluwarsa
        if ($request->has('filter')) {
            if ($request->filter == 'aktif') {
                $query->belumKadaluwarsa()->where('status', 'aktif');
            } elseif ($request->filter == 'kadaluwarsa') {
                $query->kadaluwarsa();
            } elseif ($request->filter == 'bulan_ini') {
                $query->bulanIni();
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $agendas = $query->paginate(15);

        // Statistik
        $stats = [
            'total' => Agenda::count(),
            'aktif' => Agenda::aktif()->belumKadaluwarsa()->count(),
            'kadaluwarsa' => Agenda::kadaluwarsa()->count(),
            'bulan_ini' => Agenda::bulanIni()->count(),
        ];

        return view('admin.agenda.index', compact('agendas', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,selesai,dibatalkan',
            'warna' => 'nullable|string|max:7',
        ], [
            'judul.required' => 'Judul agenda harus diisi',
            'deskripsi.required' => 'Deskripsi agenda harus diisi',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai',
            'status.required' => 'Status harus dipilih',
        ]);
        
        // Validasi waktu selesai jika kedua waktu diisi
        if ($request->filled('waktu_mulai') && $request->filled('waktu_selesai')) {
            if ($request->waktu_selesai <= $request->waktu_mulai) {
                return back()->withErrors(['waktu_selesai' => 'Waktu selesai harus setelah waktu mulai'])->withInput();
            }
        }

        $validated['user_id'] = Auth::id();
        $validated['warna'] = $validated['warna'] ?? '#3b82f6';

        Agenda::create($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        $agenda->load('user');
        return view('admin.agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,selesai,dibatalkan',
            'warna' => 'nullable|string|max:7',
        ], [
            'judul.required' => 'Judul agenda harus diisi',
            'deskripsi.required' => 'Deskripsi agenda harus diisi',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai',
            'status.required' => 'Status harus dipilih',
        ]);
        
        // Validasi waktu selesai jika kedua waktu diisi
        if ($request->filled('waktu_mulai') && $request->filled('waktu_selesai')) {
            if ($request->waktu_selesai <= $request->waktu_mulai) {
                return back()->withErrors(['waktu_selesai' => 'Waktu selesai harus setelah waktu mulai'])->withInput();
            }
        }

        $validated['warna'] = $validated['warna'] ?? '#3b82f6';

        $agenda->update($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus!');
    }

    /**
     * Update status agenda secara cepat
     */
    public function updateStatus(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'status' => 'required|in:aktif,selesai,dibatalkan',
        ]);

        $agenda->update(['status' => $validated['status']]);

        return back()->with('success', 'Status agenda berhasil diperbarui!');
    }

    /**
     * Get agenda untuk API (untuk kalender di home)
     */
    public function getAgendaByMonth(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('n'));

        $agendas = Agenda::aktif()
            ->belumKadaluwarsa()
            ->bulanIni($year, $month)
            ->orderBy('tanggal_mulai', 'asc')
            ->get();

        // Generate calendar data
        $calendar = $this->generateCalendarData($year, $month, $agendas);
        
        // Month names in Indonesian
        $monthNames = [
            '', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        return response()->json([
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
                    'warna' => $agenda->warna,
                    'status' => $agenda->status,
                    'is_berlangsung' => $agenda->isBerlangsung(),
                    'is_akan_datang' => $agenda->isAkanDatang(),
                ];
            }),
            'month_name' => $monthNames[$month],
            'year' => $year,
            'month' => $month,
        ]);
    }
    
    /**
     * Generate calendar data for a specific month
     */
    private function generateCalendarData($year, $month, $agendas)
    {
        $calendar = [];
        
        // Get first day of month and last day of month
        $firstDay = Carbon::createFromDate($year, $month, 1);
        $lastDay = $firstDay->copy()->endOfMonth();
        
        // Start from the Sunday before the first day of the month
        $startDate = $firstDay->copy()->startOfWeek(Carbon::SUNDAY);
        
        // End at the Saturday after the last day of the month
        $endDate = $lastDay->copy()->endOfWeek(Carbon::SATURDAY);
        
        // Loop through all days
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dateStr = $currentDate->format('Y-m-d');
            
            // Check if this date has any agendas
            $dayAgendas = $agendas->filter(function($agenda) use ($currentDate) {
                return $currentDate->between($agenda->tanggal_mulai, $agenda->tanggal_selesai);
            });
            
            $calendar[] = [
                'date' => $dateStr,
                'day' => $currentDate->day,
                'is_current_month' => $currentDate->month == $month,
                'is_today' => $currentDate->isToday(),
                'has_events' => $dayAgendas->count() > 0,
                'events' => $dayAgendas->map(function($agenda) {
                    return [
                        'id' => $agenda->id,
                        'judul' => $agenda->judul,
                        'warna' => $agenda->warna,
                    ];
                })->values()->toArray(),
            ];
            
            $currentDate->addDay();
        }
        
        return $calendar;
    }
}
