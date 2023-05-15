<?php

use App\Http\Controllers\RegisteredNumberController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'registered', 'middleware' => ['role:admin']], function () {
});
