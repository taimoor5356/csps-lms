<?php

use App\Http\Controllers\RegisteredNumberController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'registration'], function () {
    Route::post('/fetch-batch-numbers', [RegisteredNumberController::class, 'fetchBatchNumbers'])->name('fetch_batch_nos')->middleware('permission:enrollment_view');
    Route::post('/lastregistrationnumber', [RegisteredNumberController::class, 'fetchLastRegistrationNumber'])->name('lastregistrationnumber')->middleware('permission:enrollment_view');
    Route::get('/setting', [RegisteredNumberController::class, 'index'])->name('settings.registration_settings')->middleware('permission:enrollment_view');
    Route::get('/batch-numbers/{id}/show', [RegisteredNumberController::class, 'show'])->name('show.batch_numbers')->middleware('permission:enrollment_view');
    Route::get('/batch-numbers/create', [RegisteredNumberController::class, 'create'])->name('create.batch_numbers')->middleware('permission:enrollment_create');
    Route::post('/batch-numbers/store', [RegisteredNumberController::class, 'store'])->name('store.batch_numbers')->middleware('permission:enrollment_create');
    Route::get('/batch-numbers/{id}/edit', [RegisteredNumberController::class, 'edit'])->name('edit.batch_numbers')->middleware('permission:enrollment_update');
    Route::post('/batch-numbers/{id}/update', [RegisteredNumberController::class, 'update'])->name('update.batch_numbers')->middleware('permission:enrollment_update');
    Route::post('/batch-numbers/{id}/delete', [RegisteredNumberController::class, 'destroy'])->name('delete.batch_numbers')->middleware('permission:enrollment_delete');
    Route::get('/batch-numbers/trashed', [RegisteredNumberController::class, 'trashed'])->name('trashed.batch_numbers')->middleware('permission:enrollment_delete');
    Route::get('/batch-numbers/{id}/restore', [RegisteredNumberController::class, 'restore'])->name('restore.batch_numbers')->middleware('permission:enrollment_delete');
    Route::post('/batch-numbers/{id}/permanent-delete', [RegisteredNumberController::class, 'permanentDelete'])->name('permanent_delete.batch_numbers')->middleware('permission:enrollment_delete');
});
