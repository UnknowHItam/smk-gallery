<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ekstrakurikuler extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'pembina',
        'hari_kegiatan',
        'jam_mulai',
        'jam_selesai',
        'tempat',
        'foto',
        'instagram',
        'email',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    public function photos()
    {
        return $this->hasMany(EkstrakurikulerPhoto::class)->orderBy('order');
    }

    /**
     * Get the full URL for the ekstrakurikuler photo
     */
    public function getFotoUrlAttribute()
    {
        if (!$this->foto) {
            return asset('images/placeholder.jpg');
        }
        
        // Check if file exists in storage
        if (Storage::disk('public')->exists('ekstrakurikuler/' . $this->foto)) {
            return asset('storage/ekstrakurikuler/' . $this->foto);
        }
        
        // Fallback to placeholder if file doesn't exist
        return asset('images/placeholder.jpg');
    }
}
