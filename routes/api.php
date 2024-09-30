<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth api
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'login']);
});


Route::group([
    'middleware' => 'auth:sanctum',
], function () {

    // Get user info
    Route::get('/user-info', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('project', ProjectController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('task', TaskController::class);
});
