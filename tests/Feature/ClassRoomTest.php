<?php

use App\Models\Classes;

describe('ClassRoom Test', function () {
    test('stability Test', function () {
        $this->signIn()->get('/classes')->assertOk();
    });

    test('classes details is displayed', function () {
        $classroom = Classes::factory()->create();
        $response = $this->signIn()->get('/classes')->assertOk();

        $response->assertStatus(200);
        $response->assertSee($classroom->name);
    });

    test('classrooms can be created', function () {
        $classroom  = ['name' => 'ClassRoom A'];
        $response = $this->signIn()->post('/classes', $classroom);
        $response->assertRedirect();
        $this->assertDatabaseHas('classes', [
            'name'  => 'ClassRoom A'
        ]);
    });

    test('classroom data can be modified', function () {
        $classroom = Classes::factory()->create(['name' => 'ClassRoom A']);

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
        $classroom = Classes::factory()->create(['name' => 'ClassRoom A']);

        $response = $this->signIn()->delete('/classes/' . $classroom->id, $classroom->toArray());
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/classes');
        $this->assertDatabaseMissing('classes', ['name' => $classroom->name]);
    });
});
