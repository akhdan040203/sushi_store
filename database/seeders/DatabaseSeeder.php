<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin Sushi',
            'email' => 'admin@sushi.com',
            'role' => 'admin',
        ]);

        // Create Customer User
        User::factory()->create([
            'name' => 'Customer Test',
            'email' => 'customer@sushi.com',
            'role' => 'customer',
        ]);

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
