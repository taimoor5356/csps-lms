<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'attendance'], function () {
    Route::get('/{user_type?}/{id?}', [AttendanceController::class, 'index'])->name('attendances')->middleware('permission:attendance_view');
    Route::post('/mark-attendance', [AttendanceController::class, 'markAttendance'])->name('mark_attendance')->middleware('permission:attendance_view');
});