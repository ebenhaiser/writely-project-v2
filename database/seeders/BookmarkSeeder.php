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

        // Setiap user bookmark 5-15 post
        for ($userId = 1; $userId <= 10; $userId++) {
            $bookmarkedPosts = collect(range(1, 100))
                ->random(rand(5, 15))
                ->map(function ($postId) use ($userId) {
                    return [
                        'user_id' => $userId,
                        'post_id' => $postId,
                        'created_at' => now()->subDays(rand(0, 365)),
                        'updated_at' => now()->subDays(rand(0, 365)),
                    ];
                })
                ->toArray();

            $bookmarks = array_merge($bookmarks, $bookmarkedPosts);
        }

        // Hapus duplikat (meskipun sudah ada unique constraint)
        $uniqueBookmarks = collect($bookmarks)->unique(function ($item) {
            return $item['user_id'] . '-' . $item['post_id'];
        });

        Bookmark::insert($uniqueBookmarks->toArray());
    }
}
