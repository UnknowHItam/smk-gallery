<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    public $timestamps = false;
    protected $fillable = ['judul', 'isi', 'created_at'];
}
