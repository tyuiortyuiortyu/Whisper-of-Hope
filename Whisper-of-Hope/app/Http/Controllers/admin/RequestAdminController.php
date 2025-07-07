<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HairRequest;

class RequestAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = HairRequest::query();
        
        // search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('recipient_full_name', 'LIKE', "%{$search}%")
                  ->orWhere('recipient_email', 'LIKE', "%{$search}%")
                  ->orWhere('recipient_phone', 'LIKE', "%{$search}%")
                  ->orWhere('recipient_age', 'LIKE', "%{$search}%")
                  ->orWhere('recipient_reason', 'LIKE', "%{$search}%")
                  ->orWhere('requester_full_name', 'LIKE', "%{$search}%")
                  ->orWhere('requester_email', 'LIKE', "%{$search}%")
                  ->orWhere('requester_phone', 'LIKE', "%{$search}%")
                  ->orWhere('relationship_to_recipient', 'LIKE', "%{$search}%")
                  ->orWhere('healthcare_location', 'LIKE', "%{$search}%");
            });
        }
        
        // filter
        if ($request->has('type')) {
            switch ($request->type) {
                case 'myself':
                    $query->where('who_for', 'myself');
                    break;
                case 'parent_guardian':
                    $query->where('who_for', 'parent_guardian');
                    break;
                case 'health_professional':
                    $query->where('who_for', 'health_professional');
                    break;
                // Default: all requests
            }
        }
        
        // Order by created_at descending
        $query->orderBy('created_at', 'desc');
        
        // Paginate results (10 per page)
        $requests = $query->paginate(10)->withQueryString();
        
        return view('admin.request_admin', compact('requests'));
    }

    public function show(HairRequest $hairRequest)
    {
        $hairRequest->load('user');
        return view('admin.request_show_admin', compact('hairRequest'));
    }

    // status management
    public function accept(HairRequest $hairRequest)
    {
        $hairRequest->update(['status' => 'accepted']);
        return redirect()->route('admin.request_admin');
    }

    public function reject(HairRequest $hairRequest)
    {
        $hairRequest->update(['status' => 'rejected']);
        return redirect()->route('admin.request_admin');
    }

    public function destroy(HairRequest $hairRequest)
    {
        $hairRequest->delete();
        return redirect()->route('admin.request_admin')->with('success', 'Request deleted successfully!');
    }
}