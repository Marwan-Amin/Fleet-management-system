<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'available_seats',
        'is_reserved'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_reserved' => 'boolean'
    ];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
