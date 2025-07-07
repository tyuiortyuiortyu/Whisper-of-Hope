@extends('admin.layout.app') {{-- Ensure the path to your admin layout is correct --}}

@section('title', 'Hair Donations')

@section('content')
<div class="hair-donations-management" style="display: flex; flex-direction: column; align-items: center;">
    <div class="page-header" style="justify-content: center; margin-left: 0; width: 100%;">
        <div style="flex: 1;"></div>
        <div class="search-container" style="justify-content: center; display: flex; width: 100%; max-width: 300px;">
            <form method="GET" action="{{ route('admin.donate_admin') }}" id="searchForm" style="width: 100%;">
                <input type="text"
                    id="searchInput"
                    name="search"
                    placeholder="Search donations..."
                    value="{{ request('search') }}"
                    onkeyup="debounceSearch()"
                    style="width: 100%; min-width: 300px; max-width: 100%; padding-right: 45px;">
                <img src="{{ asset('images/admin/user_admin/search.png') }}" class="search-icon" alt="Search" onclick="submitSearch()">
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" id="successAlert" style="text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="errorAlert" style="text-align: center;">
            {{ session('error') }}
        </div>
    @endif

    <div class="donations-table-container" >
        <table class="donations-table">
            <thead>
                <tr>
                    <th style="width: 8%; text-align: center;">Id</th>
                    <th style="width: 16%; text-align: center;">Name</th>
                    <th style="width: 6%; text-align: center;">Age</th>
                    <th style="width: 20%; text-align: center;">Email</th>
                    <th style="width: 14%; text-align: center;">Phone Number</th>
                    <th style="width: 12%; text-align: center;">Hair Length</th>
                    <th style="width: 10%; text-align: center;">Status</th> 
                    <th style="width: 20%; text-align: center;">Action</th> 
                </tr>
            </thead>
            <tbody id="donationsTableBody">
                @forelse($hairDonations as $donation)
                <tr>
                    <td style="text-align: center;">{{ $donation->id }}</td>
                    <td style="text-align: center;">{{ $donation->full_name }}</td>
                    <td style="text-align: center;">{{ $donation->age ?? 'N/A' }}</td>
                    <td style="text-align: center;">{{ $donation->email }}</td>
                    <td style="text-align: center;">{{ $donation->phone ?? 'N/A' }}</td>
                    <td style="text-align: center;">{{ $donation->hair_length ?? 'N/A' }} cm</td>
                    <td style="text-align: center;">
                        @php
                            $status = strtolower($donation->status);
                            $statusImages = [
                                'waiting' => asset('images/Donate_hair/waiting.png'),
                                'received' => asset('images/Donate_hair/accept-solid.png'),
                                'missing' => asset('images/Donate_hair/reject-solid.png'),
                            ];
                            $statusImage = $statusImages[$status] ?? null;
                        @endphp
                        <div style="display: flex; align-items: center; gap: 3px; justify-content: center;">
                            <span class="status-badge status-{{ str_replace(' ', '-', $status) }}">
                                @if($statusImage)
                                    @php
                                        $imgSize = ($status === 'waiting') ? 15 : 16;
                                    @endphp
                                    <img src="{{ $statusImage }}" alt="{{ ucfirst($status) }}" style="width:{{ $imgSize }}px; height:{{ $imgSize }}px;">
                                @endif
                                {{ ucfirst($donation->status) }}
                            </span>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="action-buttons" style="justify-content: center;">
                            {{-- Approve Button --}}
                            <button class="action-btn approve-btn" onclick="confirmAction('{{ $donation->id }}', 'approve')"
                                @if(strtolower($donation->status) === 'received') disabled @endif>
                                <img src="{{ asset('images/Donate_hair/' . (strtolower($donation->status) === 'received' ? 'accept-solid.png' : 'admin_received.svg')) }}" alt="Approve">
                            </button>

                            {{-- Reject Button --}}
                            <button class="action-btn reject-btn" onclick="confirmAction('{{ $donation->id }}', 'reject')"
                                @if(strtolower($donation->status) === 'missing') disabled @endif>
                                <img src="{{ asset('images/Donate_hair/' . (strtolower($donation->status) === 'missing' ? 'reject-solid.png' : 'reject-outline.png')) }}" style = "width: 18px;" alt="Reject">
                            </button>
                            <button class="action-btn delete-btn" onclick="deleteHairDonation('{{ $donation->id }}')">
                                <img src="{{ asset('images/Donate_hair/admin_hapus.svg') }}" alt="Delete">
                            </button>
                        </div>
                        
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="no-data" style="text-align: center; vertical-align: middle;">
                        @if(request('search'))
                            No hair donations found for "{{ request('search') }}"
                        @else
                            No hair donations found
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($hairDonations->hasPages())
            <div class="pagination-container" style="justify-content: center;">
                <div class="pagination-info" style="text-align: center; width: 20%;">
                    <span>Showing {{ $hairDonations->firstItem() }} to {{ $hairDonations->lastItem() }} of {{ $hairDonations->total() }} results</span>
                </div>
                <div class="pagination-wrapper" style="justify-content: center; width: 20%;">
                    <div class="pagination-links" style="justify-content: center; width: 100%;">
                        {{-- Previous Page Link --}}
                        @if ($hairDonations->onFirstPage())
                            <span class="pagination-btn nav-btn disabled">‹</span>
                        @else
                            <a href="{{ $hairDonations->previousPageUrl() }}" class="pagination-btn nav-btn">‹</a>
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $currentPage = $hairDonations->currentPage();
                            $lastPage = $hairDonations->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $hairDonations->url(1) }}" class="pagination-btn">1</a>
                            @if($start > 2)
                                <span class="pagination-dots">...</span>
                            @endif
                        @endif

                        @for($page = $start; $page <= $end; $page++)
                            @if ($page == $currentPage)
                                <span class="pagination-btn active">{{ $page }}</span>
                            @else
                                <a href="{{ $hairDonations->url($page) }}" class="pagination-btn">{{ $page }}</a>
                            @endif
                        @endfor

                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)
                                <span class="pagination-dots">...</span>
                            @endif
                            <a href="{{ $hairDonations->url($lastPage) }}" class="pagination-btn">{{ $lastPage }}</a>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($hairDonations->hasMorePages())
                            <a href="{{ $hairDonations->nextPageUrl() }}" class="pagination-btn nav-btn">›</a>
                        @else
                            <span class="pagination-btn nav-btn disabled">›</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div id="actionConfirmModal" class="modal">
    <div class="modal-content delete-modal">
        <div class="modal-body text-center">
            <h3 id="confirmMessage"></h3>
        </div>

        <div class="modal-actions">
            <button type="button" class="btn-cancel" onclick="closeModal('actionConfirmModal')">Cancel</button>
            <button type="button" class="btn-confirm" onclick="executeAction()">OK</button>
        </div>
    </div>
