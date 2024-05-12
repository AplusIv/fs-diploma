<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id', 'session_id'
    ];

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
