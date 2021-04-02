<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bus::factory()
            ->count(20)
            ->create();

        foreach (Bus::all() as $key => $bus) {
            for ($i = 0; $i < $bus->available_seats; $i++) {
                Seat::create([
                    'seat_number' => $bus->name . '-' . ($i + 1),
                    'bus_id' => $bus->id
                ]);
            }
        }
    }
}
