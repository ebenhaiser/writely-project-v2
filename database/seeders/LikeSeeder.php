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

        // Setiap user akan like beberapa post secara acak
        for ($userId = 1; $userId <= 10; $userId++) {
            // Setiap user like 10-30 post secara acak
            $likedPosts = collect(range(1, 100))
                ->random(rand(10, 30))
                ->map(function ($postId) use ($userId) {
                    return [
                        'user_id' => $userId,
                        'post_id' => $postId,
                        'created_at' => now()->subDays(rand(0, 365)),
                        'updated_at' => now()->subDays(rand(0, 365)),
                    ];
                })
                ->toArray();

            $likes = array_merge($likes, $likedPosts);
        }

        // Hapus duplikat (jika ada)
        $uniqueLikes = collect($likes)->unique(function ($item) {
            return $item['user_id'] . '-' . $item['post_id'];
        });

        Like::insert($uniqueLikes->toArray());
    }
}
