<?php

namespace Database\Factories;
use App\Models\Commentaire;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaire>
 */
class CommentaireFactory extends Factory
{
    protected $model = Commentaire::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_mentorat_id' => \App\Models\SessionMentorat::factory(),
            'mentee_id' => \App\Models\Mentee::factory(),
            'contenu' => $this->faker->paragraph(),
        ];
    }
}
