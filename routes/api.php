<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenteeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\SessionMentoratMenteeController;
use App\Http\Controllers\SessionMentoratController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});
Route::apiResource('reservations', ReservationController::class);
Route::apiResource('ressources', RessourceController::class);
Route::apiResource('session-mentorats', SessionMentoratController::class);
Route::post('/mentees/request-mentorship', [MenteeController::class, 'requestMentorship'])->name('mentees.requestMentorship');

