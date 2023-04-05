<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;


Route::prefix('visitors')->group(function () {
    Route::get('', [VisitorController::class, 'index'])->name('visitors');
    Route::get('/{id}/show', [VisitorController::class, 'show'])->name('show.visitor');
    Route::get('/{id}/edit', [VisitorController::class, 'edit'])->name('edit.visitor');
    Route::post('/{id}/update', [VisitorController::class, 'update'])->name('update.visitor');
    Route::post('/{id}/delete', [VisitorController::class, 'destroy'])->name('delete.visitor');
    Route::get('/trashed', [VisitorController::class, 'trashed'])->name('trashed.visitor');
    Route::get('/{id}/restore', [VisitorController::class, 'restore'])->name('restore.visitor');
    Route::post('/{id}/permanent-delete', [VisitorController::class, 'permanentDelete'])->name('permanent_delete.visitor');
});
