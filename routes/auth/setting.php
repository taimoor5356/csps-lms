<?php
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'settings'], function () {
    Route::get('/', [SettingController::class, 'index'])->name('settings')->middleware('permission:admin_view');
    Route::get('/seminar-dates', [SettingController::class, 'seminarDates'])->name('settings.seminar_dates')->middleware('permission:admin_view');
    Route::post('/update-settings', [SettingController::class, 'updateSettings'])->name('settings.update_settings')->middleware('permission:admin_view');
});