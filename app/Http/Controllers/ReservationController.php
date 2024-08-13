<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    // Lister toutes les réservations
    public function index()
    {
        return Reservation::all();
    }

    // Afficher les détails d'une réservation spécifique
    public function show($id)
    {
        return Reservation::findOrFail($id);
    }

    // Créer une nouvelle réservation
    public function store(StoreReservationRequest $request)
    {
        // Validate and create the reservation
        $reservation = Reservation::create($request->validated());

        // Retrieve user and session details
        $mentee = $reservation->user; // Assuming user() relationship in Reservation model
        $sessionMentorat = $reservation->sessionMentorat; // Assuming sessionMentorat() relationship in Reservation model

        // Convert the date string to a DateTime object and format it
        $date = Carbon::parse($sessionMentorat->date)->format('Y-m-d H:i:s');

        $details = [
            'email' => $mentee->email,
            'name' => $mentee->name,
            'date' => $date,
            'mentor' => $sessionMentorat->mentor->name, // Assuming mentor() relationship in SessionMentorat model
        ];

        // Send the reservation email
        Mail::send(new ReservationMail($details));

        // Return a response
        return response()->json(['message' => 'Reservation created successfully and email sent to mentee.'], 201);
    }

    // Mettre à jour une réservation spécifique
    public function update(UpdateReservationRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->validated());

        return $reservation;
    }

    // Supprimer une réservation spécifique
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['message' => 'Réservation supprimée avec succès 🤗🤗🤗']);
    }

    // Méthode pour accepter une réservation
    public function accept($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'accepted']);

        return response()->json(['message' => 'Réservation acceptée avec succès 🤗🤗🤗']);
    }

    // Méthode pour refuser une réservation
    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'rejected']);

        return response()->json(['message' => 'Désolée votre reservation a été refusée bonne chance pour une prochaine session  🫡🫡🫡.']);
    }
}

