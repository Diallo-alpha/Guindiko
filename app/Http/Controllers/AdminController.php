<?php
namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Valider un mentor.
     */
    public function validerMentor($id)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->is_valid = true;
        $mentor->save();

        return response()->json([
            'message' => 'Le mentor a été validé avec succès.',
        ]);
    }

    /**
     * Supprimer un mentor.
     */
    public function supprimerMentor($id)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->delete();

        return response()->json([
            'message' => 'Le mentor a été supprimé avec succès.',
        ]);
    }
}
