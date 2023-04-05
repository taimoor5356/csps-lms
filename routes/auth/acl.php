<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::prefix('roles')->group(function () {
    Route::get('', [RoleController::class, 'index'])->name('roles')->middleware('can:roles_view');
    Route::get('/{id}/show', [RoleController::class, 'show'])->name('show.role');
    Route::get('/create', [RoleController::class, 'create'])->name('create.role');
    Route::post('/store', [RoleController::class, 'store'])->name('store.role');
    Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit.role');
    Route::post('/{id}/update', [RoleController::class, 'update'])->name('update.role');
    Route::post('/{id}/delete', [RoleController::class, 'destroy'])->name('delete.role');
    Route::post('/assign-permission-to-role', [RoleController::class, 'assignPermissionToRole'])->name('assign_permission_to_role');
});
