<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Person;
use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['open', 'completed']),
            'taskable_id' => fake()->numberBetween(1, 70),
            'taskable_type' => fake()->randomElement(['App\Models\Person', 'App\Models\Business']),
        ];
    }
}
