<?php

namespace App\Http\Controllers;

use App\Models\Ressource;
use App\Http\Requests\StoreRessourceRequest;
use App\Http\Requests\UpdateRessourceRequest;

class RessourceController extends Controller
{
    // Lister toutes les ressources
    public function index()
    {
        return Ressource::all();
    }

    // Afficher les détails d'une ressource spécifique
    public function show($id)
    {
        return Ressource::findOrFail($id);
    }

    // Créer une nouvelle ressource
    public function store(StoreRessourceRequest $request)
    {
        $ressource = Ressource::create($request->validated());
        return response()->json($ressource, 201); // 201 Created
    }

    // Mettre à jour une ressource spécifique
    public function update(UpdateRessourceRequest $request, $id)
    {
        $ressource = Ressource::findOrFail($id);
        $ressource->update($request->validated());
        return response()->json($ressource)->with(['message' => 'Ressource mise à jour avec succès']);
    }

    // Supprimer une ressource spécifique
    public function destroy($id)
    {
        $ressource = Ressource::findOrFail($id);
        $ressource->delete();
        return response()->json(['message' => 'Ressource supprimée avec succès'], 204);
    }
}
