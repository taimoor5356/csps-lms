<?php

use App\Http\Controllers\AssignmentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'assignments'], function () {
    Route::post('/store', [AssignmentController::class, 'store'])->name('assignments.store')->middleware('permission:assignment_create');
    Route::get('/{user_type?}/{user_id?}', [AssignmentController::class, 'index'])->name('assignments')->middleware('permission:assignment_view');
    Route::get('/file/{id}/download-file', [AssignmentController::class, 'downloadAssignment'])->name('assignment.download')->middleware('permission:assignment_view');
    Route::get('/file/{id}/status/{status}', [AssignmentController::class, 'updateAssignmentStatus'])->name('update_assignment_status')->middleware('permission:assignment_view');
});