<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bookmark;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookmarks = [];
        $totalUsers = 750;
        $totalPosts = 3000;

        // Setiap user bookmark 10-30 post
        for ($userId = 1; $userId <= $totalUsers; $userId++) {
            // Jumlah bookmark per user: 10-30
            $bookmarkCount = rand(10, 30);

            // Pilih post yang akan di-bookmark (unique per user)
            $bookmarkedPostIds = collect(range(1, $totalPosts))
                ->shuffle()
                ->take($bookmarkCount);

            foreach ($bookmarkedPostIds as $postId) {
                $bookmarks[] = [
                    'user_id' => $userId,
                    'post_id' => $postId,
                    'created_at' => now()->subDays(rand(0, 365)),
                    'updated_at' => now()->subDays(rand(0, 365)),
                ];
            }

            // Insert per 1000 records
            if (count($bookmarks) >= 1000) {
                Bookmark::insert($bookmarks);
                $bookmarks = [];
            }
        }

        // Insert sisa bookmarks
        if (!empty($bookmarks)) {
            Bookmark::insert($bookmarks);
        }

        $this->command->info('Total bookmarks created: ' . Bookmark::count());
    }
}
