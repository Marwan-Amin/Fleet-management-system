<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('starting_station_id')->constrained('stations')->onDelete('cascade');
            $table->foreignId('ending_station_id')->constrained('stations')->onDelete('cascade');
            $table->foreignId('bus_id')->constrained('stations')->onDelete('cascade');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->integer('available_seats');
            $table->tinyInteger('is_booking_open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
