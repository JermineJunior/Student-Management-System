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
       //$schools = School::factory(5)->create();
        Classes::factory()
            ->count(10)
            ->sequence(fn($sequence) => [
                'name' => 'ClassRoom ' . $sequence->index +
                    1,
            ])
            ->has(
                Student::factory()
                    ->count(10)
                    ->state(
                        function (array $attributes, Classes $class) {
                            return [
                                'class_id' => $class->id,
                                'school_id' =>  $class->school_id
                            ];
                        }
                    )
            )
            ->create();
    }
}
