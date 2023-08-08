<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;

Route::prefix('enrollments')->group(function () {
    Route::get('', [EnrollmentController::class, 'index'])->name('enrollments');
    Route::get('/enroll-student', [EnrollmentController::class, 'create'])->name('enroll-student.create');
    Route::post('/enrollment-save', [EnrollmentController::class, 'store'])->name('enrollment.save');
    Route::post('/trashed', [EnrollmentController::class, 'store'])->name('trashed.enrollments');

    // fetch user courses
    Route::post('/student/courses', [EnrollmentController::class, 'fetchUserCourses'])->name('fetch_user_courses');
});