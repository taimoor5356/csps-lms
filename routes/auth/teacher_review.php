<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherReviewController;

Route::prefix('teacher-review')->group(function () {
    Route::get('', [TeacherReviewController::class, 'index'])->name('teacher_review');
    Route::post('/store', [TeacherReviewController::class, 'store'])->name('store.teacher_review');
});