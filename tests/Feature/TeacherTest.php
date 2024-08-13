<?php

use App\Models\Teacher;
use App\Models\User;

describe('Teachers Crud', function () {
    test('Unauthenticated users cant view the Index page', function () {
        $response = $this->get('/teachers');

        $response->assertRedirect('/login');
    });

    test('authenticated users can view the Index page', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/teachers');

        $response->assertOk();
        $response->assertStatus(200);
    });
    test('authenticated users can view teachers details', function () {
        $user = User::factory()->create();

        $teacher = Teacher::factory()->create();
        $response = $this->actingAs($user)->get('/teachers');

        $response->assertOk();
        $response->assertSee($teacher->name);
    });
    test('authenticated users can view the create page', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/teachers/create');

        $response->assertOk();
        $response->assertStatus(200);
    });

    test('authenticated users can add teachers', function () {
        $user = User::factory()->create();

        $teacher = [
            'name' => 'Ahmed',
            'email' => 'ahmed@example.com',
            'phone' => '01234567890',
            'date_of_recruit' => now(),
            'base_salary'  => 20000,
            'specialty' => 'Arabic'
        ];
        $response = $this->actingAs($user)->post('/teachers', $teacher);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/teachers');
        $this->assertDatabaseHas('teachers', [
            'name' => 'Ahmed'
        ]);
    });

    test('authenticated users can modify teachers details', function () {
        $user = User::factory()->create();
        $teacher = Teacher::factory()->create([
            'name' => 'Ali Omer',
            'email' => 'ali@example.com',
            'phone' => '01234567890',
            'date_of_recruit' => now(),
            'base_salary'  => 40000,
            'specialty' => 'Arabic'
        ]);
        $newTeacher = [
            'name' => 'Ali Adil',
            'email' => 'ali.eng@example.com',
            'phone' => '01234567890',
            'date_of_recruit' => now(),
            'base_salary'  => 40000,
            'specialty' => 'Arabic'
        ];
        $response = $this->actingAs($user)->put('/teachers/' . $teacher->id, $newTeacher);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/teachers');
        $this->assertDatabaseHas('teachers', [
            'email' => 'ali.eng@example.com'
        ]);
    });

    test('teachers can be deleted', function () {
        $user = User::factory()->create();
        $teacher = [
            'id' => 1,
            'name' => 'Ahmed',
            'email' => 'ahmed@example.com',
            'phone' => '01234567890',
            'date_of_recruit' => now(),
            'base_salary'  => 20000,
            'specialty' => 'Arabic'
        ];
        $response = $this->actingAs($user)->post('/teachers', $teacher);

        $deleteResponse = $this->actingAs($user)->delete('/teachers/' . $teacher['id'], $teacher);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/teachers');
    });
});
