<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


// CRUD
Route::prefix('tasks')->group(function () {
    Route::get('/index', [TaskController::class, 'index']);
    Route::get('/{id}', [TaskController::class, 'show']);
    Route::post('/store', [TaskController::class, 'store']);
    Route::put('/update/{id}', [TaskController::class, 'update']);
    Route::delete('/destroy/{id}', [TaskController::class, 'destroy']);
});
