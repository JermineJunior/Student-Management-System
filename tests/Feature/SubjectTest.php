<?php

use App\Models\Classes;
use App\Models\Subject;

function createSubject()
{
    //setup a subject factory for testing
    $class = Classes::factory()->create();
    $subject = Subject::factory()->create(['class_id' => $class->id]);

    return $subject;
}

//test suite
describe('subjects test', function () {
    test('the show page is auth guarded', function () {
        $subject = createSubject();

        $this->get('/subjects/' . $subject->id)->assertRedirect('/login');
    });

    test('the show page is can be rendered', function () {
        $subject = createSubject();

        $this->signIn()->get('/subjects/' . $subject->id)->assertOk();
    });

    test('users can view the details of it', function () {
        $subject = createSubject();
        $response =  $this->signIn()->get('/subjects/' . $subject->id)->assertOk();
        $response->assertSee($subject->name);
        $response->assertSee($subject->full_mark);
    });

    it('has belongs to a classroom', function () {
        $subject = createSubject();
        expect($subject->classRoom->id)->toEqual($subject->class_id);
    });

    test('the create page is auth guarded', function () {
        $this->get('/subjects/create')->assertRedirect('/login');
    });

    test('the create page can be rendered', function () {
        $this->signIn()->get('/subjects/create')->assertOk();
    });

    test('authenticated users can add new subject', function () {
        $class = Classes::factory()->create();
        $subject = [
            'name' => 'Arabic',
            'class_id' => $class->id,
            'full_mark' => 40
        ];

        $response = $this->signIn()->post('/subjects', $subject);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/subjects/1');
    });

    test('unauthenticated users cant modify subject data', function () {

        $subject = createSubject();

        $newSubject = ['name' => 'History', 'full_mark' => 40];
        $response = $this->put('/subjects/' . $subject->id, $newSubject);
        $response->assertRedirect('/login');
    });

    test('authenticated users can modify it details', function () {
        $class = Classes::factory()->create();
        $subject = Subject::factory()->create([
            'name' => 'Art',
            'full_mark' => 30,
            'class_id' => $class->id
        ]);

        $newSubject = ['name' => 'History', 'full_mark' => 40, 'class_id' => $class->id];
        $response = $this->signIn()->put('/subjects/' . $subject->id, $newSubject);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/subjects/1');
        $this->assertDatabaseHas('subjects', [
            'name' => 'History',
            'full_mark' => 40
        ]);
    });

    it('can be deleted', function () {
        $subject = createSubject();

        $response = $this->signIn()->delete('/subjects/' . $subject->id, $subject->toArray());

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/subjects/1');
        $this->assertDatabaseMissing('subjects' , ['name' => $subject->name]);
    });
});
