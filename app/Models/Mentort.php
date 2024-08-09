<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentort extends Model
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
        return $this->hasMany(SessionMentorat::class, 'mentort_id');
    }
}
