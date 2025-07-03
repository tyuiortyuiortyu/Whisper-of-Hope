<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommunityAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Story::query()
        ->leftJoin('categories', 'stories.category_id', '=', 'categories.id')
        ->select('stories.*', 'categories.name as category_name');

        $categories = Category::all();
        
         // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('categories.name', 'LIKE', "%{$search}%"); 
            });
        }

        // Order by ID ascending
        $query->orderBy('created_at', 'asc');
        
        // Paginate results (10 per page)
        $stories = $query->paginate(5)->withQueryString();

        return view('admin.community_admin', compact('stories', 'categories'));
    }

    public function edit($id){
        $story = Story::with('category')->findOrFail($id);
        $categories = Category::all();
        return view('admin.community_admin_preview', compact('story', 'categories'));
    }

    public function update(Request $request, $id){
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Ambil story lama
        $story = Story::findOrFail($id);

        // Update field dasar
        $story->title = $validated['title'];
        $story->content = $validated['content'];
        $story->category_id = $validated['category_id'];

        // Kalau user upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama (optional, kalau mau)
            if ($story->image && Storage::disk('public')->exists($story->image)) {
                Storage::disk('public')->delete($story->image);
                // Simpan file baru
                $path = $request->file('image')->store('stories', 'public'); // simpan di storage/app/public/stories
                $story->image = $path;
            }

            // Simpan perubahan ke DB
            $story->save();

            // Redirect kembali ke halaman edit atau index + pesan sukses
            return redirect()->route('admin.community_edit', $story->id)->with('success', 'Story updated successfully!');
        }
    }
}