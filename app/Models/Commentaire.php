<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = ['session_mentorat_id', 'mentee_id', 'contenu'];

    // Un commentaire appartient à une session de mentorat
    public function sessionMentorat()
    {
        return $this->belongsTo(SessionMentorat::class);
    }

    // Un commentaire appartient à un mentee
    public function mentee()
    {
        return $this->belongsTo(Mentee::class);
    }
}
