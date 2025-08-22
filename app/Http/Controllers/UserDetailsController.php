<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDetailsUpdateRequest;
use App\Models\UserDetails;
use Exception;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    private function checkDetailsComplete(UserDetails $details): bool
    {
        return !empty($details->province) &&
            !empty($details->district) &&
            !empty($details->city) &&
            !empty($details->address) &&
            !empty($details->postal_code) &&
            !empty($details->phone);
    }
    public function getUserDetails(Request $request)
    {
        $user = $request->user();
        $details = $user->details;

        return response()->json([
            'details' => $details,
            'details_complete' => $this->checkDetailsComplete($details)
        ]);
    }

    public function updateUserDetails(UserDetailsUpdateRequest$request)
    {
        try {
            $user = $request->user();

            $user->details->update([
                'province' => $request->province ?? $user->details->province,
                'district' => $request->district ?? $user->details->district,
                'city' => $request->city ?? $user->details->city,
                'address' => $request->address ?? $user->details->address,
                'postal_code' => $request->postal_code ?? $user->details->postal_code,
                'phone' => $request->phone ?? $user->details->phone,
            ]);

            return response()->json([
                'message' => 'User details updated successfully',
                'details' => $user->details,
                'details_complete' => $this->checkDetailsComplete($user->details)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User details update failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
