<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User pertama dengan email admin@admin.com
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'bio' => 'Administrator of the platform', // Pastikan kurang dari 100 karakter
            'profile_picture' => 'https://i.pravatar.cc/300?img=1',
            'email_verified_at' => now(),
        ]);

        // Buat 9 user tambahan menggunakan factory
        User::factory()->count(9)->create();
    }
}
