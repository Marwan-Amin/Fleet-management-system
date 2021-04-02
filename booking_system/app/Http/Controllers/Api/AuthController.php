<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Role;
use App\Models\User;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $data = $request->validated();
        $data['role_id'] = Role::CUSTOMER_ROLE_ID;
        $user = User::create($data);
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    public function login(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out'
        ]);
    }
}
