@extends('admin.layout.app')

@section('title', __('admin.header_community'))

@section('content')
<div class="stories-management">
    <div class="d-flex flex-wrap gap-3 pt-5">
        <a href="{{ route('admin.community_admin') }}" class="btn text-dark rounded-pill px-4 py-2 filter-btn btn-light {{ request('category') ? '' : 'btn-pink' }}" style="font-family: 'Yantramanav'; font-size: 20px">
            {{ __('admin.All')}}
        </a>
        @foreach ($categories as $category)
        <a href="{{ route('admin.community_admin', ['category' => $category->id]) }}" class="btn text-dark rounded-pill px-4 py-2 filter-btn btn-light {{ request('category') == $category->id ? 'btn-pink' : '' }}" style="font-family: 'Yantramanav'; font-size: 20px">
            {{ __('admin.' . $category->name)}}
        </a>
        @endforeach
    </div>

    <div class="page-header mb-3">
        <div class="search-container">
            <input type="text" 
                id="searchInput" 
                placeholder="{{ __('admin.search_placeholder') }}"
                value="{{ request('search') }}"
                onkeyup="debounceSearch()">
            <img src="{{ asset('images/admin/user_admin/search.png') }}" class="search-icon" alt="Search" onclick="performSearch()">
        </div>
        <div class="btn-add-user" onclick="window.location.href='{{ route('admin.community_admin_addPreview') }}'">
            {{ __('admin.add_story') }}
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mx-0">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="stories-container"  style = "border-color: transparent">
        @include('admin._stories', ['stories' => $stories])
    </div>
</div>
{{-- Modal --}}
<div id="deleteStoryModal" class="modal" tabindex="-1">
    <div class="modal-content delete-modal">
        <div class="modal-body text-center">
            <h3>{{ __('admin.modal_deleteMsg')}}</h3>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn-cancel" id="deleteModalCancel">{{ __('admin.cancelBtn_label') }}</button>
            <button type="button" class="btn-delete-confirm" id="deleteModalConfirm">OK</button>
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
        /* padding: 5px 10px 5px 15px; */
        border: 1px solid #ddd;
        border-radius: 25px;
        /* font-size: 15px; */
        background: white;
        font-family: 'Yantramanav', sans-serif;

        /* PERUBAHAN */
        padding: 12px 40px 12px 15px;
        font-size: 14px;
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

    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
    }

    .modal-content {
        background-color: #FEF0F0;
        border-radius: 20px;
        border: none;
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        width: 90%;
        max-width: 400px;
        text-align: center;
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }

    .modal.is-active .modal-content {
        transform: scale(1);
    }
    
    .modal-body {

        padding: 30px 30px 20px 30px;
    }
    
    .modal-body h3 {
        margin: 0;
        color: black;
        font-family: 'Yantramanav';
        font-weight: 500;
        font-size: 1.5rem;
    }

    .modal-actions {
        display: flex;
        justify-content: center;
        /* gap: 12px; */
        /* padding: 15px 30px 20px; */
        padding: 0 30px 30px;
        gap: 20px;
    }

    .modal-actions button {
        cursor: pointer;
        font-family: 'Yantramanav', sans-serif;
        transition: background-color 0.2s ease, transform 0.1s ease;
        padding: 8px 30px;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        width: 120px;
    }

    .modal-actions button:active {
        transform: scale(0.95);
    }

    .modal-actions .btn-cancel {
        background-color: #E8E8E8;
        font-weight: 500;
        /* color: #333; */
    }

    .modal-actions .btn-cancel:hover {
        background-color: #CCC;
        color: #FFFFFF;
    }

    .modal-actions .btn-delete-confirm {
        background: #F9BCC4;
        font-weight: 500;
    }

    .modal-actions .btn-delete-confirm:hover {
        background: #F791A9;
        color: #FFFFFF;
    }

    .btn-add-user {
        background: #F9BCC4;
        color: black;
        border: none;
        padding: 10px 50px;
        border-radius: 50px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Yantramanav';
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(249,188,196,0.2);
        margin-left: 10px;
    }

    .btn-add-user:hover {
        background-color: #ff8a94;
        transform: translateY(-1px);
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
document.addEventListener('DOMContentLoaded', function() {
    let storyToDelete = null;

    // Modal elements
    const deleteModal = document.getElementById('deleteStoryModal');
    const deleteModalCancel = document.getElementById('deleteModalCancel');
    const deleteModalConfirm = document.getElementById('deleteModalConfirm');

    // Open modal on delete button click (event delegation)
    document.querySelector('.stories-container').addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-delete');
        if (btn && btn.dataset.storyId) {
            storyToDelete = btn.dataset.storyId;
            deleteModal.style.display = 'flex';
            deleteModal.style.opacity = 100;
            deleteModal.style.visibility = 'visible';
        }
    });

    // Cancel button closes modal
    deleteModalCancel.addEventListener('click', function() {
        deleteModal.style.display = 'none';
        storyToDelete = null;
    });

    // Confirm button submits delete form
    deleteModalConfirm.addEventListener('click', function() {
        if (storyToDelete) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/community/delete/${storyToDelete}`;
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

    // Close modal when clicking outside modal-content
    deleteModal.addEventListener('mousedown', function(e) {
        if (e.target === deleteModal) {
            deleteModal.style.display = 'none';
            storyToDelete = null;
        }
    });
});

// let searchTimeout = null;

// // Search debounce and enter key
// function debounceSearch() {
//     clearTimeout(searchTimeout);
//     searchTimeout = setTimeout(function() {
//         submitSearch();
//     }, 500); // Wait 500ms after user stops typing
// }

// function submitSearch() {
//     document.getElementById('searchForm').submit();
// }

// // Clear search functionality
// function clearSearch() {
//     document.getElementById('searchInput').value = '';
//     submitSearch();
// }

// // Handle enter key in search
// document.getElementById('searchInput').addEventListener('keypress', function(e) {
//     if (e.key === 'Enter') {
//         e.preventDefault();
//         submitSearch();
//     }
// });
let searchTimeout = null;

function debounceSearch() {
    clearTimeout(searchTimeout);
    // searchTimeout = setTimeout(function() {
        performSearch();
    // }, 0);
}

function performSearch() {
    const searchQuery = document.getElementById('searchInput').value;
    const category = new URLSearchParams(window.location.search).get('category') || '';

    const url = new URL("{{ route('admin.community_list_partial') }}", window.location.origin);
    if (searchQuery) url.searchParams.set('search', searchQuery);
    if (category) url.searchParams.set('category', category);

    fetch(url)
        .then(response => response.text())
        .then(html => {
            document.querySelector('.stories-container').innerHTML = html;
        })
        .catch(err => console.error(err));
}

// Handle enter key juga boleh tetap ada
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        performSearch();
    }
});

</script>
@endpush