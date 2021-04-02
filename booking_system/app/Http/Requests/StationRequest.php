<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StationRequest extends FormRequest
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
        if ($this->path() == 'api/station' && $this->method() == 'POST') {
            return [
                'name' => 'required|string|unique:stations,name',
            ];
        }
        if ($this->path() == 'api/station/update') {
            return [
                'station_id' => 'required|integer|min:1|exists:stations,id',
                'name' => 'string|unique:stations,name,' . $this->station_id,
            ];
        }
        if ($this->path() == 'api/station' && $this->method() == 'GET') {
            return [
                'station_id' => 'required|integer|min:1|exists:stations,id'
            ];
        }
        if ($this->path() == 'api/station/delete' && $this->method() == 'DELETE') {
            return [
                'station_id' => 'required|integer|min:1|exists:stations,id'
            ];
        }
        if ($this->path() == 'api/stations') {
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
}
