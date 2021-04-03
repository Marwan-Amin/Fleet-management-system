<?php

namespace App\Rules;

use App\Models\SmallTrip;
use App\Models\TripSeat;
use Illuminate\Contracts\Validation\Rule;

class NotReservedSeatValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->request->path() == 'api/trip/book-small-trip') {
            $seat = TripSeat::find($value);
            if (!$seat) {
                return false;
            }
            return !$seat->isReserved();
        }

        if ($this->request->path() == 'api/trip/book') {
            $smallTrips = SmallTrip::where(function ($query) {
                $query->where('trip_id', $this->request->trip_id);
            })->Where(function ($query) {
                $query->where('starting_station_id', $this->request->starting_station_id)
                    ->orwhere('ending_station_id', $this->request->ending_station_id);
            })->get();

            foreach ($smallTrips as $smallTrip) {
                foreach ($this->request->trip_seats as $seat_id) {
                    $tripSeat = TripSeat::where('small_trip_id', $smallTrip->id)->where('seat_id', $seat_id)->first();
                    if ($tripSeat->isReserved()) {
                        return false;
                    }
                }
            }
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'One of these seats is resereved, please make sure to select an available seat';
    }
}
