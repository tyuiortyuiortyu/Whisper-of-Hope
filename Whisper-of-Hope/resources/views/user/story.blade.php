@extends('layout.app')
@section('title', 'Story Page')

@section('content')
<div class="container py-5">

    {{-- Judul --}}
    <h1 class="text-center fw-bold" style="font-family: 'Gidugu'; font-size: 4.5rem">{{ strtoupper($story->title) }}</h1>

    {{-- Author & Date --}}
    <p class="text-start text-muted" style="font-family: 'Yantramanav'">
        by {{ $story->author ?? 'Anonymous' }} on {{ \Carbon\Carbon::parse($story->created_at)->format('F d, Y h.i.s A') }}
    </p>

    {{-- Gambar --}}
    <div class="text-center py-2">
        <img src="{{ asset($story->image) }}" alt="{{ $story->title }}" class="img-fluid" style="width: 100%; max-height: 500px; object-fit: cover;">
    </div>

    {{-- Konten --}}
    <div class="px-3 mb-5 pt-4" style="max-width: 100%; margin: 0 auto; font-family: 'Yantramanav'">
        {!! nl2br(e($story->content)) !!}
    </div>

    {{-- Related Stories --}}
    <h3 class="text-center fw-bold mb-4" style="font-family: 'Gidugu'; font-size: 3.5rem;">You Might Also Like</h3>
    <div class="row justify-content-center" id="story-container">
        @forelse ($relatedStories as $related)
            <div class="col-md-4 mb-4 story-card justify-content-center">
                <a href="{{ route('community.story', ['id' => $story->id]) }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm story-hover mb-3">
                        <img src="{{ asset($related->image) }}" class="card-img-top" alt="{{ $related->title }}">
                        <div class="card-body text-black rounded-bottom" style="background-color: #F791A9">
                            <h5 class="card-title" style="font-family: 'Yantramanav'; font-weight: 800;">
                                {{ $related->title }}
                            </h5>
                            <p class="card-text" style="font-family: 'Yantramanav'">{{ Str::limit($related->content, 60) }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-center text-muted">No other stories in this category.</p>
        @endforelse
    </div>

</div>
@endsection

@push('styles')
<style>
    .story-hover {
        transition: transform 0.3s ease;
    }

    .story-hover:hover {
        transform: scale(1.05);
    }
</style>