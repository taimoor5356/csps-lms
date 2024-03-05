<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MockScheduleController;

Route::group(['prefix' => 'mock-schedule'], function () {
    Route::get('', [MockScheduleController::class, 'index'])->name('mock_schedule')->middleware('permission:lecture_schedule_view');
    Route::post('/store', [MockScheduleController::class, 'store'])->name('store.mock_schedule')->middleware('permission:lecture_schedule_create');
});