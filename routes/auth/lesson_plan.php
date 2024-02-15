<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonPlanController;

Route::prefix('lessons')->group(function () {
    Route::get('', [LessonPlanController::class, 'index'])->name('lesson_plans');
});