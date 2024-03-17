<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'token' => $request->user()->createToken('')->plainTextToken
        ]);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
    public function logout()
    {
        
    }
}
