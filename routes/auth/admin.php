<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;

Route::group(['prefix' => 'admins', 'middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('', [AdminController::class, 'index'])->name('admins');
    Route::get('/{id}/show', [AdminController::class, 'show'])->name('show.admin');
    Route::get('/create', [AdminController::class, 'create'])->name('create.admin');
    Route::post('/store', [AdminController::class, 'store'])->name('store.admin');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit.admin');
    Route::post('/{id}/update', [AdminController::class, 'update'])->name('update.admin');
    Route::post('/{id}/delete', [AdminController::class, 'destroy'])->name('delete.admin');
    Route::get('/trashed', [AdminController::class, 'trashed'])->name('trashed.admins');
    Route::get('/{id}/restore', [AdminController::class, 'restore'])->name('restore.admin');
    Route::post('/{id}/permanent-delete', [AdminController::class, 'permanentDelete'])->name('permanent_delete.admin');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.admin');
});
