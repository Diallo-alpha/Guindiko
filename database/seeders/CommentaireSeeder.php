<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commentaire;
use App\Models\User;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer tous les utilisateurs qui ont le rôle de mentee
        $mentees = User::role('mentee')->get();

        // Créer des commentaires pour chaque mentee
        foreach ($mentees as $mentee) {
            Commentaire::create([
                'user_id' => $mentee->id,
                'session_mentorat_id' => 1,
                'contenu' => 'Très bon mentorat, merci!',
            ]);
        }
    }
}
