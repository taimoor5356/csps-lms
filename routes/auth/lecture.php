<?php

use App\Http\Controllers\LectureScheduleController;
use Illuminate\Support\Facades\Route;

Route::prefix('lectures')->group(function () {
    Route::get('/{id}/schedules', [LectureScheduleController::class, 'index'])->name('lecture_schedules');
});