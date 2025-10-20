<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    public $timestamps = false;
    protected $fillable = ['galery_id', 'file', 'judul'];

    public function galery()
    {
        return $this->belongsTo(Galery::class, 'galery_id');
    }
}
