<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryShare extends Model
{
    protected $fillable = [
        'gallery_id',
        'user_id',
        'platform',
        'ip_address',
    ];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Galery::class, 'gallery_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(PublicUser::class, 'user_id');
    }
}
