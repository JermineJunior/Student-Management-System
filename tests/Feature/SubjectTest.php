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
    test('the index page is auth guarded', function () {
        $this->get('/subjects')->assertRedirect('/login');
    });
    test('the index page is can be rendered', function () {
        $this->signIn()->get('/subjects')->assertOk();
    });

    test('users can view the details of it', function () {
        $subject = createSubject();
        $response =  $this->signIn()->get('/subjects')->assertOk();
        $response->assertSee($subject->name);
        $response->assertSee($subject->full_mark);
    });

    it('has belongs to a classroom', function () {
        $subject = createSubject();
        expect($subject->classRoom->id)->toEqual($subject->class_id);
    });
});
