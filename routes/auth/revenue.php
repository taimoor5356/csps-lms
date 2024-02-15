<?php

use App\Http\Controllers\FeePlanController;
use Illuminate\Support\Facades\Route;

Route::prefix('revenue')->group(function () {
    Route::get('/fee-collection', [FeePlanController::class, 'index'])->name('fee_collection');
    Route::post('/send-fee-reminder/{student_id}', [FeePlanController::class, 'sendFeeReminder'])->name('send_fee_reminder');
});