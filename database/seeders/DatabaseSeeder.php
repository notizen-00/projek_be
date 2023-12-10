<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Penjual',
            'email' => 'penjual@gmail.com',
            'role' => 'penjual',
            'password' => Hash::make('penjual123'),

        ]);

        \App\Models\User::factory()->create([
            'name' => 'Buyer',
            'email' => 'pembeli@gmail.com',
            'role' => 'pembeli',
            'password' => Hash::make('pembeli123'),

        ]);
    }
}
