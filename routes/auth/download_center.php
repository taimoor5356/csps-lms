<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadCenterController;

Route::prefix('download-center')->group(function () {
    Route::get('', [DownloadCenterController::class, 'index'])->name('download_center');
    Route::get('/{id}/show', [DownloadCenterController::class, 'show'])->name('show.download_center');
    Route::get('/create', [DownloadCenterController::class, 'create'])->name('create.download_center');
    Route::post('/store', [DownloadCenterController::class, 'store'])->name('store.download_center');
    Route::get('/{id}/edit', [DownloadCenterController::class, 'edit'])->name('edit.download_center');
    Route::post('/{id}/update', [DownloadCenterController::class, 'update'])->name('update.download_center');
    Route::post('/{id}/delete', [DownloadCenterController::class, 'destroy'])->name('delete.download_center');
    Route::get('/trashed', [DownloadCenterController::class, 'trashed'])->name('trashed.download_center');
    Route::get('/{id}/restore', [DownloadCenterController::class, 'restore'])->name('restore.download_center');
    Route::post('/{id}/permanent-delete', [DownloadCenterController::class, 'permanentDelete'])->name('permanent_delete.download_center');
});