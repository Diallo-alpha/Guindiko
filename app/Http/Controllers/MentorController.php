<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DemandeMentorat;
use App\Models\SessionMentorat;
use App\Notifications\MentoratAccepte;
use App\Notifications\SessionMentoratCreee;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MentoratRefuse;
class MentorController extends Controller
{

    // Accepter une demande de mentorat
    public function accepterDemandeMentorat(DemandeMentorat $demandeMentorat)
    {
        if ($demandeMentorat->mentor->id === auth()->user()->id && auth()->user()->hasRole('mentor')) {
            $demandeMentorat->update(['statut' => 'acceptée']);

            // Envoyer une notification au mentee
            $demandeMentorat->mentee->notify(new MentoratAccepte($demandeMentorat));
            \Log::info('Notification envoyée au mentee avec l\'ID: ' . $demandeMentorat->mentee->id);

            return response()->json(['message' => 'Demande de mentorat acceptée.'], 200);
        }

        return response()->json(['message' => 'Action non autorisée.'], 403);
    }
    //refuser une de demande de mentorat

    public function refuserDemandeMentorat(DemandeMentorat $demandeMentorat)
    {
        if ($demandeMentorat->mentor->id === auth()->user()->id && auth()->user()->hasRole('mentor')) {
            $demandeMentorat->update(['statut' => 'rejetée']);

            // Envoyer une notification au mentee
            $demandeMentorat->mentee->notify(new MentoratRefuse($demandeMentorat));
            \Log::info('Notification envoyée au mentee avec l\'ID: ' . $demandeMentorat->mentee->id);

            return response()->json(['message' => 'Demande de mentorat refusée.'], 200);
        }

        return response()->json(['message' => 'Action non autorisée.'], 403);
    }
    // Créer une session de mentorat
    public function creerSessionMentorat(Request $request)
    {
        $session = SessionMentorat::create([
            'user_id' => auth()->user()->id,
            'formation_user_id' => $request->formation_user_id,
            'date' => $request->date,
            'statut' => 'en attente',
            'duree' => $request->duree,
        ]);

        $menteesIds = explode(',', $request->mentees);
        $mentees = User::whereIn('id', $menteesIds)->get();

        // Optionnel : Notifier les mentees participants
        Notification::send($mentees, new SessionMentoratCreee($session));
        \Log::info('Notification envoyée aux mentees avec les IDs: ' . $mentees->pluck('id')->implode(', '));

        return response()->json(['message' => 'Session de mentorat créée.'], 200);
    }
}

