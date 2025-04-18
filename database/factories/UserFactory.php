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
        $gender = fake()->randomElement(['male', 'female']);
        $dob = fake()->dateTimeBetween('-60 years', '-18 years'); // adult range
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'profile_photo' => 'default.png', // or use a faker image if needed
            'date_of_birth' => $dob->format('Y-m-d'),
            // 'age' => now()->diff($dob)->y,
            'gender' => $gender,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'bio' => fake()->paragraph(2),
            'role' => fake()->randomElement(['admin', 'editor', 'user']),
            'is_active' => fake()->boolean(90),
            'last_login_at' => fake()->dateTimeBetween('-30 days', 'now'),
            'joined_at' => fake()->dateTimeBetween('-1 years', '-1 months'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
