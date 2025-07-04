@extends('admin.layout.app')

@section('title', 'Community Stories')

@section('content')
<div class="stories-management">
    <div class="d-flex flex-wrap gap-3 pt-5">
        <a href="{{ route('admin.community_admin') }}" class="btn text-dark rounded-pill px-4 py-2 filter-btn btn-light {{ request('category') ? '' : 'btn-pink' }}" style="font-family: 'Yantramanav'; font-size: 20px">
            All
        </a>
        @foreach ($categories as $category)
        <a href="{{ route('admin.community_admin', ['category' => $category->id]) }}" class="btn text-dark rounded-pill px-4 py-2 filter-btn btn-light {{ request('category') == $category->id ? 'btn-pink' : '' }}" style="font-family: 'Yantramanav'; font-size: 20px">
            {{ $category->name }}
        </a>
        @endforeach
    </div>

    <div class="page-header mb-3">
        <div class="search-container">
            <form method="GET" action="{{ route('admin.community_admin') }}" id="searchForm">
                <input type="text" 
                       id="searchInput" 
                       name="search" 
                       placeholder="Search stories..." 
                       value="{{ request('search') }}">
                <img src="{{ asset('images/admin/user_admin/search.png') }}" class="search-icon" alt="Search" onclick="submitSearch()">
            </form>
        </div>
        <div class="btn-add-user" onclick="window.location.href='{{ route('admin.community_admin_addPreview') }}'">
            Add Story
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="stories-container"  style = "border-color: transparent">
        @foreach($stories as $story)
        <div class="story-item d-flex align-items-start justify-content-between p-3 mb-3 border rounded" data-category="{{ $story->category_id }}">
            <a href="{{ route('admin.community_admin_edit', $story) }}" class="d-flex flex-grow-1 text-decoration-none text-dark">
                <img src="{{ asset('images/'.$story->image) }}" alt="Thumbnail" class="story-thumbnail me-2" style="height: 5rem; width: 5rem">
                <div class="d-flex justify-content-center flex-column ps-3">
                    <h6 class="mb-1">{{ $story->title }}</h6>
                    <p class="mb-0 text-muted">{{ Str::limit($story->content, 100) }}</p>
                </div>
            </a>
            <button type="button" class="btn-delete" style="height: 1.5rem; width: 1.5rem" onclick="deleteUser({{ $story->id }})">
                <img src="{{ asset('images/admin/user_admin/delete.png') }}" style="height: 100%; width: 100%" class="delete-icon" alt="Delete">
            </button>
        </div>

        @endforeach


        <!-- Pagination -->
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
</div>

{{-- Modal --}}
<div class="confirmation-overlay" id="deleteConfirmationModal">
    <div class="confirmation-content">
        <div class="confirmation-title">Delete Story</div>
        <div class="confirmationn-message">
            Are your sure you want to delte this story? This action cannot be undone.
        </div>
        <div class="confirmation-button">
            <button class="btn-cancel" id="deleteCancel">Cancel</button>
            <button class="btn-confirm" id="deleteConfirm">Delete</button>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');
    
    .stories-management {
        padding: 0;
        background: white;
        font-family: 'Yantramanav';
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
        padding: 0 30px;
        padding-top: 20px;
        margin-left: 650px;
    }
    
    .search-container {
        position: relative;
        flex: 1;
        max-width: 300px;
    }
    
    .search-container input {
        width: 100%;
        padding: 5px 10px 5px 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 15px;
        background: white;
        font-family: 'Yantramanav', sans-serif;
    }
    
    .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        object-fit: contain;
        cursor: pointer;
    } 
    
    .alert {
        padding: 15px;
        margin: 0 30px 20px 30px;
        border-radius: 8px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    .stories-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin: 0;
        border: 1px solid #e8e8e8;
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

    .btn-pink {
        background-color: rgb(249, 188, 196) !important;
    }

    .btn-pink:hover {
        background-color: #f28ca6 !important;
    }

    .modal-content {
        background-color: #FFFCF5;
        margin: 3% auto;
        padding: 0;
        border-radius: 15px;
        width: 90%;
        max-width: 520px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        position: relative;
    }

    .delete-modal {
        max-width: 400px;
        text-align: center;
        margin: 50vh auto;
        transform: translateY(-50%);
    }
    
    .delete-modal .modal-body {
        padding: 40px 30px 20px 30px;
    }
    
    .delete-modal .modal-body h3 {
        margin: 0;
        color: black;
        font-family: 'Yantramanav';
        font-size: 1.2rem;
        font-weight: 500;
        line-height: 1.4;
    }
    
    .delete-modal .modal-actions {
        padding: 15px 30px 20px;
        border-top: none;
        gap: 15px;
        justify-content: center;
    }

    .modal-body {
        padding: 25px 30px;
    }

    .modal-actions {
        display: flex;
        justify-content: center;
        gap: 12px;
        padding: 15px 30px 20px;
        background: #FFFCF5;
        border-radius: 0 0 15px 15px;
    }

    .btn-cancel,
    .btn-add {
        padding: 12px 28px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 14px;
        font-family: 'Yantramanav';
        font-weight: 600;
        transition: all 0.3s ease;
        min-width: 100px;
        background: #D6D6D6;
        color: black;
        border-radius: 50px;
    }
    
    .btn-cancel:hover {
        background: #C3C3C3;
        color: black;
    }

    .btn-delete-confirm {
        padding: 12px 28px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 14px;
        font-family: 'Yantramanav';
        font-weight: 600;
        min-width: 100px;
        background: #F9BCC4;
        color: #333;
    }
    
    .btn-delete-confirm:hover {
        background: #F791A9;
    }

    .btn-delete {
        border: none;
        cursor: pointer;
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background: rgba(255, 0, 0, 0.1);
        transform: scale(1.05);
        border-radius: 50%;
    }
</style>
@endpush

@push('scripts')
<script>
    let searchTimeout = null;
    
    function debounceSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            submitSearch();
        }, 500); // Wait 500ms after user stops typing
    }
    
    function submitSearch() {
        document.getElementById('searchForm').submit();
    }
    
    // Clear search functionality
    function clearSearch() {
        document.getElementById('searchInput').value = '';
        submitSearch();
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modals = document.getElementsByClassName('modal');
        for (let i = 0; i < modals.length; i++) {
            if (event.target === modals[i]) {
                modals[i].style.display = 'none';
                if (modals[i].id === 'deleteUserModal') {
                    userToDelete = null;
                }
            }
        }
    }
    
    // Handle enter key in search
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            submitSearch();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        let storyToDeleteId = null;

        function confirmDelete(storyId) {
            storyToDeleteId = storyId;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        document.getElementById('deleteCancel').addEventListener('click', function() {
            document.getElementById('deleteModal').style.display = 'none';
        });

        document.getElementById('deleteOk').addEventListener('click', function() {
            if (storyToDeleteId) {
                // Buat dan submit form delete
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/community/delete/' + storyToDeleteId;

                // Tambahkan csrf dan method spoofing _method=DELETE
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });

    // Delete Constant
    const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    const deleteCancel = document.getElementById('deleteCancel');
    const deleteConfirm = document.getElementById('deleteConfirm');
</script>
@endpush