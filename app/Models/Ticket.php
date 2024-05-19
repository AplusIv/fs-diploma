<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id', 'session_id', 'order_id', 'status'
    ];

    public function place()
    {
        // return $this->hasOne(Place::class);
        return $this->belongsTo(Place::class);

    }

    // public function session()
    // {
    //     return $this->hasOne(Session::class);
    // }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
