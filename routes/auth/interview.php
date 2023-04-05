<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterviewController;

Route::prefix('interviews')->group(function() {
    Route::get('/students', [InterviewController::class, 'index'])->name('interview.students');
    Route::get('/student/{id}/show', [InterviewController::class, 'show'])->name('show.interview');
    Route::get('/student/create', [InterviewController::class, 'create'])->name('create.interview');
    Route::post('/student/store', [InterviewController::class, 'store'])->name('store.interview');
});