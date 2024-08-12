<?php

namespace Database\Factories;

use App\Models\FormationMentor;
use App\Models\Formation;
use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormationMentor>
 */
class FormationMentorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mentor_id' => Mentor::inRandomOrder()->first()->id ?? Mentor::factory(),
            'formation_id' => Formation::inRandomOrder()->first()->id ?? Formation::factory(),
        ];
    }
}
