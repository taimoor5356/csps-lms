<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;

Route::group(['prefix' => 'admins'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('', [AdminController::class, 'index'])->name('admins')->middleware('permission:admin_view');
    Route::get('/{id}/show', [AdminController::class, 'show'])->name('show.admin')->middleware('permission:admin_view');
    Route::get('/create', [AdminController::class, 'create'])->name('create.admin')->middleware('permission:admin_create');
    Route::post('/store', [AdminController::class, 'store'])->name('store.admin')->middleware('permission:admin_create');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit.admin')->middleware('permission:admin_update');
    Route::post('/{id}/update', [AdminController::class, 'update'])->name('update.admin')->middleware('permission:admin_update');
    Route::post('/{id}/delete', [AdminController::class, 'destroy'])->name('delete.admin')->middleware('permission:admin_delete');
    Route::get('/trashed', [AdminController::class, 'trashed'])->name('trashed.admins')->middleware('permission:admin_delete');
    Route::get('/{id}/restore', [AdminController::class, 'restore'])->name('restore.admin')->middleware('permission:admin_delete');
    Route::post('/{id}/permanent-delete', [AdminController::class, 'permanentDelete'])->name('permanent_delete.admin')->middleware('permission:admin_delete');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.admin')->middleware('permission:admin_delete');
    Route::get('/{id}/approve', [AdminController::class, 'userApproval'])->name('approval.admins')->middleware('permission:admin_delete');
    Route::get('/{id}/block', [AdminController::class, 'userBlock'])->name('block.admins')->middleware('permission:admin_delete');
});
