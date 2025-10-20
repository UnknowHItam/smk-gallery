<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galery';
    public $timestamps = false;
    protected $fillable = ['post_id', 'position', 'status'];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }

    public function foto()
    {
        return $this->hasMany(Foto::class, 'galery_id');
    }

    public function likes()
    {
        return $this->hasMany(GalleryLike::class, 'gallery_id');
    }

    public function shares()
    {
        return $this->hasMany(GalleryShare::class, 'gallery_id');
    }

    public function downloads()
    {
        return $this->hasMany(GalleryDownload::class, 'gallery_id');
    }
}
