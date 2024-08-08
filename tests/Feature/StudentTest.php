<?php

use App\Models\User;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('student crud', function () {

    test('Unauthenticated users cant view the Index page', function () {
        $response = $this->get('/students');

        $response->assertRedirect('/login');
    });

    test('authenticated users can view the Index page', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/students');

        $response->assertOk();
        $response->assertStatus(200);
    });

    test('users can view student details in the index page', function () {
        $user = User::factory()->create();

        $this->seed();

        $student = Student::find(1);

        $response = $this->actingAs($user)->get('/students');

        $response->assertSee($student->name);
        $response->assertSee($student->email);
    });

    test('authenticated users can see the create student page', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/students/create');

        $response->assertOk();
        $response->assertStatus(200);
    });
});
