<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Afficher tous les articles.
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Créer un nouvel article.
     */
    public function store(StoreArticleRequest $request)
    {
        // Vérifier si l'utilisateur est authentifié et a le rôle de mentor
        if (!auth()->check() || !auth()->user()->hasRole('mentor')) {
            return response()->json(['message' => 'Seuls les mentors peuvent créer des articles.'], 403);
        }

        $validatedData = $request->validated();

        // Assigner l'utilisateur authentifié comme créateur de l'article
        $article = Article::create(array_merge($validatedData, ['user_id' => auth()->id()]));

        return response()->json($article, 201);
    }


    /**
     * Afficher un article spécifique.
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return response()->json($article);
    }

    /**
     * Mettre à jour un article existant.
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        // Vérification que l'utilisateur connecté est le créateur de l'article
        if ($article->user_id !== auth()->id()) {
            return response()->json(['message' => 'Action non autorisée vous.'], 403);
        }

        $validatedData = $request->validated();
        $article->update($validatedData);

        return response()->json($article, 200);
    }
    /**
 * Afficher tous les articles créés par un mentor.
 */
public function articlesParMentor($mentor_id)
{
    // Vérifier si l'utilisateur spécifié est un mentor
    $mentor = User::findOrFail($mentor_id);

    if (!$mentor->hasRole('mentor')) {
        return response()->json(['message' => 'Cet utilisateur n\'est pas un mentor.'], 403);
    }

    // Récupérer tous les articles créés par ce mentor
    $articles = Article::where('user_id', $mentor->id)->get();

    return response()->json($articles, 200);
}

    /**
     * Supprimer un article.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Vérification que l'utilisateur connecté est le créateur de l'article
        if ($article->user_id !== auth()->id()) {
            return response()->json(['message' => 'Action non autorisée supprimer ce que vous avez créer.'], 403);
        }

        $article->delete();

        return response()->json(null, 204);
    }
}

