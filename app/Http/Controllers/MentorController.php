<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    // Autres méthodes existantes...

    /**
     * Accepter ou refuser une demande de mentorat.
     */
    public function respondsToRequest(Request $request, Mentee $mentee)
    {
        $validated = $request->validate([
            'response' => 'required|in:accepted,refused',
        ]);

        // Vérifier que l'utilisateur est bien un mentor
        $mentor = Auth::user();

        if (!$mentor || !$mentor->is_mentor) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        if ($validated['response'] === 'accepted') {
            // Ajouter le mentee à la liste des mentees du mentor
            $mentor->mentees()->attach($mentee->id);
            $status = 'accepted';
        } else {
            $status = 'refused';
        }

        // Enregistrer la notification
        Notification::create([
            'mentee_id' => $mentee->id,
            'mentor_id' => $mentor->id,
            'message' => "Votre demande de mentorat a été $status.",
            'is_read' => false,
        ]);

        return response()->json(['success' => "Demande de mentorat $status."], 200);
    }
}
