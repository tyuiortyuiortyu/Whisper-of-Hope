<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HairRequest;
use Illuminate\Support\Facades\Auth;

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
        // Validate the request data
        $request->validate([
           'who-for' => 'required|in:I am applying for myself,I am applying for my child as their parent/guardian,I am applying for a patient as a medical professional',
       
            
            // recipient details validation
            'recipient_full_name' => 'required|string|max:255',
            'recipient_age' => 'required|integer|min:0',
            'recipient_email' => 'nullable|email|max:255',
            'recipient_phone' => 'nullable|string|max:20',
            'recipient_reason' => 'required|string|max:500',
            
            // requester details validation
            'requester_full_name' => 'nullable|required_if:request_type,parent_guardian,medical_professional|string|max:255',
            'requester_email' => 'nullable|required_if:request_type,parent_guardian,medical_professional|email|max:255',
            'requester_phone' => 'nullable|required_if:request_type,parent_guardian,medical_professional|string|max:20',
            'relationship_to_recipient' => 'nullable|required_if:request_type,parent_guardian|string|max:255',
            'healthcare_location' => 'nullable|required_if:request_type,medical_professional|string|max:255',
            'purpose_id' => 'required|exists:purposes,id',
        ]);

        // Create the wig request
        $wigRequest = HairRequest::create([
            'recipient_full_name' => $request->recipient_full_name,
            'recipient_age' => $request->recipient_age,
            'recipient_email' => $request->recipient_email,
            'recipient_phone' => $request->recipient_phone,
            'recipient_reason' => $request->recipient_reason,
            'requester_full_name' => $request->requester_full_name,
            'requester_email' => $request->requester_email,
            'requester_phone' => $request->requester_phone,
            'relationship_to_recipient' => $request->relationship_to_recipient,
            'healthcare_location' => $request->healthcare_location,
            'user_id' => Auth::id(),
            'purpose_id' => $request->purpose_id,
        ]);
    
        return redirect()->route('user.request');
    }
}
