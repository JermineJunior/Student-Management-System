<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassesResource;
use App\Models\Classes;
use App\Models\Student;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = ClassesResource::collection(Classes::all());
        $studentCount = Student::count();
        return inertia('Classes/Index', ['classes' => $classes, 'students' => $studentCount]);
    }

    public function store()
    {
        $validatedDate = request()->validate(['name' => ['required', 'min:3']]);

        Classes::create($validatedDate);

        return redirect()->route('classes.index');
    }

    public function edit(Classes $class)
    {
        $Class =  ClassesResource::make($class);
        return inertia('Classes/Edit', ['Class' => $Class]);
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

        return redirect()->route('classes.index');
    }
}
