@extends('user.layout.app')

@section('title', 'Community Stories Page')

{{-- Gambar Bagian paling atas --}}
@section('hero')
<div class="w-100">
    <div class="hero-section text-center text-white d-flex align-items-center justify-content-center" style="height: 350px; background-image: url('{{ asset('images/background.png') }}'); background-size: cover; background-position: center;">
        <div>
            <h1 class="mb-0" style="line-height: 4rem; font-family: 'Gidugu', cursive; font-weight: 100; letter-spacing: 0.25rem; font-size: 6rem">Community Stories</h1>
            <p class="mt-2 mb-0" style="line-height:1.5rem; font-family: 'Yantramanav'; font-weight: 20; font-size: 1.4rem">Whether you have a question, feedback, or just want to say hi, we're always here for you. Reach out and let us know how we can make your</p>
            <p class="my-0" style="line-height:1.5rem; font-family: 'Yantramanav'; font-weight: 20; font-size: 1.4rem">experience even better.</p>
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
            <button class="btn text-dark rounded-pill px-4 py-2 filter-btn btn-light" data-category="all" style="font-family: 'Yantramanav'; font-size: 20px">All</button>
            @foreach ($categories as $category)
            <button class="btn text-dark rounded-pill px-4 py-2 filter-btn btn-light" data-category="{{ $category->id }}" style="font-family: 'Yantramanav'; font-size: 20px">
                {{ $category->name }}
            </button>
            @endforeach
        </div>
    </div>

    {{-- Pilihan Story --}}
    <div class="row pt-5 story-grid" id="story-container">
        @foreach ($stories as $story)
        <div class="px-4 my-4 story-card" data-category="{{ $story->category_id }}" style="display: none;">
            <a href="{{ route('community.story', ['id' => $story->id]) }}" class="full-link text-decoration-none text-dark">
                <div class="card shadow-sm story-hover mb-3" style=" width: 380px; border-radius: 1rem;">
                    <img src="{{ asset('images/'.$story->image) }}" class="card-img-top" alt="..." style="border-top-left-radius: 1rem; border-top-right-radius: 1rem; height: 240px; width: 100%">
                    <div class="card-body text-black" style="background-color: #F791A9; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem; height: 110px">
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

    <div class="pagination-container" style="margin-top: 2rem;">
        <div class="pagination-info" id="pagination-info" style="margin-left: 10px; width: 200px"></div>
        <div class="pagination-wrapper" style="justify-content: flex-end; width: 100%;">
            <div class="pagination-links">
                <ul class="pagination mb-0" id="pagination-controls" style="margin-bottom: 0;"></ul>
            </div>
        </div>
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

    .pagination .page-item .page-link {
        color: #000; /* warna teks */
        background-color: #E8E8E8; /* warna latar belakang tombol */
        border: 1px solid #E8E8E8; /* warna border */
    }

    /* Add gap between pagination buttons */
    .pagination .page-item {
        margin-right: 2px;
    }
    .pagination .page-item:last-child {
        margin-right: 0;
    }

    .pagination .page-item.active .page-link {
        color: white; /* warna teks tombol aktif */
        background-color: #F791A9; /* warna latar tombol aktif */
        border-color: #F791A9;
    }

    .pagination .page-item .page-link:hover {
        background-color: #f9a7ba;
        border-color: #f9a7ba;
        color: white;
    }

    /* PAGINATION NEW */
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
        gap: 14px; /* Increased gap for more space between buttons */
        align-items: center;
    }

    .pagination .page-item .page-link {
        margin: 0 3px; /* Add horizontal margin for extra gap */
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.filter-btn');
    const titleElement = document.getElementById('filter-title');
    const cards = document.querySelectorAll('.story-card');
    const noStoryMessage = document.getElementById('no-story-message');
    const paginationControls = document.getElementById('pagination-controls');

    const ITEMS_PER_PAGE = 6;
    let currentCategory = 'all';
    let currentPage = 1;

    function updateDisplay() {
        let visibleCards = [];

        cards.forEach(card => {
            const cardCategory = card.dataset.category;
            const match = (currentCategory === 'all' || currentCategory === cardCategory);
            card.style.display = match ? '' : 'none';
            if (match) visibleCards.push(card);
        });

        // Pagination logic
        const totalPages = Math.ceil(visibleCards.length / ITEMS_PER_PAGE) || 1;
        if (currentPage > totalPages) currentPage = totalPages;
        const start = (currentPage - 1) * ITEMS_PER_PAGE;
        const end = start + ITEMS_PER_PAGE;

        visibleCards.forEach((card, index) => {
            card.style.display = (index >= start && index < end) ? '' : 'none';
        });

        // No story message
        noStoryMessage.style.display = visibleCards.length === 0 ? 'block' : 'none';

        // Pagination info ("Showing x to y of z results")
        const info = document.getElementById('pagination-info');
        const paginationContainer = document.querySelector('.pagination-container');
        if (visibleCards.length === 0) {
            info.textContent = '';
        } else {
            info.textContent = `Showing ${visibleCards.length === 0 ? 0 : (start + 1)} to ${Math.min(end, visibleCards.length)} of ${visibleCards.length} results`;
        }

        // Hide pagination if not needed
        if (visibleCards.length <= ITEMS_PER_PAGE) {
            paginationContainer.style.display = 'none';
        } else {
            paginationContainer.style.display = '';
            // Render pagination controls
            renderPagination(totalPages);
        }
    }

    function renderPagination(totalPages) {
        paginationControls.innerHTML = '';
        if (totalPages <= 1) return;

        // Previous button
        const prevLi = document.createElement('li');
        prevLi.classList.add('page-item');
        const prevA = document.createElement('a');
        prevA.classList.add('page-link', 'pagination-btn', 'nav-btn');
        prevA.href = '#';
        prevA.textContent = '‹';
        if (currentPage === 1) {
            prevLi.classList.add('disabled');
            prevA.classList.add('disabled');
            prevA.tabIndex = -1;
            prevA.setAttribute('aria-disabled', 'true');
        } else {
            prevA.addEventListener('click', e => {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    updateDisplay();
                }
            });
        }
        prevLi.appendChild(prevA);
        paginationControls.appendChild(prevLi);

        // Page numbers (max 5 shown)
        let start = Math.max(1, currentPage - 2);
        let end = Math.min(totalPages, currentPage + 2);
        if (currentPage <= 3) {
            end = Math.min(5, totalPages);
        }
        if (currentPage >= totalPages - 2) {
            start = Math.max(1, totalPages - 4);
        }

        if (start > 1) {
            addPageBtn(1);
            if (start > 2) addDots();
        }
        for (let i = start; i <= end; i++) {
            addPageBtn(i);
        }
        if (end < totalPages) {
            if (end < totalPages - 1) addDots();
            addPageBtn(totalPages);
        }

        // Next button
        const nextLi = document.createElement('li');
        nextLi.classList.add('page-item');
        const nextA = document.createElement('a');
        nextA.classList.add('page-link', 'pagination-btn', 'nav-btn');
        nextA.href = '#';
        nextA.textContent = '›';
        if (currentPage === totalPages) {
            nextLi.classList.add('disabled');
            nextA.classList.add('disabled');
            nextA.tabIndex = -1;
            nextA.setAttribute('aria-disabled', 'true');
        } else {
            nextA.addEventListener('click', e => {
                e.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    updateDisplay();
                }
            });
        }
        nextLi.appendChild(nextA);
        paginationControls.appendChild(nextLi);

        function addPageBtn(page) {
            const li = document.createElement('li');
            li.classList.add('page-item');
            if (page === currentPage) li.classList.add('active');
            const a = document.createElement('a');
            a.classList.add('page-link', 'pagination-btn');
            a.href = '#';
            a.textContent = page;
            a.addEventListener('click', e => {
                e.preventDefault();
                currentPage = page;
                updateDisplay();
            });
            li.appendChild(a);
            paginationControls.appendChild(li);
        }
        function addDots() {
            const li = document.createElement('li');
            li.classList.add('page-item');
            const span = document.createElement('span');
            span.classList.add('pagination-dots');
            span.textContent = '...';
            li.appendChild(span);
            paginationControls.appendChild(li);
        }
    }

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Reset semua button
            buttons.forEach(b => {
                b.classList.remove('btn-pink');
                b.classList.add('btn-light');
            });

            // Aktifkan button terpilih
            btn.classList.remove('btn-light');
            btn.classList.add('btn-pink');

            // Ganti kategori
            currentCategory = btn.dataset.category;
            currentPage = 1;

            // Ganti judul
            titleElement.textContent = btn.textContent.trim() === "All" ? "Community Stories" : btn.textContent.trim();

            updateDisplay();
        });
    });

    // Set default kategori
    document.querySelector('.filter-btn[data-category="all"]').classList.add('btn-pink');

    updateDisplay();
});
</script>
@endpush