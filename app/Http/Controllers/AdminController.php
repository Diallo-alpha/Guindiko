<?php
namespace App\Http\Controllers;

use Str;
use App\Models\User;
use App\Models\DevnirMentor;
use Illuminate\Http\Request;
use App\Models\SessionMentorat;
use App\Http\Controllers\Controller;
use App\Notifications\UserSuspended;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\MentorValidated;

class AdminController extends Controller
{
    // Suspendre un utilisateur
    public function suspendreUtilisateur(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_suspended = true;  // Champ 'is_suspended' dans la table 'users'
        $user->save();

        // Envoyer une notification de suspension
        $reason = $request->input('reason', 'Vous ne respecter pas notre politique de discipline');
        $user->notify(new UserSuspended($reason));

        return response()->json(['message' => 'Utilisateur suspendu avec succès.'], 200);
    }

    //aficher les demandes de mentorar
    public function afficherDemandesMentorat()
    {
        $demandes = DevnirMentor::where('statut', 'en attente')->get();

        return response()->json([
            'success' => true,
            'demandes' => $demandes
        ], 200);
    }

    // Valider un mentor
    public function validerMentor($id)
    {
        $demande =  DevnirMentor::findOrFail($id);
        $mentor = User::findOrFail($demande->user_id);

        // Valider la demande
        $demande->statut = 'validée';
        $demande->save();

        // Valider le mentor dans la table user
        $mentor->is_validated = true;  // Assurez-vous d'avoir ce champ dans la table 'users'

        // Générer un mot de passe aléatoire
        $password = Str::random(8);
        $mentor->password = Hash::make($password);
        $mentor->save();

        // Assigner le rôle 'mentor'
        $mentor->assignRole('mentor');

        // Envoyer une notification au mentor avec le mot de passe
        $mentor->notify(new MentorValidated($password));

        return response()->json(['message' => 'Mentor validé avec succès.'], 200);
    }

    // Refuser une demande de mentorat
    public function refuserDemandeMentor($id)
    {
        $demande =  DevnirMentor::findOrFail($id);
        $demande->statut = 'rejetée';
        $demande->save();

        return response()->json(['message' => 'Demande rejetée.'], 200);
    }

    //Aficher les mentors de la platform
    public function afficherMentors()
{
    $mentors = User::role('mentor')->get();

    return response()->json([
        'success' => true,
        'mentors' => $mentors
    ], 200);
}
//afficher tous les mente
public function afficherMentees()
{
    $mentees = User::role('mentee')->get();

    return response()->json([
        'success' => true,
        'mentees' => $mentees
    ], 200);
}
//afficher les ressouces pour une session
public function afficherRessourcesSession($sessionId)
{
    $session = SessionMentorat::findOrFail($sessionId);

    // Récupérer les ressources associées à cette session
    $ressources = $session->ressources;

    if ($ressources->isEmpty()) {
        return response()->json(['message' => 'Aucune ressource trouvée pour cette session.'], 404);
    }

    return response()->json([
        'success' => true,
        'ressources' => $ressources
    ], 200);
}
}
