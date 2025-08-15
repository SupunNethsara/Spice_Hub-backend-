<?php

namespace App\Http\Controllers;

use App\Models\UserRegister;
use Illuminate\Http\Request;

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
    public function userLogin()
    {

    }


}
