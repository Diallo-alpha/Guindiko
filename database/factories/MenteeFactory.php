<?php

namespace Database\Factories;
use App\Models\Mentee;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenteeFactory extends Factory
{
    protected $model = Mentee::class;

    public function definition(): array
    {
        return [
            'parcours_academique' => $this->faker->sentence(),
            'diplome' => $this->faker->word(),
            'langue' => $this->faker->languageCode(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

