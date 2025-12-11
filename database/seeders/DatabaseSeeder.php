<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::firstOrCreate(
        //     ['email' => 'test@example.com'],
        //     [
        //         'name' => 'Test User',
        //         'password' => 'password',
        //         'email_verified_at' => now(),
        //     ]
        // );

        // $this->call([
        //     UserSeeder::class,
        //     CategorySeeder::class,
        //     PostSeeder::class,
        //     LikeSeeder::class,
        //     CommentSeeder::class,
        //     FollowSeeder::class,
        //     NotificationSeeder::class,
        //     MessageSeeder::class,
        //     HistorySeeder::class,
        //     BookmarkSeeder::class,
        // ]);

        // Disable foreign key checks untuk performa
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Truncate tables
        $tables = [
            'users',
            'categories',
            'posts',
            'comments',
            'likes',
            'follows',
            'notifications',
            'messages',
            'histories',
            'bookmarks'
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Urutan seeding penting!
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            LikeSeeder::class,
            CommentSeeder::class,
            FollowSeeder::class,
            HistorySeeder::class,
            BookmarkSeeder::class,
            NotificationSeeder::class,
            MessageSeeder::class,
        ]);
    }
}
