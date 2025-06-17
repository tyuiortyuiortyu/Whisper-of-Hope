@extends('admin.layout.app')

@section('title', 'Users')

@section('content')
<div class="users-management">
    <div class="page-header">
        <h2>Users</h2>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search" onkeyup="searchUsers()">
            <i class="fas fa-search"></i>
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
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? '08xx xxxx xxxx' }}</td>
                    <td>{{ $user->gender ?? 'male' }}</td>
                    <td>
                        <span class="role-badge role-{{ $user->role }}">
                            <i class="fas fa-user"></i> {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        <button class="btn-delete" onclick="deleteUser({{ $user->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="no-data">No users found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add New User</h3>
            <span class="close" onclick="closeModal('addUserModal')">&times;</span>
        </div>
        <form method="POST" action="{{ route('admin.users.create') }}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone">
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('addUserModal')">Cancel</button>
                <button type="submit" class="btn-submit">Add User</button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    .users-management {
        padding: 30px;
        background: #f5f5f5;
        min-height: 100vh;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
    }
    
    .page-header h2 {
        color: #333;
        margin: 0;
        font-size: 28px;
        font-weight: 600;
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
    }
    
    .search-container i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }
    
    .btn-add-user {
        background: #ff69b4;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
    }
    
    .btn-add-user:hover {
        background: #ff1493;
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .users-table-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .users-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .users-table th,
    .users-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .users-table th {
        background: #f8f9fa;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }
    
    .users-table td {
        font-size: 14px;
        color: #555;
    }
    
    .users-table tbody tr:hover {
        background: #f9f9f9;
    }
    
    .role-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .role-user {
        background: #e8f5e8;
        color: #2e7d32;
    }
    
    .role-admin {
        background: #ffebee;
        color: #d32f2f;
    }
    
    .btn-delete {
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        background: #ff4444;
        color: white;
    }
    
    .btn-delete:hover {
        background: #cc0000;
    }
    
    .no-data {
        text-align: center;
        color: #999;
        font-style: italic;
        padding: 30px;
    }
    
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
    }
    
    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 0;
        border-radius: 10px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .modal-header h3 {
        margin: 0;
        color: #333;
    }
    
    .close {
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        color: #999;
    }
    
    .close:hover {
        color: #333;
    }
    
    .modal form {
        padding: 20px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        color: #333;
    }
    
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }
    
    .btn-cancel,
    .btn-submit {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }
    
    .btn-cancel {
        background: #6c757d;
        color: white;
    }
    
    .btn-submit {
        background: #ff69b4;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    function showAddUserModal() {
        document.getElementById('addUserModal').style.display = 'block';
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
    
    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/users/${userId}`;
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }
    
    function searchUsers() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const tbody = document.getElementById('usersTableBody');
        const rows = tbody.getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            
            for (let j = 0; j < cells.length - 1; j++) {
                if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
            
            rows[i].style.display = found ? '' : 'none';
        }
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modals = document.getElementsByClassName('modal');
        for (let i = 0; i < modals.length; i++) {
            if (event.target === modals[i]) {
                modals[i].style.display = 'none';
            }
        }
    }
</script>
@endpush
@endsection
