<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LessonPlanController;
use App\Http\Controllers\ZoomClassesController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\DownloadCenterController;

// Route::group(['prefix' => 'teachers', 'middleware' => ['role:admin|teacher']], function () {
Route::group(['prefix' => 'teachers'], function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher_dashboard')->middleware('permission:teacher_view');
    Route::get('', [TeacherController::class, 'index'])->name('teachers')->middleware('permission:teacher_view');
    Route::get('/{id}/show', [TeacherController::class, 'show'])->name('show.teacher')->middleware('permission:teacher_view');
    Route::get('/create', [TeacherController::class, 'create'])->name('create.teacher')->middleware('permission:teacher_create');
    Route::post('/store', [TeacherController::class, 'store'])->name('store.teacher')->middleware('permission:teacher_create');
    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('edit.teacher')->middleware('permission:teacher_update');
    Route::post('/{id}/update', [TeacherController::class, 'update'])->name('update.teacher')->middleware('permission:teacher_update');
    Route::post('/{id}/delete', [TeacherController::class, 'destroy'])->name('delete.teacher')->middleware('permission:teacher_delete');
    Route::get('/trashed', [TeacherController::class, 'trashed'])->name('trashed.teachers')->middleware('permission:teacher_delete');
    Route::get('/{id}/restore', [TeacherController::class, 'restore'])->name('restore.teacher')->middleware('permission:teacher_delete');
    Route::post('/{id}/permanent-delete', [TeacherController::class, 'permanentDelete'])->name('permanent_delete.teacher')->middleware('permission:teacher_delete');
    Route::get('/students/attendance', [AttendanceController::class, 'teacherStudentAttendance'])->name('teachers_student_attendance')->middleware('permission:teacher_update');
    Route::get('/examination', [ExaminationsController::class, 'teacherExaminations'])->name('teacher_examinations');
    Route::get('/lesson-plan', [LessonPlanController::class, 'teachersLessonPlan'])->name('teachers_lesson_plan')->middleware('permission:teacher_view');
    Route::get('/academics', [AcademicController::class, 'teachersAcademics'])->name('teachers_academics')->middleware('permission:teacher_view');
    Route::get('/download-center', [DownloadCenterController::class, 'teacherDownloadCenter'])->name('teachers_download_center')->middleware('permission:teacher_view');
    Route::get('/assignments', [AssignmentController::class, 'teacherAssignment'])->name('teachers_assignment')->middleware('permission:teacher_view');
    Route::get('/zoom-class', [ZoomClassesController::class, 'teacherZoomClass'])->name('teachers_zoom_class')->middleware('permission:teacher_view');
});
