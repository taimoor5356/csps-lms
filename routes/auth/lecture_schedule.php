<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LectureScheduleController;
use App\Http\Controllers\TeacherLectureScheduleController;

Route::group(['prefix' => 'lecture-schedule'], function () {
    Route::get('/{id}/teachers', [LectureScheduleController::class, 'teacherLectureSchedules'])->name('teacher_lecture_schedules')->middleware('permission:lecture_schedule_view');
    Route::get('/teachers/{teacher_id}/students', [LectureScheduleController::class, 'studentLectureSchedules'])->name('students_lecture_schedule')->middleware('permission:lecture_schedule_view');
    Route::get('/teachers/{teacher_id}/students', [LectureScheduleController::class, 'studentLectureSchedules'])->name('students_lecture_schedule')->middleware('permission:lecture_schedule_view');
    Route::get('/course/{course_id}/teacher/{teacher_id}/status/update', [TeacherLectureScheduleController::class, 'updateStatus'])->name('update_lecture_schedule_status')->middleware('permission:lecture_schedule_view');
    Route::get('/course/{course_id}/teacher/{teacher_id}/course/details', [TeacherLectureScheduleController::class, 'teacherCourseDetails'])->name('teacher_lecture_details')->middleware('permission:lecture_schedule_view');
    Route::post('/{course_id}/store', [LectureScheduleController::class, 'store'])->name('store_lecture_schedules')->middleware('permission:lecture_schedule_view');
});
