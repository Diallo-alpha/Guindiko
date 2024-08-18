<?php

namespace App\Models;
use App\Models\DevenirMentor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\DevenirMentorRecue;
use Illuminate\Support\Facades\Notification;
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
  // Définir la relation many-to-many avec le modèle Formation
  public function formations()
  {
      return $this->belongsToMany(Formation::class, 'formation_mentors');
  }
  //devenir mentor
  public function store(Request $request)
    {
        // Créer une demande de mentorat
        $demande = DevnirMentor::create([
            'user_id' => auth()->id(),
            'parcours_academique' => $request->parcours_academique,
            'diplome' => $request->diplome,
            'langue' => $request->langue,
            'cv' => $request->cv,
            'experience' => $request->experience,
            'domaine' => $request->domaine,
        ]);

        // Envoyer une notification à l'admin
        $admins = User::role('admin')->get();
        Notification::send($admins, new DevenirMentorRecue($demande));

        return response()->json(['message' => 'Demande de mentorat soumise avec succès.'], 200);
    }
}
