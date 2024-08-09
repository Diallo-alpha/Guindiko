<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    // Un mentee est associé à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un mentee peut faire plusieurs réservations pour des sessions de mentorat
    public function reservations()
    {
        return $this->belongsToMany(SessionMentorat::class, 'reservations')
                    ->withPivot('statut')
                    ->withTimestamps();
    }
    
}
