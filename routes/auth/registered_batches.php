<?php

use App\Http\Controllers\RegisteredNumberController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'registered', 'middleware' => ['role:admin']], function () {
    Route::post('/fetch-batch-numbers', [RegisteredNumberController::class, 'fetchBatchNumbers'])->name('fetch_batch_nos');
    Route::post('/lastregistrationnumber', [RegisteredNumberController::class, 'fetchLastRegistrationNumber'])->name('lastregistrationnumber');
    Route::get('/registration-setting', [RegisteredNumberController::class, 'index'])->name('settings.registration_settings');
    Route::get('/batch-numbers/{id}/show', [RegisteredNumberController::class, 'show'])->name('show.batch_numbers');
    Route::get('/batch-numbers/create', [RegisteredNumberController::class, 'create'])->name('create.batch_numbers');
    Route::post('/batch-numbers/store', [RegisteredNumberController::class, 'store'])->name('store.batch_numbers');
    Route::get('/batch-numbers/{id}/edit', [RegisteredNumberController::class, 'edit'])->name('edit.batch_numbers');
    Route::post('/batch-numbers/{id}/update', [RegisteredNumberController::class, 'update'])->name('update.batch_numbers');
    Route::post('/batch-numbers/{id}/delete', [RegisteredNumberController::class, 'destroy'])->name('delete.batch_numbers');
    Route::get('/batch-numbers/trashed', [RegisteredNumberController::class, 'trashed'])->name('trashed.batch_numbers');
    Route::get('/batch-numbers/{id}/restore', [RegisteredNumberController::class, 'restore'])->name('restore.batch_numbers');
    Route::post('/batch-numbers/{id}/permanent-delete', [RegisteredNumberController::class, 'permanentDelete'])->name('permanent_delete.batch_numbers');
});
