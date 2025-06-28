<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('role', 'LIKE', "%{$search}%")
                  ->orWhere('gender', 'LIKE', "%{$search}%");
            });
        }
        
        // Order by ID ascending
        $query->orderBy('id', 'asc');
        
        // Paginate results (10 per page)
        $users = $query->paginate(10)->withQueryString();
        
        return view('admin.user_admin', compact('users'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.user_admin')->with('success', 'User created successfully!');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female',
            'role' => 'required|in:user,admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.user_admin')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        // Prevent deletion of current admin
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.user_admin')->with('error', 'You cannot delete your own account!');
        }

        $user->delete();
        return redirect()->route('admin.user_admin')->with('success', 'User deleted successfully!');
    }
}
