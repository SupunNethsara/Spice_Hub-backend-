<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use Exception;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function getUserDetails(Request $request)
    {
        try {
            $userDetails = UserDetails::where('user_registration_id', $request->user()->id)->first();
            return response()->json([
                'message' => 'User details fetched successfully',
                'userDetails' => $userDetails
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'User details fetch failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
