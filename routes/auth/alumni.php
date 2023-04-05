<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;

Route::prefix('alumni')->group(function () {
    Route::get('', [AlumniController::class, 'index'])->name('alumni');
    Route::get('/{id}/show', [AlumniController::class, 'show'])->name('show.alumni');
    Route::get('/create', [AlumniController::class, 'create'])->name('create.alumni');
    Route::post('/store', [AlumniController::class, 'store'])->name('store.alumni');
    Route::get('/{id}/edit', [AlumniController::class, 'edit'])->name('edit.alumni');
    Route::post('/{id}/update', [AlumniController::class, 'update'])->name('update.alumni');
    Route::post('/{id}/delete', [AlumniController::class, 'destroy'])->name('delete.alumni');
    Route::get('/trashed', [AlumniController::class, 'trashed'])->name('trashed.alumni');
    Route::get('/{id}/restore', [AlumniController::class, 'restore'])->name('restore.alumni');
    Route::post('/{id}/permanent-delete', [AlumniController::class, 'permanentDelete'])->name('permanent_delete.alumni');
});