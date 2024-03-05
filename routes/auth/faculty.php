<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;

Route::group(['prefix' => 'faculty'], function () {
    Route::get('', [FacultyController::class, 'index'])->name('faculty')->middleware('permission:teacher_view');
    Route::post('/store', [FacultyController::class, 'store'])->name('store.faculty')->middleware('permission:teacher_create');
});
