<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\UserDetails;
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
            UserDetails::create([
               'user_registration_id' => $userRegister->id,
                'name' => $request->name,
                'email' => $request->email,
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
    private function checkDetailsComplete(UserDetails $details): bool
    {
        return !empty($details->province) &&
            !empty($details->district) &&
            !empty($details->city) &&
            !empty($details->address) &&
            !empty($details->postal_code) &&
            !empty($details->phone);
    }
    public function userLogin(UserLoginRequest $request)
    {
        $user = UserRegister::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('auth-token')->plainTextToken;
            $detailsComplete = $this->checkDetailsComplete($user->details);

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token ,
                'details_complete' => $detailsComplete,
                'details' => $user->details
            ]);
        }
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
    public function userLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout successful'
        ]);
    }



}
