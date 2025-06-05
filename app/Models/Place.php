<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'hall_id', 'row', 'place', 'type', 'is_selected'
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function ticket() 
    {
        return $this->hasOne(Ticket::class);
    }
}
