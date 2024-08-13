<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Lister toutes les réservations
    public function index()
    {
        return response()->json(Reservation::all(), 200);
    }

    // Afficher les détails d'une réservation spécifique
    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Réservation introuvable'], 404);
        }

        return response()->json($reservation, 200);
    }

    // Créer une nouvelle réservation
    public function store(StoreReservationRequest $request)
    {
        // Créer la réservation avec les données validées
        $reservation = Reservation::create($request->validated());
    
        // Récupérer les détails du mentee et de la session
        $user = $reservation->user; // Relation mentee() dans le modèle Reservation
        $sessionMentorat = $reservation->sessionMentorat; // Relation sessionMentorat() dans le modèle Reservation
    
        if (!$user || !$sessionMentorat) {
            return response()->json(['error' => 'Mentee ou session de mentorat introuvable'], 404);
        }
    
        // Convertir et formater la date de la session
        $date = Carbon::parse($sessionMentorat->date)->format('Y-m-d H:i:s');
    
        $details = [
            'email' => $user->email,
            'name' => $user->name,
            'date' => $date,
            'user' => $sessionMentorat->user->name, // Relation mentor() dans le modèle SessionMentorat
        ];
    
        // Envoi de l'e-mail de réservation
        try {
            Mail::send(new ReservationMail($details));
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'e-mail : ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de l\'envoi de l\'e-mail'], 500);
        }
    
        // Réponse JSON après création réussie
        return response()->json(['message' => 'Réservation créée avec succès et e-mail envoyé au mentee.'], 201);
    }
    
    // Mettre à jour une réservation spécifique
    public function update(UpdateReservationRequest $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Réservation introuvable'], 404);
        }

        $reservation->update($request->validated());

        return response()->json($reservation, 200);
    }

    // Supprimer une réservation spécifique
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
