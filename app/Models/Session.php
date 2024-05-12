<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'time', 'movie_id', 'hall_id' 
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
