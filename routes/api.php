<?php
use App\Http\Controllers\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\SessionMentoratController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SessionMentoratMenteeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MenteeController;

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

Route::get('/mentees/{id}/notifications', [NotificationController::class, 'getNotifications']);


// acceptation ou refus d'une reservations de mentoring

Route::put('/reservations/{id}/accept', [ReservationController::class, 'accept']);
Route::put('/reservations/{id}/reject', [ReservationController::class, 'reject']);
Route::post('/mentees/request-mentorship', [MenteeController::class, 'requestMentorship'])->name('mentees.requestMentorship');
Route::apiResource('domaines', DomaineController::class);

// Définir les routes pour le contrôleur Formation
Route::apiResource('formations', FormationController::class);


// acceptation ou refus d'une demande de mentoring
Route::post('/mentee/request', [MenteeController::class, 'requestMentorships']);
// Route::post('/mentor/respond/{mentee_id}', [MentorController::class, 'respondsToRequest']);
Route::get('/notifications/{mentee_id}', [NotificationController::class, 'getNotifications']);
Route::post('/mentor/respond/{mentee_id}', [MentorController::class, 'respondsToRequest']);
