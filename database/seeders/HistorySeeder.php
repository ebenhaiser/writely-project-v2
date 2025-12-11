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
        $totalUsers = 750;
        $totalPosts = 3000;

        // Setiap user memiliki 30-100 riwayat pembacaan
        for ($userId = 1; $userId <= $totalUsers; $userId++) {
            // Jumlah history per user: 30-100
            $historyCount = rand(30, 100);

            // Pilih post yang telah dilihat (unique per user)
            $viewedPostIds = collect(range(1, $totalPosts))
                ->shuffle()
                ->take($historyCount);

            foreach ($viewedPostIds as $postId) {
                $viewedAt = now()->subDays(rand(0, 365));

                $histories[] = [
                    'user_id' => $userId,
                    'post_id' => $postId,
                    'viewed_at' => $viewedAt,
                    'created_at' => $viewedAt,
                    'updated_at' => $viewedAt,
                ];
            }

            // Insert per 1000 records
            if (count($histories) >= 1000) {
                History::insert($histories);
                $histories = [];
            }
        }

        // Insert sisa histories
        if (!empty($histories)) {
            History::insert($histories);
        }

        $this->command->info('Total histories created: ' . History::count());
    }
}
