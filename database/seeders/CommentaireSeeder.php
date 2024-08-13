<?php

namespace Database\Seeders;
use App\Models\Commentaire;
use App\Models\SessionMentorat;
use App\Models\Mentee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mentee::all()->each(function ($mentee) {
            SessionMentorat::inRandomOrder()->take(3)->get()->each(function ($sessionMentorat) use ($mentee) {
                Commentaire::factory()->create([
                    'session_mentorat_id' => $sessionMentorat->id,
                    'mentee_id' => $mentee->id,
                ]);
            });
        });
    }
}
