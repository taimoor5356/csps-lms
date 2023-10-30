<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LectureScheduleController;

Route::prefix('lecture-schedule')->group(function () {
    Route::get('', [LectureScheduleController::class, 'index'])->name('lecture_schedule');
    Route::post('/store', [LectureScheduleController::class, 'store'])->name('store.lecture_schedule');
});