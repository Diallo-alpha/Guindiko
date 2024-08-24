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
       
        // Créer les rôles
        $adminRole = Role::create(['name' => 'admin']);
        $mentorRole = Role::create(['name' => 'mentor']);
        $menteeRole = Role::create(['name' => 'mentee']);

        // Créer les utilisateurs
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'adiaratououmyfall@gmail.com',
            'password' => bcrypt('password'),
            'parcours_academique' => 'Parcours académique par défaut',
            'diplome' => 'Diplôme par défaut',
            'langue' => 'Langue par défaut',
            'cv' => null,
            'experience' => 'Expérience par défaut',
            'domaine' => 'Domaine par défaut',
            'formation_id' => 1,
            'role_id' => $adminRole->id,
        ]);
        $adminUser->assignRole($adminRole);

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
            'role_id' => $mentorRole->id,
        ]);
        $mentorUser->assignRole($mentorRole);

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
            'role_id' => $menteeRole->id,
        ]);
        $menteeUser->assignRole($menteeRole);
    }
}
