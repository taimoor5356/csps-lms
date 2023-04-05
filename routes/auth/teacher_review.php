<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherReviewController;

Route::prefix('teacher-review')->group(function () {
    Route::get('', [TeacherReviewController::class, 'index'])->name('teacher_review');
    Route::get('/{id}/show', [TeacherReviewController::class, 'show'])->name('show.teacher_review');
    Route::get('/create', [TeacherReviewController::class, 'create'])->name('create.teacher_review');
    Route::post('/store', [TeacherReviewController::class, 'store'])->name('store.teacher_review');
    Route::get('/{id}/edit', [TeacherReviewController::class, 'edit'])->name('edit.teacher_review');
    Route::post('/{id}/update', [TeacherReviewController::class, 'update'])->name('update.teacher_review');
    Route::post('/{id}/delete', [TeacherReviewController::class, 'destroy'])->name('delete.teacher_review');
    Route::get('/trashed', [TeacherReviewController::class, 'trashed'])->name('trashed.teacher_review');
    Route::get('/{id}/restore', [TeacherReviewController::class, 'restore'])->name('restore.teacher_review');
    Route::post('/{id}/permanent-delete', [TeacherReviewController::class, 'permanentDelete'])->name('permanent_delete.teacher_review');
});