</div>

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');

    .hair-donations-management {
        padding: 0;
        background: white;
        font-family: 'Yantramanav';
        margin-left: -15px;
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

    .alert {
        padding: 15px;
        margin: 0 10px 20px 10px;
        border-radius: 14px;
        opacity: 1;
        transition: opacity 0.5s ease-out;
    }

    .alert.fade-out {
        opacity: 0;
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

    .donations-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-right: -15px;
        border: 1px solid #e8e8e8;
        width: calc(100% - 15px);
    }

    .donations-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
    }

    .donations-table th {
        padding: 18px 15px; 
        text-align: left;
        vertical-align: middle;
        background: #fafafa;
        font-weight: 600;
        color: #2c2c2c;
        font-size: 14px;
        font-family: 'Yantramanav';
        border-bottom: 2px solid #f0f0f0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .donations-table th.text-right {
        text-align: right;
    }

    .donations-table td {
        padding: 15px 15px; 
        text-align: left;
        vertical-align: middle;
        font-size: 15px;
        color: #2c2c2c;
        font-family: 'Yantramanav';
        background: white;
        border-bottom: 2px solid #e8e8e8;
    }

    .donations-table tbody tr {
        border-bottom: 2px solid #e8e8e8;
        position: relative;
    }

    .donations-table tbody tr:last-child td {
        border-bottom: 2px solid #e8e8e8;
    }

    .donations-table tbody tr:hover {
        background: #fafafa;
    }

    .donations-table tbody tr:hover td {
        background: #fafafa;
        border-bottom: 2px solid #e8e8e8;
    }

    .status-badge {
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        font-family: 'Yantramanav';
        border: 1px solid transparent;
        width: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
        text-align: center;
    }

    .status-missing {
        background: #fbecec;
        color: #e53935;
        border-color: #fce4e4;
    }

    .status-received {
        background: #e8f5e8;
        color: #388e3c;
        border-color: #d4edda;
    }

    .status-waiting {
        background: #fff8e1;
        color: #fbc02d;
        border-color: #fff3cd;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: flex-start;
        align-items: center;
        flex-wrap: nowrap;
    }

    .action-btn {
        padding: 8px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        transition: all 0.3s ease;
        margin-right: 8px;
    }

    .action-btn img {
        width: 20px;
        height: 20px;
        object-fit: contain;
    }

    .approve-btn:hover {
        background: rgba(46, 125, 50, 0.1);
        border-radius: 50%;
    }

    .reject-btn:hover {
        background: rgba(211, 47, 47, 0.1);
        border-radius: 50%;
    }

    .delete-btn:hover {
        background: rgba(255, 0, 0, 0.1);
        border-radius: 50%;
    }

    .no-data {
        text-align: center;
        color: #999;
        font-style: italic;
        padding: 40px;
        font-size: 16px;
    }

    /* Enhanced Modal Styles (reused and slightly modified) */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: #FFFCF5;
        margin: 3% auto;
        padding: 0;
        border-radius: 14px;
        width: 90%;
        max-width: 520px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        position: relative;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 30px;
        border-bottom: 1px solid #f0f0f0;
    }

    .modal-header h3 {
        margin: 0;
        color: #333;
        font-family: 'Yantramanav';
        font-size: 1.2rem;
        font-weight: 600;
    }

    .close {
        width: 24px;
        height: 24px;
        object-fit: contain;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .close:hover {
        background: #f5f5f5;
        transform: scale(1.1);
    }

    .modal-body {
        padding: 25px 30px;
    }

    .form-section {
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .half-width {
        flex: 1;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
        font-family: 'Yantramanav';
        font-size: 14px;
    }

    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Yantramanav';
        transition: border-color 0.3s ease;
        background: white;
    }

    .form-input:focus {
        outline: none;
        border-color: #F9BCC4;
        box-shadow: 0 0 0 3px rgba(249, 188, 196, 0.1);
    }

    .radio-group {
        display: flex;
        gap: 25px;
        margin-top: 5px;
    }

    .radio-option {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-family: 'Yantramanav', sans-serif;
        font-size: 14px;
        color: #333;
        font-weight: 400;
    }

    .radio-option input[type="radio"] {
        display: none;
    }

    .radio-custom {
        width: 18px;
        height: 18px;
        border: 2px solid #ddd;
        border-radius: 50%;
        margin-right: 10px;
        position: relative;
        transition: all 0.3s ease;
    }

    .radio-option input[type="radio"]:checked + .radio-custom {
        border-color: #F9BCC4;
        background: #F9BCC4;
    }

    .radio-option input[type="radio"]:checked + .radio-custom::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 8px;
        height: 8px;
        background: white;
        border-radius: 50%;
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
    .btn-confirm {
        padding: 12px 28px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 14px;
        font-family: 'Yantramanav';
        font-weight: 600;
        transition: all 0.3s ease;
        min-width: 100px;
    }

    .btn-cancel {
        background: #D6D6D6;
        color: black;
        border-radius: 50px;
    }

    .btn-cancel:hover {
        background: #C3C3C3;
        color: black;
    }

    .btn-confirm {
        background: #F9BCC4;
        color: #333;
        border: 1px solid #F9BCC4;
    }

    .btn-confirm:hover {
        background: #F791A9;
        border-color: #F791A9;
    }

    .btn-confirm:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(249, 188, 196, 0.2);
    }

    /* Delete Modal Styles (reused for general confirmation) */
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

