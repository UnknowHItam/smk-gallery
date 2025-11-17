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
        // User::factory(10)->create();

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

        $this->call([
            PublicUserSeeder::class,
            KategoriSeeder::class,
            PostSeeder::class,
            EkstrakurikulerSeeder::class,
        ]);
    }
}
