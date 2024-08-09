<?php

namespace Database\Factories;

use App\Models\Mentee;
use App\Models\Mentort;
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
            'mentort_id' => Mentort::factory(), // Associe un mentor fictif
            'mentee_id' => Mentee::factory(), // Associe un mentee fictif
            'date' => $this->faker->dateTimeBetween('now', '+1 year'), // Génère une date aléatoire
            'statut' => 'en attente', // Statut par défaut
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
