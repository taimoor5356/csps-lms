<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MockScheduleController;

Route::prefix('mock-schedule')->group(function () {
    Route::get('', [MockScheduleController::class, 'index'])->name('mock_schedule');
    Route::post('/store', [MockScheduleController::class, 'store'])->name('store.mock_schedule');
});