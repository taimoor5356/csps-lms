<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'expenses'], function () {
    Route::get('', [ExpenseController::class, 'index'])->name('expenses')->middleware('permission:expense_view');
    Route::get('/create', [ExpenseController::class, 'create'])->name('create.expense')->middleware('permission:expense_create');
    Route::post('/store', [ExpenseController::class, 'store'])->name('store.expense')->middleware('permission:expense_create');
    Route::get('/{id}/edit', [ExpenseController::class, 'edit'])->name('edit.expense')->middleware('permission:expense_update');
    Route::post('/{id}/update', [ExpenseController::class, 'update'])->name('update.expense')->middleware('permission:expense_update');
    Route::get('/trashed', [ExpenseController::class, 'trashed'])->name('trashed.expenses')->middleware('permission:expense_delete');
});