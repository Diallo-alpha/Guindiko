<?php

namespace Database\Factories;
use App\Models\Forum;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Forum>
 */
class ForumFactory extends Factory
{
    protected $model = Forum::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'formation_id' => Formation::factory(), // Crée une formation si elle n'existe pas
            'titre' => $this->faker->sentence, // Génère une phrase pour le titre
            'description' => $this->faker->paragraph, // Génère un paragraphe pour la description
        ];
    }
}
