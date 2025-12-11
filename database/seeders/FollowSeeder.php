<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Follow;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $follows = [];

        // Setiap user follow 3-8 user lainnya
        for ($followerId = 1; $followerId <= 10; $followerId++) {
            // Pilih user yang akan di-follow (tidak termasuk diri sendiri)
            $usersToFollow = collect(range(1, 10))
                ->filter(fn($id) => $id !== $followerId)
                ->random(rand(3, 8))
                ->map(function ($followingId) use ($followerId) {
                    return [
                        'follower_id' => $followerId,
                        'following_id' => $followingId,
                        'created_at' => now()->subDays(rand(0, 365)),
                        'updated_at' => now()->subDays(rand(0, 365)),
                    ];
                })
                ->toArray();

            $follows = array_merge($follows, $usersToFollow);
        }

        // Hapus duplikat
        $uniqueFollows = collect($follows)->unique(function ($item) {
            return $item['follower_id'] . '-' . $item['following_id'];
        });

        Follow::insert($uniqueFollows->toArray());
    }
}
