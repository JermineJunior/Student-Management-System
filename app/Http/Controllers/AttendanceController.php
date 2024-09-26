<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassesResource;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Classes;
use Carbon\Carbon;
use Inertia\Inertia;


class AttendanceController extends Controller
{
    // Display the form to select class and date
    public function attendanceForm()
    {
        // Fetch all classes for the dropdown selection
        $classes = ClassesResource::collection(Classes::all());

        return Inertia::render('Attendance/Search', [
            'classes' => $classes,
            'attendances' => [],
            'attendanceDate' => null,
            'selectedClass' => null
        ]);
    }

     // Fetch the attendance for a specific class and date
    public function fetchAttendance(Request $request)
    {
        // Validate the form input
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'date' => 'required|date'
        ]);

        $classId = $request->input('class_id');
        $date = $request->input('date');

        // Fetch the class and students
        $class = Classes::where('id',$classId)->with('students')->first();
        // Fetch attendance records for this class and date
        $attendances = Attendance::where('class_id', $classId)
            ->where('date', $date)
            ->get()
            ->keyBy('student_id');  // Organize by student ID for easier lookup
        // Return the data to the same view
        return Inertia::render('Attendance/Search', [
            'classes' => ClassesResource::collection(Classes::all()),
            'class' => $class,
            'students' => StudentResource::collection($class->students),
            'attendances' => $attendances,
            'attendanceDate' => $date,
            'selectedClass' => $classId
        ]);
    }
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
