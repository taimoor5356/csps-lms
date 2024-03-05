<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::group(['prefix' => 'roles'], function () {
    Route::get('', [RoleController::class, 'index'])->name('roles')->middleware('permission:roles_view');
    Route::get('/{id}/show', [RoleController::class, 'show'])->name('show.role')->middleware('permission:roles_view');
    Route::get('/create', [RoleController::class, 'create'])->name('create.role')->middleware('permission:roles_create');
    Route::post('/store', [RoleController::class, 'store'])->name('store.role')->middleware('permission:roles_create');
    Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit.role')->middleware('permission:roles_update');
    Route::post('/{id}/update', [RoleController::class, 'update'])->name('update.role')->middleware('permission:roles_update');
    Route::post('/{id}/delete', [RoleController::class, 'destroy'])->name('delete.role')->middleware('permission:roles_delete');
    Route::post('/assign-permission-to-role', [RoleController::class, 'assignPermissionToRole'])->name('assign_permission_to_role')->middleware('permission:roles_delete');
});
