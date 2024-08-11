<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionMentorat extends Model
{
    use HasFactory;

    protected $fillable = ['mentor_id', 'mentee_id', 'date', 'statut'];

    // Une session de mentorat est animée par un mentor
    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    // Une session de mentorat a un  ou plusieurs mentee
    public function mentees()
    {
        return $this->belongsToMany(Mentee::class, 'session_mentorat_mentee', 'session_mentorat_id', 'mentee_id');
    }

    // Une session de mentorat peut avoir plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Une session de mentorat peut avoir plusieurs ressources
    public function ressources()
    {
        return $this->hasMany(Ressources::class);
    }
}
