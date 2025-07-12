@extends('user.layout.app')

@section('title', 'Community Stories Page')

{{-- Gambar Bagian paling atas --}}
@section('hero')
<div class="w-100">
    <div class="hero-section text-center text-white d-flex align-items-center justify-content-center" style="height: 350px; background-image: url('{{ asset('images/background.png') }}'); background-size: cover; background-position: center;">
        <div>
            <h1 class="mb-0" style="line-height: 4rem; font-family: 'Gidugu', cursive; font-weight: 100; letter-spacing: 0.25rem; font-size: 6rem">Community Stories</h1>
            <p class="mt-2 mb-0" style="line-height:1.5rem; font-family: 'Yantramanav'; font-weight: 20; font-size: 1.4rem">Whether you have a question, feedback, or just want to say hi, we're always here for you. Reach out and let us know how we can make your</p>
            <p class="my-0" style="linez-height:1.5rem; font-family: 'Yantramanav'; font-weight: 20; font-size: 1.4rem">experience even better.</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    {{-- Judul Kategori --}}
    <div class="text-end" style = "margin-top: 2.7rem; margin-left: 0px;">
        <h1 id="filter-title" class="display-6 mb-2" style="line-height: 4rem; font-family: 'gidugu'; font-size: 4.5rem">Community Stories</h1>
    </div>

    {{-- Kotak Filter Kategori --}}
    <div class="px-5 flex-column d-flex justify-content-center" style="height: 12rem; background-color: rgb(254,240,240); border-radius: 20px;">
        <h5 class="mb-2 ms-2" style="font-family: 'Yantramanav'; font-size:30px">Filter by Category:</h5>
        <div class="d-flex flex-wrap gap-2 pt-3">
            <a href="{{ route('user.community') }}" class="btn text-dark rounded-pill px-4 py-2 filter-btn {{ request('category') ? 'btn-light' : 'btn-pink' }}" style="font-family: 'Yantramanav'; font-size: 20px">
                All
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('user.community', ['category' => $category->id]) }}"
                class="btn text-dark rounded-pill px-4 py-2 filter-btn {{ request('category') == $category->id ? 'btn-pink' : 'btn-light' }}"
                style="font-family: 'Yantramanav'; font-size: 20px">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Pilihan Story --}}
    <div class="row pt-5 story-grid" id="story-container">
        @foreach ($stories as $story)
        <div class="px-4 my-4 story-card" data-category="{{ $story->category_id }}">
            <a href="{{ route('community.story', ['id' => $story->id]) }}" class="full-link text-decoration-none text-dark">
                <div class="card shadow-sm story-hover mb-3" style=" width: 380px; border-radius: 1rem;">
                    <img src="{{ asset('images/'.$story->image) }}" class="card-img-top" alt="..." style="border-top-left-radius: 1rem; border-top-right-radius: 1rem; height: 240px; width: 100%">
                    <div class="card-body text-black" style="background-color: #F9BCC4; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem; height: 110px">
                        <h5 class="card-title mb-0" style="font-family: 'Yantramanav'; font-weight: 800;">
                            {{ Str::limit($story->title, 35) }}
                        </h5>
                        <p class="card-text" style="font-family: 'Yantramanav'">{{ Str::limit($story->content, 60) }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div id="no-story-message" class="text-center fw-bold fs-4 mt-0" style="display: none; font-family: 'Yantramanav'">
        There's no story for this category yet :(
    </div>

    {{-- Pagination --}}
    @if($stories->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                <span>Showing {{ $stories->firstItem() }} to {{ $stories->lastItem() }} of {{ $stories->total() }} results</span>
            </div>
            <div class="pagination-wrapper">
                <div class="pagination-links">
                    {{-- Previous Page Link --}}
                    @if ($stories->onFirstPage())
                        <span class="pagination-btn nav-btn disabled">‹</span>
                    @else
                        <a href="{{ $stories->previousPageUrl() }}" class="pagination-btn nav-btn">‹</a>
                    @endif

                    {{-- Page Numbers --}}
                    @php
                        $currentPage = $stories->currentPage();
                        $lastPage = $stories->lastPage();
                        $start = max(1, $currentPage - 2);
                        $end = min($lastPage, $currentPage + 2);
                    @endphp

                    @if($start > 1)
                        <a href="{{ $stories->url(1) }}" class="pagination-btn">1</a>
                        @if($start > 2)
                            <span class="pagination-dots">...</span>
                        @endif
                    @endif

                    @for($page = $start; $page <= $end; $page++)
                        @if ($page == $currentPage)
                            <span class="pagination-btn active">{{ $page }}</span>
                        @else
                            <a href="{{ $stories->url($page) }}" class="pagination-btn">{{ $page }}</a>
                        @endif
                    @endfor

                    @if($end < $lastPage)
                        @if($end < $lastPage - 1)
                            <span class="pagination-dots">...</span>
                        @endif
                        <a href="{{ $stories->url($lastPage) }}" class="pagination-btn">{{ $lastPage }}</a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($stories->hasMorePages())
                        <a href="{{ $stories->nextPageUrl() }}" class="pagination-btn nav-btn">›</a>
                    @else
                        <span class="pagination-btn nav-btn disabled">›</span>
                    @endif
                </div>
            </div>
        </div>
    @endif
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

    .full-link {
        display: inline-block; /* atau block */
        width: 100%;
        height: auto; /* ubah dari 100% ke auto */
    }

    /* .bg-pink {
        background-color: #f598b2;
    } */

    .story-hover {
        transition: transform 0.3s ease;
    }

    .story-hover:hover {
        transform: scale(1.05);
    }

    .btn-pink {
        background-color: rgb(249, 188, 196) !important;
    }

    .btn-pink:hover {
        background-color: #f28ca6 !important;
    }

    .story-grid{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }

    .story-card {
        width: 100%;
    }

    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-top: 1px solid #e8e8e8;
        background: white;
    }
    
    .pagination-info {
        font-size: 14px;
        color: #666;
        font-family: 'Yantramanav';
    }
    
    .pagination-wrapper {
        display: flex;
        align-items: center;
    }
    
    .pagination-links {
        display: flex;
        gap: 6px;
        align-items: center;
    }
    
    .pagination-btn {
        padding: 8px 12px;
        border: none;
        background: white;
        color: #333;
        text-decoration: none;
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Yantramanav';
        font-weight: 500;
        min-width: 32px;
        height: 32px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ddd;
    }
    
    .pagination-btn:hover:not(.disabled):not(.active) {
        background: white;
        color: #333;
        text-decoration: none;
        border-color: #ccc;
    }
    
    .pagination-btn.active {
        background: #F791A9;
        color: white;
        font-weight: 600;
        border-color: #F791A9;
    }
    
    .pagination-btn.nav-btn {
        font-size: 16px;
        font-weight: 600;
        width: 32px;
        min-width: 32px;
        background: white;
        color: #333;
        border-color: #ddd;
    }
    
    .pagination-btn.nav-btn:hover:not(.disabled) {
        background: white;
        color: #333;
        border-color: #ccc;
    }
    
    .pagination-btn.disabled {
        background: #E8E8E8;
        color: #999;
        cursor: not-allowed;
        opacity: 0.6;
        border-color: #E8E8E8;
    }
    
    .pagination-btn.disabled:hover {
        transform: none;
        background: #E8E8E8;
        border-color: #E8E8E8;
    }
    
    .pagination-dots {
        padding: 8px 4px;
        color: #666;
        font-size: 14px;
        font-family: 'Yantramanav';
        font-weight: 500;
    }
    
</style>
@endpush
