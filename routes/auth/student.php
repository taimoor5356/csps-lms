<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::group(['prefix' => 'students', 'middleware' => ['role:admin|student']], function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student_dashboard');
    Route::get('', [StudentController::class, 'index'])->name('students');
    Route::get('/{id}/show', [StudentController::class, 'show'])->name('show.student');
    Route::get('/create', [StudentController::class, 'create'])->name('create.student')->middleware('role:admin');
    Route::post('/store', [StudentController::class, 'store'])->name('store.student');
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit.student');
    Route::post('/{id}/update', [StudentController::class, 'update'])->name('update.student');
    Route::post('/{id}/delete', [StudentController::class, 'destroy'])->name('delete.student');
    Route::get('/trashed', [StudentController::class, 'trashed'])->name('trashed.students');
    Route::get('/{id}/restore', [StudentController::class, 'restore'])->name('restore.student');
    Route::post('/{id}/permanent-delete', [StudentController::class, 'permanentDelete'])->name('permanent_delete.student');
});
