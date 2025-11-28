<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        User::truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create additional users dengan email yang unik
        User::factory(8)->create();

        // Call other seeders
        $this->call([
            RwSeeder::class,
            // Tambahkan seeders lainnya di sini
            // WargaSeeder::class,
            // RtSeeder::class,
        ]);
    }
}