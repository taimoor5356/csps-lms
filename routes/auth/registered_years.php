<?php

use App\Http\Controllers\RegisteredYearContoller;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'settings', 'middleware' => ['role:admin']], function () {
    Route::get('/registered-years', [RegisteredYearContoller::class, 'index'])->name('registered_years');
    Route::get('/registered-years/{id}/show', [RegisteredYearContoller::class, 'show'])->name('registered_year');
    Route::post('/registered-years/store', [RegisteredYearContoller::class, 'store'])->name('regsitered_year.store');
    Route::post('/registered-years/{id}/update', [RegisteredYearContoller::class, 'update'])->name('registered_year.update');
    Route::get('/registered-years/{id}/delete', [RegisteredYearContoller::class, 'delete'])->name('registered_year.delete');
});
