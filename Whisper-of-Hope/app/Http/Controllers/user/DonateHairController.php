<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\DonateHair;
use Illuminate\Support\Facades\Auth;

class DonateHairController extends Controller
{
    public function showDonatePage()
    {
        return view('user.donate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'   => 'required|string|max:255',
            'age'         => 'required|integer',
            'email'       => 'required|email',
            'phone'       => 'required|string|max:20',
            'hair_length' => 'required|numeric',
        ]);

        $donate = DonateHair::create([
            'full_name'   => $request->full_name,
            'age'         => $request->age,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'hair_length' => $request->hair_length,
            'user_id'     => Auth::id(), // ✅ ambil ID user yang sedang login
        ]);

        return redirect()->back()->with('show_modal', true);
    }
}
