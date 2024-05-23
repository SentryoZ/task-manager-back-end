<?php

namespace App\Http\Controllers\Auth;

use App\Const\AuthCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard()->attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('loginToken')->plainTextToken;

            return response()->json([
                'status' => AuthCode::LOGIN_SUCCESS,
                'message' => __('auth.login_success'),
                'data' => compact(['token', 'user'])
            ]);
        }

        return response()->json([
            'status' => AuthCode::LOGIN_FAIL,
            'message' => __('auth.login_fail'),
            'data' => []
        ]);
    }
}
