<?php

namespace App\Http\Controllers;

use App\Http\Resources\SchoolResource;
use Inertia\Inertia;
use App\Models\Classes;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        $student_count =  Student::where('school_id', School::activeSchool()->id)->count() || 0;
        $class_count   =  Classes::where('school_id', School::activeSchool()->id)->count() || 0;
        $teacher_count =  Teacher::where('school_id', School::activeSchool()->id)->count() || 0;

        $schools = SchoolResource::collection(
            School::all()->sortBy(function ($school) {
                return array_search($school->status, ['1', '0']);
            })
        );

        return Inertia::render("Dashboard", [
            "students" => $student_count,
            "classes" => $class_count,
            "teachers" => $teacher_count,
            'schools'  => $schools
        ]);
    }
}
