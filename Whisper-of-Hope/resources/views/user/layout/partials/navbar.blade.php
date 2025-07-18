<style>
    @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');
    
    .menubtn {
        background-color: transparent;
        color: #000000;
        padding: 6px 20px;
        font-weight: 600;
        font-size: 1rem;
        font-family: 'Yantramanav', sans-serif;
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
        color: #F78DA7 !important;
        background-color: transparent;
    }

    /* Auth link khusus login/profile */
    .auth-link {
        background-color: transparent;
        color: #000000;
        border-radius: 0;
        padding: 6px 15px;
        font-weight: 600;
        font-size: 1rem;
        font-family: 'Yantramanav', sans-serif;
        transition: all 0.3s ease;
        text-align: center;
        border: none;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        cursor: pointer;
    }

    .menubtn.active {
        color: #F78DA7;
        background-color: transparent;
    }

    .auth-link:hover,
    .auth-link:active,
    .auth-link:focus,
    .auth-link.active,
    .auth-link[aria-expanded="true"] {
        color: #F78DA7 !important;
        background-color: transparent !important;
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

    /* Simple Modal Backdrop System */
    .modal {
        z-index: 1055;
    }

    .modal-backdrop {
        z-index: 1050;
        transition: opacity 0.3s ease-in-out;
    }

    .modal-backdrop.fade {
        opacity: 0;
    }

    .modal-backdrop.fade.show {
        opacity: 0.5;
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

    /* Mobile responsive styles */
    @media (max-width: 991.98px) {
        .navbar-nav {
            margin-top: 10px;
        }
        
        .navbar-nav .nav-item {
            margin-bottom: 10px;
        }
        
        .auth-container {
            margin-left: 0;
            margin-top: 10px;
        }
        
        .language-switcher {
            margin-top: 10px;
        }
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
                        {{ __('navbar.donate') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.request') }}"
                        class="btn menubtn mx-2 {{ request()->routeIs('user.request') ? 'active' : '' }}">
                        {{ __('navbar.request') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.community') }}"
                        class="btn menubtn mx-2 {{ request()->routeIs('user.community') ? 'active' : '' }}">
                        {{ __('navbar.community') }}
                    </a>    
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.about') }}"
                        class="btn menubtn mx-2 {{ request()->routeIs('user.about') ? 'active' : '' }}">
                        {{ __('navbar.about') }}
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
                                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}?v={{ time() }}" class="profile-img ms-2" style="width:32px;height:32px;object-fit:cover;border-radius:50%;">
                            @else
                                <i class="bi bi-person-circle fs-5 ms-2"></i>
                            @endif
                        </a>
                        <div class="profile-dropdown-content" id="profileOverlay">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                <i class="bi bi-person me-2"></i>{{ __('navbar.profile') }}
                            </a>
                            <a href="#" onclick="event.preventDefault(); logoutUser();">
                                <i class="bi bi-box-arrow-right me-2"></i>{{ __('navbar.logout') }}
                            </a>
                        </div>
                    </div>
                @else
                    <a class="auth-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                        {{ __('navbar.login') }} <i class="bi bi-person-circle ms-2"></i>
                    </a>
                @endauth
            </div>

            <!-- Language Switcher -->
            <div class="language-switcher me-3">
                <x-language-switcher />
            </div>
        </div>
    </div>
</nav>

<script>
function logoutUser() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("logout") }}';
    
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}';
    
    form.appendChild(csrfInput);
    document.body.appendChild(form);
    form.submit();
}

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
        var lastActive = activeMenuStack.pop() || [];
        lastActive.forEach(function(btn) {
            btn.classList.add('active');
        });
    }

    // Clean force remove all modals and backdrops
    function forceCleanup() {
        // Force close all modals
        modals.forEach(function(modal) {
            if (modal) {
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
                modal.style.display = 'none';
                
                // Destroy any existing modal instance
                var instance = bootstrap.Modal.getInstance(modal);
                if (instance) {
                    instance.dispose();
                }
            }
        });
        
        // Force remove all backdrops
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => backdrop.remove());
        
        // Reset body
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }

    // Enhanced modal switcher for profile/edit profile transitions
    document.addEventListener('click', function(e) {
        const target = e.target.closest('[data-bs-toggle="modal"][data-bs-target]');
        if (target) {
            const targetModalId = target.getAttribute('data-bs-target');
            if (targetModalId && targetModalId.startsWith('#')) {
                e.preventDefault();
                
                // Special handling for edit profile modal
                if (targetModalId === '#editProfileModal') {
                    // Don't force cleanup, just hide profile modal and show edit modal
                    const profileModal = document.getElementById('profileModal');
                    if (profileModal) {
                        const profileInstance = bootstrap.Modal.getInstance(profileModal);
                        if (profileInstance) {
                            profileInstance.hide();
                        }
                    }
                    
                    setTimeout(() => {
                        const editModal = document.querySelector(targetModalId);
                        if (editModal) {
                            const editInstance = new bootstrap.Modal(editModal, {
                                backdrop: true,
                                keyboard: true
                            });
                            editInstance.show();
                        }
                    }, 150);
                } else {
                    // For other modals, use force cleanup
                    forceCleanup();
                    
                    setTimeout(function() {
                        const targetModal = document.querySelector(targetModalId);
                        if (targetModal) {
                            const modalInstance = new bootstrap.Modal(targetModal, {
                                backdrop: true,
                                keyboard: true
                            });
                            modalInstance.show();
                        }
                    }, 100);
                }
            }
        }
    });

    // Handle backdrop clicks and escape key
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-backdrop')) {
            forceCleanup();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            forceCleanup();
        }
    });

    // Handle X button clicks specifically
    modals.forEach(function(modal) {
        if (modal) {
            const closeBtn = modal.querySelector('.btn-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    forceCleanup();
                });
            }
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
@include('user.auth.login')
@include('user.auth.register')
@include('user.auth.passwords.forgot-password')

<!-- Include profile modal if logged in -->
@auth
    @include('user.profile.profile')
    @include('user.profile.edit-profile')
@endauth