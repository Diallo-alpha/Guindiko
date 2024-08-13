<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\User;
use App\Models\FormationMentor;
use App\Models\FormationUser;
use Illuminate\Database\Seeder;

class FormationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créez 10 mentors et 10 formations
        $users = User::factory()->count(10)->create();
        $formations = Formation::factory()->count(10)->create();

        // Associer les users aux formations
        foreach ($users as $user) {
            FormationUser::factory()->count(rand(1, 3))->create([
                'user_id' => $user->id,
                'formation_id' => $formations->random()->id,
            ]);
        }
    }
}
