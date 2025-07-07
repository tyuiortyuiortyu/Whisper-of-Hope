<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Whisper of Hope" class="logo-img">
            <div class="logo-text">
                <h3>{{ __('navbar.admin') }}</h3>
                <span>{{ __('admin.dashboard') }}</span>
            </div>
        </div>
        
        <!-- Language Switcher -->
        <div class="language-switcher mt-3">
            <x-language-switcher />
        </div>
    </div>
    
    <ul class="sidebar-menu">
        <li class="menu-item {{ request()->routeIs('admin.user_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.user_admin') }}">
                <img src="/images/admin/users.png" class="menu-icon" alt="{{ __('admin.users') }}">
                <span>{{ __('admin.users') }}</span>
            </a>
        </li>
        
        <li class="menu-item {{ request()->routeIs('admin.request_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.request_admin') }}">
                <img src="/images/admin/requested-wig.png" class="menu-icon" alt="{{ __('admin.requested_wig') }}">
                <span>{{ __('admin.requested_wig') }}</span>
            </a>
        </li>
        
        <li class="menu-item {{ request()->routeIs('admin.donate_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.donate_admin') }}">
                <img src="/images/admin/donated-hair.png" class="menu-icon" alt="{{ __('admin.donated_hair') }}">
                <span>{{ __('admin.donated_hair') }}</span>
            </a>
        </li>
        
        <li class="menu-item {{ request()->routeIs('admin.whisper_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.whisper_admin') }}">
                <img src="/images/admin/the-whispers.png" class="menu-icon" alt="{{ __('admin.the_whisper') }}">
                <span>{{ __('admin.the_whisper') }}</span>
            </a>
        </li>
        
        <li class="menu-item {{ request()->routeIs('admin.community_admin') ? 'active' : '' }}">
            <a href="{{ route('admin.community_admin') }}">
                <img src="/images/admin/community-stories.png" class="menu-icon" alt="{{ __('admin.community_stories') }}">
                <span>{{ __('admin.community_stories') }}</span>
            </a>
        </li>
    </ul>
    
    <div class="sidebar-footer">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); logoutAdmin();">
            <img src="/images/admin/logout.png" class="menu-icon" alt="{{ __('admin.logout') }}">
            <span>{{ __('navbar.logout') }}</span>
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

    .language-switcher .btn {
        background: rgba(255, 255, 255, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: #333;
        font-size: 0.875rem;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .language-switcher .btn:hover {
        background: rgba(255, 255, 255, 0.5);
        border-color: rgba(255, 255, 255, 0.6);
        color: #333;
        transform: translateY(-1px);
    }
    
    .language-switcher .dropdown-menu {
        min-width: 160px;
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        padding: 8px 0;
    }
    
    .language-switcher .dropdown-item {
        font-size: 0.875rem;
        padding: 10px 16px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .language-switcher .dropdown-item.active {
        background-color: #F791A9;
        color: white;
        font-weight: 600;
    }
    
    .language-switcher .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #333;
        transform: translateX(2px);
    }
    
    .language-switcher .dropdown-item.active:hover {
        background-color: #F791A9;
        color: white;
        transform: translateX(2px);
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