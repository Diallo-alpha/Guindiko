<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\UserSuspended;
use App\Notifications\MentorValidated;
use Illuminate\Http\Request;
use Str;

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

    // Valider un mentor
    public function validerMentor($id)
    {
        $mentor = User::findOrFail($id);
        $mentor->is_validated = true;  // Champ 'is_validated' dans la table 'users'

        // Générer un mot de passe aléatoire
        $password = Str::random(8);
        $mentor->password = Hash::make($password);
        $mentor->save();

        // Envoyer le mot de passe par email au mentor
        $mentor->notify(new MentorValidated($password));

        return response()->json(['message' => 'Mentor validé avec succès.'], 200);
    }
}
