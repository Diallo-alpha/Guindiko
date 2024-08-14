<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\Reservation as ReservationNotification;
use App\Notifications\ReservationNotification as NotificationsReservationNotification;
use Illuminate\Routing\Controller as BaseController; // Ensure this line is present

class ReservationController extends BaseController // Ensure the class extends the BaseController
{ 
    public function __construct()
    {
        $this->middleware('role:mentee')->only(['store']);
        $this->middleware('role:mentor')->only(['update', 'destroy']);
    }

    public function index()
    {
        return response()->json(Reservation::all(), 200);
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Réservation introuvable'], 404);
        }

        return response()->json($reservation, 200);
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'session_mentorat_id' => $request->session_mentorat_id,
            'statut' => 'en attente',
        ]);
    
        $sessionMentorat = $reservation->sessionMentorat;
    
        if (!$sessionMentorat) {
            return response()->json(['error' => 'Session de mentorat introuvable'], 404);
        }
    
        $mentor = $sessionMentorat->mentor; // Utilisez la relation définie dans SessionMentorat
    
        if (!$mentor) {
            return response()->json(['error' => 'Mentor introuvable'], 404);
        }
    
        // Envoyer la notification
        $mentor->notify(new NotificationsReservationNotification($reservation)); // Assurez-vous que ReservationNotification est bien le nom de la classe de notification
    
        return response()->json(['message' => 'Réservation créée avec succès et notification envoyée au mentor.'], 201);
    }
    
    

    public function update(UpdateReservationRequest $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Réservation introuvable'], 404);
        }

        $reservation->update($request->validated());

        return response()->json($reservation, 200);
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Réservation introuvable'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Réservation supprimée avec succès'], 200);
    }
}
