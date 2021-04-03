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
        'updated_at',
        'starting_station_id',
        'ending_station_id',
    ];

    protected $with = [
        'starting_station',
        'ending_station',
        'seats',
    ];

    protected $casts = [
        'is_booking_open' => 'boolean'
    ];

    public function starting_station()
    {
        return $this->belongsTo(Station::class, 'starting_station_id');
    }

    public function ending_station()
    {
        return $this->belongsTo(Station::class, 'ending_station_id');
    }

    public function seats()
    {
        return $this->hasMany(TripSeat::class);
    }
}
