@extends('admin.layout.app')

@section('title', 'Users')

@section('content')
<div class="users-management">
    <div class="page-header">
        <div class="search-container">
            <form method="GET" action="{{ route('admin.user_admin') }}" id="searchForm">
                <input type="text" 
                       id="searchInput" 
                       name="search" 
                       placeholder="Search users..." 
                       value="{{ request('search') }}"
                       onkeyup="debounceSearch()">
                <img src="{{ asset('images/admin/user_admin/search.png') }}" class="search-icon" alt="Search" onclick="submitSearch()">
            </form>
        </div>
        <button class="btn-add-user" onclick="showAddUserModal()">
            Add User
        </button>
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

    <div class="users-table-container">
        <table class="users-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <div class="user-name-container">
                            <div class="profile-picture">
                                @if($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile">
                                @else
                                    <div class="default-avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
                                @endif
                            </div>
                            <span>{{ $user->name }}</span>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? '08xx xxxx xxxx' }}</td>
                    <td>{{ ucfirst($user->gender ?? 'Not specified') }}</td>
                    <td>
                        <span class="role-badge role-{{ $user->role }}">
                            <img src="{{ asset('images/admin/user_admin/role_' . $user->role . '.png') }}" class="role-icon" alt="{{ ucfirst($user->role) }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        @if($user->id !== auth()->id())
                            <button class="btn-delete" onclick="deleteUser({{ $user->id }})">
                                <img src="{{ asset('images/admin/user_admin/delete.png') }}" class="delete-icon" alt="Delete">
                            </button>
                        @else
                            <span class="text-muted" style="font-size: 0.8rem;">Current User</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="no-data">
                        @if(request('search'))
                            No users found for "{{ request('search') }}"
                        @else
                            No users found
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    <span>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results</span>
                </div>
                <div class="pagination-wrapper">
                    <div class="pagination-links">
                        {{-- Previous Page Link --}}
                        @if ($users->onFirstPage())
                            <span class="pagination-btn nav-btn disabled">‹</span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="pagination-btn nav-btn">‹</a>
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $currentPage = $users->currentPage();
                            $lastPage = $users->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $users->url(1) }}" class="pagination-btn">1</a>
                            @if($start > 2)
                                <span class="pagination-dots">...</span>
                            @endif
                        @endif

                        @for($page = $start; $page <= $end; $page++)
                            @if ($page == $currentPage)
                                <span class="pagination-btn active">{{ $page }}</span>
                            @else
                                <a href="{{ $users->url($page) }}" class="pagination-btn">{{ $page }}</a>
                            @endif
                        @endfor

                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)
                                <span class="pagination-dots">...</span>
                            @endif
                            <a href="{{ $users->url($lastPage) }}" class="pagination-btn">{{ $lastPage }}</a>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="pagination-btn nav-btn">›</a>
                        @else
                            <span class="pagination-btn nav-btn disabled">›</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add New User</h3>
            <img src="{{ asset('images/admin/user_admin/close.png') }}" class="close" onclick="closeModal('addUserModal')" alt="Close">
        </div>
        <form method="POST" action="{{ route('admin.users.create') }}">
            @csrf
            <div class="modal-body">
                <div class="form-section">
                    <label class="form-label">Role</label>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="role" value="user" checked>
                            <span class="radio-custom"></span>
                            User
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="role" value="admin">
                            <span class="radio-custom"></span>
                            Admin
                        </label>
                    </div>
                </div>

                <div class="form-section">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-input" required>
                </div>

                <div class="form-section">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required>
                </div>

                <div class="form-section">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" required minlength="8">
                </div>

                <div class="form-row">
                    <div class="form-section half-width">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-input">
                    </div>
                    <div class="form-section half-width">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-input" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('addUserModal')">Cancel</button>
                <button type="submit" class="btn-add">Add User</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteUserModal" class="modal">
    <div class="modal-content delete-modal">
        <div class="modal-body text-center">
            <h3>Are you sure want to delete this user?</h3>
        </div>
        
        <div class="modal-actions">
            <button type="button" class="btn-cancel" onclick="closeModal('deleteUserModal')">Cancel</button>
            <button type="button" class="btn-delete-confirm" onclick="confirmDelete()">OK</button>
        </div>
    </div>
