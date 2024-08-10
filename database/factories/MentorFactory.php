<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mentor>
 */
class MentorFactory extends Factory
{
    protected $model = \App\Models\Mentor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cv' => $this->faker->text(100), // Génère un texte factice pour le champ 'cv'
            'experience' => $this->faker->sentence(),
            'parcours_academique' => $this->faker->sentence(),
            'diplome' => $this->faker->word(),
            'langue' => $this->faker->languageCode(),
            'domaine' => $this->faker->word(),
            'user_id' => User::factory(), // Crée un utilisateur fictif associé
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
