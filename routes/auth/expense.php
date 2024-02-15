<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::prefix('expenses')->group(function () {
    Route::get('', [ExpenseController::class, 'index'])->name('expenses');
    Route::get('/create', [ExpenseController::class, 'create'])->name('create.expense');
    Route::post('/store', [ExpenseController::class, 'store'])->name('store.expense');
    Route::get('/{id}/edit', [ExpenseController::class, 'edit'])->name('edit.expense');
    Route::post('/{id}/update', [ExpenseController::class, 'update'])->name('update.expense');
    Route::get('/trashed', [ExpenseController::class, 'trashed'])->name('trashed.expenses');
});