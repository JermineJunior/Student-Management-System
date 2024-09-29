<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Student;
use App\Models\School;
use Illuminate\Database\Seeder;


class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::factory()
            ->count(10)
            ->sequence(fn($sequence) => [
                'name' => 'ClassRoom ' . $sequence->index +
                    1,
                'school_id' =>  fake()->randomElement(School::all())->id,
            ])
            ->has(
                Student::factory()
                    ->count(10)
                    ->state(
                        function (array $attributes, Classes $class) {
                            return [
                                'class_id' => $class->id,
                                'school_id' =>  fake()->randomElement(School::all())->id,
                            ];
                        }
                    )
            )
            ->create();
    }
}
