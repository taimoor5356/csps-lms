<?php

use App\Http\Controllers\RegisteredYearContoller;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'settings'], function () {
    Route::get('/registered-years', [RegisteredYearContoller::class, 'index'])->name('registered_years')->middleware('permission:enrollment_view');
    Route::get('/registered-years/{id}/show', [RegisteredYearContoller::class, 'show'])->name('registered_year')->middleware('permission:enrollment_view');
    Route::post('/registered-years/store', [RegisteredYearContoller::class, 'store'])->name('regsitered_year.store')->middleware('permission:enrollment_create');
    Route::post('/registered-years/update', [RegisteredYearContoller::class, 'update'])->name('registered_year.update')->middleware('permission:enrollment_update');
    Route::get('/registered-years/{id}/delete', [RegisteredYearContoller::class, 'delete'])->name('registered_year.delete')->middleware('permission:enrollment_delete');
});
