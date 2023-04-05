<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::prefix('courses')->group(function () {
    Route::get('', [CourseController::class, 'index'])->name('courses');
    Route::get('/{id}/show', [CourseController::class, 'show'])->name('show.course');
    Route::get('/create', [CourseController::class, 'create'])->name('create.course');
    Route::post('/store', [CourseController::class, 'store'])->name('store.course');
    Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('edit.course');
    Route::post('/{id}/update', [CourseController::class, 'update'])->name('update.course');
    Route::post('/{id}/delete', [CourseController::class, 'destroy'])->name('delete.course');
    Route::get('/trashed', [CourseController::class, 'trashed'])->name('trashed.courses');
    Route::get('/{id}/restore', [CourseController::class, 'restore'])->name('restore.course');
    Route::post('/{id}/permanent-delete', [CourseController::class, 'permanentDelete'])->name('permanent_delete.course');
});