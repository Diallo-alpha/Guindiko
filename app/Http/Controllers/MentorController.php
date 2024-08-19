<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DevnirMentor;
use App\Models\DemandeMentorat;
use App\Models\SessionMentorat;
use App\Notifications\MentoratAccepte;
use App\Notifications\SessionMentoratCreee;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MentoratRefuse;
use App\Notifications\DevenirMentorRecue;
class MentorController extends Controller
{

    // Accepter une demande de mentorat
    public function accepterDemandeMentorat(DemandeMentorat $demandeMentorat)
    {
        $user = auth()->user();

        if ($demandeMentorat->mentor_id === $user->id && $user->hasRole('mentor')) {
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
        $user = auth()->user();

        if ($demandeMentorat->mentor_id === $user->id && $user->hasRole('mentor')) {
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
        // Validation des données d'entrée
        $request->validate([
            'formation_user_id' => 'required|exists:formation_users,id',
            'date' => 'required|date|after_or_equal:today',
            'duree' => 'required|integer|min:1',
            'mentees' => 'required|string',
        ]);

        // Vérification que l'utilisateur connecté est un mentor
        if (!auth()->user()->hasRole('mentor')) {
            return response()->json(['message' => 'Seuls les mentors peuvent créer des sessions de mentorat.'], 403);
        }

        // Créer la session de mentorat
        $session = SessionMentorat::create([
            'user_id' => auth()->user()->id,
            'formation_user_id' => $request->formation_user_id,
            'date' => $request->date,
            'statut' => 'en attente',
            'duree' => $request->duree,
        ]);

        // Récupérer les IDs des mentees à partir de la chaîne
        $menteesIds = explode(',', $request->mentees);
        $mentees = User::whereIn('id', $menteesIds)->get();

        // Vérifier que des mentees valides ont été trouvés
        if ($mentees->isEmpty()) {
            return response()->json(['message' => 'Aucun mentee valide trouvé.'], 400);
        }

        // Notifier les mentees participants
        Notification::send($mentees, new SessionMentoratCreee($session));
        \Log::info('Notification envoyée aux mentees avec les IDs: ' . $mentees->pluck('id')->implode(', '));

        return response()->json(['message' => 'Session de mentorat créée avec succès.'], 200);
    }

    //demande pour devenir mentor
    public function DevenirMentor(Request $request)
    {
        $request->validate([
            'parcours_academique' => 'required|string',
            'diplome' => 'required|string',
            'langue' => 'required|string',
            'cv' => 'required|string',
            'experience' => 'required|string',
            'domaine' => 'required|string',
        ]);
        \Log::info($request->all()); // Vérifiez ce qui est envoyé par la requête

        $demande = DevnirMentor::create([
            'user_id' => auth()->id(),
            'parcours_academique' => $request->parcours_academique,
            'diplome' => $request->diplome,
            'langue' => $request->langue,
            'cv' => $request->cv,
            'experience' => $request->experience,
            'domaine' => $request->domaine,
        ]);

        // Envoyer une notification à l'admin
        $admins = User::role('admin')->get();
        Notification::send($admins, new DevenirMentorRecue($demande));

        return response()->json(['message' => 'Votre demande pour devenir un mentor soumise avec succès.'], 200);
    }

    //affihcer les demandes pour un mentor
    public function afficherDemandesRecues()
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur connecté est bien un mentor
        if (!$user->hasRole('mentor')) {
            return response()->json(['message' => 'Seuls les mentors peuvent accéder à cette ressource.'], 403);
        }

        // Récupérer les demandes de mentorat reçues par le mentor
        $demandes = DemandeMentorat::where('mentor_id', $user->id)->get();

        return response()->json(['demandes' => $demandes], 200);
    }

}

