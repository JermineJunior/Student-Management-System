<?php

use App\Models\Subject;
use App\Models\Classes;

describe('Subject Test', function () {
    it('has a name', function () {
        $class = Classes::factory()->create();
        $subject = Subject::factory()->create([
            'class_id'  => $class->id,
            'name' =>  'Arabic',
            'full_mark'  =>  50
        ]);

        expect($subject->name)->toBe('Arabic');
    });
    it('belongs to a classroom', function () {
        $class = Classes::factory()->create();
        $subject = Subject::factory()->create([
            'class_id'  => $class->id,
            'name' =>  'Arabic',
            'full_mark'  =>  50
        ]);

        expect($subject->name)->toBe($class->subjects[0]->name);
    });

    test('Unauthenticated users cant create subjects', function () {
        $class = Classes::factory()->create();
        $subject = [
            'class_id'  => $class->id,
            'name' =>  'Arabic',
            'full_mark'  =>  50
        ];
        $response = $this->post('/subjects', $subject);
        $response
            ->assertRedirect()
            ->assertStatus(302);
    });
    test('authenticated users can view the create page', function () {
        $class = Classes::factory()->create();

        $response = $this->signIn()->get('/subjects/create');

        $response->assertStatus(200);
    });
    test('authenticated users can create subjects', function () {
        $class = Classes::factory()->create();
        $subject = [
            'class_id'  => $class->id,
            'name' =>  'Arabic',
            'full_mark'  =>  50
        ];
        $response = $this->signIn()->post('/subjects', $subject);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/subjects/' . $class->id);
        $this->assertDatabaseHas('subjects', [
            'name' => 'Arabic'
        ]);
    });

    test('authenticated users can update subjects', function () {
        $class = Classes::factory()->create();
        $subject = Subject::factory()->create([
            'class_id'  => $class->id,
            'name' =>  'Arabic',
            'full_mark'  =>  50
        ]);

        $newSubject = [
            'class_id' => $class->id,
            'name' => 'English',
            'full_mark'  =>  40,
        ];

        $response = $this->signIn()->put('/subjects/' . $subject->id, $newSubject);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/subjects/' . $class->id);
        $this->assertDatabaseHas('subjects', [
            'name' => 'English'
        ]);
    });

    test('authenticated users can delete subjects', function () {
        $class = Classes::factory()->create();
        $subject = Subject::factory()->create([
            'class_id'  => $class->id,
            'name' =>  'Arabic',
            'full_mark'  =>  50
        ]);
        $deleteResponse = $this->signIn()->delete('/subjects/' . $subject->id , $subject->toArray());
        $deleteResponse
            ->assertSessionHasNoErrors()
            ->assertRedirect('/subjects/' . $class->id);
        $this->assertDatabaseMissing('subjects', ['name' => $subject->name]);
    });
});
