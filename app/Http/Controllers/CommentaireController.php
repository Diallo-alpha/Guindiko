<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Afficher tous les commentaires.
     */
    public function index()
    {
        return Commentaire::all();
    }

    /**
     * Créer un nouveau commentaire.
     */
    public function store(StoreCommentaireRequest $request)
    {
        $commentaire = new Commentaire([
            'session_mentorat_id' => $request->input('session_mentorat_id'),
            'user_id' => $request->input('user_id'), 
            'contenu' => $request->input('contenu'),
        ]);

        $commentaire->save();

        return response()->json($commentaire, 201);
    }

    /**
     * Afficher un commentaire spécifique.
     */
    public function show($id)
    {
        $commentaire = Commentaire::findOrFail($id);

        return response()->json($commentaire);
    }

    /**
     * Mettre à jour un commentaire existant.
     */
    public function update(UpdateCommentaireRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $commentaire = Commentaire::findOrFail($id);
            $commentaire->update($validatedData);

            return response()->json($commentaire, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    /**
     * Supprimer un commentaire.
     */
    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->delete();

        return response()->json(null, 204);
    }
}
