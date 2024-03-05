<?php

use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'shifts'], function () {
    Route::get('/', [ShiftController::class, 'index'])->name('shifts')->middleware('permission:enrollment_view');
});
