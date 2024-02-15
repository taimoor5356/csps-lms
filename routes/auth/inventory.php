<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('inventory')->group(function () {
    Route::get('', [InventoryController::class, 'index'])->name('inventory');
});