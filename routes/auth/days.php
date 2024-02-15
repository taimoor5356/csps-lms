<?php

use App\Http\Controllers\DayController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'days', 'middleware' => ['role:admin']], function () {
    Route::get('/', [DayController::class, 'index'])->name('days');
    Route::get('/{id}/course-shifts', [DayController::class, 'courseShifts'])->name('day.course_shifts');
});