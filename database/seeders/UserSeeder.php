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
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admintest@example.com',
            'password' => bcrypt('password'),
            'parcours_academique' => 'Parcours académique par défaut',  // Ajouté ici
            'diplome' => 'Diplôme par défaut',
            'langue' => 'Langue par défaut',
            'cv' => null,
            'experience' => 'Expérience par défaut',
            'domaine' => 'Domaine par défaut',
            'formation_id' => 1, 
        ]);

        // Récupérer le rôle 'admin'
        $adminRole = Role::where('name', 'admin')->first();

        // Assigner le rôle 'admin' à l'utilisateur
        if ($adminRole) {
            $user->assignRole($adminRole);
        } else {
            // Si le rôle 'admin' n'existe pas, créez-le et l'assignez
            $adminRole = Role::create(['name' => 'admin']);
            $user->assignRole($adminRole);
        }
}
}
