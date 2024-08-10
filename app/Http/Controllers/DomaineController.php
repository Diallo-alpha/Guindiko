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
        return Domaine::all();
    }

    /**
     * Stocker une nouvelle ressource dans le stockage.
     */
    public function store(StoreDomaineRequest $request)
    {
        $domaine = Domaine::create($request->validated());

        return response()->json($domaine, Response::HTTP_CREATED);
    }

    /**
     * Afficher la ressource spécifiée.
     */
    public function show(Domaine $domaine)
    {
        return $domaine;
    }

    /**
     * Mettre à jour la ressource spécifiée dans le stockage.
     */
    public function update(UpdateDomaineRequest $request, Domaine $domaine)
    {
        $domaine->update($request->validated());

        return response()->json($domaine, Response::HTTP_OK);
    }

    /**
     * Supprimer la ressource spécifiée du stockage.
     */
    public function destroy(Domaine $domaine)
    {
        $domaine->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
