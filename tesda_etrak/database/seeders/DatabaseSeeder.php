<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'ROD-NCR',
            'email' => 'superadmin@email.com',
            'password' => 'superadmin',
            'role' => 'superadmin',
        ]);

        User::factory()->create([
            'name' => 'ROD-NCR',
            'email' => 'admin@email.com',
            'password' => 'admin',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'ROD-NCR',
            'email' => 'user@email.com',
            'password' => 'user',
        ]);
    }
}
