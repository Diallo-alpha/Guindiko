<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\MenteeController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\NotificationReservationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\SessionMentoratController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
});

// Routes d'authentification
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

//login
// Route::post('/login', function () {

// })->name('login');
//logout
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
Route::middleware('auth:api')->group(function () {
    Route::apiResource('reservations', ReservationController::class);
    Route::post('mentorats/devenir', [MentorController::class, 'DevenirMentor'])->name('mentorats.devenir');
    Route::post('/profile/modifier', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/supprimer', [AuthController::class, 'effacerChampsProfile'])->name('profile.clear');

});
Route::apiResource('ressources', RessourceController::class);
Route::apiResource('session-mentorats', SessionMentoratController::class);
Route::apiResource('domaines', DomaineController::class);
Route::get('formations', [FormationController::class, 'index']);
Route::get('formations/{id}', [FormationController::class, 'show']);
Route::get('/domaines/{domaine_id}/formations', [FormationController::class, 'formationsByDomaine']);
Route::get('mentors', [AdminController::class, 'afficherMentors'])->name('admin.afficherMentors');
Route::get('mentees', [AdminController::class, 'afficherMentees'])->name('admin.afficherMentees');
Route::get('sessions/{sessionId}/ressources', [AdminController::class, 'afficherRessourcesSession'])->name('admin.afficherRessourcesSession');


//aficher domain public
Route::get('/domaines', [DomaineController::class, 'index']);
Route::get('domaines/{id}', [DomaineController::class, 'show']);
Route::get('/mentor/{mentorId}/sessions', [SessionMentoratController::class, 'afficherSessionsMentor']);
Route::get('mentor/{mentorId}/demandes-acceptees', [MentorController::class, 'afficherDemandesAccepteesPourMentor'])->name('mentor.demandes.acceptees.mentor');
Route::get('Articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('Articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
//devenir un mentor
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    //valider un mentor
    Route::post('/admin/mentor/{id}/valider', [AdminController::class, 'validerMentor'])->name('admin.validerMentor');
    // Suspendre un utilisateur
    Route::post('/admin/utilisateur/{id}/suspendre', [AdminController::class, 'suspendreUtilisateur'])->name('admin.suspendreUtilisateur');
    // Créer une nouvelle formation
    Route::post('/formations', [FormationController::class, 'store']);
    Route::put('/formations/{id}', [FormationController::class, 'update']);
    Route::delete('/formations/{id}', [FormationController::class, 'destroy']);
    //ajouter des domaine
    Route::post('/domaines', [DomaineController::class, 'store']);
    Route::put('/domaines/{id}', [DomaineController::class, 'update']);
    //afficher les demande
    Route::get('admin/demandes-mentor', [AdminController::class, 'afficherDemandesMentorat'])->name('admin.demandes-mentorat');
});
Route::middleware(['auth:api', 'role:mentor'])->group(function () {
    Route::post('mentorats/{demandeMentorat}/accepter', [MentorController::class, 'accepterDemandeMentorat']);
    Route::post('mentorats/session', [MentorController::class, 'creerSessionMentorat']);
    Route::apiResource('ressources', RessourceController::class);
    Route::apiResource('session-mentorats', SessionMentoratController::class);
    Route::post('mentorats/{demandeMentorat}/refuser', [MentorController::class, 'refuserDemandeMentorat']);
    Route::get('mentor/demandes-recues', [MentorController::class, 'afficherDemandesRecues'])->name('mentor.demandes.recues');
    Route::post('ajouter/article', [ArticleController::class, 'store'])->name('article.store');
    Route::patch('modifier/article/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('supprimer/{id}/article', [ArticleController::class, 'destroy'])->name('article.destroy');

});

Route::middleware(['auth:api', 'role:mentee'])->group(function () {
    Route::post('mentorats/{mentor}/demande', [MenteeController::class, 'envoyerDemandeMentorat']);
    Route::apiResource('commentaires', CommentaireController::class);
    Route::apiResource('reservations', ReservationController::class);
});
Route::get('/notifications', [NotificationReservationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read', [NotificationReservationController::class, 'markAsRead'])->name('notifications.markAsRead');
