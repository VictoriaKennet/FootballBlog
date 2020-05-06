<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function userLogin(Request $request) {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token = $user->createToken('token')->accessToken;
            $success['success'] = true;
            $success['token'] = $token;
            return response()->json(['success' => $success, 'user' => $user ], 200);
        }
        else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
