<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Setting;
use App\Models\User;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [];
        $totalUsers = User::count();

        $messageSeederCount = Setting::value('messageSeederCount') ?? 4000;
        $messageCount = (int) $messageSeederCount;

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
            // Casual / Small talk
            'Hey, how are you doing?',
            'Hi! Hope your day is going well.',
            'Just checking in, how have you been?',
            'Hey there! Long time no chat.',
            'Hope everything is going great on your side.',
            'Just wanted to say hi!',
            'What have you been up to lately?',
            'How’s your week going so far?',

            // Feedback / Appreciation
            'Thanks for your post, it was really helpful!',
            'I really enjoyed reading your latest post.',
            'Great work on your recent article!',
            'Your content is always insightful.',
            'That post gave me a new perspective, thank you!',
            'I learned a lot from what you shared.',
            'Really appreciate the effort you put into your content.',
            'Your writing style is very easy to follow.',

            // Discussion / Opinion
            'What do you think about this topic?',
            'I have a different perspective on this, curious what you think.',
            'Do you think this approach would work in other cases?',
            'I’ve been thinking about what you said in your post.',
            'That topic is really interesting to discuss further.',
            'I agree with most of your points, especially the last one.',
            'Have you considered another angle on this issue?',

            // Question / Help
            'I have a question about your last post.',
            'Could you help me understand this part better?',
            'Do you have any recommendations for learning resources?',
            'I’m a bit confused about one section, mind explaining?',
            'Can you share how you approached this problem?',
            'Do you have any tips for beginners on this topic?',
            'What tools do you usually use for this kind of work?',

            // Collaboration / Professional
            'Do you want to collaborate on something?',
            'Would you be interested in working on a project together?',
            'I think our interests align pretty well.',
            'Maybe we can collaborate in the future.',
            'I’d love to hear your thoughts on a potential collaboration.',
            'Are you open to discussing a joint project?',
            'Let’s connect and explore some ideas together.',

            // Follow-up / Engagement
            'Just following up on my previous message.',
            'Let me know what you think when you have time.',
            'Looking forward to your thoughts on this.',
            'Feel free to reply whenever you’re free.',
            'No rush, just wanted to check back.',
            'Did you get a chance to look at it?',
            'Would love to hear your feedback.',

            // Meeting / Planning
            'Can we schedule a meeting sometime?',
            'Would you be available for a quick call?',
            'Maybe we can discuss this over a short meeting.',
            'Let’s catch up sometime!',
            'Are you free sometime this week?',
            'Would next week work for you?',
            'Let me know a time that works best.',

            // Sharing / Recommendation
            'Check out this article I found interesting.',
            'I came across something you might like.',
            'Thought you might find this useful.',
            'Here’s something related to what we discussed.',
            'I recently read something that reminded me of your post.',
            'This resource might help with your current project.',
            'I think this aligns well with your interests.',

            // Encouragement / Positive tone
            'Keep up the great work!',
            'You’re doing an awesome job.',
            'Really inspiring stuff, honestly.',
            'Don’t stop sharing content like this.',
            'Looking forward to more posts from you.',
            'You’re definitely on the right track.',
            'Your consistency really shows.',
        ];
        return $messages[array_rand($messages)];
    }
}
