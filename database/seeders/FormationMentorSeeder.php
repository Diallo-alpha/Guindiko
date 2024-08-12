<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\Mentor;
use App\Models\FormationMentor;
use Illuminate\Database\Seeder;

class FormationMentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créez 10 mentors et 10 formations
        $mentors = Mentor::factory()->count(10)->create();
        $formations = Formation::factory()->count(10)->create();

        // Associer les mentors aux formations
        foreach ($mentors as $mentor) {
            FormationMentor::factory()->count(rand(1, 3))->create([
                'mentor_id' => $mentor->id,
                'formation_id' => $formations->random()->id,
            ]);
        }
    }
}
