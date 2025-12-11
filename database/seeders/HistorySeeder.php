<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\History;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $histories = [];

        // Setiap user memiliki 10-30 riwayat pembacaan
        for ($userId = 1; $userId <= 10; $userId++) {
            $viewedPosts = collect(range(1, 100))
                ->random(rand(10, 30))
                ->map(function ($postId) use ($userId) {
                    $viewedAt = now()->subDays(rand(0, 365));

                    return [
                        'user_id' => $userId,
                        'post_id' => $postId,
                        'viewed_at' => $viewedAt,
                        'created_at' => $viewedAt,
                        'updated_at' => $viewedAt,
                    ];
                })
                ->toArray();

            $histories = array_merge($histories, $viewedPosts);
        }

        // Hapus duplikat
        $uniqueHistories = collect($histories)->unique(function ($item) {
            return $item['user_id'] . '-' . $item['post_id'];
        });

        History::insert($uniqueHistories->toArray());
    }
}
