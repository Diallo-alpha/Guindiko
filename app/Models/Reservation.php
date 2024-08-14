<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory; 

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = ['user_id', 'session_mentorat_id', 'statut'];

    // Relation : Une réservation est faite par un utilisateur (mentee)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation : Une réservation est pour une session de mentorat spécifique
    public function sessionMentorat()
    {
        return $this->belongsTo(SessionMentorat::class, 'session_mentorat_id');
    }
}
