<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Classes;
use Carbon\Carbon;
use Inertia\Inertia;


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

    public function storeAttendance(Request $request , Classes $class)
    {
         $request->validate([
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:students,id',
            'attendance.*.status' => 'required|boolean',  // 1 for present, 0 for absent
        ]);

        $date = Carbon::today();

        // Loop through attendance data and update/create attendance records
        foreach ($request->attendance as $attendanceData) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $attendanceData['student_id'],
                    'class_id' => $class->id,
                    'date' => $date,
                ],
                [
                    'status' => $attendanceData['status'], // 1 for present, 0 for absent
                ]
            );
        }
            return redirect()->back()->with([
            'message' => [
                'type' => 'success',
                'message' => 'Attendance saved Successfuly'
            ]
        ]);

    }
}
