<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UpdateUserRolesSeeder extends Seeder
{
    public function run()
    {
        // Assurez-vous que vous avez le rôle "mentee" existant
        $menteeRole = Role::where('name', 'mentee')->first();
        if (!$menteeRole) {
            $this->command->error('Le rôle "mentee" n\'existe pas.');
            return;
        }

        foreach (User::all() as $user) {
            // Assigner le rôle "mentee" si l'utilisateur n'a pas de rôle valide
            if (!$user->role_id || !Role::find($user->role_id)) {
                $user->role_id = $menteeRole->id;
                $user->save();
            }
        }
    }
}
