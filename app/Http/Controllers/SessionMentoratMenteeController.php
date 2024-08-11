<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionMentoratMenteeRequest;
use App\Http\Requests\UpdateSessionMentoratMenteeRequest;
use App\Models\SessionMentoratMentee;
use Illuminate\Http\Response;


class SessionMentoratMenteeController extends Controller
{
    /**
     * Affiche une liste de toutes les ressources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Récupère et renvoie toutes les entrées de la table session_mentorat_mentees
        return response()->json(SessionMentoratMentee::all(), 200);
    }

    /**
     * Stocke une nouvelle ressource dans la base de données.
     *
     * @param  \App\Http\Requests\StoreSessionMentoratMenteeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSessionMentoratMenteeRequest $request)
    {
        // Crée une nouvelle entrée dans la table session_mentorat_mentees avec les données validées
        $sessionMentoratMentee = SessionMentoratMentee::create($request->validated());

        // Renvoie une réponse JSON avec les détails de la nouvelle ressource et un statut HTTP 201 Created
        return response()->json([
            'message' => 'Session de mentorat avec le mentee créée avec succès',
            'data' => $sessionMentoratMentee
        ], 201);
    }

    /**
     * Affiche les détails d'une ressource spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Trouve l'entrée par son ID ou échoue si elle n'existe pas
        $sessionMentoratMentee = SessionMentoratMentee::findOrFail($id);

        // Renvoie les détails de la ressource trouvée
        return response()->json($sessionMentoratMentee, 200);
    }

    /**
     * Met à jour une ressource spécifique dans la base de données.
     *
     * @param  \App\Http\Requests\UpdateSessionMentoratMenteeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSessionMentoratMenteeRequest $request, $id)
    {
        // Trouve l'entrée par son ID ou échoue si elle n'existe pas
        $sessionMentoratMentee = SessionMentoratMentee::findOrFail($id);

        // Met à jour l'entrée avec les nouvelles données validées
        $sessionMentoratMentee->update($request->validated());

        // Renvoie une réponse JSON avec les détails mis à jour de la ressource
        return response()->json([
            'message' => 'Session de mentorat avec le mentee mise à jour avec succès',
            'data' => $sessionMentoratMentee
        ], 200);
    }

    /**
     * Supprime une ressource spécifique de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Trouve l'entrée par son ID ou échoue si elle n'existe pas
        $sessionMentoratMentee = SessionMentoratMentee::findOrFail($id);

        // Supprime l'entrée de la base de données
        $sessionMentoratMentee->delete();

        // Renvoie une réponse JSON avec un message de succès et un statut HTTP 204 No Content
        return response()->json([
            'message' => 'Session de mentorat avec le mentee supprimée avec succès'
        ], 204);
    }
}

