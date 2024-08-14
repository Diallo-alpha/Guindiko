<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SessionMentoratController;
use App\Http\Controllers\MentorController;


Route::get('/user', function (Request $request) {
    return $request->user();
});

// Routes d'authentification
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);

// Groupement des routes nécessitant l'authentification via l'API
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/admin/mentor/{id}/valider', [AdminController::class, 'validerMentor'])->name('admin.validerMentor');
    Route::delete('/admin/mentor/{id}/supprimer', [AdminController::class, 'supprimerMentor'])->name('admin.supprimerMentor');
    Route::apiResource('domaines', DomaineController::class);
    Route::apiResource('formations', FormationController::class);
    Route::apiResource('forums', ForumController::class);
});
Route::middleware(['auth:api', 'role:mentor'])->group(function () {
    Route::post('mentorats/{demandeMentorat}/accepter', [MentorController::class, 'accepterDemandeMentorat']);
    Route::post('mentorats/session', [MentorController::class, 'creerSessionMentorat']);
    Route::apiResource('ressources', RessourceController::class);
    Route::apiResource('session-mentorats', SessionMentoratController::class);
    Route::post('mentorats/{demandeMentorat}/refuser', [MentorController::class, 'refuserDemandeMentorat']);
});

Route::middleware(['auth:api', 'role:mentee'])->group(function () {
    Route::post('/mentees/request-mentorship', [MentorController::class, 'envoyerDemandeMentorat'])->name('mentees.requestMentorship');
    Route::post('mentorats/{mentor}/demande', [MentorController::class, 'envoyerDemandeMentorat']);
    Route::apiResource('commentaires', CommentaireController::class);
    Route::apiResource('reservations', ReservationController::class);
});

