<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadCenterController;

Route::group(['prefix' => 'download-center'], function () {
    Route::get('', [DownloadCenterController::class, 'index'])->name('download_center')->middleware('permission:download_center_view');
    Route::get('/{id}/show', [DownloadCenterController::class, 'show'])->name('show.download_center')->middleware('permission:download_center_view');
    Route::get('/create', [DownloadCenterController::class, 'create'])->name('create.download_center')->middleware('permission:download_center_create');
    Route::post('/store', [DownloadCenterController::class, 'store'])->name('store.download_center')->middleware('permission:download_center_create');
    Route::get('/{id}/edit', [DownloadCenterController::class, 'edit'])->name('edit.download_center')->middleware('permission:download_center_update');
    Route::post('/{id}/update', [DownloadCenterController::class, 'update'])->name('update.download_center')->middleware('permission:download_center_update');
    Route::post('/{id}/delete', [DownloadCenterController::class, 'destroy'])->name('delete.download_center')->middleware('permission:download_center_delete');
    Route::get('/trashed', [DownloadCenterController::class, 'trashed'])->name('trashed.download_center')->middleware('permission:download_center_delete');
    Route::get('/{id}/restore', [DownloadCenterController::class, 'restore'])->name('restore.download_center')->middleware('permission:download_center_delete');
    Route::post('/{id}/permanent-delete', [DownloadCenterController::class, 'permanentDelete'])->name('permanent_delete.download_center')->middleware('permission:download_center_delete');
});