<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\School;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_id' => School::first()->id,
            'name' => fake()->randomElement(
                ['ClassRoom1', 'ClassRoom2', 'ClassRoom3', 'ClassRoom4', 'ClassRoom5', 'ClassRoom6']
            )
        ];
    }
}
