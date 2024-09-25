<?php
use App\Models\School;
it('has a name' , function (){
    $school = School::factory()->create([
        'name'  => 'school one',
        'description'  => 'School Description'
    ]);

    expect($school->name)->toBe('school one');
});

it('has a description ' , function (){
    $school = School::factory()->create([
        'name'  => 'school one',
        'description'  => 'School Description'
    ]);

    expect($school->description)->toBe('School Description');
});

test('authenticated users can view the dashboard page' , function (){
    $school = School::factory()->create([
        'name'  => 'school one',
        'description'  => 'School Description'
    ]);
    $response = $this->signIn()->get('/dashboard');

        $response->assertOk();
        $response->assertStatus(200);

        $response->assertSee($school->name);
});

test('authenticated users can activate a school' , function (){
    $school = School::factory()->create([
        'name'  => 'school one',
        'description'  => 'School Description'
    ]);
    $response = $this->signIn()->put('/schools/'. $school->id .'/activate');
    $response->assertSessionHasNoErrors();

    expect($school->status)->toBe(1);

});
test('authenticated users can update a school' , function (){
    $school = School::factory()->create([
        'name'  => 'school one',
        'description'  => 'School Description'
    ]);

    $newSchool = ['name'  => 'school two'];

    $response = $this->signIn()->put(route('schools.update',$school->id) , $newSchool);
    $response->assertSessionHasNoErrors();
});

test('authenticated users can delete a school' , function (){
    $school = School::factory()->create([
        'name'  => 'school one',
        'description'  => 'School Description'
    ]);

    $deleteResponse = $this->signIn()->delete('/schools/' . $school->id, $school->toArray());
     $deleteResponse
            ->assertSessionHasNoErrors()
            ->assertRedirect('/dashboard');
        $this->assertDatabaseMissing('schools', ['name' => $school->name]);
});





