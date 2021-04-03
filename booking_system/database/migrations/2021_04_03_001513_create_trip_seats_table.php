<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seat_id')->constrained('seats')->onDelete('cascade');
            $table->foreignId('trip_id')->constrained('small_trips')->onDelete('cascade');
            $table->foreignId('user_id')->nullable();
            $table->tinyInteger('is_reserved')->default(0);
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
        Schema::dropIfExists('trip_seats');
    }
}
