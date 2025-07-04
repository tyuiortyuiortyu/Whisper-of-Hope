<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 
use App\Models\DonateHair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

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
            'age'         => 'required|integer|min:1|max:120',
            'email'       => 'required|email|max:255', 
            'phone'       => 'required|string|max:20',
            'hair_length' => 'required|numeric|min:10', 
        ]);

        return DB::transaction(function () use ($request) {
            $lastDonation = DonateHair::where('id', 'like', 'DH%')
                                      ->orderBy('id', 'desc')
                                      ->first();

            $newIdNumber = 1; // Default untuk donasi pertama

            if ($lastDonation) {
                $lastIdNumber = (int) substr($lastDonation->id, 2); 
                
                $newIdNumber = $lastIdNumber + 1;
            }

            // 5. Format Ulang ID
            $newDonationId = 'DH';
            if ($newIdNumber < 1000) {
                $newDonationId .= str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
            } else {
                $newDonationId .= $newIdNumber;
            }

            // 6. Buat Entri Donasi Baru
            $donate = new DonateHair();
            $donate->id = $newDonationId;
            $donate->full_name = $request->full_name;
            $donate->age = $request->age;
            $donate->email = $request->email;
            $donate->phone = $request->phone;
            $donate->hair_length = $request->hair_length;
            $donate->status = 'waiting';
            $donate->user_id = Auth::id(); 

            $donate->save(); // Simpan data ke database
            return redirect()->back()->with('show_modal', true);
        });
    }
}