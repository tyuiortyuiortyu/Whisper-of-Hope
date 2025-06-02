@extends('layout.app')
@section('title', 'Community Stories Page')
@section('content')
    <h1>Welcome to Community Stories</h1>
    <div class="container my-5">
        <h2 class="text-center fw-bold">Community Stories</h2>
        <p class="text-center mb-4">Whether you have a question, feedback, or just want to say hi...</p>

        {{-- Filter --}}
        <div class="text-center mb-4">
            <button class="btn btn-outline-dark mx-1 filter-btn" data-category="all">All</button>
            @foreach ($categories as $category)
                <button class="btn btn-outline-dark mx-1 filter-btn" data-category="{{ $category->slug }}">{{ $category->name }}</button>
            @endforeach
        </div>

        {{-- Cards --}}
        <div class="row" id="story-container">
            @foreach ($stories as $story)
            <div class="col-md-4 mb-4 story-card" data-category="{{ $story->category->slug }}">
                <a href="{{ route('stories.show', $story->id) }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm story-hover">
                        <img src="{{ asset('storage/' . $story->image) }}" class="card-img-top" alt="...">
                        <div class="card-body bg-pink text-white rounded-bottom">
                            <h5 class="card-title">{{ $story->title }}</h5>
                            <p class="card-text">{{ Str::limit($story->description, 60) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
<style>
    .bg-pink {
        background-color: #f598b2;
    }

    .story-hover {
        transition: transform 0.3s ease;
    }

    .story-hover:hover {
        transform: scale(1.05);
    }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const category = btn.dataset.category;
            document.querySelectorAll('.story-card').forEach(card => {
                card.style.display = category === 'all' || card.dataset.category === category ? 'block' : 'none';
            });
        });
    });
</script>
@endpush
