<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuggestionsController;

Route::prefix('suggestions')->group(function () {
    Route::get('', [SuggestionsController::class, 'index'])->name('suggestions');
    Route::get('/{id}/show', [SuggestionsController::class, 'show'])->name('show.suggestions');
    Route::get('/create', [SuggestionsController::class, 'create'])->name('create.suggestions');
    Route::post('/store', [SuggestionsController::class, 'store'])->name('store.suggestions');
    Route::get('/{id}/edit', [SuggestionsController::class, 'edit'])->name('edit.suggestions');
    Route::post('/{id}/update', [SuggestionsController::class, 'update'])->name('update.suggestions');
    Route::post('/{id}/delete', [SuggestionsController::class, 'destroy'])->name('delete.suggestions');
    Route::get('/trashed', [SuggestionsController::class, 'trashed'])->name('trashed.suggestions');
    Route::get('/{id}/restore', [SuggestionsController::class, 'restore'])->name('restore.suggestions');
    Route::post('/{id}/permanent-delete', [SuggestionsController::class, 'permanentDelete'])->name('permanent_delete.suggestions');
});