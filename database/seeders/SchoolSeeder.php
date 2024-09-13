<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\Teacher;


class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::factory(3)
            ->count(5)
            ->sequence(fn ($sequence) => [
                'name'  => 'School ' . $sequence->index + 1
            ])
            ->has(
                Teacher::factory()
                ->count(3)
                 ->state(
                        function (array $attributes, School $school) {
                            return ['school_id' => $school->id];
                        }
                    )
            )->create();
    }
}
