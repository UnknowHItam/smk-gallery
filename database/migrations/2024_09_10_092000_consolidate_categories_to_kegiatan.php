<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Kategori;
use App\Models\Posts;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, ensure we have the Kegiatan category
        $kegiatanCategory = Kategori::firstOrCreate(['judul' => 'Kegiatan']);
        
        // Find categories to be removed
        $beritaCategory = Kategori::where('judul', 'Berita')->first();
        $prestasiCategory = Kategori::where('judul', 'Prestasi')->first();
        
        // Update all posts from Berita and Prestasi to Kegiatan
        if ($beritaCategory) {
            Posts::where('kategori_id', $beritaCategory->id)
                 ->update(['kategori_id' => $kegiatanCategory->id]);
            
            // Delete the Berita category
            $beritaCategory->delete();
        }
        
        if ($prestasiCategory) {
            Posts::where('kategori_id', $prestasiCategory->id)
                 ->update(['kategori_id' => $kegiatanCategory->id]);
            
            // Delete the Prestasi category
            $prestasiCategory->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate the removed categories
        Kategori::firstOrCreate(['judul' => 'Berita']);
        Kategori::firstOrCreate(['judul' => 'Prestasi']);
    }
};
