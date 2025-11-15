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
        // Skip if kategori table doesn't exist yet
        if (!Schema::hasTable('kategori')) {
            return;
        }

        // Ambil ID kategori yang akan dipertahankan (yang pertama kali muncul)
        $kegiatanId = DB::table('kategori')->where('judul', 'Kegiatan')->orderBy('id')->value('id');
        $kejuaraanId = DB::table('kategori')->where('judul', 'Kejuaraan')->orderBy('id')->value('id');
        
        // Pindahkan semua post dari kategori Ekstrakurikuler ke Kegiatan
        if ($kegiatanId) {
            DB::table('posts')
                ->where('kategori_id', '!=', $kegiatanId)
                ->whereIn('kategori_id', function($query) {
                    $query->select('id')
                          ->from('kategori')
                          ->where('judul', 'Ekstrakurikuler');
                })
                ->update(['kategori_id' => $kegiatanId]);
        }
        
        // Pindahkan semua post dari kategori Agenda ke Kegiatan
        if ($kegiatanId) {
            DB::table('posts')
                ->where('kategori_id', '!=', $kegiatanId)
                ->whereIn('kategori_id', function($query) {
                    $query->select('id')
                          ->from('kategori')
                          ->where('judul', 'Agenda');
                })
                ->update(['kategori_id' => $kegiatanId]);
        }
        
        // Pindahkan semua post dari kategori Kegiatan duplikat ke Kegiatan utama
        if ($kegiatanId) {
            DB::table('posts')
                ->where('kategori_id', '!=', $kegiatanId)
                ->whereIn('kategori_id', function($query) use ($kegiatanId) {
                    $query->select('id')
                          ->from('kategori')
                          ->where('judul', 'Kegiatan')
                          ->where('id', '!=', $kegiatanId);
                })
                ->update(['kategori_id' => $kegiatanId]);
        }
        
        // Pindahkan semua post dari kategori Kejuaraan duplikat ke Kejuaraan utama
        if ($kejuaraanId) {
            DB::table('posts')
                ->where('kategori_id', '!=', $kejuaraanId)
                ->whereIn('kategori_id', function($query) use ($kejuaraanId) {
                    $query->select('id')
                          ->from('kategori')
                          ->where('judul', 'Kejuaraan')
                          ->where('id', '!=', $kejuaraanId);
                })
                ->update(['kategori_id' => $kejuaraanId]);
        }
        
        // Hapus semua kategori kecuali Kegiatan dan Kejuaraan yang pertama
        DB::table('kategori')
            ->whereNotIn('id', [$kegiatanId, $kejuaraanId])
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu rollback karena ini adalah cleanup
    }
};
