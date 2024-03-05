<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;

Route::group(['prefix' => 'courses'], function () {
    Route::get('', [CourseController::class, 'index'])->name('courses')->middleware('permission:courses_view');
    Route::get('/{id}/show', [CourseController::class, 'show'])->name('show.course')->middleware('permission:courses_view');
    Route::get('/create', [CourseController::class, 'create'])->name('create.course')->middleware('permission:courses_create');
    Route::post('/store', [CourseController::class, 'store'])->name('store.course')->middleware('permission:courses_create');
    Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('edit.course')->middleware('permission:courses_update');
    Route::post('/{id}/update', [CourseController::class, 'update'])->name('update.course')->middleware('permission:courses_update');
    Route::post('/{id}/delete', [CourseController::class, 'destroy'])->name('delete.course')->middleware('permission:courses_delete');
    Route::get('/trashed', [CourseController::class, 'trashed'])->name('trashed.courses')->middleware('permission:courses_delete');
    Route::get('/{id}/restore', [CourseController::class, 'restore'])->name('restore.course')->middleware('permission:courses_delete');
    Route::post('/{id}/permanent-delete', [CourseController::class, 'permanentDelete'])->name('permanent_delete.course')->middleware('permission:courses_delete');

    // Lectures
    Route::get('/{course_id}/lectures', [LectureController::class, 'index'])->name('lectures')->middleware('permission:courses_view');
});