@extends('user.layout.app')

@section('title', 'Community Stories Page')

{{-- Gambar Bagian paling atas --}}
@section('hero')
<div class="w-100">
    <div class="hero-section text-center text-white d-flex align-items-center justify-content-center" style="height: 300px; background-image: url('{{ asset('images/background.png') }}'); background-size: cover; background-position: center;">
        <div>
            <h1 class="fw-bold display-4" style="font-family: 'Gidugu'">Community stories</h1>
            <p class="lead mt-3 font-gidugu" style="font-family: 'Gidugu'">
                Whether you have a question, feedback, or just want to say hi, we're always here for you. <br>
                Reach out and let us know how we can make your experience even better.
            </p>
        </div>
    </div>
</div>
@endsection

@section('content')
{{-- Judul Kategori --}}
<div class="text-end" style = "margin-top: 5.25rem; margin-left: 0px;">
    <h1 id="filter-title" class="fw-bold display-6" style="font-family: 'gidugu'">Community Stories</h1>
</div>

{{-- Kotak Filter Kategori --}}
<div class="px-4 pt-3 pb-5 mb-5" style="background-color: rgb(254,240,240); border-radius: 20px;">
  <h5 class="fw-bold mb-2 ms-2" style="font-family: 'Yantramanav'">Filter by Category:</h5>
  <div class="d-flex flex-wrap gap-2 ms-4 pt-3">
    <button class="btn text-dark rounded-pill px-4 py-2 filter-btn btn-light" data-category="all" style="font-family: 'Yantramanav'">All</button>
    @foreach ($categories as $category)
      <button class="btn text-dark rounded-pill px-4 py-2 filter-btn btn-light" data-category="{{ $category->id }}" style="font-family: 'Yantramanav'">
        {{ $category->name }}
      </button>
    @endforeach
  </div>
</div>

{{-- Pilihan Story --}}
{{-- <div class="row pt-5" id="story-container">
    @foreach ($stories as $story)
    <div class="col-md-4 mb-5 story-card justify-content-center" data-category="{{ $story->category_id }}">
        <a href="{{ route('community.story', ['id' => $story->id]) }}" class="text-decoration-none text-dark">
            <div class="card h-100 shadow-sm story-hover mb-3">
                <img src="{{ asset($story->image) }}" class="card-img-top" alt="...">
                <div class="card-body text-black rounded-bottom" style="background-color: #F791A9">
                    <h5 class="card-title mb-0" style="font-family: 'Yantramanav'; font-weight: 800;">{{ $story->title }}</h5>
                    <p class="card-text">{{ Str::limit($story->content, 60) }}</p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div> --}}
<div class="row pt-5" id="story-container">
    @foreach ($stories as $story)
    <div class="col-md-4 mb-5 story-card justify-content-center" data-category="{{ $story->category_id }}" style="display: none;">
        <a href="{{ route('community.story', ['id' => $story->id]) }}" class="text-decoration-none text-dark">
            <div class="card h-100 shadow-sm story-hover mb-3">
                <img src="{{ asset($story->image) }}" class="card-img-top" alt="...">
                <div class="card-body text-black rounded-bottom" style="background-color: #F791A9">
                    <h5 class="card-title mb-0" style="font-family: 'Yantramanav'; font-weight: 800;">
                        {{ $story->title }}
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
{{-- <div class="d-flex justify-content-center mt-4">
    {{ $stories->links() }}
</div> --}}
<div class="d-flex justify-content-center mt-4">
    <nav>
        <ul class="pagination" id="pagination-controls"></ul>
    </nav>
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

    .btn-pink {
        background-color: rgb(249, 188, 196) !important;
    }

    .btn-pink:hover {
        background-color: #f28ca6 !important;
    }
</style>
@endpush

{{-- @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.filter-btn');
        const titleElement = document.getElementById('filter-title');
        const cards = document.querySelectorAll('.story-card');
        const noStoryMessage = document.getElementById('no-story-message');

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

                // Ganti judul
                const category1 = btn.textContent.trim();
                titleElement.textContent = category1 === "All" ? "Community Stories" : category1;

                // Filter card berdasarkan kategori
                const selectedCategory = btn.dataset.category;
                let visibleCount = 0;

                cards.forEach(card => {
                    const cardCategory = card.dataset.category;
                    const match = selectedCategory === 'all' || selectedCategory === cardCategory;
                    card.style.display = match ? 'block' : 'none';
                    if (match) visibleCount++;
                });

                // Tampilkan atau sembunyikan pesan "no story"
                noStoryMessage.style.display = (visibleCount === 0) ? 'block' : 'none';
            });
        });

        // Set tombol "All" aktif di awal
        const defaultBtn = document.querySelector('.filter-btn[data-category="all"]');
        if (defaultBtn) {
            defaultBtn.classList.remove('btn-light');
            defaultBtn.classList.add('btn-pink');
        }
    });
</script>
@endpush --}}

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
            card.style.display = match ? '' : 'none'; // sementara tampilkan semua yang cocok
            if (match) visibleCards.push(card);
        });

        // Pagination logic
        const totalPages = Math.ceil(visibleCards.length / ITEMS_PER_PAGE);
        const start = (currentPage - 1) * ITEMS_PER_PAGE;
        const end = start + ITEMS_PER_PAGE;

        // Tampilkan hanya yang sesuai halaman
        visibleCards.forEach((card, index) => {
            card.style.display = (index >= start && index < end) ? '' : 'none';
        });

        // No story message
        noStoryMessage.style.display = visibleCards.length === 0 ? 'block' : 'none';

        // Render pagination controls
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        paginationControls.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.classList.add('page-item');
            if (i === currentPage) li.classList.add('active');

            const a = document.createElement('a');
            a.classList.add('page-link');
            a.href = '#';
            a.textContent = i;
            a.addEventListener('click', e => {
                e.preventDefault();
                currentPage = i;
                updateDisplay();
            });

            li.appendChild(a);
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
