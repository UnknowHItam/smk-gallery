<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PublicUser;
use Illuminate\Support\Facades\Hash;

class PublicUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test public user - VERIFIED so they can login
        PublicUser::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => Hash::make('password123'),
            'verification_status' => 'VERIFIED',
            'email_verified_at' => now(),
        ]);

        PublicUser::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'verification_status' => 'VERIFIED',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Public users created successfully!');
        $this->command->info('Test credentials:');
        $this->command->info('Email: user@test.com | Password: password123');
        $this->command->info('Email: john@example.com | Password: password123');
    }
}
