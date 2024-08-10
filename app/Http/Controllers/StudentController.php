<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\ClassesResource;
use App\Models\Classes;
use App\Models\Student;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function index()
    {
        $students = StudentResource::collection(Student::paginate(10));
        return inertia('Students/Index', [
            'students' => $students,
        ]);
    }

    public function create()
    {
        $classes = ClassesResource::collection(Classes::all());
        return inertia('Students/Create', [
            "classes" => $classes
        ]);
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
