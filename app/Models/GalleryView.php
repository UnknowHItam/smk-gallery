<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryView extends Model
{
    protected $table = 'gallery_views';
    public $timestamps = false;
    protected $fillable = ['gallery_id', 'user_id', 'ip_address', 'user_agent', 'viewed_at'];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function gallery()
    {
        return $this->belongsTo(Galery::class, 'gallery_id');
    }
}
