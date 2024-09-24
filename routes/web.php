<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UpdateSchoolController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;


Route::get("/", function () {
    return to_route('dashboard');
});

//dashboard
Route::get("/dashboard", [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name("dashboard");

//Auth Routes
Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );

    // Student Routes
    Route::resource("/students", StudentController::class);
    //Teacher Routes
    Route::resource('/teachers', TeacherController::class);
    //Classes Route
    Route::resource('/classes', ClassesController::class)->except(['show', 'edit', 'create']);
    //Subjects Routes
    Route::resource('/subjects', SubjectController::class)->except(['index', 'edit']);

    //Schools Routes
    Route::post('/schools', [SchoolController::class, 'store'])->name('schools.store');
    Route::patch('/schools/{school}', [SchoolController::class, 'update'])->name('schools.update');
    Route::delete('/schools/{school}', [SchoolController::class, 'destroy'])->name('schools.destroy');
    Route::patch('/schools/{school}/activate', UpdateSchoolController::class)->name('schools.edit');

    //Attendance Routes
    Route::get('/students/{class}/attendance', [AttendanceController::class, 'showAtendanceForm'])
        ->name('attendance.showForm');
    Route::post('/students/{class}/attendance', [AttendanceController::class, 'storeAttendance'])
        ->name('attendance.store');
});

require __DIR__ . "/auth.php";
