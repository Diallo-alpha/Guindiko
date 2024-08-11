<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom du domaine est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Création du domaine
        $domaine = Domaine::create($validator->validated());

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
    public function update(Request $request, Domaine $domaine)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom du domaine est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Mise à jour du domaine
        $domaine->update($validator->validated());

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
