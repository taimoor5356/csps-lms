<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RevisionClassController;

Route::prefix('revision-classes')->group(function () {
    Route::get('', [RevisionClassController::class, 'index'])->name('revision_classes');
    Route::post('/store', [RevisionClassController::class, 'store'])->name('store.revision_classes');
});
