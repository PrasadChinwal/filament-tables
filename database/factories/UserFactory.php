<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        return [
            'name' => Str::of($firstName)->append($lastName)->value(),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'netid' => $this->faker->regexify('[a-z0-9]{6}'),
            'uin' => fake()->randomNumber(9),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'access_token' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'id_token' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'refresh_token' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
