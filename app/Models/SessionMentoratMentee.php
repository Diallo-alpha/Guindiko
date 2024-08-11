<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionMentoratMentee extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Définition de la relation "belongsToMany" entre les sessions de mentorat et les mentees.
     *
     * Cette relation indique qu'une session de mentorat peut être associée à plusieurs mentees,
     * et inversement, un mentee peut être associé à plusieurs sessions de mentorat.
     * La table pivot "session_mentorat_mentee" est utilisée pour stocker ces associations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mentees()
    {
        return $this->belongsToMany(Mentee::class, 'session_mentorat_mentees', 'session_mentorat_id', 'mentee_id')
                    ->using(SessionMentoratMentee::class);
    }
}

