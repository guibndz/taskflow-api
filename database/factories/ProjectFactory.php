<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
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
        'name' => fake()->sentence(3),
        'description' => fake()->paragraph(),
        'status' => fake()->randomElement(['open', 'in_progress', 'completed']),
        'deadline' => fake()->dateTimeBetween('now', '+1 year'),
    ];
}
}
