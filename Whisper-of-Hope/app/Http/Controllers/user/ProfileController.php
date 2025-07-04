<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        try {
            $user = Auth::user();
            
            // Log request data untuk debugging
            \Log::info('Profile update request received', [
                'user_id' => $user->id,
                'has_file' => $request->hasFile('profile_image'),
                'remove_image' => $request->input('remove_image'),
                'form_data' => $request->only(['name', 'email', 'phone', 'gender'])
            ]);
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'phone' => 'nullable|string|max:20',
                'gender' => 'nullable|in:male,female',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'remove_image' => 'nullable|string',
            ]);
            
            $data = $request->only(['name', 'email', 'phone', 'gender']);
            $profileImageUrl = null;
            $oldImage = $user->profile_image; // Simpan path gambar lama
            
            // Handle image removal
            if ($request->input('remove_image') == '1') {
                \Log::info('Removing profile image for user: ' . $user->id);
                
                // Delete old image if exists
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    $deleted = Storage::disk('public')->delete($user->profile_image);
                    \Log::info('Old image deletion result: ' . ($deleted ? 'success' : 'failed'));
                }
                $data['profile_image'] = null;
                $profileImageUrl = null;
            }
            // Handle new image upload
            elseif ($request->hasFile('profile_image')) {
                \Log::info('Uploading new profile image for user: ' . $user->id);
                
                // Delete old image if exists
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    $deleted = Storage::disk('public')->delete($user->profile_image);
                    \Log::info('Old image deletion result: ' . ($deleted ? 'success' : 'failed'));
                }
                
                // Store new image with unique name
                $image = $request->file('profile_image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('profile_images', $imageName, 'public');
                
                if (!$path) {
                    throw new \Exception('Failed to store uploaded image');
                }
                
                $data['profile_image'] = $path;
                $profileImageUrl = asset('storage/' . $path);
                
                \Log::info('New image stored at: ' . $path);
            }
            // Keep existing image if no changes
            else {
                if ($user->profile_image) {
                    $profileImageUrl = asset('storage/' . $user->profile_image);
                }
            }
            
            // Log data yang akan diupdate
            \Log::info('Data to be updated:', $data);
            
            // Update user data in database
            $updated = $user->update($data);
            
            if (!$updated) {
                throw new \Exception('Failed to update user data in database');
            }
            
            // Refresh user data from database to ensure we have latest data
            $user->refresh();
            
            // Verify the update was successful by checking database
            $verifyUser = \App\Models\User::find($user->id);
            \Log::info('Profile updated successfully for user: ' . $user->id, [
                'old_image' => $oldImage,
                'new_image' => $verifyUser->profile_image,
                'name' => $verifyUser->name,
                'email' => $verifyUser->email,
                'phone' => $verifyUser->phone,
                'gender' => $verifyUser->gender,
                'updated_at' => $verifyUser->updated_at
            ]);
            
            // Return JSON response for AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile updated successfully!',
                    'profile_image_url' => $profileImageUrl ? $profileImageUrl . '?v=' . time() : null,
                    'user' => [
                        'name' => $verifyUser->name,
                        'email' => $verifyUser->email,
                        'phone' => $verifyUser->phone ?? '',
                        'gender' => $verifyUser->gender ?? '',
                    ],
                    'debug' => [
                        'old_image' => $oldImage,
                        'new_image' => $verifyUser->profile_image,
                        'timestamp' => now()->toDateTimeString()
                    ]
                ]);
            }
            
            return redirect()->back()->with('success', 'Profile updated successfully!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error in profile update: ', $e->errors());
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Error updating profile: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating profile: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'An error occurred while updating profile.');
        }
    }
}