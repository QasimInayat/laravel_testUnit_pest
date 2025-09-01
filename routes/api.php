<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/todos', [\App\Http\Controllers\TodoController::class, 'store']);
Route::get('/todos', [\App\Http\Controllers\TodoController::class, 'index']);
