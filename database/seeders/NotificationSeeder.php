<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [];
        $totalUsers = 750;
        $totalPosts = 3000;
        $notificationCount = 2000; // Total notifikasi

        $types = ['like', 'comment', 'follow'];

        for ($i = 0; $i < $notificationCount; $i++) {
            $userId = rand(1, $totalUsers);
            $sourceUserId = rand(1, $totalUsers);
            $postId = rand(1, $totalPosts);
            $type = $types[array_rand($types)];

            // Pastikan source user bukan user itu sendiri
            while ($sourceUserId === $userId) {
                $sourceUserId = rand(1, $totalUsers);
            }

            $notifications[] = [
                'user_id' => $userId,
                'type' => $type,
                'source_user_id' => $sourceUserId,
                'post_id' => $type === 'follow' ? null : $postId,
                'is_read' => rand(0, 1) == 1, // 50% chance true
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ];

            // Insert per 500 records
            if (count($notifications) >= 500) {
                Notification::insert($notifications);
                $notifications = [];
            }
        }

        // Insert sisa notifications
        if (!empty($notifications)) {
            Notification::insert($notifications);
        }

        $this->command->info('Total notifications created: ' . Notification::count());
    }
}
