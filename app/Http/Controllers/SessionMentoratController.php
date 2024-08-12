<?php

namespace App\Http\Controllers;

use App\Models\SessionMentorat;
use App\Models\Notification;
use App\Models\Mentee;
use App\Http\Requests\StoreSessionMentoratRequest;
use App\Http\Requests\UpdateSessionMentoratRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SessionMentoratController extends Controller
{
    /**
     * Afficher une liste des sessions de mentorat.
     */
    public function index(): JsonResponse
    {
        $sessions = SessionMentorat::with(['mentor', 'mentees', 'reservations', 'ressources'])->get();
        return response()->json($sessions);
    }

    /**
     * Stocker une nouvelle session de mentorat.
     */
    public function store(StoreSessionMentoratRequest $request): JsonResponse
    {
        // Créer la session
        $session = SessionMentorat::create([
            'mentor_id' => $request->mentor_id,
            'title' => $request->title,
            'description' => $request->description,
            'scheduled_at' => $request->scheduled_at,
        ]);

        // Récupérer tous les mentees du mentor
        $mentees = Mentee::where('mentor_id', $request->mentor_id)->get();

        // Envoyer une notification à chaque mentee
        foreach ($mentees as $mentee) {
            Notification::create([
                'mentee_id' => $mentee->id,
                'mentor_id' => $request->mentor_id,
                'session_id' => $session->id,
                'message' => "Une nouvelle session '{$session->title}' a été ajoutée.",
            ]);
        }

        return response()->json(['message' => 'Session créée et notifications envoyées.👍👍👍'], 201);
    }

    /**
     * Afficher une session de mentorat spécifique.
     */
    public function show(SessionMentorat $sessionMentorat): JsonResponse
    {
        return response()->json($sessionMentorat->load(['mentor', 'mentees', 'reservations', 'ressources']));
    }

    /**
     * Mettre à jour une session de mentorat spécifique.
     */
    public function update(UpdateSessionMentoratRequest $request, SessionMentorat $sessionMentorat): JsonResponse
    {
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
}
