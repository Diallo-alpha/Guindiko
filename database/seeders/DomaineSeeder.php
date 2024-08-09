<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domaine;

class DomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Domaine::factory()->count(10)->create(); // Crée 10 domaines factices
    }
}
