<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest;
use App\Models\Trip;
use App\Services\TripService;

class TripController extends Controller
{
    public function __construct(ApiResponse $apiResponse, TripService $tripService)
    {
        $this->service = $tripService;
        $this->apiResponse = $apiResponse;
    }

    public function create(TripRequest $request)
    {
        $trip = $this->service->create($request->validated());
        return $this->apiResponse->setSuccess("Success: A new trip has been created successfully")->setData($trip)->returnJSON();
    }

    public function update(TripRequest $request)
    {
        $trip = Trip::find($request->validated()['trip_id']);
        $trip->update($request->validated());
        return $this->apiResponse->setSuccess("Success: This trip information has been updated successfully")->setData($trip)->returnJSON();
    }

    public function view(TripRequest $request)
    {
        $trip = Trip::find($request->validated()['trip_id']);
        return $this->apiResponse->setSuccess("Success: This trip has been loaded successfully")->setData($trip)->returnJSON();
    }

    public function all(TripRequest $request)
    {
        $trips = Trip::paginate(10);
        return $this->apiResponse->setSuccess("Success: All trips have been loaded successfully")->setData($trips)->returnJSON();
    }

    public function delete(TripRequest $request)
    {
        Trip::find($request->validated()['trip_id'])->delete();
        return $this->apiResponse->setSuccess("Success: This trip has been deleted successfully")->setData()->returnJSON();
    }
}
