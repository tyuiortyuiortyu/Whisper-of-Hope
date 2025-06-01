<style>
    .menubtn {
        background-color: transparent;
        color: #000000;
        border-radius: 999px;
        padding: 6px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
        border: none;
    }

    .menubtn:hover {
        background-color: #F78DA7;
        color: white;
    }

    .menubtn.active {
        background-color: #F78DA7;
        color: white;
    }

    .auth-container {
        display: flex;
        align-items: center;
        margin-left: 10px;
    }

    .auth-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: inherit;
        padding: 6px 12px;
        border-radius: 999px;
        transition: all 0.3s ease;
    }

    .auth-link:hover {
        background-color: #F78DA7;
        color: white !important;
    }

    .auth-link:hover .bi-person-fill {
        color: white !important;
    }

    .auth-text {
        margin-right: 8px;
    }

    .bi-person-fill {
        transition: all 0.3s ease;
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
                            <span class="auth-text">Logout</span>
                            <i class="bi bi-person-fill"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="auth-link">
                        <span class="auth-text">Login</span>
                        <i class="bi bi-person-fill"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>