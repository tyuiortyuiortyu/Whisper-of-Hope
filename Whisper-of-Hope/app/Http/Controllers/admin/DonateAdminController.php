<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonateHair; // Pastikan ini mengarah ke model DonateHair Anda
use Illuminate\Http\Request;

class DonateAdminController extends Controller // Pastikan nama class ini sesuai dengan nama file
{
    /**
     * Menampilkan daftar donasi rambut.
     */
     public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DonateHair::query();

        if ($search) {
            $query->where('full_name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%');
        }

        $hairDonations = $query->orderBy('id', 'asc')->paginate(10);

        return view('admin.donate_admin', compact('hairDonations'));
    }

    public function approve(DonateHair $hairDonation) // Model binding ke DonateHair
    {
        $hairDonation->status = 'received';
        $hairDonation->save();

        return redirect()->back()->with('success', 'Hair donation approved successfully!');
    }

    /**
     * Menolak donasi rambut (mengubah status menjadi 'missing').
     */
    public function reject(DonateHair $hairDonation) // Model binding ke DonateHair
    {
        $hairDonation->status = 'missing';
        $hairDonation->save();

        return redirect()->back()->with('success', 'Hair donation rejected successfully!');
    }

    public function destroy(DonateHair $hairDonation) // Model binding ke DonateHair
    {
        $hairDonation->delete();

        return redirect()->back()->with('success', 'Hair donation deleted successfully!');
    }

}