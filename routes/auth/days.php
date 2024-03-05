<?php

use App\Http\Controllers\DayController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'days'], function () {
    Route::get('/', [DayController::class, 'index'])->name('days')->middleware('permission:admin_view');
    Route::get('/{id}/course-shifts', [DayController::class, 'courseShifts'])->name('day.course_shifts')->middleware('permission:admin_view');
});