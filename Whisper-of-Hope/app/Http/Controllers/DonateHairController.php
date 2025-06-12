<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonateHair;

class DonateHairController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donator_name' => 'required|string|max:255',
            'donator_age' => 'required|integer',
            'donator_email' => 'required|email',
            'donator_phone' => 'required|string|max:20',
            'donator_reason' => 'required|numeric',
        ]);

        DonateHair::create($validated);

        return response()->json(['success' => true]);
    }
}

