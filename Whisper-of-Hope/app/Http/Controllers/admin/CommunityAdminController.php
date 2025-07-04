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

    public function create() {
        $categories = Category::all();
        return view('admin.community_admin_addPreview', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480'
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $whisper = Story::create([
            'title' => $data['title'],
            'image' => $data['image'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
        ]);

        return redirect()->route('admin.community_admin')->with('success', 'Story posted successfully');
    }

    public function edit(Story $story){
        $categories = Category::all();
        return view('admin.community_admin_editPreview', compact('story', 'categories'));
    }

    public function update(Request $request, Story $story){
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480'
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            // if ($story->image && file_exists(public_path('images/' . $story->image))) {
            //     unlink(public_path('images/' . $story->image));
            // }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $story->update($data);

        return redirect()->route('admin.community_admin')->with('success', 'Story updated successfully');
    }

    public function destroy(Story $story)
    {
        // Delete image file if exists
        if ($story->image && file_exists(public_path('images/' . $story->image))) {
            @unlink(public_path('images/' . $story->image));
        }

        $story->delete();

        return redirect()->route('admin.community_admin')->with('success', 'Story deleted successfully.');
    }
}