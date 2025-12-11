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
        // Simpan semua ID komentar yang akan dibuat
        $commentIds = [];
        $totalComments = rand(200, 300);

        // Tahap 1: Buat semua komentar TANPA parent_id terlebih dahulu
        $commentsWithoutParent = [];

        for ($i = 0; $i < $totalComments; $i++) {
            $postId = rand(1, 100);
            $userId = rand(1, 10);

            $commentsWithoutParent[] = [
                'post_id' => $postId,
                'user_id' => $userId,
                'parent_id' => null, // Semua tanpa parent dulu
                'content' => $this->generateCommentContent(),
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now()->subDays(rand(0, 365)),
            ];
        }

        // Insert komentar tanpa parent
        Comment::insert($commentsWithoutParent);

        // Dapatkan ID komentar yang baru saja dibuat
        $commentIds = Comment::pluck('id')->toArray();

        // Tahap 2: Update beberapa komentar menjadi reply (dengan parent_id)
        $commentsToUpdate = Comment::inRandomOrder()->limit(rand(50, 100))->get();

        foreach ($commentsToUpdate as $comment) {
            // Pastikan parent_id tidak sama dengan comment_id itu sendiri
            $potentialParents = array_diff($commentIds, [$comment->id]);

            if (!empty($potentialParents)) {
                $parentId = array_rand(array_flip($potentialParents));

                $comment->update([
                    'parent_id' => $parentId,
                ]);
            }
        }

        // Tahap 3: Buat komentar tambahan yang sudah memiliki parent_id
        $additionalReplies = rand(50, 100);
        $replyComments = [];

        for ($i = 0; $i < $additionalReplies; $i++) {
            $postId = rand(1, 100);
            $userId = rand(1, 10);

            // Pilih parent_id dari komentar yang sudah ada
            $parentId = $commentIds[array_rand($commentIds)];

            $replyComments[] = [
                'post_id' => $postId,
                'user_id' => $userId,
                'parent_id' => $parentId,
                'content' => $this->generateCommentContent(),
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now()->subDays(rand(0, 365)),
            ];
        }

        // Insert komentar reply tambahan
        if (!empty($replyComments)) {
            Comment::insert($replyComments);
        }
    }

    private function generateCommentContent(): string
    {
        $comments = [
            'Great post! Thanks for sharing.',
            'I completely agree with your points.',
            'This is very insightful, thank you!',
            'I have a different perspective on this...',
            'Could you elaborate more on this topic?',
            'Well written and informative.',
            'This helped me a lot, thank you!',
            'I learned something new today.',
            'Looking forward to more content like this.',
            'Interesting take on the subject.',
        ];

        return $comments[array_rand($comments)];
    }
}
