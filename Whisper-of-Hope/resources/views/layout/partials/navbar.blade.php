<style>
    .menubtn, .auth-link {
        background-color: transparent;
        color: #000000;
        border-radius: 999px;
        padding: 6px 20px;
        font-weight: 600;
        font-size: 1rem;
        font-family: inherit;
        transition: all 0.3s ease;
        text-align: center;
        border: none;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        cursor: pointer;
    }

    .menubtn:hover, .auth-link:hover {
        background-color: #F78DA7;
        color: white !important;
    }

    .menubtn.active, .auth-link.active {
        background-color: #F78DA7;
        color: white;
    }

    .auth-container {
        display: flex;
        align-items: center;
        margin-left: 10px;
    }

    .auth-link {
        padding: 6px 15px;
    }

    .auth-link .bi-person-fill {
        margin-left: 8px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    /* Ensure all text has same styling */
    .navbar-nav .nav-item .menubtn,
    .auth-container .auth-link {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        letter-spacing: 0.5px;
        text-transform: none;
    }
</style>

<nav class="navbar navbar-expand-lg sticky-top" style="background-color: #FFDBDF;">
    <div class="container-fluid px-4">
        <!-- Logo (left side) -->
        <a class="navbar-brand me-4" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Whisper of Hope" height="50">
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Items (right side) -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('user.donate') }}"
                        class="btn menubtn mx-2 {{ request()->routeIs('user.donate') ? 'active' : '' }}">
                        Donate Hair
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.request') }}"
                        class="btn menubtn mx-2 {{ request()->routeIs('user.request') ? 'active' : '' }}">
                        Request a Wig
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.community') }}"
                        class="btn menubtn mx-2 {{ request()->routeIs('user.community') ? 'active' : '' }}">
                        Community Stories
                    </a>    
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.about') }}"
                        class="btn menubtn mx-2 {{ request()->routeIs('user.about') ? 'active' : '' }}">
                        About Us
                    </a>
                </li>
            </ul>

            <!-- Auth Section - Clickable as one unit -->
            <div class="auth-container">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="auth-link">
                            Logout <i class="bi bi-person-fill"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="auth-link">
                        Login <i class="bi bi-person-fill"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>