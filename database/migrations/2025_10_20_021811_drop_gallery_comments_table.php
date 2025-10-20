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
        Schema::dropIfExists('gallery_comments');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('gallery_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gallery_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment');
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('gallery_id')->references('id')->on('galery')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('public_users')->onDelete('cascade');
        });
    }
};