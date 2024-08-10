<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\FormationController;

// Route protégée pour récupérer l'utilisateur authentifié
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Définir les routes pour le contrôleur Domaine
Route::apiResource('domaines', DomaineController::class);

// Définir les routes pour le contrôleur Formation
Route::apiResource('formations', FormationController::class);
