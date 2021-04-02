<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bus_id',
        'seat_number',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
