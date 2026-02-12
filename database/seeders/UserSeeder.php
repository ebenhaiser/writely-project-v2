<?php

namespace Database\Seeders;

use App\Models\Setting;
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
            'name' => 'Horang Kaya',
            'username' => 'horang.kaya',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'bio' => 'Platform Administrator',
            'isAdmin' => true,
            'email_verified_at' => now(),
            'created_at' => now()->subYear(),
        ]);

        // 2. Buat popular users
        $popularUsers = [
            [ // 1
                'name' => 'Bang Ganteng',
                'username' => 'bang.ganteng',
                'email' => 'bang.ganteng@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Full Stack Developer | Tech Enthusiast',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 2
                'name' => 'Jago Kelahi',
                'username' => 'jago.kelahi',
                'email' => 'jago.kelahi@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'UI/UX Designer | Creative Director',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 3
                'name' => 'Bang Jordi',
                'username' => 'bang.jordi',
                'email' => 'bang.jordi@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Content Writer | Blogger',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 4
                'name' => 'Cewek Rusia',
                'username' => 'cewek.rusia',
                'email' => 'cewek.rusia@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Technology Analyst | AI Researcher',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 5
                'name' => 'Gus Syams',
                'username' => 'gus.syams',
                'email' => 'gus.syams@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 6
                'name' => 'Gus Syams',
                'username' => 'gus.syams',
                'email' => 'gus.syams@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 7
                'name' => 'Immortal',
                'username' => 'immortal',
                'email' => 'immortal@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 8
                'name' => 'Jago Pantun',
                'username' => 'jago.pantun',
                'email' => 'jago.pantun@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 9
                'name' => 'Jago Silat',
                'username' => 'jago.silat',
                'email' => 'jago.silat@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 10
                'name' => 'Joni Dosa',
                'username' => 'joni.dosa',
                'email' => 'joni.dosa@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 11
                'name' => 'Kakek Sugiono',
                'username' => 'kakek.sugiono',
                'email' => 'kakek.sugiono@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 12
                'name' => 'Mbak Jago Ekting',
                'username' => 'mbak.jago.ekting',
                'email' => 'mbak.jago.ekting@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 13
                'name' => 'Mbak Lebanon',
                'username' => 'mbak.lebanon',
                'email' => 'mbak.lebanon@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 14
                'name' => 'Pelawak Jenius',
                'username' => 'pelawak.jenius',
                'email' => 'pelawak.jenius@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 15
                'name' => 'Puncak Rantai Makanan',
                'username' => 'puncak.rantai.makanan',
                'email' => 'puncak.rantai.makanan@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 16
                'name' => 'Raja Mukbang',
                'username' => 'raja.mukbang',
                'email' => 'raja.mukbang@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],
            [ // 17
                'name' => 'Si Paling Ngulang',
                'username' => 'si.paling.ngulang',
                'email' => 'si.paling.ngulang@gmail.com',
                'password' => Hash::make('admin'),
                'bio' => 'Entrepreneur | Business Consultant',
                'isAdmin' => true,
                'email_verified_at' => now(),
                'created_at' => now()->subYear(),
            ],

        ];

        foreach ($popularUsers as $user) {
            $user['email_verified_at'] = now();
            $user['created_at'] = now()->subMonths(rand(6, 18));
            User::create($user);
        }

        // 3. Buat user random menggunakan factory
        $userFactoryCount = Setting::value('userSeederCount') ?? 300;
        $totalUser = (int) $userFactoryCount;
        User::factory()->count($totalUser)->create();
    }
}
