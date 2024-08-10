<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomaineRequest;
use App\Http\Requests\UpdateDomaineRequest;
use App\Models\Domaine;
use Illuminate\Http\Response;

class DomaineController extends Controller
{
    /**
     * Afficher la liste des ressources.
     */
    public function index()
    {
        $domaines = Domaine::all();
        return response()->json([
            'message' => 'Liste des domaines chargée avec succès.',
            'data' => $domaines
        ], Response::HTTP_OK);
    }

    /**
     * Stocker une nouvelle ressource dans le stockage.
     */
    public function store(StoreDomaineRequest $request)
    {
        $domaine = Domaine::create($request->validated());

        return response()->json([
            'message' => 'Domaine créé avec succès.',
            'data' => $domaine
        ], Response::HTTP_CREATED);
    }

    /**
     * Afficher la ressource spécifiée.
     */
    public function show(Domaine $domaine)
    {
        return response()->json([
            'message' => 'Domaine récupéré avec succès.',
            'data' => $domaine
        ], Response::HTTP_OK);
    }

    /**
     * Mettre à jour la ressource spécifiée dans le stockage.
     */
    public function update(UpdateDomaineRequest $request, Domaine $domaine)
    {
        $domaine->update($request->validated());

        return response()->json([
            'message' => 'Domaine mis à jour avec succès.',
            'data' => $domaine
        ], Response::HTTP_OK);
    }

    /**
     * Supprimer la ressource spécifiée du stockage.
     */
    public function destroy(Domaine $domaine)
    {
        $domaine->delete();

        return response()->json([
            'message' => 'Domaine supprimé avec succès.'
        ], Response::HTTP_NO_CONTENT);
    }
}
