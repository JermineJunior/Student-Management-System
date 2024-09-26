<?php

use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('student crud', function () {

    test('Unauthenticated users cant view the Index page', function () {
        $response = $this->get('/students');

        $response->assertRedirect('/login');
    });

    test('authenticated users can view the Index page', function () {
        $response = $this->signIn()->get('/students');

        $response->assertOk();
        $response->assertStatus(200);
    });

    test('users can view student details in the index page', function () {
    $school = School::factory()->create([
        'name'  => 'school one',
        'description'  => 'School Description'
    ]);
        $student = Student::factory()->create([
            'school_id'  => $school->id,
            'parent_id' =>  1,
            'name' => 'john doe',
            'email' => 'john@example.com',
            'class_id' => Classes::factory()->create(),
        ]);
        $response = $this->signIn()->get('/students');

        $response->assertSee($student->name);
        $response->assertSee($student->email);
        $response->assertSee($student->parent->parent_name);
    });

    test('authenticated users can see the create student page', function () {

        $response = $this->SignIn()->get('/students/create');

        $response->assertOk();
        $response->assertStatus(200);
    });
    test('authenticated users can add students', function () {
        $school = School::factory()->create([
            'name'  => 'school one',
            'description'  => 'School Description'
        ]);
        $parent = Parents::factory()->create();
        $classroom = Classes::factory()->create();
        $student = [
            'name' => 'jack reacher',
            'email' => 'jac@ex.com',
            'school_id'  => $school->id,
            'class_id' => $classroom->id,
            'parent_id' => $parent->id,
            'parent_name' => $parent->parent_name,
            'parent_email' => $parent->parent_email,
            'phone' => $parent->phone,
        ];

        $response = $this->signIn()->post('/students', $student);
        $response->assertSessionHasNoErrors();
    });

    test('authenticated users can modify students' , function () {
        $school = School::factory()->create([
            'name'  => 'school one',
            'description'  => 'School Description'
        ]);
        $parent = Parents::factory()->create();
        $classroom = Classes::factory()->create();
        $student = Student::factory()->create([
            'name' => 'jack reacher',
            'email' => 'jac@ex.com',
            'school_id'  => $school->id,
            'class_id' => $classroom->id,
            'parent_id' => $parent->id,
        ]);

        $newStudent = [ 'name' => 'jack alison' ,  'class_id' => $classroom->id,  'email' => 'jac2@ex.com', ];
        $updateResponse = $this->signIn()->put('/students/' . $student->id , $newStudent);

        $updateResponse ->assertSessionHasNoErrors()
            ->assertRedirect('/students');
        $this->assertDatabaseHas('students', [
             'name' => 'jack alison',
             'email' => 'jac2@ex.com',
        ]);
    });

    test('authenticated users can delete students' , function(){
        $school = School::factory()->create([
            'name'  => 'school one',
            'description'  => 'School Description'
        ]);
        $parent = Parents::factory()->create();
        $classroom = Classes::factory()->create();
        $student = Student::factory()->create([
            'name' => 'jack reacher',
            'email' => 'jac@ex.com',
            'school_id'  => $school->id,
            'class_id' => $classroom->id,
            'parent_id' => $parent->id,
        ]);

        $deleteResponse = $this->signIn()->delete('/students/' . $student->id, $student->toArray());
        $deleteResponse
            ->assertSessionHasNoErrors()
            ->assertRedirect('/students');
    });
});
