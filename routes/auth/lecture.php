<?php

use App\Http\Controllers\LectureScheduleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'lectures'], function () {
    Route::get('/{id}/schedules', [LectureScheduleController::class, 'index'])->name('lecture_schedules')->middleware('permission:lecture_schedule_view');
});