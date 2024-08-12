<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
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
    public function store(StoreReservationRequest $request)
    {
        return Reservation::create($request->validated());
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

        return response()->json(['message' => 'Réservation supprimée avec succès']);
    }



    namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // ... autres méthodes

    // Méthode pour accepter une réservation
    public function accept($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'accepted']);

        return response()->json(['message' => 'Réservation acceptée avec succès']);
    }

    // Méthode pour refuser une réservation
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
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
    public function store(StoreReservationRequest $request)
    {
        return Reservation::create($request->validated());
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

        return response()->json(['message' => 'Réservation supprimée avec succès']);
    }

    // Méthode pour accepter une réservation
    public function accept($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'accepted']);

        return response()->json(['message' => 'Réservation acceptée avec succès']);
    }

    // Méthode pour refuser une réservation
    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'rejected']);

        return response()->json(['message' => 'Réservation refusée avec succès']);
    }
}
    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'rejected']);

        return response()->json(['message' => 'Réservation refusée avec succès']);
    }
}

}
