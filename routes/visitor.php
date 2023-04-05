<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;

Route::get('/visitors/create', [VisitorController::class, 'create'])->name('create.visitor');
Route::post('/visitors/store', [VisitorController::class, 'store'])->name('store.visitor');