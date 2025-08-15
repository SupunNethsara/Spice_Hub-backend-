<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserRegister(\App\Http\Requests\UserRegisterRequest $request)
    {
        try{
            $userRegister = UserRegister::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $userRegister
            ]);
        }
        catch (\Exception $e){
            return response()->json([
                'message' => 'User registration failed',
                'error' => $e->getMessage(),
            ], 500);
        }


    }
    public function userLogin(UserLoginRequest $request)
    {
        $user = UserRegister::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Login successful',
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);

    }


}
