<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BusRequest extends FormRequest
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
        if ($this->path() == 'api/bus' && $this->method() == 'POST') {
            return [
                'name' => 'required|string|unique:buses,name',
                'available_seats' => 'required|integer|min:12|max:50'
            ];
        }
        if ($this->path() == 'api/bus/update') {
            return [
                'bus_id' => 'required|integer|min:1|exists:buses,id',
                'name' => 'string|unique:buses,name,' . $this->bus_id,
                'available_seats' => 'integer|min:12|max:50'
            ];
        }
        if ($this->path() == 'api/bus' && $this->method() == 'GET') {
            return [
                'bus_id' => 'required|integer|min:1|exists:buses,id'
            ];
        }
        if ($this->path() == 'api/bus/delete' && $this->method() == 'DELETE') {
            return [
                'bus_id' => 'required|integer|min:1|exists:buses,id'
            ];
        }
        if ($this->path() == 'api/buses') {
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
