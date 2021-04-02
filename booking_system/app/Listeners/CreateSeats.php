<?php

namespace App\Listeners;

use App\Events\BusCreated;
use App\Models\Seat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateSeats
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BusCreated  $event
     * @return void
     */
    public function handle(BusCreated $event)
    {
        for ($i = 0; $i < $event->bus->available_seats; $i++) {
            Seat::create([
                'seat_number' => $event->bus->name . '-' . ($i + 1),
                'bus_id' => $event->bus->id
            ]);
        }
    }
}
