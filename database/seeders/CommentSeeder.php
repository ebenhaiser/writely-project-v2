<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [];
        $totalUsers = User::count();
        $totalPosts = Post::count();

        $commentSeederCount = Setting::value('commentSeederCount') ?? 5000;
        $totalComments = (int) $commentSeederCount; // Total komentar yang ingin dibuat

        // Tahap 1: Buat komentar utama (parent)
        for ($i = 0; $i < $totalComments; $i++) {
            $postId = rand(1, $totalPosts);
            $userId = rand(1, $totalUsers);

            $comments[] = [
                'post_id' => $postId,
                'user_id' => $userId,
                'parent_id' => null,
                'content' => $this->generateCommentContent(),
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now()->subDays(rand(0, 365)),
            ];

            // Insert per 1000 records
            if (count($comments) >= 1000) {
                Comment::insert($comments);
                $comments = [];
            }
        }

        // Insert sisa komentar
        if (!empty($comments)) {
            Comment::insert($comments);
        }

        $this->command->info('Created ' . Comment::count() . ' parent comments');

        // Tahap 2: Buat reply komentar (20% dari total komentar)
        $replyCount = floor($totalComments * 0.2);
        $parentComments = Comment::pluck('id')->toArray();
        $replyComments = [];

        for ($i = 0; $i < $replyCount; $i++) {
            $postId = rand(1, $totalPosts);
            $userId = rand(1, $totalUsers);
            $parentId = $parentComments[array_rand($parentComments)];

            $replyComments[] = [
                'post_id' => $postId,
                'user_id' => $userId,
                'parent_id' => $parentId,
                'content' => $this->generateReplyContent(),
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now()->subDays(rand(0, 365)),
            ];

            // Insert per 1000 records
            if (count($replyComments) >= 1000) {
                Comment::insert($replyComments);
                $replyComments = [];
            }
        }

        // Insert sisa reply
        if (!empty($replyComments)) {
            Comment::insert($replyComments);
        }

        $this->command->info('Total comments created: ' . Comment::count());
    }

    private function generateCommentContent(): string
    {
        $comments = [
            // General appreciation
            'Great post! Really enjoyed reading this.',
            'This is very insightful, thank you for sharing!',
            'Well written and informative article.',
            'Solid write-up, keep it up!',
            'Very helpful content, thanks!',
            'This was a really good read.',
            'Nice article, learned a lot from it.',
            'Clear and easy to follow explanation.',
            'This deserves more attention.',
            'One of the better posts I’ve read on this topic.',

            // Learning & value
            'I learned something new today, thanks!',
            'This helped me understand the topic much better.',
            'This cleared up a lot of confusion for me.',
            'Exactly the explanation I was looking for.',
            'Very useful, especially for beginners.',
            'This answered a lot of my questions.',
            'Helpful and practical, appreciate it.',
            'The step-by-step explanation really helped.',
            'This made the concept much clearer.',
            'Good balance between theory and practice.',

            // Opinion & agreement
            'I completely agree with your points here.',
            'I share the same opinion on this.',
            'Couldn’t agree more with what you said.',
            'That’s exactly how I see it as well.',
            'You explained this really well.',
            'Interesting perspective, never thought about it this way.',
            'This gave me a new way of looking at the problem.',
            'I like the way you approached this topic.',
            'Your reasoning makes a lot of sense.',
            'This aligns with my own experience.',

            // Questions & engagement
            'Could you elaborate more on this topic?',
            'Would love to see a follow-up post on this.',
            'Can you explain this part in more detail?',
            'Do you plan to write more about this?',
            'I’m curious how this works in a real-world scenario.',
            'What would you recommend as the next step?',
            'How would this scale for larger projects?',
            'Any tips for someone just starting out?',
            'Would this approach work in other cases?',
            'Have you tried alternative methods for this?',

            // Style & presentation
            'Really love how you explained this step by step.',
            'The examples you provided were really helpful.',
            'I like how simple and direct this explanation is.',
            'Nice breakdown of the topic.',
            'Short, clear, and straight to the point.',
            'The structure of this post makes it easy to read.',
            'You explained a complex topic in a simple way.',
            'Very easy to follow, even for beginners.',
            'I like how you used real examples here.',
            'This was very well organized.',

            // Encouragement
            'Looking forward to more content like this.',
            'Keep up the great work!',
            'Hope to see more posts from you.',
            'Don’t stop writing content like this.',
            'You clearly know what you’re talking about.',
            'Great effort, really appreciate it.',
            'Thanks for taking the time to write this.',
            'This kind of content is always welcome.',
            'Really appreciate you sharing this.',
            'Can’t wait to read your next post.',

            // Mixed / casual
            'Bookmarking this for future reference.',
            'I wish I had read this earlier!',
            'This came at the perfect time for me.',
            'Saved this, very useful.',
            'Definitely going to revisit this later.',
            'This is exactly what I needed today.',
            'Glad I stumbled upon this post.',
            'This made things click for me.',
            'Simple explanation but very effective.',
            'Thanks, this was really helpful.',
        ];

        return $comments[array_rand($comments)];
    }


    private function generateReplyContent(): string
    {
        $replies = [
            // Agreement & acknowledgment
            'Thanks for clarifying!',
            'I see what you mean now.',
            'Exactly my thoughts!',
            'Couldn’t agree more.',
            'That makes a lot of sense.',
            'Totally agree with you on this.',
            'Yes, that’s a good point.',
            'That’s exactly what I was thinking.',
            'I’m on the same page with you.',
            'Well said!',

            // Appreciation
            'Thanks for sharing your experience.',
            'Appreciate the explanation.',
            'Good insight, thanks for adding this.',
            'Nice explanation, very clear.',
            'Thanks for pointing that out.',
            'This really helps clarify things.',
            'Glad you mentioned this.',
            'That’s helpful, thanks!',
            'Good follow-up!',
            'Thanks for the additional context.',

            // Reflection & understanding
            'I hadn’t thought about it like that before.',
            'Interesting take, thanks for sharing.',
            'That’s a good way to look at it.',
            'This adds a lot to the discussion.',
            'Makes total sense now.',
            'That answers my question, thanks.',
            'This cleared things up for me.',
            'Now I understand it better.',
            'That explanation helped a lot.',
            'This connects nicely with the main post.',

            // Discussion & continuation
            'Adding to what you said...',
            'This reminds me of another post I read.',
            'Have you considered this alternative?',
            'That’s an interesting angle.',
            'Would love to hear more thoughts on this.',
            'Do you think this applies in other cases?',
            'How would this work in a larger project?',
            'I think this could be expanded further.',
            'This opens up a good discussion.',
            'Curious to hear others’ opinions too.',

            // Casual / friendly tone
            'Good point!',
            'Nice catch.',
            'Fair point, I agree.',
            'That’s true.',
            'Well put.',
            'Makes sense 👍',
            'Agreed!',
            'Totally.',
            'Exactly.',
            'Good observation.',

            // Encouraging engagement
            'Glad this was brought up.',
            'This is worth discussing further.',
            'Happy to see this perspective here.',
            'Nice addition to the conversation.',
            'This kind of discussion is always great.',
            'Thanks for contributing to the thread.',
            'This makes the discussion more complete.',
            'Glad to see different viewpoints.',
            'Good discussion overall.',
            'Love seeing thoughtful replies like this.',
        ];

        return $replies[array_rand($replies)];
    }
}
