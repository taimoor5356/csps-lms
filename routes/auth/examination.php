<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExaminationsController;

Route::group(['prefix' => 'examinations'], function () {
    Route::get('', [ExaminationsController::class, 'index'])->name('examinations')->middleware('permission:examination_view');
    Route::get('/{id}/show', [ExaminationsController::class, 'show'])->name('show.examinations')->middleware('permission:examination_view');
    Route::get('/create', [ExaminationsController::class, 'create'])->name('create.examinations')->middleware('permission:examination_create');
    Route::post('/store', [ExaminationsController::class, 'store'])->name('store.examinations')->middleware('permission:examination_create');
    Route::get('/{id}/edit', [ExaminationsController::class, 'edit'])->name('edit.examinations')->middleware('permission:examination_update');
    Route::post('/{id}/update', [ExaminationsController::class, 'update'])->name('update.examinations')->middleware('permission:examination_update');
    Route::post('/{id}/delete', [ExaminationsController::class, 'destroy'])->name('delete.examinations')->middleware('permission:examination_delete');
    Route::get('/trashed', [ExaminationsController::class, 'trashed'])->name('trashed.examinations')->middleware('permission:examination_delete');
    Route::get('/{id}/restore', [ExaminationsController::class, 'restore'])->name('restore.examinations')->middleware('permission:examination_delete');
    Route::post('/{id}/permanent-delete', [ExaminationsController::class, 'permanentDelete'])->name('permanent_delete.examinations')->middleware('permission:examination_delete');
});