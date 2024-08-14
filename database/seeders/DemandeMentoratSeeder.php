<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DemandeMentorat;
use App\Models\User;
class DemandeMentoratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mentor = User::where('email', 'cheikhsane656@gmail.com')->first();
        $mentee = User::where('email', 'ndiayeamina775@gmail.com')->first();

        if ($mentor && $mentee) {
            DemandeMentorat::create([
                'mentor_id' => $mentor->id,
                'mentee_id' => $mentee->id,
                'statut' => 'en attente',
            ]);

            DemandeMentorat::create([
                'mentor_id' => $mentor->id,
                'mentee_id' => $mentee->id,
                'statut' => 'acceptée',
            ]);

            DemandeMentorat::create([
                'mentor_id' => $mentor->id,
                'mentee_id' => $mentee->id,
                'statut' => 'rejetée',
            ]);
        } else {
            echo "Veuillez vous assurer que les utilisateurs avec les emails fournis existent dans la base de données.\n";
        }
    }
    }
