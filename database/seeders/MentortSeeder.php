<?php

namespace Database\Seeders;

use App\Models\Mentort;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mentort::factory()->count(10)->create(); // Crée 10 domaines factices
        
    }
}
