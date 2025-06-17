<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show() { 
        return view('profile.profile'); 
    }
    
    public function edit() { 
        return view('profile.edit-profile'); 
    }
    
    public function update(Request $request) {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);
        
        $data = $request->only(['name', 'email', 'phone', 'gender']);
        
        // Handle image removal
        if ($request->input('remove_image') == '1') {
            // Delete old image if exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $data['profile_image'] = null;
        }
        // Handle new image upload
        elseif ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            
            // Store new image
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $path;
        }
        
        $user->update($data);
        
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}