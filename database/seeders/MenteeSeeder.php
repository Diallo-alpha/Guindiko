<?php

namespace Database\Seeders;

use App\Models\Mentee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crée 10 utilisateurs fictifs et pour chacun, crée un mentee associé
        User::factory(10)->create()->each(function ($user) {
            Mentee::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
