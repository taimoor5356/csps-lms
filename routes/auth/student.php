<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::group(['prefix' => 'students'], function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student_dashboard')->middleware('permission:student_view');
    Route::get('', [StudentController::class, 'index'])->name('students')->middleware('permission:student_view');
    Route::get('/{id}/show', [StudentController::class, 'show'])->name('show.student')->middleware('permission:student_view');
    Route::get('/create', [StudentController::class, 'create'])->name('create.student')->middleware('role:student')->middleware('permission:student_create');
    Route::post('/store', [StudentController::class, 'store'])->name('store.student')->middleware('permission:student_create');
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit.student')->middleware('permission:student_update');
    Route::post('/{id}/update', [StudentController::class, 'update'])->name('update.student')->middleware('permission:student_update');
    Route::post('/{id}/delete', [StudentController::class, 'destroy'])->name('delete.student')->middleware('permission:student_delete');
    Route::get('/trashed', [StudentController::class, 'trashed'])->name('trashed.students')->middleware('permission:student_delete');
    Route::get('/{id}/restore', [StudentController::class, 'restore'])->name('restore.student')->middleware('permission:student_delete');
    Route::post('/{id}/permanent-delete', [StudentController::class, 'permanentDelete'])->name('permanent_delete.student')->middleware('permission:student_delete');
    Route::get('/{id}/update-exam-status', [StudentController::class, 'examPassedStatus'])->name('exam_passed_status')->middleware('permission:student_update');
});
