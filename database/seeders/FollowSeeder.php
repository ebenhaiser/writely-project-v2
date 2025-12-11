<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalUsers = 750;
        $follows = [];

        // Setiap user akan follow 30-100 user lainnya
        for ($followerId = 1; $followerId <= $totalUsers; $followerId++) {
            // Tentukan berapa banyak user yang akan di-follow
            $followCount = rand(30, 100);

            // Pilih user yang akan di-follow (tidak termasuk diri sendiri)
            $allUserIds = range(1, $totalUsers);
            unset($allUserIds[$followerId - 1]); // Hapus diri sendiri

            // Acak dan ambil sejumlah followCount
            shuffle($allUserIds);
            $followingIds = array_slice($allUserIds, 0, $followCount);

            foreach ($followingIds as $followingId) {
                $follows[] = [
                    'follower_id' => $followerId,
                    'following_id' => $followingId,
                    'created_at' => now()->subDays(rand(0, 365)),
                    'updated_at' => now()->subDays(rand(0, 365)),
                ];
            }

            // Insert per 2000 records
            if (count($follows) >= 2000) {
                // Gunakan insert ignore untuk menghindari duplicate entry error
                foreach (array_chunk($follows, 500) as $chunk) {
                    DB::table('follows')->insertOrIgnore($chunk);
                }
                $follows = [];
                $this->command->info('Processed follows for user ' . $followerId);
            }
        }

        // Insert sisa follows
        if (!empty($follows)) {
            DB::table('follows')->insertOrIgnore($follows);
        }

        $this->command->info('Total follows created: ' . Follow::count());
    }
}
