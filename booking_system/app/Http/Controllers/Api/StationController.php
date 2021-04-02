<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StationRequest;
use App\Models\Station;

class StationController extends Controller
{
    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function create(StationRequest $request)
    {
        $station = Station::create($request->validated());
        return $this->apiResponse->setSuccess("Success: A new station has been created successfully")->setData($station)->returnJSON();
    }

    public function update(StationRequest $request)
    {
        $station = Station::find($request->validated()['station_id']);
        $station->update($request->validated());
        return $this->apiResponse->setSuccess("Success: This station information has been updated successfully")->setData($station)->returnJSON();
    }

    public function view(StationRequest $request)
    {
        $station = Station::find($request->validated()['station_id']);
        return $this->apiResponse->setSuccess("Success: This station has been loaded successfully")->setData($station)->returnJSON();
    }

    public function all(StationRequest $request)
    {
        $stations = Station::all();
        return $this->apiResponse->setSuccess("Success: All stations have been loaded successfully")->setData($stations)->returnJSON();
    }

    public function delete(StationRequest $request)
    {
        Station::find($request->validated()['station_id'])->delete();
        return $this->apiResponse->setSuccess("Success: This station has been deleted successfully")->setData()->returnJSON();
    }
}
