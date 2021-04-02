<?php

namespace App\Http\Requests;

use App\Rules\DifferentStations;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->path() == 'api/trip' && $this->method() == 'POST') {
            return [
                'stations' => ['array', new DifferentStations()],
                'stations.*' => ['required', 'integer', 'exists:stations,id'],
                'bus_id' => 'required|integer|exists:buses,id|unique:trips,bus_id',
                'departure_time' => 'required|date',
                'arrival_time' => 'required|date',
                'is_booking_open' => 'required|boolean'
            ];
        }
        if ($this->path() == 'api/trip/update') {
            return [
                'stations' => 'array',
                'stations.*' => ['required', 'integer', 'exists:stations,id'],
                'bus_id' => 'integer|exists:buses,id',
                'departure_time' => 'date',
                'arrival_time' => 'date',
                'is_booking_open' => 'boolean'
            ];
        }
        if ($this->path() == 'api/trip' && $this->method() == 'GET') {
            return [
                'trip_id' => 'required|integer|min:1|exists:trips,id'
            ];
        }
        if ($this->path() == 'api/trip/delete' && $this->method() == 'DELETE') {
            return [
                'trip_id' => 'required|integer|min:1|exists:trips,id'
            ];
        }
        if ($this->path() == 'api/trips') {
            return [
                // 
            ];
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()->first(),
                    'data' => null
                ],
                400
            )
        );
    }

    public function messages()
    {
        return [
            'in_between_stations.*.exists' => "One of the in-between stations is not correct"
        ];
    }
}
