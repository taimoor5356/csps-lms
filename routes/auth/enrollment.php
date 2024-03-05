<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;

Route::group(['prefix' => 'enrollments'], function () {
    Route::get('/students/{id?}', [EnrollmentController::class, 'students'])->name('enrollments.students')->middleware('permission:enrollment_view');
    Route::get('/teachers/{id?}', [EnrollmentController::class, 'teachers'])->name('enrollments.teachers')->middleware('permission:enrollment_view');
    Route::get('/enroll/{type?}', [EnrollmentController::class, 'create'])->name('enrollment.create')->middleware('permission:enrollment_create');
    Route::post('/enrollment-save', [EnrollmentController::class, 'store'])->name('enrollment.save')->middleware('permission:enrollment_create');
    Route::post('/trashed', [EnrollmentController::class, 'store'])->name('trashed.enrollments')->middleware('permission:enrollment_delete');

    // fetch user courses
    Route::post('/student/courses', [EnrollmentController::class, 'fetchUserCourses'])->name('fetch_user_courses')->middleware('permission:enrollment_view');
    Route::post('/course/teachers', [EnrollmentController::class, 'fetchCourseTeachers'])->name('fetch_course_teachers')->middleware('permission:enrollment_view');
});