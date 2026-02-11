<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\History;
use App\Models\Post;
use App\Models\User;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $histories = [];
        $totalUsers = User::count();
        $totalPosts = Post::count();

        for ($userId = 1; $userId <= $totalUsers; $userId++) {
            // Jumlah history per user: 30-100
            $historyCount = rand(30, 100);

            // Pilih post yang telah dilihat (UNIK per user)
            $viewedPostIds = collect(range(1, $totalPosts))
                ->shuffle()
                ->take($historyCount)
                ->unique(); // pastikan unik

            foreach ($viewedPostIds as $postId) {
                $viewedAt = now()->subDays(rand(0, 365));

                $histories[] = [
                    'user_id' => $userId,
                    'post_id' => $postId,
                    'created_at' => $viewedAt,
                    'updated_at' => $viewedAt,
                ];
            }

            // Insert per 1000 records untuk efisiensi
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
