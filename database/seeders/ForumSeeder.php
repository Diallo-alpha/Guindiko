<?php

namespace Database\Seeders;
use App\Models\Formation;
use App\Models\Forum;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Formation::all()->each(function ($formation) {
            Forum::factory()->create([
                'formation_id' => $formation->id,
            ]);
        });
    }
}
