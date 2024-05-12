<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'hall_id', 'session_id', 'row', 'place', 'type', 'is_free'
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function ticket() // Не всегда есть билет на место...
    {
        return $this->belongsTo(Ticket::class);
    }
}
