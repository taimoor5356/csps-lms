<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LectureController;

Route::prefix('lectures')->group(function () {
    Route::get('', [LectureController::class, 'index'])->name('lectures');
    Route::get('/{id}/show', [LectureController::class, 'show'])->name('show.lecture');
    Route::get('/create', [LectureController::class, 'create'])->name('create.lecture');
    Route::post('/store', [LectureController::class, 'store'])->name('store.lecture');
    Route::get('/{id}/edit', [LectureController::class, 'edit'])->name('edit.lecture');
    Route::post('/{id}/update', [LectureController::class, 'update'])->name('update.lecture');
    Route::post('/{id}/delete', [LectureController::class, 'destroy'])->name('delete.lecture');
    Route::get('/trashed', [LectureController::class, 'trashed'])->name('trashed.lectures');
    Route::get('/{id}/restore', [LectureController::class, 'restore'])->name('restore.lecture');
    Route::post('/{id}/permanent-delete', [LectureController::class, 'permanentDelete'])->name('permanent_delete.lecture');
    Route::post('/fetch-students', [LectureController::class, 'fetchStudents'])->name('fetch_students.lecture');
});