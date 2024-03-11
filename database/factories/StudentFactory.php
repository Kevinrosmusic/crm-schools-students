<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_id' => rand(1, 10),
            'name' => fake()->firstName(),
            'surnames' => fake()->lastName(),
            'city' => fake()->city(),
            'birth_date' => fake()->date('Y-m-d'),
        ];
    }
}
