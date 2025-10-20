<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryLike extends Model
{
    protected $fillable = [
        'gallery_id',
        'user_id',
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
