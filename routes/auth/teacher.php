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
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher_dashboard');
    Route::get('', [TeacherController::class, 'index'])->name('teachers')->middleware('role:admin');
    Route::get('/{id}/show', [TeacherController::class, 'show'])->name('show.teacher')->middleware('role:admin');
    Route::get('/create', [TeacherController::class, 'create'])->name('create.teacher')->middleware('role:admin');
    Route::post('/store', [TeacherController::class, 'store'])->name('store.teacher')->middleware('role:admin');
    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('edit.teacher')->middleware('role:admin');
    Route::post('/{id}/update', [TeacherController::class, 'update'])->name('update.teacher')->middleware('role:admin');
    Route::post('/{id}/delete', [TeacherController::class, 'destroy'])->name('delete.teacher')->middleware('role:admin');
    Route::get('/trashed', [TeacherController::class, 'trashed'])->name('trashed.teachers')->middleware('role:admin');
    Route::get('/{id}/restore', [TeacherController::class, 'restore'])->name('restore.teacher')->middleware('role:admin');
    Route::post('/{id}/permanent-delete', [TeacherController::class, 'permanentDelete'])->name('permanent_delete.teacher')->middleware('role:admin');
    Route::get('/students/attendance', [AttendanceController::class, 'teacherStudentAttendance'])->name('teachers_student_attendance')->middleware('role:admin');
    Route::get('/examination', [ExaminationsController::class, 'teacherExaminations'])->name('teacher_examinations');
    Route::get('/lesson-plan', [LessonPlanController::class, 'teachersLessonPlan'])->name('teachers_lesson_plan')->middleware('role:admin');
    Route::get('/academics', [AcademicController::class, 'teachersAcademics'])->name('teachers_academics')->middleware('role:admin');
    Route::get('/download-center', [DownloadCenterController::class, 'teacherDownloadCenter'])->name('teachers_download_center')->middleware('role:admin');
    Route::get('/assignments', [AssignmentController::class, 'teacherAssignment'])->name('teachers_assignment')->middleware('role:admin');
    Route::get('/zoom-class', [ZoomClassesController::class, 'teacherZoomClass'])->name('teachers_zoom_class')->middleware('role:admin');
});
