<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmallTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'starting_station_id',
        'ending_station_id',
        'is_booking_open',
        'available_seats',
        'trip_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
