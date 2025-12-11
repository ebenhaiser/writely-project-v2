<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 3000 post menggunakan factory
        // Dengan chunk untuk menghindari memory limit
        $chunkSize = 500;
        $totalPosts = 3000;

        for ($i = 0; $i < ceil($totalPosts / $chunkSize); $i++) {
            Post::factory()
                ->count(min($chunkSize, $totalPosts - ($i * $chunkSize)))
                ->create();

            $this->command->info('Created ' . (($i + 1) * $chunkSize) . ' posts...');
        }
    }
}
