<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;

Route::group(['prefix' => 'faculty'], function () {
    Route::get('', [FacultyController::class, 'index'])->name('faculty');
    Route::post('/store', [FacultyController::class, 'store'])->name('store.faculty');
});