</div>

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');
    
    .users-management {
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
        background: #F791A9;
        /* transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(249,188,196,0.3); */
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
    
    .users-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin: 0;
        border: 1px solid #e8e8e8;
    }
    
    .users-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
    }
    
    .users-table th,
    .users-table td {
        padding: 18px 25px;
        text-align: left;
        vertical-align: middle;
    }
    
    .users-table th {
        background: #fafafa;
        font-weight: 600;
        color: #2c2c2c;
        font-size: 14px;
        font-family: 'Yantramanav';
        border-bottom: 2px solid #f0f0f0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .users-table td {
        font-size: 15px;
        color: #2c2c2c;
        font-family: 'Yantramanav';
        background: white;
        border-bottom: 2px solid #e8e8e8;
    }
    
    .users-table tbody tr {
        border-bottom: 2px solid #e8e8e8;
        position: relative;
    }
    
    .users-table tbody tr:last-child td {
        border-bottom: 2px solid #e8e8e8;
    }
    
    .users-table tbody tr:hover {
        background: #fafafa;
    }
    
    .users-table tbody tr:hover td {
        background: #fafafa;
        border-bottom: 2px solid #e8e8e8;
    }
    
    .user-name-container {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .profile-picture {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f0f0;
        flex-shrink: 0;
        border: 2px solid #e8e8e8;
    }
    
    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .default-avatar {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #FFDBDF 10%, #F791A9 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
        font-size: 18px;
        font-family: 'Yantramanav';
    }
    
    .user-name-container span {
        font-weight: 500;
        color: #2c2c2c;
    }
    
    .role-badge {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: 'Yantramanav';
        border: 1px solid transparent;
    }
    
    .role-icon {
        width: 16px;
        height: 16px;
        object-fit: contain;
    }
    
    .role-user {
        background: #e8f5e8;
        color: #2e7d32;
        border-color: #c8e6c9;
    }
    
    .role-admin {
        background: #ffebee;
        color: #d32f2f;
        border-color: #ffcdd2;
    }
    
    .btn-delete {
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
    }
    
    .delete-icon {
        width: 20px;
        height: 20px;
        object-fit: contain;
    }
    
    .btn-delete:hover {
        background: rgba(255, 0, 0, 0.1);
        transform: scale(1.05);
        border-radius: 50%;
    }
    
    .no-data {
        text-align: center;
        color: #999;
        font-style: italic;
        padding: 40px;
        font-size: 16px;
    }
    
    /* Enhanced Modal Styles */
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
        border-radius: 15px;
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
        font-size: 1.4rem;
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
    
    .btn-add {
        background: #F9BCC4;
        color: #333;
        border: 1px solid #F9BCC4;
    }
    
    .btn-add:hover {
        background: #F791A9;
        border-color: #F791A9;
        /* transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(249, 188, 196, 0.4); */
    }
    
    .btn-add:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(249, 188, 196, 0.2);
    }
    
    /* Delete Modal Styles */
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
    let userToDelete = null;
    let searchTimeout = null;
    
    function showAddUserModal() {
        document.getElementById('addUserModal').style.display = 'block';
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
        if (modalId === 'deleteUserModal') {
            userToDelete = null;
        }
    }
    
    function deleteUser(userId) {
        userToDelete = userId;
        document.getElementById('deleteUserModal').style.display = 'block';
    }
    
    function confirmDelete() {
        if (userToDelete) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/users/${userToDelete}`;
            
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
    }
    
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
</script>
@endpush

@endsection

