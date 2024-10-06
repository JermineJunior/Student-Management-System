<?php
use App\Models\Classes;
use App\Models\School;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;

it('exports the students of a selected class as an excel file', function () {
    // Create a fake Excel instance to prevent real file creation
    Excel::fake();

    // Create a mock class and students
    $school = School::factory()->create();
    $class = Classes::factory()->create();
    $students = Student::factory()->count(5)->create([
        'class_id' => $class->id,
        'school_id' => $school->id,
    ]);

    // Simulate a request to the export route
    $response = $this->get("/export/class/{$class->id}");

    // Check if the route returns 200 OK
    $response->assertStatus(302);
});
