<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Resources\ClassesResource;
use App\Http\Resources\StudentResource;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $studentQuery = Student::search($request);
        $classes = ClassesResource::collection(Classes::all());

        return inertia('Students/Index', [
            'students' => StudentResource::collection(
                $studentQuery->paginate(10)
            ),
            'classes' => $classes,
            'search' => request('search') ?? ''
        ]);
    }

    public function create()
    {
        $classes = ClassesResource::collection(Classes::all());
        return inertia('Students/Create', [
            "classes" => $classes
        ]);
    }

    public function show(Student $student)
    {
        return inertia(
            'Students/Show',
            ['student' => StudentResource::make($student)]
        );
    }

    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());

        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        $classes = ClassesResource::collection(Classes::all());

        return inertia('Students/Edit', [
            "classes" => $classes,
            "student" => StudentResource::make($student)
        ]);
    }
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //update the record with the validated user data
        $student->update($request->validated());
        //redirect to see the changes implemented
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}
