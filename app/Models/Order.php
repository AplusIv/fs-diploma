<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'sum', 'is_paid',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
