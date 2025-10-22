<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cari ID kategori Kegiatan dan Ekstrakurikuler
        $kegiatanId = DB::table('kategori')->where('judul', 'Kegiatan')->value('id');
        $ekstrakurikulerId = DB::table('kategori')->where('judul', 'Ekstrakurikuler')->value('id');
        
        if ($ekstrakurikulerId && $kegiatanId) {
            // Pindahkan semua post dari kategori Ekstrakurikuler ke Kegiatan
            DB::table('posts')
                ->where('kategori_id', $ekstrakurikulerId)
                ->update(['kategori_id' => $kegiatanId]);
            
            // Hapus kategori Ekstrakurikuler
            DB::table('kategori')->where('id', $ekstrakurikulerId)->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Buat kembali kategori Ekstrakurikuler jika rollback
        $ekstrakurikuler = DB::table('kategori')->where('judul', 'Ekstrakurikuler')->first();
        
        if (!$ekstrakurikuler) {
            DB::table('kategori')->insert([
                'judul' => 'Ekstrakurikuler',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
};
