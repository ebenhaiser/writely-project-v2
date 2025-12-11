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
        // 1. Buat admin utama
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'bio' => 'Platform Administrator',
            'profile_picture' => 'https://i.pravatar.cc/300?img=1',
            'email_verified_at' => now(),
            'created_at' => now()->subYear(),
        ]);

        // 2. Buat 5 popular users
        $popularUsers = [
            [
                'name' => 'John Developer',
                'username' => 'johndev',
                'email' => 'john@example.com',
                'password' => Hash::make('admin'),
                'bio' => 'Full Stack Developer | Tech Enthusiast',
                'profile_picture' => 'https://i.pravatar.cc/300?img=5',
            ],
            [
                'name' => 'Sarah Designer',
                'username' => 'sarahdesign',
                'email' => 'sarah@example.com',
                'password' => Hash::make('admin'),
                'bio' => 'UI/UX Designer | Creative Director',
                'profile_picture' => 'https://i.pravatar.cc/300?img=8',
            ],
            [
                'name' => 'Mike Writer',
                'username' => 'mikewrites',
                'email' => 'mike@example.com',
                'password' => Hash::make('admin'),
                'bio' => 'Content Writer | Blogger',
                'profile_picture' => 'https://i.pravatar.cc/300?img=12',
            ],
            [
                'name' => 'Lisa Tech',
                'username' => 'lisatech',
                'email' => 'lisa@example.com',
                'password' => Hash::make('admin'),
                'bio' => 'Technology Analyst | AI Researcher',
                'profile_picture' => 'https://i.pravatar.cc/300?img=15',
            ],
            [
                'name' => 'David Business',
                'username' => 'davidbiz',
                'email' => 'david@example.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'profile_picture' => 'https://i.pravatar.cc/300?img=20',
            ],
        ];

        foreach ($popularUsers as $user) {
            $user['email_verified_at'] = now();
            $user['created_at'] = now()->subMonths(rand(6, 18));
            User::create($user);
        }

        // 3. Buat 744 user random menggunakan factory (total 750)
        \App\Models\User::factory()->count(744)->create();
    }
}
