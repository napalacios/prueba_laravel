<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request){

        $credentials = $request->validated();
        
        if(!Auth::attempt($credentials)){
            return response([
                'message' => 'Provided email adress or password is incorrect'
            ], 422);
        }

        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response(compact(
            'user',
            'token'
        ));

    }
}