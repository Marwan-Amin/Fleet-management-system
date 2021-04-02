<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Station::create(['name' => 'Alexandria']);
        Station::create(['name' => 'Cairo']);
        Station::create(['name' => 'Asyut']);
        Station::create(['name' => 'Fayoum']);
        Station::create(['name' => 'Minya']);
        Station::create(['name' => 'Port Said']);
        Station::create(['name' => 'Suez']);
        Station::create(['name' => 'north Sinai']);
        Station::create(['name' => 'Kafr Elsheikh']);
        Station::create(['name' => 'Red Sea']);
        Station::create(['name' => 'Giza']);
        Station::create(['name' => 'Mansora']);
        Station::create(['name' => 'Qena']);
        Station::create(['name' => 'Aswan']);
        Station::create(['name' => 'New Valley']);
        Station::create(['name' => 'Luxor']);
        Station::create(['name' => 'Beni Suef']);
        Station::create(['name' => 'Sharqia']);
        Station::create(['name' => 'Monufia']);
        Station::create(['name' => 'Ismailia']);
        Station::create(['name' => 'Gharbia']);
        Station::create(['name' => 'Beheira']);
        Station::create(['name' => 'Dakahlia']);
    }
}
