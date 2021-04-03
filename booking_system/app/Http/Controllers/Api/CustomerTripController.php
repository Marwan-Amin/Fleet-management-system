<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerTripRequest;
use App\Models\SmallTrip;
use App\Models\Trip;
use App\Services\TripService;

class CustomerTripController extends Controller
{
    public function __construct(ApiResponse $apiResponse, TripService $tripService)
    {
        $this->service = $tripService;
        $this->apiResponse = $apiResponse;
    }

    public function all(CustomerTripRequest $request)
    {
        $smallTrips = SmallTrip::where('ending_station_id', $request->ending_station_id)->where('available_seats', '>=', $request->seats)->get();
        $trips_ids = [];
        foreach ($smallTrips as $trip) {
            $trips_ids[] = $trip->trip_id;
        }
        $trips = Trip::whereIn('id', $trips_ids)->paginate(5);
        return $this->apiResponse->setSuccess("Success: All available trips have been loaded successfully")->setData($trips)->returnJSON();
    }

    public function bookSmallTrip(CustomerTripRequest $request)
    {
        $this->service->bookSmallTrip($request->validated());
        return $this->apiResponse->setSuccess("Success: You have booked this trip successfully")->setData()->returnJSON();
    }

    public function book(CustomerTripRequest $request)
    {
        $this->service->book($request->validated());
        return $this->apiResponse->setSuccess("Success: You have booked this trip successfully")->setData()->returnJSON();
    }
}
