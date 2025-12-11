<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [];
        $totalUsers = 750;
        $totalPosts = 3000;
        $totalComments = 5000; // Total komentar yang ingin dibuat

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
            'Great post! Really enjoyed reading this.',
            'This is very insightful, thank you for sharing!',
            'I completely agree with your points here.',
            'Interesting perspective, never thought about it this way.',
            'Could you elaborate more on this topic?',
            'Well written and informative article.',
            'This helped me solve a problem I was having.',
            'Thanks for the detailed explanation!',
            'Looking forward to more content like this.',
            'Bookmarking this for future reference.',
            'The examples you provided were really helpful.',
            'Clear and concise explanation, thank you!',
            'I have a different take on this, but great post nonetheless.',
            'This is exactly what I was looking for!',
            'Appreciate the effort you put into this post.',
        ];

        return $comments[array_rand($comments)];
    }

    private function generateReplyContent(): string
    {
        $replies = [
            'Thanks for clarifying!',
            'I see what you mean now.',
            'Good point, I hadn\'t considered that.',
            'Exactly my thoughts!',
            'Couldn\'t agree more.',
            'Adding to what you said...',
            'This reminds me of another post I read.',
            'Have you considered this alternative?',
            'Great addition to the discussion!',
            'Thanks for sharing your experience.',
        ];

        return $replies[array_rand($replies)];
    }
}
