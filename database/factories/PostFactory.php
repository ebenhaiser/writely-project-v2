<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'category_id' => $this->faker->numberBetween(1, 20),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'content' => $this->generateHtmlContent(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    private function generateHtmlContent(): string
    {
        $html = '';

        // Opening paragraph
        $html .= '<p>' . $this->faker->paragraph() . '</p>';

        // Paragraph with <strong>
        $html .= '<p><strong>' . $this->faker->sentence() . '</strong> ' .
            $this->faker->paragraph() . '</p>';

        // Paragraph with <a>
        $html .= '<p>' .
            $this->faker->sentence() .
            ' <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer">' .
            'Watch related video</a> ' .
            $this->faker->sentence() .
            '</p>';

        // Bullet list
        $html .= '<ul>';
        foreach (range(1, rand(3, 5)) as $i) {
            $html .= '<li>' . $this->faker->sentence() . '</li>';
        }
        $html .= '</ul>';

        // Additional paragraphs
        foreach (range(1, rand(2, 4)) as $i) {
            $html .= '<p>' . $this->faker->paragraph() . '</p>';
        }

        return $html;
    }
}
