<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
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
            'body' => fake()->text(),
            'image' => fake()->boolean(50) ? 'https://source.unsplash.com/random?nature' . '&' . rand(1, 1000) : null,
            'is_active' => fake()->boolean(),
        ];
    }
}
