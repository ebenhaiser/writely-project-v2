<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $types = ['like', 'comment', 'follow'];

        // Generate 50-100 notifikasi
        for ($i = 0; $i < rand(50, 100); $i++) {
            $userId = rand(1, 10);
            $sourceUserId = rand(1, 10);
            $postId = rand(1, 100);
            $type = $types[array_rand($types)];

            // Pastikan source user bukan user itu sendiri
            while ($sourceUserId === $userId) {
                $sourceUserId = rand(1, 10);
            }

            $notifications[] = [
                'user_id' => $userId,
                'type' => $type,
                'source_users_id' => $sourceUserId,
                'post_id' => $postId,
                'created_at' => now()->subDays(rand(0, 30)), // Notifikasi dalam 30 hari terakhir
                'updated_at' => now()->subDays(rand(0, 30)),
            ];
        }

        Notification::insert($notifications);
    }
}
