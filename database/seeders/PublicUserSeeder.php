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
        // Only create test public users in development environment
        // In production, users register themselves
        if (app()->environment('production')) {
            $this->command->info('⏭️  Skipping PublicUserSeeder in production');
            $this->command->info('ℹ️  Users will register through the public registration form');
            return;
        }

        // Development: Create test public users for testing
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

        $this->command->info('✅ Public users created successfully!');
        $this->command->info('📝 Test credentials (Development only):');
        $this->command->info('   Email: user@test.com | Password: password123');
        $this->command->info('   Email: john@example.com | Password: password123');
    }
}
