<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formation_mentor extends Model
{
    use HasFactory;
    protected $fillable = ['formation_id', 'mentor_id'];
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
