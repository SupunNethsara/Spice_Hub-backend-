<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password'=>'required',
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken ;

            return response()->json(['token' => $token , 'user' => $user]);
        }
        return response()->json(['message'=> 'unauthorized'],401);
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message'=> 'Logged Out']);
    }

}
