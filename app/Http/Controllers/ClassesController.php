<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassesResource;
use App\Models\Classes;
use App\Models\Student;
use App\Models\School;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = ClassesResource::collection(Classes::where('school_id', School::activeSchool()->id)->get());
        $studentCount = Student::where('school_id', School::activeSchool()->id)->count();
        return inertia('Classes/Index', ['classes' => $classes, 'students' => $studentCount]);
    }

    public function store()
    {
        $activeSchool = School::activeSchool();
        $validatedDate = request()->validate(['name' => ['required', 'min:3']]);

        Classes::create([...$validatedDate, 'school_id' => $activeSchool->id]);

        return to_route('classes.index')->with([
            'message' => [
                'type' => 'success',
                'message' => 'Class Room Added Successfuly'
            ]
        ]);
    }

    public function update(Classes $class)
    {
        $validatedDate = request()->validate([
            'name' => ['required', 'min:3']
        ]);
        $class->update($validatedDate);

        return redirect()->route('classes.index');
    }

    public function destroy(Classes $class)
    {
        $class->delete();

        return redirect()->route('classes.index')->with([
            'message' => [
                'type' => 'success',
                'message' => 'Class Room was removed Successfuly'
            ]
        ]);
    }
}
