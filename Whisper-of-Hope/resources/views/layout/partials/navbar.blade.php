<style>
    .menubtn {
        background-color: transparent;
        color: #F78DA7;
        border-radius: 999px;
        padding: 6px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
    }

    .menubtn:hover {
        background-color: #F78DA7;
        color: white;
    }

    .menubtn.active {
        background-color: #F78DA7;
        color: white;
    }
</style>

<nav class="navbar navbar-expand-lg sticky-top" style="background-color: #FFDBDF;">
    <div class="container-fluid px-4">
        
        <!-- Logo -->
        <a class="navbar-brand me-4" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Whisper of Hope" height="50">
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
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

            <!-- Auth Section Aligned Right -->
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn menubtn me-2">Logout</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <i class="bi bi-person-fill text-dark ms-2"></i>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn menubtn me-2">Login</a>
                    </li>
                    <li class="nav-item">
                        <i class="bi bi-person-fill text-dark ms-2"></i>
                    </li>
                @endauth
            </ul>
        </div>

    </div>
</nav>
