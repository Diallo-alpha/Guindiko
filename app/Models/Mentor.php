<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Un mentor est associé à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un mentor peut animer plusieurs sessions de mentorat
    public function sessionsMentorat()
    {
        return $this->hasMany(SessionMentorat::class, 'mentor_id');
    }
    public function formation()
    {
        return $this->belongsTo(SessionMentorat::class, 'formation_id');
    }
}
