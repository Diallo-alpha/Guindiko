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
            'message' => 'Liste des formations chargée avec succès. 👍👍👍',
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
            'message' => 'Formation créée avec succès. 👍👍👍',
            'data' => $formation
        ], Response::HTTP_CREATED);
    }

    /**
     * Afficher la ressource spécifiée.
     */
    public function show(Formation $formation)
    {
        return response()->json([
            'message' => 'Formation récupérée avec succès. 👍👍👍',
            'data' => $formation
        ], Response::HTTP_OK);
    }

    /**
     * Mettre à jour la ressource spécifiée dans le stockage.
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        // Validation des données déjà effectuée dans UpdateFormationRequest
        $formation->update($request->validated());

        return response()->json([
            'message' => 'Formation mise à jour avec succès. 👍👍👍',
            'data' => $formation
        ], Response::HTTP_OK);
    }

    /**
     * Supprimer la ressource spécifiée du stockage.
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();

        return response()->json([
            'message' => 'Formation supprimée avec succès.👍👍👍'
        ], Response::HTTP_NO_CONTENT);
    }
}
