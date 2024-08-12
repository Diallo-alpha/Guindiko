<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_mentorat_id', 'statut'];

    // Une réservation est faite par un  mentee
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Une réservation est pour une session de mentorat spécifique
    public function mentee()
    {
        return $this->belongsTo(Mentee::class, 'mentee_id');
    }

    // Une réservation est pour une session de mentorat spécifique
    public function sessionMentorat()
    {
        return $this->belongsTo(SessionMentorat::class, 'session_mentorat_id');
    }

}
