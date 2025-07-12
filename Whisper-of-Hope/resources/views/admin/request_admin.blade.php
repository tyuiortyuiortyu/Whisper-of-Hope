@extends('admin.layout.app')

@section('title', 'Requested Wig')

@section('content')

<div class="request-data">
    <div class="page-header">
        <div class="tab-navigation">
            <ul class="nav-tabs">
                <!-- <li class="nav-item active">All Requests</li>
                <li class="nav-item">For Personal</li>
                <li class="nav-item">For Child</li>
                <li class="nav-item">For Patient</li> -->
                
                <!-- all requests -->
                <li class="nav-item @if(!request('type')) active @endif">
                    <a href="{{ route('admin.request_admin')  }}">All Requests</a>
                </li>
                <!-- personal -->
                <li class="nav-item @if(request('type') == 'myself') active @endif">
                    <a href="{{ route('admin.request_admin', ['type' => 'myself'])  }}">For Personal</a>
                </li>
                <!-- child -->
                <li class="nav-item @if(request('type') == 'parent_guardian') active @endif">
                    <a href="{{ route('admin.request_admin', ['type' => 'parent_guardian'])  }}">For Child</a>
                </li>
                <!-- patient -->
                <li class="nav-item @if(request('type') == 'health_professional') active @endif">
                    <a href="{{ route('admin.request_admin', ['type' => 'health_professional'])  }}">For Patient</a>
                </li>
            </ul>
        </div>
        <div class="search-container">
            <form method="GET" action="{{ route('admin.request_admin') }}" id="searchForm">
                <input type="text" 
                       id="searchInput" 
                       name="search" 
                       placeholder="Search requests..." 
                       value="{{ request('search') }}"
                       onkeyup="debounceSearch()">
                <img src="{{ asset('images/admin/user_admin/search.png') }}" class="search-icon" alt="Search" onclick="submitSearch()">
            </form>
        </div>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success" id="successAlert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="errorAlert">
            {{ session('error') }}
        </div>
    @endif

    <div class="requests-table-container">
        <table class="requests-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Reason</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="requestsTableBody">
                @forelse($requests as $request)
                <tr class="clickable-row" onclick="window.location.href='{{ route('admin.requests.show', $request) }}'">
                    <td>{{ $request->id }}</td>
                    <!-- <td>{{ $request->recipient_full_name }}</td> -->
                     <td title="{{ $request->recipient_full_name ?? '-' }}">
                        {{ Str::of($request->recipient_full_name ?? '-')->words(2, '...') }}
                    </td>
                    <td>{{ $request->recipient_age ?? '-' }}</td>
                    <td>{{ $request->recipient_email ?? '-'}}</td>
                    <td>{{ $request->recipient_phone ?? '-' }}</td>
                    <!-- <td>{{ $request->recipient_reason ?? '-' }}</td> -->
                    <td title="{{ $request->recipient_reason ?? '-' }}">
                        {{ Str::of($request->recipient_reason ?? '-')->words(2, '...') }}
                    </td>
                    <td>{{ $request->who_for ?? '-' }}</td>
                    <td>
                        @php
                            $statusClass = '';
                            $statusText = '';
                            $iconPath = '';
                            $iconClass = '';

                            switch ($request->status) {
                                case 'accepted':
                                    $statusClass = 'status-accepted';
                                    $statusText = 'Accepted';
                                    $iconPath = asset('images/admin/request_admin/accept-solid.png');
                                    $iconClass = 'icon-accepted';
                                    break;
                                case 'rejected':
                                    $statusClass = 'status-rejected';
                                    $statusText = 'Rejected';
                                    $iconPath = asset('images/admin/request_admin/reject-solid.png');
                                    $iconClass = 'icon-rejected';
                                    break;
                                default:
                                    $statusClass = 'status-waiting';
                                    $statusText = 'Waiting';
                                    $iconPath = asset('images/admin/request_admin/waiting.png');
                                    $iconClass = 'icon-waiting';
                                    break;
                                }
                        @endphp
                        <span class="status-pill {{ $statusClass }}">
                            <span class="status-icon-wrapper">
                                <img src="{{ $iconPath }}" alt="{{ $statusText }}" class="status-icon {{ $iconClass }}">
                            </span>
                            <span>{{ $statusText }}</span>
                        </span>
                    </td>
                    <td class="action-cell" onclick="event.stopPropagation();">
                        <!-- Accept -->
                        <form action="{{ route('admin.requests.accept', $request) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn" title="Accept" @if($request->status == 'accepted') disabled @endif>
                                @if($request->status == 'accepted')
                                    <img src="{{ asset('images/admin/request_admin/accept-solid.png') }}" alt="Accepted">
                                @else
                                    <img src="{{ asset('images/admin/request_admin/accept-outline.png') }}" alt="Accept">
                                @endif
                            </button>
                        </form>
                        <!-- Reject -->
                        <form action="{{ route('admin.requests.reject', $request) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn" title="Reject" @if($request->status == 'rejected') disabled @endif>
                                @if($request->status == 'rejected')
                                    <img src="{{ asset('images/admin/request_admin/reject-solid.png') }}" alt="Rejected">
                                @else
                                    <img src="{{ asset('images/admin/request_admin/reject-outline.png') }}" alt="Reject">
                                @endif
                            </button>
                        </form>
                        <!-- Delete  -->
                        <form action="{{ route('admin.requests.destroy', $request) }}" method="POST" id="deleteForm-{{ $request->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="action-btn" title="Delete" onclick="showDeleteModal(event, '{{ $request->id }}')">
                                <img src="{{ asset('images/admin/user_admin/delete.png') }}" alt="Delete">
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="no-data">
                        @if(request('search'))
                            No requests found for "{{ request('search') }}"
                        @else
                            No requests found
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Pagination -->
       @if($requests->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    <span>Showing {{ $requests->firstItem() }} to {{ $requests->lastItem() }} of {{ $requests->total() }} results</span>
                </div>
                <div class="pagination-wrapper">
                    <div class="pagination-links">
                        {{-- Previous Page Link --}}
                        @if ($requests->onFirstPage())
                            <span class="pagination-btn nav-btn disabled">‹</span>
                        @else
                            <a href="{{ $requests->previousPageUrl() }}" class="pagination-btn nav-btn">‹</a>
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $currentPage = $requests->currentPage();
                            $lastPage = $requests->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $requests->url(1) }}" class="pagination-btn">1</a>
                            @if($start > 2)
                                <span class="pagination-dots">...</span>
                            @endif
                        @endif

                        @for($page = $start; $page <= $end; $page++)
                            @if ($page == $currentPage)
                                <span class="pagination-btn active">{{ $page }}</span>
                            @else
                                <a href="{{ $requests->url($page) }}" class="pagination-btn">{{ $page }}</a>
                            @endif
                        @endfor

                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)
                                <span class="pagination-dots">...</span>
                            @endif
                            <a href="{{ $requests->url($lastPage) }}" class="pagination-btn">{{ $lastPage }}</a>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($requests->hasMorePages())
                            <a href="{{ $requests->nextPageUrl() }}" class="pagination-btn nav-btn">›</a>
                        @else
                            <span class="pagination-btn nav-btn disabled">›</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div id="deleteRequestModal" class="modal">
    <div class="modal-content delete-modal">
        <div class="modal-body text-center">
            <h3>Are you sure want to delete this request?</h3>
        </div>
        
        <div class="modal-actions">
            <button type="button" class="btn-cancel">Cancel</button>
            <button type="button" class="btn-delete-confirm">OK</button>
        </div>
    </div>
