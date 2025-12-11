<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
        $username = Str::slug($firstName . '.' . $lastName) . $this->faker->randomNumber(3, false);

        return [
            'name' => $firstName . ' ' . $lastName,
            'username' => $username,
            'email' => $username . '@example.com',
            'email_verified_at' => $this->faker->randomElement([now(), null]),
            'password' => Hash::make('admin'), // Password default
            'bio' => $this->faker->boolean(70) ? Str::limit($this->faker->sentence(rand(5, 15)), 100) : null,
            'profile_picture' => $this->faker->randomElement([
                null,
                $this->faker->imageUrl(200, 200, 'people', true, 'avatar'),
                'https://i.pravatar.cc/300?img=' . $this->faker->numberBetween(1, 70),
            ]),
            'remember_token' => Str::random(10),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
