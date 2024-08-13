<?php

namespace Database\Factories;

use App\Models\FormationMentor;
use App\Models\Formation;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormationMentor>
 */
class FormationUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'formation_id' => Formation::inRandomOrder()->first()->id ?? Formation::factory(),
        ];
    }
}
