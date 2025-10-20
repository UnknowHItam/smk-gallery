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
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Drop tables if they exist
        Schema::dropIfExists('foto');
        Schema::dropIfExists('galery');
        
        // Create galery table
        Schema::create('galery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->integer('position')->default(1);
            $table->tinyInteger('status')->default(1);
            
            $table->index('post_id');
        });
        
        // Create foto table
        Schema::create('foto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('galery_id');
            $table->string('file');
            $table->string('judul')->nullable();
            
            $table->index('galery_id');
        });
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('foto');
        Schema::dropIfExists('galery');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
