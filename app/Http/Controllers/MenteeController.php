<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMenteeRequest;
use App\Http\Requests\UpdateMenteeRequest;

class MenteeController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenteeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mentee $mentee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mentee $mentee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenteeRequest $request, Mentee $mentee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentee $mentee)
    {
        //
    }

    public function requestMentorship(Request $request)
    {
        // Valider la demande pour s'assurer qu'un mentor est sélectionné
        $validated = $request->validate([
            'mentor_id' => 'required|exists:users,id',
            // Ajoutez des règles de validation pour le nom du mentee s'il est fourni
            'mentee_name' => 'nullable|string'
        ]);

        // Récupérer le mentor sélectionné
        $mentor = User::findOrFail($validated['mentor_id']);

        // Récupérer le nom du mentee depuis la requête ou définir une valeur par défaut
        $menteeName = $request->input('mentee_name', 'Inconnu');

        // Envoyer l'email
        Mail::to($mentor->email)->send(new DemandeMentoratMail($menteeName, $mentor));

        return back()->with('success', 'Votre demande de mentorat a été envoyée avec succès.');
    }
}
