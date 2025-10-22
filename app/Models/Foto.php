<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Foto extends Model
{
    protected $table = 'foto';
    public $timestamps = false;
    protected $fillable = ['galery_id', 'file', 'judul'];

    public function galery()
    {
        return $this->belongsTo(Galery::class, 'galery_id');
    }

    /**
     * Get the full URL for the photo
     * This ensures consistent path across different devices
     */
    public function getUrlAttribute()
    {
        if (!$this->file) {
            return asset('images/placeholder.jpg');
        }
        
        // Check if file exists in storage
        if (Storage::disk('public')->exists('posts/' . $this->file)) {
            return asset('storage/posts/' . $this->file);
        }
        
        // Fallback to placeholder if file doesn't exist
        return asset('images/placeholder.jpg');
    }

    /**
     * Get the full path for the photo in storage
     */
    public function getPathAttribute()
    {
        return 'posts/' . $this->file;
    }
}
