<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreHairRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'role' => ['required', Rule::in(['medical_professional', 'parent_guardian', 'myself'])],
            'purpose_id' => ['required', 'exists:purposes,id'],
            
            // Recipient details (always required)
            'recipient_full_name' => ['required', 'string', 'max:255'],
            'recipient_age' => ['required', 'integer', 'min:1', 'max:120'],
            'recipient_reason' => ['required', 'string', 'max:1000'],
        ];

        // Conditional validation based on role
        $role = $this->input('role');

        if ($role === 'myself') {
            // When applying for self, recipient details should include contact info
            $rules['recipient_email'] = ['required', 'email', 'max:255'];
            $rules['recipient_phone'] = ['required', 'string', 'max:20'];
        } else {
            // When applying for someone else, requester details are required
            $rules['requester_full_name'] = ['required', 'string', 'max:255'];
            $rules['requester_email'] = ['required', 'email', 'max:255'];
            $rules['requester_phone'] = ['required', 'string', 'max:20'];
            $rules['relationship_to_recipient'] = ['required', 'string', 'max:255'];
            
            // Recipient contact info is optional when someone else is applying
            $rules['recipient_email'] = ['nullable', 'email', 'max:255'];
            $rules['recipient_phone'] = ['nullable', 'string', 'max:20'];
        }

        // Medical professional specific validation
        if ($role === 'medical_professional') {
            $rules['healthcare_location'] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'role.required' => 'Please select who you are applying for.',
            'role.in' => 'Invalid role selection.',
            'recipient_full_name.required' => 'Recipient full name is required.',
            'recipient_age.required' => 'Recipient age is required.',
            'recipient_age.min' => 'Recipient age must be at least 1.',
            'recipient_age.max' => 'Recipient age must not exceed 120.',
            'recipient_reason.required' => 'Reason for hair loss is required.',
            'recipient_email.required' => 'Recipient email is required when applying for yourself.',
            'recipient_phone.required' => 'Recipient phone is required when applying for yourself.',
            'requester_full_name.required' => 'Your full name is required when applying for someone else.',
            'requester_email.required' => 'Your email is required when applying for someone else.',
            'requester_phone.required' => 'Your phone number is required when applying for someone else.',
            'relationship_to_recipient.required' => 'Please specify your relationship to the recipient.',
            'healthcare_location.required' => 'Healthcare location is required for medical professionals.',
            'purpose_id.required' => 'Please select a purpose for this request.',
            'purpose_id.exists' => 'Selected purpose is invalid.',
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     */
    public function attributes(): array
    {
        return [
            'recipient_full_name' => 'recipient full name',
            'recipient_age' => 'recipient age',
            'recipient_email' => 'recipient email',
            'recipient_phone' => 'recipient phone',
            'recipient_reason' => 'reason for hair loss',
            'requester_full_name' => 'your full name',
            'requester_email' => 'your email',
            'requester_phone' => 'your phone number',
            'relationship_to_recipient' => 'relationship to recipient',
            'healthcare_location' => 'healthcare location',
            'purpose_id' => 'purpose',
        ];
    }
}
