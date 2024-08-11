<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'domaine_id' => 'required|exists:domaines,id',
        ], [
            'nom.required' => 'Le nom de la formation est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'domaine_id.required' => 'L\'ID du domaine est requis.',
            'domaine_id.exists' => 'Le domaine sélectionné n\'existe pas.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Création de la formation
        $formation = Formation::create($validator->validated());

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
    public function update(Request $request, Formation $formation)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'domaine_id' => 'required|exists:domaines,id',
        ], [
            'nom.required' => 'Le nom de la formation est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'domaine_id.required' => 'L\'ID du domaine est requis.',
            'domaine_id.exists' => 'Le domaine sélectionné n\'existe pas.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Mise à jour de la formation
        $formation->update($validator->validated());

        return response()->json([
            'message' => 'Formation mise à jour avec succès.',
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
            'message' => 'Formation supprimée avec succès.'
        ], Response::HTTP_NO_CONTENT);
    }
}
