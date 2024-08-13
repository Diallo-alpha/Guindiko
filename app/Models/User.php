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
      // Relations avec mentor et mentee
      public function mentor()
      {
          return $this->hasOne(Mentor::class);
      }

      public function mentee()
      {
          return $this->hasOne(Mentee::class);
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

     // Dans le modèle User
public function reservations()
{
    return $this->hasMany(Reservation::class, 'mentee_id');
}

}
