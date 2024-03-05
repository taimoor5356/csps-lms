<?php

use App\Http\Controllers\FeePlanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'revenue'], function () {
    Route::get('/fee-collection', [FeePlanController::class, 'index'])->name('fee_collection')->middleware('permission:examination_view');
    Route::post('/send-fee-reminder/{student_id}', [FeePlanController::class, 'sendFeeReminder'])->name('send_fee_reminder')->middleware('permission:revenue_update');
});