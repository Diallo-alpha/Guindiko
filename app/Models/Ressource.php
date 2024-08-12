<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    protected $fillable = ['session_mentorat_id', 'titre', 'lien'];

    // Une ressource appartient à une session de mentorat
    public function sessionMentorat()
    {
        return $this->belongsTo(SessionMentorat::class, 'session_mentorat_id');
    }

}
