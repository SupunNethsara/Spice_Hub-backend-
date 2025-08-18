<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use Exception;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function create(Request $request)
    {
      $request->validate([
        'user_registration_id' => 'required',
          'name' => 'required',
        'email' => 'required',
        'phone_number' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
        'postal_code' => 'required',
      ]);
        try {
            $userDetails = UserDetails::create($request->all());
            return response()->json(['message' => 'User details created successfully!', 'userDetails' => $userDetails], 201);
        }
         catch (Exception $e) {
            $error = $e->getMessage();
            return response()->json(['message' => 'User details creation failed', 'error' => $error], 500);
        }
    }

}
