<?php

namespace App\Services;

use App\Models\Bus;
use App\Models\Seat;
use App\Models\SmallTrip;
use App\Models\Trip;
use App\Models\TripSeat;

class TripService
{
    public function create($data)
    {
        $bus = Bus::find($data['bus_id']);
        $bus->is_reserved = 1;
        $bus->update();
        $available_seats = $bus->available_seats;
        $data['starting_station_id'] = $data['stations'][0];
        $data['ending_station_id'] = end($data['stations']);
        $trip = Trip::create($data);

        $small_trips = [];
        foreach ($data['stations'] as $key => $station) {
            if ($key < (count($data['stations']) - 1)) {
                $small_trips[] = [$data['stations'][$key], $data['stations'][$key + 1]];
            }
        }

        foreach ($small_trips as $small_trip) {
            $newSmallTrip = SmallTrip::create([
                'starting_station_id' => $small_trip[0],
                'ending_station_id' => $small_trip[1],
                'available_seats' => $available_seats,
                'trip_id' => $trip->id
            ]);

            $seats = Seat::where('bus_id', $data['bus_id'])->get();
            foreach ($seats as $seat) {
                TripSeat::create([
                    'seat_id' => $seat->id,
                    'trip_id' => $newSmallTrip->id,
                ]);
            }
        }

        return $trip;
    }

    public function delete($trip_id)
    {
        $trip = Trip::find($trip_id);
        Bus::find($trip->bus_id)->update([
            'is_reserved' => 0
        ]);
        $trip->delete();
    }
}
