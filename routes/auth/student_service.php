<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentServicesController;

Route::group(['prefix' => 'student-services'], function () {
    Route::get('', [StudentServicesController::class, 'index'])->name('student_services')->middleware('permission:student_view');
    Route::get('/{id}/show', [StudentServicesController::class, 'show'])->name('show.student_services')->middleware('permission:student_view');
    Route::get('/create', [StudentServicesController::class, 'create'])->name('create.student_services')->middleware('permission:student_view');
    Route::post('/store', [StudentServicesController::class, 'store'])->name('store.student_services')->middleware('permission:student_view');
    Route::get('/{id}/edit', [StudentServicesController::class, 'edit'])->name('edit.student_services')->middleware('permission:student_view');
    Route::post('/{id}/update', [StudentServicesController::class, 'update'])->name('update.student_services')->middleware('permission:student_view');
    Route::post('/{id}/delete', [StudentServicesController::class, 'destroy'])->name('delete.student_services')->middleware('permission:student_view');
    Route::get('/trashed', [StudentServicesController::class, 'trashed'])->name('trashed.student_services')->middleware('permission:student_view');
    Route::get('/{id}/restore', [StudentServicesController::class, 'restore'])->name('restore.student_services')->middleware('permission:student_view');
    Route::post('/{id}/permanent-delete', [StudentServicesController::class, 'permanentDelete'])->name('permanent_delete.student_services')->middleware('permission:student_view');
});