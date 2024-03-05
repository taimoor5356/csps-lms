<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuggestionsController;

Route::group(['prefix' => 'suggestions'], function () {
    Route::get('', [SuggestionsController::class, 'index'])->name('suggestions')->middleware('permission:admission_view');
    Route::get('/{id}/show', [SuggestionsController::class, 'show'])->name('show.suggestions')->middleware('permission:admin_delete');
    Route::get('/create', [SuggestionsController::class, 'create'])->name('create.suggestions')->middleware('permission:admin_delete');
    Route::post('/store', [SuggestionsController::class, 'store'])->name('store.suggestions')->middleware('permission:admin_delete');
    Route::get('/{id}/edit', [SuggestionsController::class, 'edit'])->name('edit.suggestions')->middleware('permission:admin_delete');
    Route::post('/{id}/update', [SuggestionsController::class, 'update'])->name('update.suggestions')->middleware('permission:admin_delete');
    Route::post('/{id}/delete', [SuggestionsController::class, 'destroy'])->name('delete.suggestions')->middleware('permission:admin_delete');
    Route::get('/trashed', [SuggestionsController::class, 'trashed'])->name('trashed.suggestions')->middleware('permission:admin_delete');
    Route::get('/{id}/restore', [SuggestionsController::class, 'restore'])->name('restore.suggestions')->middleware('permission:admin_delete');
    Route::post('/{id}/permanent-delete', [SuggestionsController::class, 'permanentDelete'])->name('permanent_delete.suggestions')->middleware('permission:admin_delete');
});