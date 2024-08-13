<?php

namespace Database\Factories;

use App\Models\FormationMentor;
use App\Models\SessionMentorat;
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
            'formation_mentor_id' => FormationMentor::inRandomOrder()->first()->id ?? FormationMentor::factory(),
            'date' => $this->faker->dateTime(),
            'duree' => $this->faker->numberBetween(1, 100),
            'statut' => $this->faker->randomElement(['en attente', 'confirmée', 'terminée', 'annulée']),
        ];
    }
}
