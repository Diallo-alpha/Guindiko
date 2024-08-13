<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
   

    //    Get the identifier that will be stored in the subject claim of the JWT.
      
     public function getJWTIdentifier()
     {
         return $this->getKey();
     }
 
     /**
      * Return a key value array, containing any custom claims to be added to the JWT.
      */
     public function getJWTCustomClaims()
     {
         return [];
     }

public function reservations()
{
    return $this->hasMany(Reservation::class);
}

// Un mentee peut réserver plusieurs sessions de mentorat
public function sessions()
{
    return $this->belongsToMany(SessionMentorat::class, 'reservations')
                ->withPivot('statut')
                ->withTimestamps();
}


    // Un mentor peut animer plusieurs sessions de mentorat
    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }
  // Définir la relation many-to-many avec le modèle Formation
  public function formations()
  {
      return $this->belongsToMany(Formation::class, 'formation_users');
  }

}
