<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticeBoardController;

Route::group(['prefix' => 'notice-board'], function () {
    Route::get('', [NoticeBoardController::class, 'index'])->name('notice_board')->middleware('permission:admission_view');
    Route::get('/{id}/show', [NoticeBoardController::class, 'show'])->name('show.notice_board')->middleware('permission:admission_view');
    Route::get('/create', [NoticeBoardController::class, 'create'])->name('create.notice_board')->middleware('permission:admission_create');
    Route::post('/store', [NoticeBoardController::class, 'store'])->name('store.notice_board')->middleware('permission:admission_create');
    Route::get('/{id}/edit', [NoticeBoardController::class, 'edit'])->name('edit.notice_board')->middleware('permission:admission_update');
    Route::post('/{id}/update', [NoticeBoardController::class, 'update'])->name('update.notice_board')->middleware('permission:admission_update');
    Route::get('/{id}/delete', [NoticeBoardController::class, 'destroy'])->name('delete.notice_board')->middleware('permission:admission_delete');
    Route::get('/trashed', [NoticeBoardController::class, 'trashed'])->name('trashed.notice_board')->middleware('permission:admission_delete');
    Route::get('/{id}/restore', [NoticeBoardController::class, 'restore'])->name('restore.notice_board')->middleware('permission:admission_delete');
    Route::post('/{id}/permanent-delete', [NoticeBoardController::class, 'permanentDelete'])->name('permanent_delete.notice_board')->middleware('permission:admission_delete');
    Route::post('/fetch-role-users', [NoticeBoardController::class, 'fetchRoleUsers'])->name('fetch_role_users');
});