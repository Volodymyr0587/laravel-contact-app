<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\User;
use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $businesses = Business::pluck('id');

        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'birthday' => fake()->date('Y-m-d'),
            'phone' => fake()->phoneNumber(),
            'image' => fake()->boolean(50) ? 'https://source.unsplash.com/random?person' : null,
            'business_id' => (fake()->boolean(50) ? fake()->randomElement($businesses) : null),
            'user_id' => User::all()->random()->id,
        ];
    }

    // public function configure()
    // {
    //     return $this->afterCreating(function (Person $person) {
    //         $person->update(['image' => $person->image ? 'https://source.unsplash.com/random?person' : null]);
    //     });
    // }
}
