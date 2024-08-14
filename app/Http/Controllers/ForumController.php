<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Http\Requests\StoreForumRequest;
use App\Http\Requests\UpdateForumRequest;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Afficher tous les forums.
     */
    public function index()
    {
        return Forum::all();
    }

    /**
     * Créer un nouveau forum.
     */
    public function store(StoreForumRequest $request)
    {
        $validatedData = $request->validated();

        $forum = Forum::create($validatedData);

        return response()->json($forum, 201); 
    }

    /**
     * Afficher un forum spécifique.
     */
    public function show($id)
    {
        $forum = Forum::findOrFail($id);

        return response()->json($forum);
    }

    /**
     * Mettre à jour un forum existant.
     */
    public function update(UpdateForumRequest $request, $id)
    {
        $validatedData = $request->validated();

        $forum = Forum::findOrFail($id);
        $forum->update($validatedData);

        return response()->json($forum, 200);
    }

    /**
     * Supprimer un forum.
     */
    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);
        $forum->delete();

        return response()->json(null, 204);
    }
}
