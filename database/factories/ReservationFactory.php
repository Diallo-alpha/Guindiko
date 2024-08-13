<?php

namespace Database\Factories;

use App\Models\SessionMentorat;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10), // Crée ou utilise un utilisateur
            'session_mentorat_id' => SessionMentorat::factory(), // Crée ou utilise une session de mentorat
            'statut' => $this->faker->randomElement(['en attente', 'confirmée', 'annulée']), // Choisit un statut au hasard
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
