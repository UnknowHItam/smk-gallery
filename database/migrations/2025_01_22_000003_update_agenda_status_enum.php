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
        // First, modify the enum column to include all old and new values
        DB::statement("ALTER TABLE agendas MODIFY COLUMN status ENUM('aktif', 'selesai', 'dibatalkan', 'akan_datang', 'dilaksanakan') DEFAULT 'aktif'");
        
        // Update existing status values
        DB::table('agendas')->where('status', 'aktif')->update(['status' => 'akan_datang']);
        DB::table('agendas')->where('status', 'dibatalkan')->update(['status' => 'dilaksanakan']);
        
        // Finally, modify the enum column to only include new values
        DB::statement("ALTER TABLE agendas MODIFY COLUMN status ENUM('akan_datang', 'dilaksanakan', 'selesai') DEFAULT 'akan_datang'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert enum column
        DB::statement("ALTER TABLE agendas MODIFY COLUMN status ENUM('aktif', 'selesai', 'dibatalkan') DEFAULT 'aktif'");
        
        // Revert status values
        DB::table('agendas')->where('status', 'akan_datang')->update(['status' => 'aktif']);
        DB::table('agendas')->where('status', 'dilaksanakan')->update(['status' => 'dibatalkan']);
    }
};
