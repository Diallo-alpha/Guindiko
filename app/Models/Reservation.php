<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['mentee_id', 'session_mentorat_id', 'statut'];

    // Une réservation est faite par un mentee
    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }

    // Une réservation est pour une session de mentorat spécifique
    public function sessionMentorat()
    {
        return $this->belongsTo(SessionMentorat::class, 'session_mentorat_id');
    }
}
