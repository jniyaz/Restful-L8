<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate(
                ['email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if(!Auth::attempt($credentials)) {
                return response()->json(['status_code' => 500, 'message' => 'Unauthorized'], 500);
            }

            $user = Auth::user();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            $data = [
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer'
            ];

            return response()->json($data, 200);
        } catch (\Exception $error) {
            return response()->json(['status_code' => 500, 'message' => 'Error in login', 'error' => $error], 500);
        }
    }
}
