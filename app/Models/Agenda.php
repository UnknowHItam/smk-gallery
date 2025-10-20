<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'status',
        'warna',
        'user_id',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Relasi dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk agenda yang aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk agenda yang belum kadaluwarsa
     */
    public function scopeBelumKadaluwarsa($query)
    {
        return $query->where('tanggal_selesai', '>=', Carbon::today());
    }

    /**
     * Scope untuk agenda yang sudah kadaluwarsa
     */
    public function scopeKadaluwarsa($query)
    {
        return $query->where('tanggal_selesai', '<', Carbon::today());
    }

    /**
     * Scope untuk agenda bulan tertentu
     */
    public function scopeBulanIni($query, $year = null, $month = null)
    {
        $year = $year ?? Carbon::now()->year;
        $month = $month ?? Carbon::now()->month;
        
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        
        return $query->where(function($q) use ($startDate, $endDate) {
            $q->whereBetween('tanggal_mulai', [$startDate, $endDate])
              ->orWhereBetween('tanggal_selesai', [$startDate, $endDate])
              ->orWhere(function($q2) use ($startDate, $endDate) {
                  $q2->where('tanggal_mulai', '<=', $startDate)
                     ->where('tanggal_selesai', '>=', $endDate);
              });
        });
    }

    /**
     * Cek apakah agenda sudah kadaluwarsa
     */
    public function isKadaluwarsa()
    {
        return $this->tanggal_selesai < Carbon::today();
    }

    /**
     * Cek apakah agenda sedang berlangsung
     */
    public function isBerlangsung()
    {
        $today = Carbon::today();
        return $this->tanggal_mulai <= $today && $this->tanggal_selesai >= $today;
    }

    /**
     * Cek apakah agenda akan datang
     */
    public function isAkanDatang()
    {
        return $this->tanggal_mulai > Carbon::today();
    }

    /**
     * Get formatted date range
     */
    public function getFormattedDateRange()
    {
        $mulai = $this->tanggal_mulai->format('d M Y');
        $selesai = $this->tanggal_selesai->format('d M Y');
        
        if ($this->tanggal_mulai->isSameDay($this->tanggal_selesai)) {
            return $mulai;
        }
        
        return $mulai . ' - ' . $selesai;
    }

    /**
     * Get formatted time range
     */
    public function getFormattedTimeRange()
    {
        if (!$this->waktu_mulai && !$this->waktu_selesai) {
            return null;
        }
        
        $mulai = $this->waktu_mulai ? Carbon::parse($this->waktu_mulai)->format('H:i') : '';
        $selesai = $this->waktu_selesai ? Carbon::parse($this->waktu_selesai)->format('H:i') : '';
        
        if ($mulai && $selesai) {
            return $mulai . ' - ' . $selesai;
        }
        
        return $mulai ?: $selesai;
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColor()
    {
        return match($this->status) {
            'aktif' => 'bg-green-100 text-green-800',
            'selesai' => 'bg-gray-100 text-gray-800',
            'dibatalkan' => 'bg-red-100 text-red-800',
            default => 'bg-blue-100 text-blue-800',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        return match($this->status) {
            'aktif' => 'Aktif',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => 'Unknown',
        };
    }
}
