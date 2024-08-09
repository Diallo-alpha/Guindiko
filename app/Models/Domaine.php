<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description'];

    // Un domaine peut avoir plusieurs formations
    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}
