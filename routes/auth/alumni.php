<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;

Route::group(['prefix' => 'alumni'], function () {
    Route::get('', [AlumniController::class, 'index'])->name('alumni')->middleware('permission:student_view');
    Route::get('/{id}/show', [AlumniController::class, 'show'])->name('show.alumni')->middleware('permission:student_view');
    Route::get('/create', [AlumniController::class, 'create'])->name('create.alumni')->middleware('permission:student_create');
    Route::post('/store', [AlumniController::class, 'store'])->name('store.alumni')->middleware('permission:student_create');
    Route::get('/{id}/edit', [AlumniController::class, 'edit'])->name('edit.alumni')->middleware('permission:student_update');
    Route::post('/{id}/update', [AlumniController::class, 'update'])->name('update.alumni')->middleware('permission:student_update');
    Route::post('/{id}/delete', [AlumniController::class, 'destroy'])->name('delete.alumni')->middleware('permission:student_delete');
    Route::get('/trashed', [AlumniController::class, 'trashed'])->name('trashed.alumni')->middleware('permission:student_delete');
    Route::get('/{id}/restore', [AlumniController::class, 'restore'])->name('restore.alumni')->middleware('permission:student_delete');
    Route::post('/{id}/permanent-delete', [AlumniController::class, 'permanentDelete'])->name('permanent_delete.alumni')->middleware('permission:student_delete');
});