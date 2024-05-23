<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth api
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'login']);
});


Route::group([
    'middleware' => 'auth:sanctum'
], function () {

    // Get user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
