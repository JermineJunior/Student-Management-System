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
    $response = $this->signIn()->get("/export/class/{$class->id}");

    // Check if the route returns 200 OK
    $response
     ->assertSessionHasNoErrors()
     ->assertStatus(200);

      // Assert that the Excel file was downloaded with the correct name
    Excel::assertDownloaded('students.xlsx', function ($export) use ($students) {
        // Ensure the export is an instance of StudentsExport
        expect($export)->toBeInstanceOf(\App\Exports\StudentsExport::class);

        // Get the collection data from the export
        $data = $export->collection()->toArray();

        // Assert that the correct number of students were exported
        expect(count($data))->toBe(count($students));

        // Verify that the exported data matches the students created
        foreach ($students as $index => $student) {
            expect($data[$index]['name'])->toBe($student->name);
            expect($data[$index]['email'])->toBe($student->email);
        }

        return true;
    });
});
