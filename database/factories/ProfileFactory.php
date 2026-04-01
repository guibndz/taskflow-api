<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        // 'user_id' será preenchido pelo Seeder
        'bio' => fake()->realText(100),
        'phone' => fake()->phoneNumber(),
        'avatar_url' => fake()->imageUrl(),
    ];
}
}
