<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Parents;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
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
            'parent_id' => Parents::factory()->create(),
            'name'  => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail
        ];
    }
}
