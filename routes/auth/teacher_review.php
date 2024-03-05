<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherReviewController;

Route::group(['prefix' => 'teacher-review'], function () {
    Route::get('', [TeacherReviewController::class, 'index'])->name('teacher_review')->middleware('permission:teacher_view');
    Route::post('/store', [TeacherReviewController::class, 'store'])->name('store.teacher_review')->middleware('permission:teacher_view');
});