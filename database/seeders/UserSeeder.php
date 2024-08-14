<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création de l'utilisateur admin
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admintest@example.com',
            'password' => bcrypt('password'),
            'parcours_academique' => 'Parcours académique par défaut',
            'diplome' => 'Diplôme par défaut',
            'langue' => 'Langue par défaut',
            'cv' => null,
            'experience' => 'Expérience par défaut',
            'domaine' => 'Domaine par défaut',
            'formation_id' => 1,
        ]);

        // Récupérer le rôle 'admin'
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Assigner le rôle 'admin' à l'utilisateur
        $adminUser->assignRole($adminRole);

        //création de l'utilisateur mentor
        $mentorUser = User::create([
            'name' => 'Cheikh Sane',
            'email' => 'cheikhsane656@gmail.com',
            'password' => bcrypt('password'),
            'parcours_academique' => 'Master en Informatique',
            'diplome' => 'Master',
            'langue' => 'Anglais',
            'cv' => null,
            'experience' => '3 ans en développement web et mobile',
            'domaine' => 'Informatique',
            'formation_id' => 1,
        ]);

        // Récupérer le rôle'mentor'
        $mentorRole = Role::firstOrCreate(['name' => 'mentor']);

        // Assigner le rôle'mentor' à l'utilisateur
        $mentorUser->assignRole($mentorRole);

        // Création de l

        // Création de l'utilisateur mentee
        $menteeUser = User::create([
            'name' => 'Amina Ndiaye',
            'email' => 'ndiayeamina775@gmail.com',
            'password' => bcrypt('password'),
            'parcours_academique' => 'Licence en Informatique',
            'diplome' => 'Licence',
            'langue' => 'Français',
            'cv' => null,
            'experience' => '2 ans en développement web',
            'domaine' => 'Informatique',
            'formation_id' => 1,
        ]);

        // Récupérer le rôle 'mentee'
        $menteeRole = Role::firstOrCreate(['name' => 'mentee']);

        // Assigner le rôle 'mentee' à l'utilisateur
        $menteeUser->assignRole($menteeRole);
    }
}

