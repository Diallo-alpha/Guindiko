<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
   /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des rôles
        $adminRole = Role::create(['name' => 'admin']);
        $mentorRole = Role::create(['name' => 'mentor']);
        $menteeRole = Role::create(['name' => 'mentee']);

        // Création des permissions
        $permissions = [
            // Permissions pour ressource
            'afficher une ressource',
            'ajouter une ressource',
            'modifier une ressource',
            'supprimer une ressource',
            // Permissions pour formation
            'afficher une formation',
            'ajouter une formation',
            'modifier une formation',
            'supprimer une formation',
            // Permissions pour session
            'afficher une session',
            'ajouter une session',
            // Permissions pour utilisateur
            'afficher les utilisateurs',
            "modifier le statut d'un utilisateur",
            'supprimer un utilisateur',
            // Permissions pour rôle
            'afficher une role',
            'ajouter une role',
            'modifier une role',
            'supprimer une role',
            // Permissions pour permission
            'afficher une permission',
            'ajouter une permission',
            'modifier une permission',
            'supprimer une permission',
            //permissions pour mentorat
            'accepter une demande de mentorat',
            'faire la demande de mentorat',


        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Attribution des permissions aux rôles
        // Le rôle admin obtient toutes les permissions
        $adminRole->givePermissionTo(Permission::all());

        // Le rôle mentor obtient les permissions de ressource et de formation
        $mentorRole->givePermissionTo([
            'afficher une ressource',
            'ajouter une ressource',
            'modifier une ressource',
            'supprimer une ressource',
            'afficher une formation',
            'ajouter une formation',
            'modifier une formation',
            'supprimer une formation',
            'afficher une session',
            'ajouter une session',
            'accepter une demande de mentorat',
        ]);

        // Le rôle mentee obtient uniquement les permissions d'affichage
        $menteeRole->givePermissionTo([
            'afficher une ressource',
            'afficher une formation',
            'afficher une session',
            'faire la demande de mentorat',
        ]);
    }
}
