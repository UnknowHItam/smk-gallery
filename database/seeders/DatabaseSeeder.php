<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only seed test users in development, not in production
        if (app()->environment('production')) {
            // In production, only seed categories and posts
            $this->command->info('Production environment detected - skipping user seeding');
        } else {
            // Development: Create test users
            // Default regular user
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

            // Admin user
            User::factory()->create([
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'is_admin' => true,
            ]);

            $this->command->info('Development users created');
        }

        $this->call([
            PublicUserSeeder::class,
            KategoriSeeder::class,
            PostSeeder::class,
            EkstrakurikulerSeeder::class,
        ]);
    }
}
