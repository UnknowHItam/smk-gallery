<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    public $timestamps = false;
    protected $fillable = ['judul', 'nama'];

    public function posts()
    {
        return $this->hasMany(Posts::class, 'kategori_id');
    }
}
