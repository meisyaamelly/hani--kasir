<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan model User diimport
use Illuminate\Support\Facades\Hash; // Import Hash untuk password hashing

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'address' => 'babatan',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Employee',
            'email' => 'employee@gmail.com',
            'address' => 'babatan',
            'password' => Hash::make('employee'),
            'role' => 'employee',
        ]);
    }
}
