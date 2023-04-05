<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticeBoardController;

Route::prefix('notice-board')->group(function () {
    Route::get('', [NoticeBoardController::class, 'index'])->name('notice_board');
    Route::get('/{id}/show', [NoticeBoardController::class, 'show'])->name('show.notice_board');
    Route::get('/create', [NoticeBoardController::class, 'create'])->name('create.notice_board');
    Route::post('/store', [NoticeBoardController::class, 'store'])->name('store.notice_board');
    Route::get('/{id}/edit', [NoticeBoardController::class, 'edit'])->name('edit.notice_board');
    Route::post('/{id}/update', [NoticeBoardController::class, 'update'])->name('update.notice_board');
    Route::post('/{id}/delete', [NoticeBoardController::class, 'destroy'])->name('delete.notice_board');
    Route::get('/trashed', [NoticeBoardController::class, 'trashed'])->name('trashed.notice_board');
    Route::get('/{id}/restore', [NoticeBoardController::class, 'restore'])->name('restore.notice_board');
    Route::post('/{id}/permanent-delete', [NoticeBoardController::class, 'permanentDelete'])->name('permanent_delete.notice_board');
});