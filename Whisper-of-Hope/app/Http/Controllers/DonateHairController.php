<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonateHair;

class DonateHairController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'donator_name' => 'required|string|max:255',
            'donator_age' => 'required|integer',
            'donator_email' => 'required|email',
            'donator_phone' => 'required|string|max:20',
            'hair_length' => 'required|numeric',
        ]);

        $donate = DonateHair::create([
            'donator_name' => $request->donator_name,
            'donator_age' => $request->donator_age,
            'donator_email' => $request->donator_email,
            'donator_phone' => $request->donator_phone,
            'hair_length' => $request->hair_length,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Whisper posted successfully!',
            'whisper' => [
                'id' => $whisper->id,
                'to' => $whisper->to,
                'message' => $whisper->content,
                'color' => $whisper->color->hex_value,
                'font_color' => $whisper->color->font_color,  // Add this line
                'created_at' => $whisper->created_at->toISOString()
            ]
        ]);
    }
    public function store(Request $donate)
    {
        $validated = $donate->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_age' => 'required|integer',
            'recipient_email' => 'required|email',
            'recipient_phone' => 'required|string|max:20',
            'recipient_reason' => 'required|numeric',
        ]);

        DonateHair::create($validated);

        return response()->json(['success' => true]);
    }
}


