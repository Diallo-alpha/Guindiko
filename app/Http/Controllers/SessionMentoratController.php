<?php
namespace App\Http\Controllers;

use App\Models\SessionMentorat;
use App\Http\Requests\StoreSessionMentoratRequest;
use App\Http\Requests\UpdateSessionMentoratRequest;
use App\Mail\DemandeMentoratMail;
use Illuminate\Http\Request; // Correct import
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class SessionMentoratController extends Controller
{
    /**
     * Afficher une liste des sessions de mentorat.
     */
    public function index(): JsonResponse
    {
        $sessions = SessionMentorat::with(['users' , 'reservations', 'ressources'])->get();
        return response()->json($sessions);
    }

    /**
     * Stocker une nouvelle session de mentorat.
     */

     public function store(StoreSessionMentoratRequest $request): JsonResponse
     {
         // Vérifier si l'utilisateur est authentifié et s'il a le rôle de mentor
         if (!auth()->check() || !auth()->user()->hasRole('mentor')) {
             return response()->json(['message' => 'Seuls les mentors peuvent créer des sessions.'], 403);
         }

         // Valider les données de la requête
         $validatedData = $request->validated();

         // Ajouter l'ID de l'utilisateur authentifié aux données de la session
         $session = SessionMentorat::create(array_merge($validatedData, ['user_id' => auth()->id()]));

         return response()->json($session, 201);
     }

    /**
     * Afficher une session de mentorat spécifique.
     */
    public function show(SessionMentorat $sessionMentorat): JsonResponse
    {
        return response()->json($sessionMentorat->load(['users', 'reservations', 'ressources']));
    }

    /**
     * Mettre à jour une session de mentorat spécifique.
     */
    public function update(UpdateSessionMentoratRequest $request, SessionMentorat $sessionMentorat): JsonResponse
    {
        // Vérifier si l'utilisateur est authentifié et est le créateur de la session
        if (auth()->id() !== $sessionMentorat->user_id) {
            return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier cette session.'], 403);
        }

        // Si l'utilisateur est le créateur, autoriser la mise à jour
        $sessionMentorat->update($request->validated());
        return response()->json($sessionMentorat);
    }

    /**
     * Supprimer une session de mentorat spécifique.
     */
    public function destroy(SessionMentorat $sessionMentorat): JsonResponse
    {
        $sessionMentorat->delete();
        return response()->json(null, 204);
    }
       // Afficher les sessions de mentorat d'un mentort
       public function afficherSessionsMentor($mentorId)
       {
           // Récupérer les sessions créées par le mentor avec l'ID fourni
           $sessions = SessionMentorat::where('user_id', $mentorId)->get();

           // Vérifier si des sessions existent
           if ($sessions->isEmpty()) {
               return response()->json(['message' => 'Aucune session de mentorat trouvée pour ce mentor.'], 404);
           }

           // Retourner les sessions en réponse JSON
           return response()->json(['sessions' => $sessions], 200);
       }

}
