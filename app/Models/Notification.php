<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentee_id', 'mentor_id', 'session_id', 'message', 'is_read'
    ];

    public function mentee()
    {
        return $this->belongsTo(Mentee::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
