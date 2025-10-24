<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ImageOptimizationService
{
    protected $manager;
    protected $maxWidth = 1920;
    protected $maxHeight = 1080;
    protected $quality = 85;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Optimize and save image
     */
    public function optimizeAndSave($file, $path, $filename)
    {
        // Read image
        $image = $this->manager->read($file->getRealPath());
        
        // Get original dimensions
        $width = $image->width();
        $height = $image->height();
        
        // Resize if larger than max dimensions while maintaining aspect ratio
        if ($width > $this->maxWidth || $height > $this->maxHeight) {
            $image->scale(width: $this->maxWidth, height: $this->maxHeight);
        }
        
        // Encode with compression
        $encoded = $image->toJpeg(quality: $this->quality);
        
        // Save to storage
        $fullPath = $path . '/' . $filename;
        Storage::disk('public')->put($fullPath, $encoded);
        
        return $filename;
    }

    /**
     * Create thumbnail
     */
    public function createThumbnail($file, $path, $filename, $size = 300)
    {
        $image = $this->manager->read($file->getRealPath());
        
        // Resize to thumbnail size
        $image->cover($size, $size);
        
        // Encode with compression
        $encoded = $image->toJpeg(quality: 80);
        
        // Save thumbnail
        $thumbFilename = 'thumb_' . $filename;
        $fullPath = $path . '/' . $thumbFilename;
        Storage::disk('public')->put($fullPath, $encoded);
        
        return $thumbFilename;
    }

    /**
     * Set custom quality
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * Set max dimensions
     */
    public function setMaxDimensions($width, $height)
    {
        $this->maxWidth = $width;
        $this->maxHeight = $height;
        return $this;
    }
}
