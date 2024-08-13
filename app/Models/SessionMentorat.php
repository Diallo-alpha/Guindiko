<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionMentorat extends Model
{
    use HasFactory;

    protected $guarded = [];

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


    // Une session de mentorat peut être réservée par plusieurs mentees
    public function users()
    {
        return $this->belongsToMany(User::class, 'reservations')
                    ->withPivot('statut')
                    ->withTimestamps();
    }

    public function formationUser()
    {
        return $this->belongsTo(FormationUser::class, 'formation_user_id');
    }

}
