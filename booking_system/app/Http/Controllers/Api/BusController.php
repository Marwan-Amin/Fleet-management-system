<?php

namespace App\Http\Controllers\Api;

use App\Events\BusCreated;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\BusRequest;
use App\Http\Resources\Bus\BusCollection;
use App\Models\Bus;

class BusController extends Controller
{
    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function create(BusRequest $request)
    {
        $bus = Bus::create($request->validated());
        event(new BusCreated($bus));
        return $this->apiResponse->setSuccess("Success: A new bus has been created successfully")->setData($bus)->returnJSON();
    }

    public function update(BusRequest $request)
    {
        $bus = Bus::find($request->validated()['bus_id']);
        $bus->update($request->validated());
        return $this->apiResponse->setSuccess("Success: This bus information has been updated successfully")->setData($bus)->returnJSON();
    }

    public function view(BusRequest $request)
    {
        $bus = Bus::find($request->validated()['bus_id']);
        return $this->apiResponse->setSuccess("Success: This bus has been loaded successfully")->setData($bus)->returnJSON();
    }

    public function all(BusRequest $request)
    {
        $buses = Bus::paginate(10);
        return $this->apiResponse->setSuccess("Success: All buses have been loaded successfully")->setData(($buses))->returnJSON();
    }

    public function delete(BusRequest $request)
    {
        Bus::find($request->validated()['bus_id'])->delete();
        return $this->apiResponse->setSuccess("Success: This bus has been deleted successfully")->setData()->returnJSON();
    }
}
