<?php

use App\Http\Controllers\RessourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Corrigez ceci
Route::apiResource('ressources', RessourceController::class);
