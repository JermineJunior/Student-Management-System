<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\StudentResource;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Models\School;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
  public function index(Request $request)
  {
    $teacherQuery = Teacher::query($request);

    //search in the students table for the name
    $this->applySearch($teacherQuery, request()->search);

    $teachers = TeacherResource::collection(
     $teacherQuery->get()
    );

    return inertia('Teachers/Index', [
      "teachers"  => $teachers,
      'search' => $request->search
    ]);
  }

  protected function applySearch($query, $search)
  {
    //return results filtered by name
    $query->when($search, function ($query, $search) {
      $query->where('name', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%');
    });
  }

  public function create()
  {
    return inertia('Teachers/Create');
  }

  public function store(CreateTeacherRequest $request)
  {
    $activeSchool = School::where('status' , '=' , 1)->first();
    $newTeacher = [...$request->validated() , 'school_id'  => $activeSchool->id];
    Teacher::create($newTeacher);

    return redirect()->route('teachers.index')->with([
            'message' => [
                'type' => 'success',
                'message' => 'Teacher Added Successfuly'
            ]
        ]);
  }

  public function edit(Teacher $teacher)
  {
    return inertia('Teachers/Edit', [
      "teacher" => TeacherResource::make($teacher)
    ]);
  }

  public function update(UpdateTeacherRequest $request, Teacher $teacher)
  {
    $teacher->update([...$request->validated(), 'school_id'  => $teacher->school_id]);

    return redirect()->route('teachers.index');
  }

  public function destroy(Teacher $teacher)
  {
    $teacher->delete();

    return to_route('teachers.index');
  }
}
