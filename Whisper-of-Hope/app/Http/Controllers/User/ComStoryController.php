<?php
    
    namespace App\Http\Controllers\User;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Models\Story;
    use App\Models\Category;
    use resources\views\user;

    class ComStoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $categories = Category::all();
            $stories = Story::paginate(6);
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
        public function show(string $id)
        {
            return view('user/story');
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
