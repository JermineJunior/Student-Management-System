<?php

use App\Models\Classes;
use App\Models\Student;
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
        $student = Student::factory()->create([
            'parent_id' =>  1,
            'name' => 'john doe',
            'email' => 'john@example.com',
            'class_id' => Classes::factory()->create(),
        ]);
        $response = $this->signIn()->get('/students');

        $response->assertSee($student->name);
        $response->assertSee($student->email);
    });

    test('authenticated users can see the create student page', function () {

        $response = $this->SignIn()->get('/students/create');

        $response->assertOk();
        $response->assertStatus(200);
    });
});
