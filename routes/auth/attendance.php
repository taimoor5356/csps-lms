<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::prefix('attendance')->group(function() {
    Route::get('/{user_type?}/{id?}', [AttendanceController::class, 'index'])->name('attendances');
    Route::post('/mark-attendance', [AttendanceController::class, 'markAttendance'])->name('mark_attendance')->middleware('role:admin');
});