<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkstrakurikulerPhoto extends Model
{
    protected $fillable = [
        'ekstrakurikuler_id',
        'filename',
        'original_name',
        'order'
    ];

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class);
    }
}
