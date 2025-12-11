<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [];
        $totalUsers = 750;
        $messageCount = 1000;

        for ($i = 0; $i < $messageCount; $i++) {
            $fromUserId = rand(1, $totalUsers);
            $toUserId = rand(1, $totalUsers);

            // Pastikan pengirim dan penerima berbeda
            while ($toUserId === $fromUserId) {
                $toUserId = rand(1, $totalUsers);
            }

            $isRead = rand(0, 1) == 1; // 50% chance read
            $createdAt = now()->subDays(rand(0, 90));

            // Jika sudah dibaca, set read_at beberapa jam setelah created_at
            $readAt = $isRead
                ? $createdAt->copy()->addHours(rand(1, 24))
                : null;

            $messages[] = [
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId,
                'message' => $this->generateMessage(),
                'is_read' => $isRead,
                'read_at' => $readAt,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];

            // Insert per 200 records
            if (count($messages) >= 200) {
                Message::insert($messages);
                $messages = [];
            }
        }

        // Insert sisa messages
        if (!empty($messages)) {
            Message::insert($messages);
        }

        $this->command->info('Total messages created: ' . Message::count());
    }

    private function generateMessage(): string
    {
        $messages = [
            'Hey, how are you doing?',
            'Thanks for your post, it was really helpful!',
            'Do you want to collaborate on something?',
            'I saw your recent post, great work!',
            'Can we schedule a meeting sometime?',
            'Check out this article I found interesting.',
            'How have you been lately?',
            'Are you attending the event next week?',
            'I have a question about your last post.',
            'Let\'s catch up sometime!',
            'What do you think about this topic?',
            'Could you help me with something?',
            'Just wanted to say hi!',
            'Your work is really inspiring.',
            'Do you have any recommendations for learning resources?',
        ];

        return $messages[array_rand($messages)];
    }
}
