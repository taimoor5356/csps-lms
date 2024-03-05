<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;


Route::group(['prefix' => 'visitors'], function () {
    Route::get('', [VisitorController::class, 'index'])->name('visitors')->middleware('permission:users_view');
    Route::get('/{id}/show', [VisitorController::class, 'show'])->name('show.visitor')->middleware('permission:users_view');
    Route::get('/{id}/edit', [VisitorController::class, 'edit'])->name('edit.visitor')->middleware('permission:users_update');
    Route::post('/{id}/update', [VisitorController::class, 'update'])->name('update.visitor')->middleware('permission:users_update');
    Route::post('/{id}/delete', [VisitorController::class, 'destroy'])->name('delete.visitor')->middleware('permission:users_delete');
    Route::get('/trashed', [VisitorController::class, 'trashed'])->name('trashed.visitor')->middleware('permission:users_delete');
    Route::get('/{id}/restore', [VisitorController::class, 'restore'])->name('restore.visitor')->middleware('permission:users_delete');
    Route::post('/{id}/permanent-delete', [VisitorController::class, 'permanentDelete'])->name('permanent_delete.visitor')->middleware('permission:users_delete');
});
