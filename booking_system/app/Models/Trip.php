<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'starting_station_id',
        'ending_station_id',
        'bus_id',
        'departure_time',
        'arrival_time',
        'is_booking_open',
    ];
}
