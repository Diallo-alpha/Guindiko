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
            RolesAndPermissionsSeeder::class,
            FormationUserSeeder::class,
            UserSeeder::class,
            DemandeMentoratSeeder::class,
            ForumSeeder::class,
            CommentaireSeeder::class,

        ]);

    }
}
