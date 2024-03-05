<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'inventory'], function () {
    Route::get('', [InventoryController::class, 'index'])->name('inventory')->middleware('permission:inventory_view');
});