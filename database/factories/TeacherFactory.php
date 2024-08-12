<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => fake()->phoneNumber(),
            'base_salary' => fake()->numberBetween(20000, 80000),
            'date_of_recruit' => fake()->date(),
            'specialty' => fake()->jobTitle()
        ];
    }
}
