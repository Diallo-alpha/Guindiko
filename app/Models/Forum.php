<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;
    protected $fillable = ['formation_id', 'titre', 'description'];

    // Relation avec la formation
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
