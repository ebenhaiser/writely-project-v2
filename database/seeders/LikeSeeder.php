<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Like;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $likes = [];
        $totalUsers = 750;
        $totalPosts = 3000;

        // Setiap user akan like 50-200 post secara acak
        for ($userId = 1; $userId <= $totalUsers; $userId++) {
            // Jumlah like per user: 50-200
            $likeCount = rand(50, 200);

            // Pilih post yang akan dilike (unique per user)
            $likedPostIds = collect(range(1, $totalPosts))
                ->shuffle()
                ->take($likeCount);

            foreach ($likedPostIds as $postId) {
                $likes[] = [
                    'user_id' => $userId,
                    'post_id' => $postId,
                    'created_at' => now()->subDays(rand(0, 365)),
                    'updated_at' => now()->subDays(rand(0, 365)),
                ];
            }

            // Insert per 1000 records untuk menghindari memory issue
            if (count($likes) >= 1000) {
                Like::insert($likes);
                $likes = [];
                $this->command->info('Inserted likes for user ' . $userId);
            }
        }

        // Insert sisa likes
        if (!empty($likes)) {
            Like::insert($likes);
        }

        // Hapus duplikat (jika ada) - meskipun sudah ada unique constraint
        $this->command->info('Total likes created: ' . Like::count());
    }
}
