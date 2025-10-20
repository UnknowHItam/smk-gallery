<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Posts extends Model
{
    protected $table = 'posts';
    public $timestamps = false;
    protected $fillable = ['judul', 'isi', 'status', 'kategori_id', 'petugas_id', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }

    public function galery()
    {
        return $this->hasMany(Galery::class, 'post_id');
    }
}
