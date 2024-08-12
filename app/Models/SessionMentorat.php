<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionMentorat extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Une session de mentorat est animée par un mentor
    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    public function formationMentor()
    {
        return $this->belongsTo(FormationMentor::class, 'formation_mentor_id');
    }
    // Une session de mentorat peut avoir plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Une session de mentorat peut avoir plusieurs ressources
    public function ressources()
    {
        return $this->hasMany(Ressource::class);
    }
    public function mentees()
    {
        return $this->belongsToMany(Mentee::class, 'session_mentorat_mentees', 'session_mentorat_id', 'mentee_id');
    }

}
