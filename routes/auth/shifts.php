<?php

use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'shifts', 'middleware' => ['role:admin']], function () {
    Route::get('/', [ShiftController::class, 'index'])->name('shifts');
});
