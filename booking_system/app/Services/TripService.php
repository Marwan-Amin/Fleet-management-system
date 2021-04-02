<?php

namespace App\Services;

use App\Models\Bus;
use App\Models\SmallTrip;
use App\Models\Trip;

class TripService
{
    public function create($data)
    {
        $available_seats = Bus::find($data['bus_id'])->available_seats;
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
            SmallTrip::create([
                'starting_station_id' => $small_trip[0],
                'ending_station_id' => $small_trip[1],
                'available_seats' => $available_seats,
                'trip_id' => $trip->id
            ]);
        }

        return $trip;
    }
}
