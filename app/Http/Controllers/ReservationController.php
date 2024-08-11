<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_mentorat_id' => 'required|exists:session_mentorats,id',
            'statut' => 'required|in:en attente,confirmée,annulée',
        ]);

        return Reservation::create($validated);
    }

    // Mettre à jour une réservation spécifique
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'session_mentorat_id' => 'exists:session_mentorats,id',
            'statut' => 'in:en attente,confirmée,annulée',
        ]);

        $reservation->update($validated);

        return $reservation;
    }

    // Supprimer une réservation spécifique
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['message' => 'Réservation supprimée avec succès']);
    }
}
