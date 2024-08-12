<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SessionMentorat;
use App\Models\FormationMentor;
use App\Models\Mentee;
use App\Models\Commentaire;

class SessionMentoratSeeder extends Seeder
{
    /**
     * Exécute le seeder.
     */
    public function run(): void
    {
        // Crée 10 FormationMentors et les associe avec des SessionMentorat
        FormationMentor::factory(10)->create()->each(function ($formationMentor) {
            $sessionMentorat = SessionMentorat::factory()->create([
                'formation_mentor_id' => $formationMentor->id,
            ]);

            // Pour chaque session de mentorat, crée des commentaires pour les mentees
            Mentee::factory(3)->create()->each(function ($mentee) use ($sessionMentorat) {
                Commentaire::factory()->create([
                    'session_mentorat_id' => $sessionMentorat->id,
                    'mentee_id' => $mentee->id,
                ]);
            });
        });
    }
}
