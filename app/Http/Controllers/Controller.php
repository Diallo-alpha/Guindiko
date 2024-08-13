<?php

namespace App\Http\Controllers;

use App\Mail\DemandeMentoratMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

abstract class Controller
{
    public function requestUsership(Request $request)
    {
        // Valider la demande pour s'assurer qu'un mentor est sélectionné
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            // Ajoutez des règles de validation pour le nom du mentee s'il est fourni
            'user_name' => 'nullable|string'
        ]);
    
        // Récupérer le mentor sélectionné
        $user = User::findOrFail($validated['user_id']);
    
        // Récupérer le nom du mentee depuis la requête ou définir une valeur par défaut
        $userName = $request->input('user_name', 'Inconnu');
    
        // Envoyer l'email
        Mail::to($user->email)->send(new DemandeMentoratMail($userName, $user));
        
        return back()->with('success', 'Votre demande de mentorat a été envoyée avec succès.');
    }
}
