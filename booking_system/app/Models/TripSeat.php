<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_id',
        'small_trip_id',
        'user_id',
        'is_reserved'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_reserved' => 'boolean'
    ];

    public function isReserved()
    {
        return $this->is_reserved;
    }
}
