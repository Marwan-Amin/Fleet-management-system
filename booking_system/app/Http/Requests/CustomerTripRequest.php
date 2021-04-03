<?php

namespace App\Http\Requests;

use App\Rules\DifferentSeats;
use App\Rules\NotReservedSeatValidation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CustomerTripRequest extends FormRequest
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
        if ($this->path() == 'api/available-trips') {
            return [
                'starting_station_id' => 'integer|min:1|exists:stations,id',
                'ending_station_id' => 'required|integer|min:1|exists:stations,id',
                'seats' => 'required|integer|min:1',
            ];
        }

        if ($this->path() == 'api/trip/book-small-trip') {
            return [
                'small_trip_id' => 'required|integer|min:1|exists:small_trips,id',
                'trip_seats' => ['array', new DifferentSeats],
                'trip_seats.*' => [
                    'required', 'integer', 'min:1', Rule::exists('trip_seats', 'id')->where(function ($query) {
                        return $query->where('small_trip_id', $this->small_trip_id);
                    }), new NotReservedSeatValidation($this)
                ],
            ];
        }

        if ($this->path() == 'api/trip/book') {
            return [
                'trip_id' => 'required|integer|min:1|exists:trips,id',
                'starting_station_id' => 'required|integer|min:1|exists:stations,id',
                'ending_station_id' => 'required|integer|min:1|exists:stations,id',
                'trip_seats' => ['array', new DifferentSeats],
                'trip_seats.*' => [
                    'required', 'integer', 'min:1', new NotReservedSeatValidation($this)
                ],
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
            'trip_seats.*.exists' => 'Trip seats ids are not valid, please select valid seat ids'
        ];
    }
}
