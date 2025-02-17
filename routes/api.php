<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Routes
Route::prefix('v1')->group(function () {
    // Projects
    Route::apiResource('projects', ProjectController::class)->only(['index', 'store']);

    // Categories
    Route::apiResource('categories', CategoryController::class)->only(['index', 'store']);

    // Tasks
    Route::apiResource('tasks', TaskController::class)->only(['index', 'store']);
    Route::patch('tasks/{task}/complete', [TaskController::class, 'complete']);
});
