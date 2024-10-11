<?php

use App\Models\Classes;
use App\Models\School;

describe('ClassRoom Test', function () {
    test('classes details is displayed', function () {
        $school = School::factory()->create([
            'name'  => 'school one',
            'description'  => 'School Description'
        ]);
        $classroom = Classes::factory()->create([
            'school_id' => $school->id,
            'name' => 'ClassRoom 1',
        ]);
        $response = $this->signIn()->get('/classes')->assertOk();
        $response->assertStatus(200);
    });

    test('classrooms can be created', function () {
        $school = School::factory()->create([
            'name'  => 'school one',
            'description'  => 'School Description'
        ]);
        $classroom  = [
            'name' => 'ClassRoom A',
            'school_id' => $school->id,
        ];
        $response = $this->signIn()->post('/classes', $classroom);
        $response->assertRedirect();
        $this->assertDatabaseHas('classes', [
            'name'  => 'ClassRoom A'
        ]);
    });

    test('classroom data can be modified', function () {
        $classroom = Classes::factory()->create([
            'school_id' => School::factory()->create(['name' => 'School 1', 'description' => 'School 1']),
            'name' => 'ClassRoom A',
        ]);

        $newClassRoom = ['name' => 'ClassRoom B'];
        $response = $this->signIn()->put('/classes/' . $classroom->id, $newClassRoom);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/classes');
        $this->assertDatabaseHas('classes', [
            'name' => 'ClassRoom B'
        ]);
    });

    test('classes can be deleted', function () {
        $classroom = Classes::factory()->create([
            'school_id' => School::factory()->create(['name' => 'School 1', 'description' => 'School 1']),
            'name' => 'ClassRoom 1',
        ]);

        $response = $this->signIn()->delete('/classes/' . $classroom->id, $classroom->toArray());
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/classes');
        $this->assertDatabaseMissing('classes', ['name' => $classroom->name]);
    });
});
