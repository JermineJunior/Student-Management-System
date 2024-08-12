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
});
