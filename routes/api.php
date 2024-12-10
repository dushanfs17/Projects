<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactFormController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Routes for Contact Form
Route::post('contact-form', [ContactFormController::class, 'store']);
Route::put('contact-form/{id}/update', [ContactFormController::class, 'update']);
Route::delete('contact-form/{id}/delete', [ContactFormController::class, 'destroy']);
Route::get('contact-form/{id}/show', [ContactFormController::class, 'show']);
