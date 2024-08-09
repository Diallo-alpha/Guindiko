<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mentee>
 */
class MenteeFactory extends Factory
{
    protected $model = \App\Models\Mentee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parcours_academique' => $this->faker->sentence(),
            'diplome' => $this->faker->word(),
            'langue' => $this->faker->languageCode(),
            'user_id' => User::factory(), // Crée un utilisateur fictif associé
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
