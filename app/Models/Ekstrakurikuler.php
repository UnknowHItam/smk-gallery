<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
