<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Role;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function register(AuthRequest $request)
    {
        $data = $request->validated();
        $data['role_id'] = Role::CUSTOMER_ROLE_ID;
        $user = User::create($data);
        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return $this->apiResponse->setSuccess("Success: You have been registered successfully")->setData($response)->returnJSON();
    }

    public function login(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return $this->apiResponse->setSuccess("Success: You have been logged in successfully")->setData($response)->returnJSON();
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->apiResponse->setSuccess("Success: You have been logged out successfully")->setData()->returnJSON();
    }
}
