<?php

use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     // Création des rôles
//     $adminRole = Role::create(['name' => 'admin']);
//     $mentorRole = Role::create(['name' => 'mentor']);
//     $menteeRole = Role::create(['name' => 'mentee']);

//     // Création des permissions
//     $permissions = [
//         // Permissions pour ressource
//         'afficher une ressource',
//         'ajouter une ressource',
//         'modifier une ressource',
//         'supprimer une ressource',
//         // Permissions pour formation
//         'afficher une formation',
//         'ajouter une formation',
//         'modifier une formation',
//         'supprimer une formation',
//         // Permissions pour session
//         'afficher une session',
//         'ajouter une session',
//         // Permissions pour utilisateur
//         'afficher les utilisateurs',
//         "modifier le statut d'un utilisateur",
//         'supprimer un utilisateur',
//         // Permissions pour rôle
//         'afficher une role',
//         'ajouter une role',
//         'modifier une role',
//         'supprimer une role',
//         // Permissions pour permission
//         'afficher une permission',
//         'ajouter une permission',
//         'modifier une permission',
//         'supprimer une permission',
//     ];

//     foreach ($permissions as $permission) {
//         Permission::create(['name' => $permission]);
//     }

//     // Attribution des permissions aux rôles
//     // Le rôle admin obtient toutes les permissions
//     $adminRole->givePermissionTo(Permission::all());

//     // Le rôle mentor obtient les permissions de ressource et de formation
//     $mentorRole->givePermissionTo([
//         'afficher une ressource',
//         'ajouter une ressource',
//         'modifier une ressource',
//         'supprimer une ressource',
//         'afficher une formation',
//         'ajouter une formation',
//         'modifier une formation',
//         'supprimer une formation',
//         'afficher une session',
//         'ajouter une session',
//     ]);

//     // Le rôle mentee obtient uniquement les permissions d'affichage
//     $menteeRole->givePermissionTo([
//         'afficher une ressource',
//         'afficher une formation',
//         'afficher une session',
//     ]);

//     return 'Rôles et permissions créés et assignés avec succès!';
// });
