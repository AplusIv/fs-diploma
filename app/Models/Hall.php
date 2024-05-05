<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'rows', 'places'
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
