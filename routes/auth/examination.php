<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExaminationsController;

Route::prefix('examinations')->group(function () {
    Route::get('', [ExaminationsController::class, 'index'])->name('examinations');
    Route::get('/{id}/show', [ExaminationsController::class, 'show'])->name('show.examinations');
    Route::get('/create', [ExaminationsController::class, 'create'])->name('create.examinations');
    Route::post('/store', [ExaminationsController::class, 'store'])->name('store.examinations');
    Route::get('/{id}/edit', [ExaminationsController::class, 'edit'])->name('edit.examinations');
    Route::post('/{id}/update', [ExaminationsController::class, 'update'])->name('update.examinations');
    Route::post('/{id}/delete', [ExaminationsController::class, 'destroy'])->name('delete.examinations');
    Route::get('/trashed', [ExaminationsController::class, 'trashed'])->name('trashed.examinations');
    Route::get('/{id}/restore', [ExaminationsController::class, 'restore'])->name('restore.examinations');
    Route::post('/{id}/permanent-delete', [ExaminationsController::class, 'permanentDelete'])->name('permanent_delete.examinations');
});