@push('scripts')
<script>
    let donationIdToAction = null;
    let actionType = null; // 'approve', 'reject', or 'delete'
    let searchTimeout = null;

    function showActionConfirmModal(message) {
        document.getElementById('confirmMessage').innerText = message;
        document.getElementById('actionConfirmModal').style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
        if (modalId === 'actionConfirmModal') {
            donationIdToAction = null;
            actionType = null;
        }
    }

    function confirmAction(donationId, type) {
        donationIdToAction = donationId;
        actionType = type;
        let message = '';
        if (type === 'approve') {
            message = 'Are you sure you want to approve this donation?';
        } else if (type === 'reject') {
            message = 'Are you sure you want to reject this donation?';
        } else if (type === 'delete') {
            message = 'Are you sure you want to delete this donation?';
        }
        showActionConfirmModal(message);
    }

    function executeAction() {
        if (donationIdToAction && actionType) {
            const form = document.createElement('form');
            form.method = 'POST';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            form.appendChild(methodInput);

            if (actionType === 'delete') {
                // For delete, we want: /admin/donations/{id}
                form.action = '{{ route('admin.donations.destroy', ['hairDonation' => '__ID__']) }}'.replace('__ID__', donationIdToAction);
                methodInput.value = 'DELETE';
            } else if (actionType === 'approve') {
                // For approve, we want: /admin/donations/{id}/approve
                form.action = '{{ route('admin.donations.approve', ['hairDonation' => '__ID__']) }}'.replace('__ID__', donationIdToAction);
                methodInput.value = 'PUT';
            } else if (actionType === 'reject') {
                // For reject, we want: /admin/donations/{id}/reject
                form.action = '{{ route('admin.donations.reject', ['hairDonation' => '__ID__']) }}'.replace('__ID__', donationIdToAction);
                methodInput.value = 'PUT';
            }

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Function specifically for delete, if you prefer a separate confirmation
    function deleteHairDonation(donationId) {
        confirmAction(donationId, 'delete');
    }

    function debounceSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            submitSearch();
        }, 500);
    }

    function submitSearch() {
        document.getElementById('searchForm').submit();
    }

    // Clear search functionality
    function clearSearch() {
        document.getElementById('searchInput').value = '';
        submitSearch();
    }

    // Close modal when clicking outside the modal
    window.onclick = function(event) {
        const modals = document.getElementsByClassName('modal');
        for (let i = 0; i < modals.length; i++) {
            if (event.target === modals[i]) {
                modals[i].style.display = 'none';
                if (modals[i].id === 'actionConfirmModal') {
                    donationIdToAction = null;
                    actionType = null;
                }
            }
        }
    }

    // Handle enter key on search
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            submitSearch();
        }
    });

    // Auto-dismiss alerts
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');

        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('fade-out');
                setTimeout(() => successAlert.remove(), 500); // Remove after fade-out transition
            }, 2000); // 2 seconds
        }

        if (errorAlert) {
            setTimeout(() => {
                errorAlert.classList.add('fade-out');
                setTimeout(() => errorAlert.remove(), 500); // Remove after fade-out transition
            }, 2000); // 2 seconds
        }
    });
</script>
@endpush
@endsection