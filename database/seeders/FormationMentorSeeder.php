<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\Mentor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
          $formations = Formation::factory()->count(5)->create();

          // Associer les mentors aux formations
          foreach ($mentors as $mentor) {
              $mentor->formations()->attach(
                  $formations->random(rand(1, 3))->pluck('id')->toArray()
              );
    }
}
}
