<?php

namespace App\Http\Controllers;

use App\Models\Classes;

class AttendanceController extends Controller
{
    public function showAtendanceForm(Classes $class)
    {
        $students = $class->students;

        return Inertia('Attendance/Form' , [
            'classroom' => $class,
            'students' => $students
        ]);
    }
}
