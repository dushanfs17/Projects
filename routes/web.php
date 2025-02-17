<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::view('/tasks', 'tasks.index');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
