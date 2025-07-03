<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HairRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class RequestWigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRequestPage()
    {
        return view('user.request');
    }

    public function storeRequest(Request $request)
    {
        $rules = [
            'who_for' => 'required|in:myself,parent_guardian,health_professional',
            
            // required recipient details fields
            'recipient_full_name' => 'required|string|max:255',
            'recipient_age' => 'required|integer|min:0',
            'recipient_reason' => 'required|string|max:500',
            
            // conditional fields
            'recipient_email' => 'nullable|email|max:255',
            'recipient_phone' => 'nullable|string|max:20',
            
            'requester_full_name' => 'required_if:who_for,parent_guardian,health_professional|string|max:255',
            'requester_email' => 'required_if:who_for,parent_guardian,health_professional|email|max:255',
            'requester_phone' => 'required_if:who_for,parent_guardian,health_professional|string|max:20',

            'relationship_to_recipient' => 'required_if:who_for,parent_guardian|string|max:255',
            'healthcare_location' => 'required_if:who_for,health_professional|string|max:255',
        ];

        try {
            $validatedData = $request->validate($rules);

            $dataToSave = $validatedData;
            $dataToSave['user_id'] = Auth::id();

            HairRequest::create($dataToSave);
            
            return response()->json([
                'success' => true,
                'message' => 'Your request has been received!'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Wig Request Submission Failed: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }
}
