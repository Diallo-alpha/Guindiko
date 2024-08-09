<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SessionMentorat;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ressource>
 */
class RessourceFactory extends Factory
{
    protected $model = \App\Models\Ressource::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_mentorat_id' => SessionMentorat::factory(), // Crée une session de mentorat associée factice
            'titre' => $this->faker->sentence(),
            'lien' => $this->faker->url(),
        ];
    }
}
