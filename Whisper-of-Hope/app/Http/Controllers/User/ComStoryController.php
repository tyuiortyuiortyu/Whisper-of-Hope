<?php
    
    namespace App\Http\Controllers\User;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller\User;
    use App\Models\Story;
    use App\Models\Category;
    
    class ComStoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $categories = Category::all();
            $stories = Story::all();
            return view('user/community', compact('categories', 'stories'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         */
        public function show($id)
        {
            // return view('user/story');
            $story = Story::with('category')->findOrFail($id);

            // Ambil 3 story lain dari kategori yang sama, kecuali story ini
            $relatedStories = Story::where('category_id', $story->category_id)
                ->where('id', '!=', $story->id)
                ->inRandomOrder()
                ->take(3)
                ->get();

            return view('user.story', compact('story', 'relatedStories'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            //
        }
    }
