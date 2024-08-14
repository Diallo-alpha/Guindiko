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
         $validatedData = $request->validated();
         $session = SessionMentorat::create($validatedData);
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
    // public function sendMentoratRequest(Request $request)
    // {
    //     // Fetch the session along with the mentor relationship
    //     $session = SessionMentorat::with('mentor')->find($request->session_mentorat_id);

    //     // Check if the session was found
    //     if (!$session) {
    //         return response()->json(['error' => 'Session de mentorat introuvable.'], 404);
    //     }

    //     // Prepare the session details for the email
    //     $sessionDetails = [
    //         'mentor' => $session->mentor->toArray(),
    //         'date' => $request->date,
    //     ];

    //     // Send the email
    //     Mail::to('mentorat@example.com')->send(new DemandeMentoratMail($sessionDetails));

    //     // Return a success response
    //     return response()->json(['message' => 'Demande de mentorat envoyée avec succès.']);
    // }

}
 