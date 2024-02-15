<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;

Route::prefix('enrollments')->group(function () {
    Route::get('/students/{id?}', [EnrollmentController::class, 'students'])->name('enrollments.students');
    Route::get('/teachers/{id?}', [EnrollmentController::class, 'teachers'])->name('enrollments.teachers');
    Route::get('/enroll/{type?}', [EnrollmentController::class, 'create'])->name('enrollment.create');
    Route::post('/enrollment-save', [EnrollmentController::class, 'store'])->name('enrollment.save');
    Route::post('/trashed', [EnrollmentController::class, 'store'])->name('trashed.enrollments');

    // fetch user courses
    Route::post('/student/courses', [EnrollmentController::class, 'fetchUserCourses'])->name('fetch_user_courses');
    Route::post('/course/teachers', [EnrollmentController::class, 'fetchCourseTeachers'])->name('fetch_course_teachers');
});