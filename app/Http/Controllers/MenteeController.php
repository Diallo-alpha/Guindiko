<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\DemandeMentorat;
use App\Notifications\DemandeMentoratReçue;

class MenteeController extends Controller
{

    public function envoyerDemandeMentorat(Request $request, User $mentor)
    {
        if ($mentor->hasRole('mentor') && auth()->user()->hasRole('mentee')) {
            $demande = DemandeMentorat::create([
                'mentor_id' => $mentor->id,
                'mentee_id' => auth()->user()->id,
                'statut' => 'en attente',
            ]);

            // Notifier le mentor de la nouvelle demande de mentorat
            $mentor->notify(new DemandeMentoratReçue($demande));

            \Log::info('Demande de mentorat envoyée au mentor avec l\'ID: ' . $mentor->id);

            return response()->json(['message' => 'Demande de mentorat envoyée.'], 200);
        }

        return response()->json(['message' => 'Action non autorisée.'], 403);
    }
}