</div>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');
    
    .request-data {
        padding: 0;
        background: white;
        font-family: 'Yantramanav';
    }

    .alert {
        padding: 15px 20px;
        margin: 25px auto;
        border-radius: 8px;
        font-size: 16px;
        /* font-weight: 500; */
        font-family: 'Yantramanav', sans-serif;
        animation: fadeIn 0.5s ease;
        width: 100%;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding: 0 10px;
        padding-top: 20px;
        border-bottom: 1.2px solid #ddd;
    }

    .tab-navigation {
        margin: 20px 30px 0;
    }

    .nav-tabs {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 20px;
    }

    .nav-item {
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        color: #8C8C8C;
        transition: all 0.3s;
        position: relative;
        margin-bottom: -2px;
        transition: color 0.3s ease;
    }

    .nav-item:hover {
        color: #000;
    }

    .nav-item.active {
        color: #000;
        font-weight: 500;
        border-bottom: none;
    }

    .nav-item.active::after {
        content: '';
        position: absolute;
        bottom: -0.5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #F791A9;
    }

    .nav-item a {
        text-decoration: none;
        color: inherit;
        font-weight: inherit;
        font-size: inherit;
        display: block;
    }

    .search-container {
        position: relative;
        flex: 1;
        max-width: 300px;
    }
    
    .search-container input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 14px;
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

    .requests-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin: 0;
        border: 1px solid #e8e8e8;
    }
    
    .requests-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
    }

    .requests-table tbody tr.clickable-row {
        cursor: pointer;
    }

    .requests-table tbody tr .action-cell {
        cursor: default;
    }
    .requests-table tbody tr .action-cell * {
        cursor: pointer;
    }
    
    .requests-table th,
    .requests-table td {
        padding: 18px 15px;
        text-align: center;
        vertical-align: middle;
    }
    
    .requests-table th {
        background: #fafafa;
        font-weight: 600;
        color: #2c2c2c;
        font-size: 14px;
        font-family: 'Yantramanav';
        border-bottom: 2px solid #f0f0f0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .requests-table td {
        font-size: 15px;
        color: #2c2c2c;
        font-family: 'Yantramanav';
        background: white;
        border-bottom: 2px solid #e8e8e8;
        text-align: center;
    }
    
    .requests-table tbody tr {
        border-bottom: 2px solid #e8e8e8;
        position: relative;
    }
    
    .requests-table tbody tr:last-child td {
        border-bottom: 2px solid #e8e8e8;
    }
    
    .requests-table tbody tr:hover {
        background: #fafafa;
    }
    
    .requests-table tbody tr:hover td {
        background: #fafafa;
        border-bottom: 2px solid #e8e8e8;
    }

    /* action */
    .action-cell {
        display: flex;
        justify-content: center;
        align-items: center;
        /* gap: 10px; */
    }

    .action-cell form {
        margin: 0;
        padding: 0;
        line-height: 1;
    }
    
    .action-btn {
        border: none;
        background-color: transparent;
        padding: 0;
        cursor: pointer;
        width: 40px;
        height: 40px;
        border-radius: 50%; 
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s ease;
    }

    .action-btn img {
        object-fit: contain;
    }

    .action-btn[title="Accept"] img {
        width: 30px;
        height: 30px;
        object-fit: contain;
        padding: 6px;
    }
    
    .action-btn[title="Reject"] img {
        width: 38px;
        height: 38px;
        object-fit: contain;
        padding: 5px;
    }
    
    .action-btn[title="Delete"] img {
        width: 30px;
        height: 30px;
        object-fit: contain;
        padding: 6px;
    }

    .action-btn[title="Reject"]:hover {
        transform: scale(1.05);
        background-color: rgba(255, 0, 0, 0.1);
        border-radius: 50%;
    }
    
    .action-btn[title="Delete"]:hover {
        transform: scale(1.05);
        background-color: rgba(255, 0, 0, 0.1);
        border-radius: 50%;
    }
    
    .action-btn[title="Accept"]:hover {
        transform: scale(1.05);
        background-color: rgba(52, 210, 0, 0.2);
        border-radius: 50%; 
    }
    
    .action-btn:disabled {
        cursor: default;
        transform: none;
        background-color: transparent;
    }

    .action-btn:disabled:hover {
        transform: none;
        background-color: transparent;
    }
    
    .no-data {
        text-align: center;
        color: #999;
        font-style: italic;
        padding: 40px;
        font-size: 16px;
    }

    /* status */
    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 12px;
        width: 110px;
        min-height: 32px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
    }

    .status-icon-wrapper {
        width: 20px;
        height: 20px;
    }

    .status-icon {
        object-fit: contain;
    }
    
    .status-icon.icon-waiting {
        width: 16px;
        height: 16px;
        margin-top: -2px;
    }
    
    .status-icon.icon-accepted {
        width: 14px;
        height: 14px;
        margin-top: -1px;
    }
    
    .status-icon.icon-rejected {
        width: 22px;
        height: 22px;
        margin-top: -2px;
        /* margin: 0 -5px; */
    }
    
    .status-waiting {
        background-color: #FFDDA5;
        color: #EF8C00;
    }
    
    .status-accepted {
        background-color: #C4F0B3;
        color: #328525;
    }

    .status-rejected {
        background-color: #FFD3D3;
        color: #AC1A1A;
    }

    /* delete modal */
    .modal {
        /display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .modal.is-active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background-color: #FEF0F0;
        border-radius: 14px;
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
        font-family: 'Yantramanav', sans-serif;
        font-size: 1.2rem;
        font-weight: 500;
        /* line-height: 1.4; */
    }

    .modal-actions {
        display: flex;
        justify-content: center;
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
        /* color: #333; */
    }

    .modal-actions .btn-delete-confirm:hover {
        background: #F791A9;
        color: #FFFFFF;
    }
    
    /* pagination */
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // delete modal
        const deleteModal = document.getElementById('deleteRequestModal');
        let requestToDeleteId = null;

        window.showDeleteModal = function(event, requestId) {
            event.stopPropagation(); // Prevents the row's main click event
            requestToDeleteId = requestId;
            if (deleteModal) {
                deleteModal.classList.add('is-active');
            }
        }

        function closeModal() {
            if (deleteModal) {
                deleteModal.classList.remove('is-active');
            }
            requestToDeleteId = null;
        }

        function confirmDelete() {
            if (requestToDeleteId) {
                const form = document.getElementById('deleteForm-' + requestToDeleteId);
                if (form) {
                    form.submit();
                }
            }
        }

        const cancelButton = deleteModal.querySelector('.btn-cancel');
        const confirmButton = deleteModal.querySelector('.btn-delete-confirm');

        if (cancelButton) {
            cancelButton.addEventListener('click', closeModal);
        }
        if (confirmButton) {
            confirmButton.addEventListener('click', confirmDelete);
        }

        // close modal if clicking outside of it
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                closeModal();
            }
        });

        // auto dismiss alerts
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }, 3000); // 3 seconds
        }
        const errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            setTimeout(() => {
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.remove(), 500);
            }, 5000); // 5 seconds
        }

        const style = document.createElement('style');
        style.innerHTML = `.alert { transition: opacity 0.5s ease-out; }`;
        document.head.appendChild(style);
    });

    // search
    let requestData = [];
    let searchTimeout = null;

    document.addEventListener('DOMContentLoaded', function() {
        extractRequestData();
        setupSearch();
    });

    function extractRequestData() {
        const rows = document.querySelectorAll('#requestsTableBody tr');
        requestData = [];
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length > 1 && !row.querySelector('.no-data')) {
                const statusElement = row.querySelector('.status-pill span:last-of-type');
                
                requestData.push({
                    id: cells[0].textContent.trim(),    
                    name: cells[1].textContent.trim(),  
                    age: cells[2].textContent.trim(),   
                    email: cells[3].textContent.trim(), 
                    phone: cells[4].textContent.trim(), 
                    reason: cells[5].getAttribute('title') || cells[5].textContent.trim(),
                    type: cells[6].textContent.trim(),  
                    status: statusElement ? statusElement.textContent.trim() : '',
                    element: row
                });
            }
        });
    }

    function setupSearch() {
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                performSearch();
            }, 300);
        });
    }

    function performSearch() {
        const searchInput = document.getElementById('searchInput');
        const searchValue = searchInput.value.toLowerCase().trim();
        
        const filteredRequests = requestData.filter(request => 
            request.name.toLowerCase().includes(searchValue) ||
            request.email.toLowerCase().includes(searchValue) ||
            request.reason.toLowerCase().includes(searchValue) ||
            request.type.toLowerCase().includes(searchValue) ||
            request.status.toLowerCase().includes(searchValue)
        );
        
        updateRequestDisplay(filteredRequests, searchValue);
    }

    function updateRequestDisplay(filteredRequests, searchValue) {
        const tbody = document.getElementById('requestsTableBody');
        
        const noDataRow = tbody.querySelector('.no-data-js');
        if (noDataRow) {
            noDataRow.remove();
        }

        requestData.forEach(request => {
            request.element.style.display = 'none';
        });
        
        if (filteredRequests.length === 0 && searchValue !== '') {
            const newRow = tbody.insertRow();
            newRow.className = 'no-data-js';
            newRow.innerHTML = `
                <td colspan="9" class="no-data">
                    No requests found for "${searchValue}"
                </td>
            `;
        } else {
            filteredRequests.forEach(request => {
                request.element.style.display = '';
            });
        }
    }

    function debounceSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => performSearch(), 300);
    }

    function submitSearch() {
        performSearch();
    }
</script>
@endsection