<?php

namespace Database\Factories;

use App\Models\Mentee;
use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SessionMentorat>
 */
class SessionMentoratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mentor_id' => Mentor::factory(), // Associe un mentor fictif
            // 'mentee_id' => Mentee::factory(), // Associe un mentee fictif
            'date' => $this->faker->dateTimeBetween('now', '+1 year'), // Génère une date aléatoire
            'duree' => $this->faker->numberBetween(30, 120), // Durée aléatoire entre 30 et 120 minutes
            'statut' => 'en attente', // Statut par défaut
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
