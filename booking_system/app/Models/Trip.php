<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

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

    protected $hidden = [
        'created_at',
        'updated_at',
        'bus_id',
        'starting_station_id',
        'ending_station_id',
    ];

    protected $with = [
        'starting_station',
        'ending_station',
        'bus',
        'smallTrips',
    ];

    protected $casts = [
        'is_booking_open' => 'boolean'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function smallTrips()
    {
        return $this->hasMany(SmallTrip::class);
    }

    public function starting_station()
    {
        return $this->belongsTo(Station::class, 'starting_station_id');
    }

    public function ending_station()
    {
        return $this->belongsTo(Station::class, 'ending_station_id');
    }
}
