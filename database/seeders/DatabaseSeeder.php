<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DomaineSeeder::class,
            FormationSeeder::class,
            RessourceSeeder::class,
            MentorSeeder::class,
            MenteeSeeder::class,
            FormationMentorSeeder::class,
            CommentaireSeeder::class,
            ForumSeeder::class,

        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


    }
}
