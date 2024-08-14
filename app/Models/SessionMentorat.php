<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionMentorat extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Une session de mentorat peut avoir plusieurs réservations.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'session_mentorat_id');
    }

    /**
     * Une session de mentorat peut avoir plusieurs ressources.
     */
    public function ressources()
    {
        return $this->hasMany(Ressource::class, 'session_mentorat_id');
    }

    /**
     * Une session de mentorat peut être associée à plusieurs utilisateurs (mentee) via les réservations.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'reservations', 'session_mentorat_id', 'user_id')
                    ->withPivot('statut')
                    ->withTimestamps();
    }

    /**
     * Une session de mentorat est associée à une formation utilisateur.
     */
    public function formationUser()
    {
        return $this->belongsTo(FormationUser::class, 'formation_user_id');
    }

    /**
     * Relation vers l'utilisateur (mentor) qui anime la session de mentorat.
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assurez-vous que 'user_id' est le bon champ
    }
}
