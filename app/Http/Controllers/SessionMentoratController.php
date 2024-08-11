<?php
namespace App\Http\Controllers;

use App\Models\SessionMentorat;
use App\Http\Requests\StoreSessionMentoratRequest;
use App\Http\Requests\UpdateSessionMentoratRequest;
use Illuminate\Http\JsonResponse;

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
        $session = SessionMentorat::create($request->validated());
        return response()->json($session, 201);
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
