<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ressource;

class RessourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ressource::factory()->count(10)->create(); // Crée 10 ressources factices
    }
}
