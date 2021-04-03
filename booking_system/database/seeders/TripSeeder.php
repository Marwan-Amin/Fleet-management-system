<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\SmallTrip;
use App\Models\Trip;
use App\Services\TripService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trips = [
            [
                'stations' => [1, 3, 5, 2],
                'bus_id' => 3,
                'departure_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-01 08')->toDateTimeString(),
                'arrival_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-01 16')->toDateTimeString(),
                'is_booking_open' => 1
            ],
            [
                'stations' => [5, 3, 8],
                'bus_id' => 7,
                'departure_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-02 08')->toDateTimeString(),
                'arrival_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-02 16')->toDateTimeString(),
                'is_booking_open' => 1
            ],
            [
                'stations' => [6, 3, 5, 13],
                'bus_id' => 6,
                'departure_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-03 08')->toDateTimeString(),
                'arrival_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-03 16')->toDateTimeString(),
                'is_booking_open' => 1
            ],
            [
                'stations' => [9, 2, 5, 1, 3],
                'bus_id' => 12,
                'departure_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-04 08')->toDateTimeString(),
                'arrival_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-04 16')->toDateTimeString(),
                'is_booking_open' => 1
            ],
            [
                'stations' => [16, 8, 3, 6],
                'bus_id' => 14,
                'departure_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-05 08')->toDateTimeString(),
                'arrival_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-05 16')->toDateTimeString(),
                'is_booking_open' => 1
            ],
            [
                'stations' => [20, 1],
                'bus_id' => 10,
                'departure_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-06 08')->toDateTimeString(),
                'arrival_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-06 16')->toDateTimeString(),
                'is_booking_open' => 1
            ],
            [
                'stations' => [1, 2, 3],
                'bus_id' => 4,
                'departure_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-07 08')->toDateTimeString(),
                'arrival_time' => Carbon::createFromFormat('Y-m-d H', '2021-04-07 16')->toDateTimeString(),
                'is_booking_open' => 1
            ]
        ];
    }
}
