<?php

namespace Database\Factories;
use App\Models\FormationUser;
use App\Models\User;
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
            'user_id' => User::factory(), // Associe un mentor fictif
            'date' => $this->faker->dateTimeBetween('now', '+1 year'), // Génère une date aléatoire
            'duree' => $this->faker->numberBetween(30, 120), // Durée aléatoire entre 30 et 120 minutes
            'statut' => 'en attente', // Statut par défaut
            'created_at' => now(),
            'updated_at' => now(),
            'formation_user_id' => FormationUser::inRandomOrder()->first()->id ?? FormationUser::factory(),
            'date' => $this->faker->dateTime(),
            'duree' => $this->faker->numberBetween(1, 100),
            'statut' => $this->faker->randomElement(['en attente', 'confirmée', 'terminée', 'annulée']),
        ];
    }
}
