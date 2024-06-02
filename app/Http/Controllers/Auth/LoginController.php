<?php

namespace App\Http\Controllers\Auth;

use App\Const\AuthCode;
use App\Http\Controllers\Controller;
use App\Http\Response\Response;
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

            return Response::successResponse(compact(['token', 'user']), 'auth.login_success');
        }

        return Response::unauthorizedResponse(
            message: 'auth.login_fail'
        );
    }
}
