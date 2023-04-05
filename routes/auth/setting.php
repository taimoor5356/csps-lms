<?php
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'settings', 'middleware' => ['role:admin']], function () {
    Route::get('/', [SettingController::class, 'index'])->name('settings');
    Route::get('/seminar-dates', [SettingController::class, 'seminarDates'])->name('settings.seminar_dates');
    Route::post('/update-settings', [SettingController::class, 'updateSettings'])->name('settings.update_settings');
});