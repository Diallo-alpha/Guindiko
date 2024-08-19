<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ressource;
use App\Models\Ressources;

class RessourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ressource::factory()->count(7)->create(); // Crée 10 ressources factices
    }
}
