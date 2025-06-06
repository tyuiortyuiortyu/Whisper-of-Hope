@extends('layout.app')
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
      <button class="btn text-dark rounded-pill px-4 py-2 filter-btn btn-light" data-category="{{ $category->slug }}" style="font-family: 'Yantramanav'">
        {{ $category->name }}
      </button>
    @endforeach
  </div>
</div>

{{-- Pilihan Story --}}
<div class="row pt-5" id="story-container">
    @foreach ($stories as $story)
    <div class="col-md-4 mb-5 story-card justify-content-center" data-category="{{ $story->category->slug }}">
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
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-4">
    {{ $stories->links() }}
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

@push('scripts')
<script>
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Ganti kelas aktif
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('btn-pink');
                b.classList.add('btn-light');
            });

            btn.classList.remove('btn-light');
            btn.classList.add('btn-pink');

            // Ubah judul berdasarkan tombol
            const category1 = btn.textContent.trim();
            const titleElement = document.getElementById('filter-title');
            
            if (category1 === "All") {
                titleElement.textContent = "Community Stories";
            } else {
                titleElement.textContent = category1;
            }

            // Filter story-card
            const category2 = btn.dataset.category;
            document.querySelectorAll('.story-card').forEach(card => {
                card.style.display = category2 === 'all' || card.dataset.category === category2 ? 'block' : 'none';
            });
        });
    });
    document.querySelector('.filter-btn[data-category="all"]').classList.remove('btn-light');
    document.querySelector('.filter-btn[data-category="all"]').classList.add('btn-pink');
</script>
@endpush