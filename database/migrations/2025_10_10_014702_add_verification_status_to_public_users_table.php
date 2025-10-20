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
        Schema::table('public_users', function (Blueprint $table) {
            $table->enum('verification_status', ['PENDING_VERIFICATION', 'VERIFIED'])
                ->default('PENDING_VERIFICATION')
                ->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public_users', function (Blueprint $table) {
            $table->dropColumn('verification_status');
        });
    }
};
