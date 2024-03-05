<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonPlanController;

Route::group(['prefix' => 'lessons'], function () {
    Route::get('', [LessonPlanController::class, 'index'])->name('lesson_plans')->middleware('permission:lecture_schedule_view');
});