<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RessourceController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// Route::middleware('auth:sanctum')->group(function () {
    // Route pour lister les réservations
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('ressources', RessourceController::class);

    // });
