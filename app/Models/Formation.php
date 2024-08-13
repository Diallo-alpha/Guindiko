<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = ['domaine_id', 'nom', 'description'];

    // Une formation appartient à un domaine
    public function domaine()
    {
        return $this->belongsTo(Domaine::class, 'domaine_id');
    }

// Définir la relation many-to-many avec le modèle Mentor
public function users()
{
    return $this->belongsToMany(User::class, 'formation_users');
}

    // Une formation peut avoir plusieurs séances de mentorat
    public function sessionsMentorats()
    {
        return $this->hasMany(SessionMentorat::class);
    }
    // Une formation peut avoir une forums
    public function forum()
    {
        return $this->hasOne(Forum::class);
    }
}
