<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use Illuminate\Http\Response;

class FormationController extends Controller
{
    /**
     * Afficher la liste des ressources.
     */
    public function index()
    {
        $formations = Formation::with('domaine')->get();
        return response()->json([
            'message' => 'Liste des formations chargée avec succès.',
            'data' => $formations
        ], Response::HTTP_OK);
    }

    /**
     * Stocker une nouvelle ressource dans le stockage.
     */
    public function store(StoreFormationRequest $request)
    {
        // Validation des données déjà effectuée dans StoreFormationRequest
        $formation = Formation::create($request->validated());

        return response()->json([
            'message' => 'Formation créée avec succès.',
            'data' => $formation
        ], Response::HTTP_CREATED);
    }

    /**
     * Afficher la ressource spécifiée.
     */
    public function show(Formation $formation)
    {
        return response()->json([
            'message' => 'Formation récupérée avec succès.',
            'data' => $formation
        ], Response::HTTP_OK);
    }

    /**
     * Mettre à jour la ressource spécifiée dans le stockage.
     */
    public function update(UpdateFormationRequest $request, $id)
    {
        // Récupérer la formation
        $formation = Formation::find($id);

        if (!$formation) {
            return response()->json(['message' => 'Formation introuvable.'], 404);
        }

        // Log des données avant la mise à jour
        \Log::info('Données de mise à jour: ', $request->validated());

        // Mise à jour de la formation
        $success = $formation->update($request->validated());

        if (!$success) {
            \Log::error('Échec de la mise à jour de la formation.', ['id' => $id]);
            return response()->json(['message' => 'Erreur lors de la mise à jour de la formation.'], 500);
        }

        // Log des données mises à jour
        \Log::info('Formation mise à jour avec succès.', ['data' => $formation]);

        return response()->json([
            'message' => 'Formation mise à jour avec succès.',
            'data' => $formation
        ], Response::HTTP_OK);
    }


    /**
     * Supprimer la ressource spécifiée du stockage.
     */
    public function destroy($id)
    {
        \Log::info('ID de la formation à supprimer : ' . $id);

        $formation = Formation::find($id);
        if (!$formation) {
            \Log::warning('Formation introuvable pour l\'ID : ' . $id);
            return response()->json(['message' => 'Formation introuvable.'], 404);
        }

        \Log::info('Formation trouvée : ' . $formation);

        $formation->delete();

        // Vérifier la suppression
        $deletedFormation = Formation::find($id);
        \Log::info('Vérification après suppression, formation trouvée : ' . $deletedFormation);

        return response()->json([
            'message' => 'Formation supprimée avec succès.'
        ], Response::HTTP_NO_CONTENT);
    }

      /**
     * Afficher les formations d'un domaine spécifique.
     *
     * @param int $domaine_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function formationsByDomaine($domaine_id)
    {
        // Récupérer toutes les formations qui appartiennent au domaine spécifié
        $formations = Formation::where('domaine_id', $domaine_id)->get();

        // Vérifier si des formations ont été trouvées
        if ($formations->isEmpty()) {
            return response()->json([
                'message' => 'Aucune formation trouvée pour ce domaine.',
            ], Response::HTTP_NOT_FOUND);
        }

        // Retourner les formations sous forme de JSON
        return response()->json([
            'message' => 'Formations récupérées avec succès.',
            'data' => $formations
        ], Response::HTTP_OK);
    }
}
