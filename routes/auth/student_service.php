<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentServicesController;

Route::prefix('student-services')->group(function () {
    Route::get('', [StudentServicesController::class, 'index'])->name('student_services');
    Route::get('/{id}/show', [StudentServicesController::class, 'show'])->name('show.student_services');
    Route::get('/create', [StudentServicesController::class, 'create'])->name('create.student_services');
    Route::post('/store', [StudentServicesController::class, 'store'])->name('store.student_services');
    Route::get('/{id}/edit', [StudentServicesController::class, 'edit'])->name('edit.student_services');
    Route::post('/{id}/update', [StudentServicesController::class, 'update'])->name('update.student_services');
    Route::post('/{id}/delete', [StudentServicesController::class, 'destroy'])->name('delete.student_services');
    Route::get('/trashed', [StudentServicesController::class, 'trashed'])->name('trashed.student_services');
    Route::get('/{id}/restore', [StudentServicesController::class, 'restore'])->name('restore.student_services');
    Route::post('/{id}/permanent-delete', [StudentServicesController::class, 'permanentDelete'])->name('permanent_delete.student_services');
});