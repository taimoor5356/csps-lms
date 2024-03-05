<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterviewController;

Route::group(['prefix' => 'interviews'], function () {
    Route::get('/students', [InterviewController::class, 'index'])->name('interview.students')->middleware('permission:enrollment_view');
    Route::get('/student/{id}/show', [InterviewController::class, 'show'])->name('show.interview')->middleware('permission:enrollment_view');
    Route::get('/student/create', [InterviewController::class, 'create'])->name('create.interview')->middleware('permission:enrollment_view');
    Route::post('/student/store', [InterviewController::class, 'store'])->name('store.interview')->middleware('permission:enrollment_view');
});