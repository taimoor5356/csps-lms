<?php

use App\Http\Controllers\AssignmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('assignments')->group(function() {
    Route::get('/{user_type?}/{user_id?}', [AssignmentController::class, 'index'])->name('assignments');
    Route::get('/file/{id}/download-file', [AssignmentController::class, 'downloadAssignment'])->name('assignment.download');
    Route::get('/file/{id}/status/{status}', [AssignmentController::class, 'updateAssignmentStatus'])->name('update_assignment_status');
});