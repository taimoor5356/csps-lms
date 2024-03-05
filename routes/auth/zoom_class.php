<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZoomClassesController;

Route::group(['prefix' => 'zoom-classes'], function () {
    Route::get('', [ZoomClassesController::class, 'index'])->name('zoom_classes')->middleware('permission:enrollment_view');
    Route::get('/{id}/show', [ZoomClassesController::class, 'show'])->name('show.zoom_classes')->middleware('permission:enrollment_view');
    Route::get('/create', [ZoomClassesController::class, 'create'])->name('create.zoom_classes')->middleware('permission:enrollment_view');
    Route::post('/store', [ZoomClassesController::class, 'store'])->name('store.zoom_classes')->middleware('permission:enrollment_view');
    Route::get('/{id}/edit', [ZoomClassesController::class, 'edit'])->name('edit.zoom_classes')->middleware('permission:enrollment_view');
    Route::post('/{id}/update', [ZoomClassesController::class, 'update'])->name('update.zoom_classes')->middleware('permission:enrollment_view');
    Route::post('/{id}/delete', [ZoomClassesController::class, 'destroy'])->name('delete.zoom_classes')->middleware('permission:enrollment_view');
    Route::get('/trashed', [ZoomClassesController::class, 'trashed'])->name('trashed.zoom_classes')->middleware('permission:enrollment_view');
    Route::get('/{id}/restore', [ZoomClassesController::class, 'restore'])->name('restore.zoom_classes')->middleware('permission:enrollment_view');
    Route::post('/{id}/permanent-delete', [ZoomClassesController::class, 'permanentDelete'])->name('permanent_delete.zoom_classes')->middleware('permission:enrollment_view');
});