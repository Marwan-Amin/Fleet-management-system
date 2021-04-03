<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_id',
        'trip_id',
        'user_id',
        'is_reserved'
    ];
}
