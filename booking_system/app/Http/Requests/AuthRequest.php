<?php

namespace App\Http\Requests;

use App\Rules\ValidatePasswordWithEmail;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
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
        if ($this->path() == 'api/register') {
            return [
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed|min:8'
            ];
        }

        if ($this->path() == 'api/login') {
            return [
                'email' => 'required|string|exists:users',
                'password' => ['required', 'string', new ValidatePasswordWithEmail($this->email)]
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
            'email.exists' => "Email does not exist, please try again"
        ];
    }
}
