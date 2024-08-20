<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parents>
 */
class ParentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_name'  => $this->faker->name,
            'parent_email' => $this->faker->safeEmail,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address()
        ];
    }
}
