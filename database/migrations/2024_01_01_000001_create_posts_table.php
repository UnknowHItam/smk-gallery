<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->longText('isi');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('created_at')->nullable();
            // Note: timestamps are NOT used for this table as it only has created_at (see Model: public $timestamps = false;)
            
            // Indexes
            $table->index('kategori_id');
            $table->index('petugas_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
