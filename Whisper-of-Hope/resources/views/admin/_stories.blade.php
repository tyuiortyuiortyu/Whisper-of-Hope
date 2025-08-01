@foreach($stories as $story)
    <div class="story-item d-flex align-items-start justify-content-between p-3 mb-3 border rounded" data-category="{{ $story->category_id }}">
        <a href="{{ route('admin.community_admin_edit', $story) }}" class="d-flex flex-grow-1 text-decoration-none text-dark">
            <img src="{{ asset('images/'.$story->image) }}" alt="Thumbnail" class="story-thumbnail me-2" style="height: 5rem; width: 5rem">
            <div class="d-flex justify-content-center flex-column ps-3">
                <h6 class="mb-1">{{ $story->title }}</h6>
                <p class="mb-0 text-muted">{{ Str::limit($story->content, 100) }}</p>
            </div>
        </a>
        <button class="btn-delete" style="height: 1.5rem; width: 1.5rem" type="button" data-story-id="{{ $story->id }}">
            <img src="{{ asset('images/admin/user_admin/delete.png') }}" style="height: 100%; width: 100%" class="delete-icon" alt="Delete">
        </button>
    </div>
    @endforeach

    @if($stories->isEmpty())
        <div class="text-center py-5 text-muted" style="font-size: 1.2rem;">
            @if(request('search'))
                <i> No stories found for "{{ request('search') }}".</i>
            @else
                No stories yet.
            @endif
        </div>
    @endif
    
    <!-- Pagination -->
    @if($stories->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                <span>{{ __('admin.showing_pagi') .' '. $stories->firstItem() .' '. __('admin.to_pagi') .' '. $stories->lastItem() .' '. __('admin.of_pagi') .' '. $stories->total() .' '. __('admin.results_pagi')}}</span>
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