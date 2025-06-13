<style>
    .menubtn {
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

    .menubtn:hover,
    .menubtn.active {
        background-color: #F78DA7;
        color: white !important;
    }

    /* Auth link khusus login/profile */
    .auth-link {
        background-color: transparent;
        color: #000000;
        border-radius: 999px;
        padding: 6px 15px;
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

    .menubtn.active {
        background-color: #F78DA7;
        color: white;
    }

    .auth-link:hover,
    .auth-link:active,
    .auth-link:focus,
    .auth-link.active,
    .auth-link[aria-expanded="true"] {
        background-color: #F78DA7 !important;
        color: white !important;
    }

    .auth-container {
        display: flex;
        align-items: center;
        margin-left: 10px;
    }

    .auth-link .bi-person-fill {
        margin-left: 8px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-item .menubtn,
    .auth-container .auth-link {  
        letter-spacing: 0.5px;
        text-transform: none;
    }
    
    .user-name {
        max-width: 120px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        vertical-align: middle;
    }

    /* Profile dropdown styles */
    .profile-dropdown {
        position: relative;
        display: inline-block;
    }

    .profile-dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 8px;
        overflow: hidden;
    }

    .profile-dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s;
    }

    .profile-dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .profile-dropdown:hover .profile-dropdown-content {
        display: block;
    }

    .profile-img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>

<nav class="navbar navbar-expand-lg sticky-top" style="background-color: #FFDBDF;">
    <div class="container-fluid px-4">
        <!-- Logo (left side) -->
        <a class="navbar-brand me-4" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Whisper of Hope" height="50">
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Items (right side) -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Your existing menu items -->
                <li class="nav-item">
                    <a href="{{ route('user.donate') }}" class="btn menubtn mx-2 {{ request()->routeIs('user.donate') ? 'active' : '' }}">
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

            <!-- Auth Section -->
            <div class="auth-container">
                @auth
                    <div class="profile-dropdown">
                        <a class="auth-link" href="#" id="profileDropdown">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            @if(Auth::user()->profile_image)
                                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="profile-img ms-2" style="width:32px;height:32px;object-fit:cover;border-radius:50%;">
                            @else
                                <i class="bi bi-person-circle fs-5 ms-2"></i>
                            @endif
                        </a>
                        <div class="profile-dropdown-content" id="profileOverlay">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                <i class="bi bi-person me-2"></i>Profile
                            </a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <a class="auth-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login <i class="bi bi-person-circle ms-2"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Button references
    var loginBtn = document.querySelector('.auth-link[data-bs-target="#loginModal"]');
    var registerBtn = document.querySelector('.auth-link[data-bs-target="#registerModal"]');
    var forgotBtn = document.querySelector('.auth-link[data-bs-target="#forgotPasswordModal"]');
    var profileBtn = document.querySelector('.auth-link#profileDropdown');
    var menuBtns = document.querySelectorAll('.menubtn');

    // Modal references
    var loginModal = document.getElementById('loginModal');
    var registerModal = document.getElementById('registerModal');
    var forgotModal = document.getElementById('forgotPasswordModal');
    var profileModal = document.getElementById('profileModal');
    var editProfileModal = document.getElementById('editProfileModal');
    var modals = [loginModal, registerModal, forgotModal, profileModal, editProfileModal];

    // Stack for menu state
    var activeMenuStack = [];

    function storeActiveMenuBtns() {
        // Save all currently active menu buttons, then deactivate them
        var currentActive = [];
        menuBtns.forEach(function(btn) {
            if(btn.classList.contains('active')) {
                currentActive.push(btn);
                btn.classList.remove('active');
            }
        });
        activeMenuStack.push(currentActive);
    }
    function restoreActiveMenuBtns() {
        // Restore last saved menu state
        var lastActive = activeMenuStack.pop() || [];
        lastActive.forEach(function(btn) {
            btn.classList.add('active');
        });
    }

    function handleModal(btn, modal) {
        if(btn && modal) {
            modal.addEventListener('show.bs.modal', function() {
                // If any other modal is open, pop the stack for each open modal
                var openModals = modals.filter(function(m) {
                    return m && m !== modal && m.classList.contains('show');
                });
                for(var i=0; i<openModals.length && activeMenuStack.length>0; i++) {
                    activeMenuStack.pop();
                }
                // Only store if this modal is not already open (prevent double-push)
                if (!modal.classList.contains('show')) {
                    storeActiveMenuBtns();
                }
                btn.classList.add('active');
            });
            modal.addEventListener('hide.bs.modal', function() {
                btn.classList.remove('active');
                restoreActiveMenuBtns();
            });
        }
    }

    handleModal(loginBtn, loginModal);
    handleModal(registerBtn, registerModal);
    handleModal(forgotBtn, forgotModal);
    handleModal(profileBtn, profileModal);
    handleModal(profileBtn, editProfileModal);

    // Modal switcher: always close all modals before opening a new one
    document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            var target = this.getAttribute('data-bs-target');
            if(target && target.startsWith('#')) {
                // Hide all modals first
                modals.forEach(function(m) {
                    if(m && m.classList.contains('show')) {
                        var modalInstance = bootstrap.Modal.getInstance(m);
                        if(modalInstance) modalInstance.hide();
                    }
                });
                // Delay to allow Bootstrap to cleanup, then show the target modal
                setTimeout(function() {
                    var modalEl = document.querySelector(target);
                    if(modalEl) {
                        var modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                        modalInstance.show();
                    }
                }, 300);
                e.preventDefault();
            }
        });
    });

    // Always reset stack if all modals are closed (extra safety)
    modals.forEach(function(modal) {
        if(modal) {
            modal.addEventListener('hidden.bs.modal', function() {
                var anyOpen = modals.some(function(m) {
                    return m && m.classList.contains('show');
                });
                if(!anyOpen) {
                    activeMenuStack = [];
                    // Also deactivate all auth-link buttons
                    [loginBtn, registerBtn, forgotBtn, profileBtn].forEach(function(btn){
                        if(btn) btn.classList.remove('active');
                    });
                }
            });
        }
    });
});
 // Adjust z-index for donate page so it appears above other content
@if(request()->routeIs('user.donate'))
    document.querySelector('.navbar').style.zIndex = 1800;
@else
    document.querySelector('.navbar').style.zIndex = '';
@endif
</script>

<!-- Include auth modals -->
@include('auth.login')
@include('auth.register')
@include('passwords.forgot-password')

<!-- Include profile modal if logged in -->
@auth
    @include('profile.profile')
    @include('profile.edit-profile')
@endauth