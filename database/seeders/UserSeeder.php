<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Supprimer tous les utilisateurs existants
        User::truncate();

        // Supprimer les rôles existants si nécessaire
        Role::truncate();

        // Créer les rôles
        $adminRole = Role::create(['name' => 'admin']);
        $mentorRole = Role::create(['name' => 'mentor']);
        $menteeRole = Role::create(['name' => 'mentee']);

        // Créer un nouvel utilisateur et lui attribuer le rôle de mentor
        $mentorUser = User::create([
            'name' => 'alpha',
            'email' => 'alpha.exemple@gmail.com',
            'password' => Hash::make('password'),
            'parcours_academique' => 'Master en Informatique',
            'diplome' => 'Master',
            'langue' => 'Français',
            'cv' => null,
            'experience' => '5 ans en développement web',
            'domaine' => 'Informatique',
            'formation_id' => 1,
        ]);

        // Assigner le rôle de mentor
        $mentorUser->assignRole($mentorRole);
    }
}
