<?php

namespace Database\Seeders;

use App\Models\Mentee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mentee::factory()->count(10)->create(); // Crée 10 mentees fictifs

    }
}
