<?php

namespace Database\Factories;

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
            'user_id' => $this->faker->numberBetween(1, 10),
            'category_id' => $this->faker->numberBetween(1, 20),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'content' => $this->generateContent(),
            'thumbnail' => $this->faker->randomElement([
                null,
                $this->faker->imageUrl(800, 600, 'nature', true, 'post'),
                $this->faker->imageUrl(800, 600, 'technology', true, 'post'),
                $this->faker->imageUrl(800, 600, 'business', true, 'post'),
            ]),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    private function generateContent(): string
    {
        $paragraphs = $this->faker->paragraphs(rand(5, 10));
        return implode("\n\n", $paragraphs);
    }
}
