@extends('user.layout.app')
@section('title', 'Story Page')

@section('content')
<div class="container">

    {{-- Judul --}}
    <div class="mt-4 d-flex align-items-center justify-content-center">
        <h1 class="text-center pb-5" style="font-family: 'Gidugu'; font-size: 4.5rem; letter-spacing: 0.1rem; font-weight: 700; line-height: 3rem">{{ strtoupper($story->title) }}</h1>
    </div>

    {{-- Author & Date --}}
    <p class="text-start text-muted" style="font-family: 'Yantramanav'">
        by {{ $story->author ?? 'Whisper of Hope' }} on {{ \Carbon\Carbon::parse($story->created_at)->format('F d, Y h.i.s A') }}
    </p>

    {{-- Gambar --}}
    <div class="text-center py-2">
        <img src="{{ asset('images/'.$story->image) }}" alt="{{ $story->title }}" class="img-fluid" style="width: 100%; max-height: 500px; object-fit: cover; border-radius: 1rem;">
    </div>

    {{-- Konten --}}
    <div class="px-3 mb-5 pt-4" style="max-width: 100%; margin: 0 auto; font-family: 'Yantramanav'">
        {!! nl2br(e($story->content)) !!}
    </div>

    {{-- Related Stories --}}
    <h3 class="text-center mb-4" style="font-family: 'Gidugu'; font-size: 3.5rem;">You Might Also Like</h3>
    <div class="row justify-content-center pb-5" id="story-container">
        @forelse ($relatedStories as $related)
        <div class="col-md-4 px-4 story-card justify-content-center">
            <a href="{{ route('community.story', ['id' => $related->id]) }}" class="full-link text-decoration-none text-dark">
                <div class="card h-100 shadow-sm story-hover mb-3" style="width: 380px; border-radius: 1rem;">
                    <img src="{{ asset('images/'.$related->image) }}" class="card-img-top" alt="{{ $related->title }}" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem; height: 240px">
                    <div class="card-body text-black" style="background-color: #F9BCC4; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem; height: 110px">
                        <h5 class="card-title" style="font-family: 'Yantramanav'; font-weight: 800;">
                            {{ Str::limit($related->title, 35) }}
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
    html::-webkit-scrollbar {
        display: none;
    }

    html {
        scrollbar-width: none;
    }

    .story-hover {
        transition: transform 0.3s ease;
    }

    .story-hover:hover {
        transform: scale(1.05);
    }
</style>