<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RevisionClassController;

Route::group(['prefix' => 'revision-classes'], function () {
    Route::get('', [RevisionClassController::class, 'index'])->name('revision_classes')->middleware('permission:enrollment_view');
    Route::post('/store', [RevisionClassController::class, 'store'])->name('store.revision_classes')->middleware('permission:enrollment_create');
});
