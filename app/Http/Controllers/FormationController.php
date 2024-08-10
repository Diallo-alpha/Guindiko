<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use App\Models\Formation;
use Illuminate\Http\Response;

class FormationController extends Controller
{
    /**
     * Afficher la liste des ressources.
     */
    public function index()
    {
        // Retourne toutes les formations avec les informations de domaine associées
        return response()->json(Formation::with('domaine')->get(), Response::HTTP_OK);
    }

    /**
     * Stocker une nouvelle ressource dans le stockage.
     */
    public function store(StoreFormationRequest $request)
    {
        // Valide et crée une nouvelle formation
        $formation = Formation::create($request->validated());

        // Retourne la formation créée avec le statut HTTP 201 (Created)
        return response()->json($formation, Response::HTTP_CREATED);
    }

    /**
     * Afficher la ressource spécifiée.
     */
    public function show(Formation $formation)
    {
        // Retourne les détails de la formation spécifiée
        return response()->json($formation, Response::HTTP_OK);
    }

    /**
     * Mettre à jour la ressource spécifiée dans le stockage.
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        // Valide et met à jour la formation spécifiée
        $formation->update($request->validated());

        // Retourne la formation mise à jour avec le statut HTTP 200 (OK)
        return response()->json($formation, Response::HTTP_OK);
    }

    /**
     * Supprimer la ressource spécifiée du stockage.
     */
    public function destroy(Formation $formation)
    {
        // Supprime la formation spécifiée
        $formation->delete();

        // Retourne une réponse vide avec le statut HTTP 204 (No Content)
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
