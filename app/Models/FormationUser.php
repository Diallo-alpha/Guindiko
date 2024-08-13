<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationUser extends Model
{
    use HasFactory;
    protected $fillable = ['formation_id', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function sessionsMentorat()
    {
        return $this->hasMany(SessionMentorat::class, 'formation_user_id');
    }
}
