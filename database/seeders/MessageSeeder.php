<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        // Generate 50-100 pesan antara user yang saling follow
        for ($i = 0; $i < rand(50, 100); $i++) {
            $fromUserId = rand(1, 10);
            $toUserId = rand(1, 10);

            // Pastikan pengirim dan penerima berbeda
            while ($toUserId === $fromUserId) {
                $toUserId = rand(1, 10);
            }

            $messages[] = [
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId,
                'message' => $this->generateMessage(),
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now()->subDays(rand(0, 365)),
            ];
        }

        Message::insert($messages);
    }

    private function generateMessage(): string
    {
        $messages = [
            'Hey, how are you doing?',
            'Thanks for your post, it was really helpful!',
            'Do you want to collaborate on something?',
            'I saw your recent post, great work!',
            'Can we schedule a meeting?',
            'Check out this article I found interesting.',
            'How have you been lately?',
            'Are you attending the event next week?',
            'I have a question about your last post.',
            'Let\'s catch up sometime!',
        ];

        return $messages[array_rand($messages)];
    }
}
