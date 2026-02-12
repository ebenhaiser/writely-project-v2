<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Setting;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat post menggunakan factory
        // Dengan chunk untuk menghindari memory limit
        $postSeedCount = Setting::value('postSeederCount') ?? 3000;
        $totalPosts = (int) $postSeedCount;
        $chunkSize = 500;

        for ($i = 0; $i < ceil($totalPosts / $chunkSize); $i++) {
            Post::factory()
                ->count(min($chunkSize, $totalPosts - ($i * $chunkSize)))
                ->create();

            $this->command->info('Created ' . (($i + 1) * $chunkSize) . ' posts...');
        }
    }
}
