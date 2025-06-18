<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Whisper of Hope" class="logo-img">
            <div class="logo-text">
                <h3>Admin</h3>
                <span>Dashboard</span>
            </div>
        </div>
    </div>
    
    <ul class="sidebar-menu">
        <li class="menu-item {{ request()->routeIs('admin.user_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.user_admin') }}">
                <img src="/images/admin/users.png" class="menu-icon" alt="Users">
                <span>Users</span>
            </a>
        </li>
        
        <li class="menu-item {{ request()->routeIs('admin.request_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.request_admin') }}">
                <img src="/images/admin/requested-wig.png" class="menu-icon" alt="Requested Wig">
                <span>Requested Wig</span>
            </a>
        </li>
        
        <li class="menu-item {{ request()->routeIs('admin.donate_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.donate_admin') }}">
                <img src="/images/admin/donated-hair.png" class="menu-icon" alt="Donated Hair">
                <span>Donated Hair</span>
            </a>
        </li>
        
        <li class="menu-item {{ request()->routeIs('admin.whisper_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.whisper_admin') }}">
                <img src="/images/admin/the-whispers.png" class="menu-icon" alt="The Whisper">
                <span>The Whisper</span>
            </a>
        </li>
        
        <li class="menu-item {{ request()->routeIs('admin.community_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.community_admin') }}">
                <img src="/images/admin/community-stories.png" class="menu-icon" alt="Community Stories">
                <span>Community Stories</span>
            </a>
        </li>
    </ul>
    
    <div class="sidebar-footer">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); logoutAdmin();">
            <img src="/images/admin/logout.png" class="menu-icon" alt="Logout">
            <span>Logout</span>
        </a>
    </div>
</nav>

<script>
function logoutAdmin() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("admin.logout") }}';
    
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}';
    
    form.appendChild(csrfInput);
    document.body.appendChild(form);
    form.submit();
}
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');
    
    .sidebar {
        width: 280px;
        background: linear-gradient(to bottom, #FFDBDF, #F791A9);
        color: #333;
        display: flex;
        flex-direction: column;
        position: fixed;
        height: 100vh;
        left: 0;
        top: 0;
        z-index: 1000;
        font-family: 'Yantramanav', sans-serif;
    }

    .sidebar-header {
        padding: 30px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        margin-bottom: -15px;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .logo-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .logo-text h3 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: -5px;
        color: #333;
        font-family: 'Yantramanav', sans-serif;
    }

    .logo-text span {
        font-size: 1rem;
        font-weight: 400;
        color: black;
        font-family: 'Yantramanav', sans-serif;
    }

    .sidebar-menu {
        flex: 1;
        list-style: none;
        padding: 15px 0;
        margin: 0;
    }

    .menu-item {
        margin-bottom: 10px;
    }

    .menu-item a {
        display: flex;
        align-items: center;
        padding: 12px 25px;
        color: #333;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 1.1rem;
        font-weight: 400;
        letter-spacing: 0.5px;
        position: relative;
        margin-right: 0;
        margin-bottom: 20px;
        margin-left: 0;
        font-family: 'Yantramanav', sans-serif;
    }

    .menu-icon {
        width: 20px;
        height: 20px;
        object-fit: contain;
        margin-right: 20px;
    }

    .menu-item a:hover,
    .menu-item a:active,
    .menu-item.active a {
        background: #FFF9EA;
        border-radius: 0 50px 50px 0;
        color: #333;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        width: calc(100% - 30px);
        margin-left: 0;
    }

    .sidebar-footer {
        padding: 15px 20px;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 0.95rem;
        font-weight: 500;
        font-family: 'Yantramanav', sans-serif;
    }

    .logout-btn:hover {
        color: #000;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }
        
        .sidebar.active {
            transform: translateX(0);
        }
    }
</style>