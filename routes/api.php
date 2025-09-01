<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Auth\AuthController;

// Public auth endpoints
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login',    [AuthController::class, 'login']);

// Protected: must send Bearer token
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/auth/user',   [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // You can also restrict by token abilities if you want:
    // Route::apiResource('todos', TodoController::class)->middleware('abilities:todos:read,todos:write');

    Route::apiResource('todos', TodoController::class);
    Route::patch('todos/{id}/toggle', [TodoController::class, 'toggle']); // quick toggle done/undone
});
