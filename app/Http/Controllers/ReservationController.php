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


use Illuminate\Routing\Controller as BaseController; // Ensure this line is present

class ReservationController extends BaseController // Ensure the class extends the BaseController
{ public function __construct()
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
    
        $mentee = $reservation->user;
        $sessionMentorat = $reservation->sessionMentorat;
    
        if (!$mentee || !$sessionMentorat) {
            return response()->json(['error' => 'Mentee ou session de mentorat introuvable'], 404);
        }
    
        // Retrieve the mentor's details by their role
        $mentor = User::role('mentor')->find($sessionMentorat->mentor_id); // Ensure mentor_id is still used or adjust as necessary
    
        if (!$mentor) {
            return response()->json(['error' => 'Mentor introuvable'], 404);
        }
    
        $date = Carbon::parse($sessionMentorat->date)->format('Y-m-d H:i:s');
    
        $details = [
            'email' => $mentee->email,
            'name' => $mentee->name,
            'date' => $date,
            'mentor' => $mentor->name, // Fetch mentor's name
        ];
    
        try {
            Mail::to($mentee->email)->send(new ReservationMail($details));
            return response()->json(['message' => 'Réservation créée avec succès et e-mail envoyé au mentee.'], 201);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'e-mail : ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de l\'envoi de l\'e-mail'], 500);
        }
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
