<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Relation pour les réservations faites par ce mentee
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_id');
    }

    // Relation pour les sessions de mentorat où cet utilisateur est le mentor
    public function sessionsMentorat()
    {
        return $this->hasMany(SessionMentorat::class, 'mentor_id');
    }

    // Relation pour les formations associées à cet utilisateur
    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_users');
    }

    // Relation pour les commentaires créés par cet utilisateur
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
    //
    public function devnirMentor()
    {
        return $this->hasOne(DevnirMentor::class);
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    //role et utilisateur
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
