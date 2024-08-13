<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use App\Models\User;
use App\Models\Mentor;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Logique pour afficher une liste des mentors
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logique pour afficher le formulaire de création d'un mentor
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMentorRequest $request)
    {
        // Logique pour enregistrer un nouveau mentor dans la base de données
    }

    /**
     * Display the specified resource.
     */
    public function show(Mentor $mentor)
    {
        // Logique pour afficher un mentor spécifique
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mentor $mentor)
    {
        // Logique pour afficher le formulaire d'édition d'un mentor
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMentorRequest $request, Mentor $mentor)
    {
        // Logique pour mettre à jour un mentor dans la base de données
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentor $mentor)
    {
        // Logique pour supprimer un mentor de la base de données
    }


    /**
     * Accepter ou refuser une demande de mentorat.
     */
    public function respondToRequest(Request $request, Mentee $mentee)
    {
        $validated = $request->validate([
            'response' => 'required|in:accepted,refused',
        ]);

        // Vérifier que l'utilisateur est bien un mentor
        $mentor = Auth::user();

        if (!$mentor || !$mentor->is_mentor) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        // Mettre à jour le statut du mentorat
        $status = $validated['response'] === 'accepted' ? 'accepted' : 'refused';

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
