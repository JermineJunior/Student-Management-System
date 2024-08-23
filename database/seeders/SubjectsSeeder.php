<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classes::all();
        $classes->map(fn($sequence) => [
            Subject::factory(5)->create(['class_id' => $sequence->id])
        ]);
    }
}
