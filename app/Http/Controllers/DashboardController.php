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
        $student_count = Student::count();
        $class_count = Classes::count();
        $teacher_count = Teacher::count();
        $schools = SchoolResource::collection(School::all());

        return Inertia::render("Dashboard", [
            "students" => $student_count,
            "classes" => $class_count,
            "teachers" => $teacher_count,
            'schools'  => $schools
        ]);
    }
}
