<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15); width: 400px; margin: 0 auto;">
            <div class="modal-body p-0">
                <div style="background-color: #F9BCC4; padding: 40px; position: relative;">
                    <img src="{{ asset('images/admin/user_admin/close.png') }}" class="modal-close-btn" data-bs-dismiss="modal" aria-label="{{ __('general.close') }}" alt="Close">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold" style="color: #000;">{{ __('auth.login') }}</h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}" id="userLoginForm">
                        @csrf
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA; border-right: 1px solid #ddd;">
                                    <img src="{{ asset('images/admin/login/email.png') }}" alt="{{ __('auth.email') }}" style="width: 16px; height: 16px;">
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="{{ __('auth.enter_your_email') }}" style="background-color: #FFF9EA; border: none;">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA; border-right: 1px solid #ddd;">
                                    <img src="{{ asset('images/admin/login/password.png') }}" alt="{{ __('auth.password') }}" style="width: 16px; height: 16px;">
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="loginPassword" name="password" required autocomplete="current-password"
                                       placeholder="{{ __('auth.enter_your_password') }}" style="background-color: #FFF9EA; border: none;">
                                <span class="input-group-text toggle-password" style="background-color: #FFF9EA; cursor: pointer; border-left: 1px solid #ddd;">
                                    <img id="userEyeIcon" src="{{ asset('images/admin/login/eye_close.png') }}" alt="Toggle Password" style="width: 16px; height: 16px;">
                                </span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('auth.remember_me') }}</label>
                            </div>
                            <div>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal"
                                   style="color: #000; font-size: 14px;">{{ __('auth.forgot_password') }}</a>
                            </div>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn fw-bold" id="userLoginBtn"
                                    style="background-color: #FFF9EA; color: #333; border-radius: 10px; transition: all 0.3s ease;">
                                {{ __('auth.login') }}
                            </button>
                        </div>
                        <div class="text-center" style="font-size: 14px;">
                            {{ __('auth.dont_have_account') }}
                            <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal"
                               style="color: #000; font-weight: 700;">{{ __('auth.register') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#loginModal .toggle-password');
    const password = document.getElementById('loginPassword');
    const userEyeIcon = document.getElementById('userEyeIcon');
    
    if(togglePassword && password && userEyeIcon) {
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            if (type === 'password') {
                userEyeIcon.src = '{{ asset("images/admin/login/eye_close.png") }}';
                userEyeIcon.alt = 'Show Password';
            } else {
                userEyeIcon.src = '{{ asset("images/admin/login/eye.png") }}';
                userEyeIcon.alt = 'Hide Password';
            }
        });
    }

    // Add form submission animation for user login
    const userLoginForm = document.querySelector('#loginModal form');
    const userLoginBtn = document.getElementById('userLoginBtn');
    
    if (userLoginForm && userLoginBtn) {
        userLoginForm.addEventListener('submit', function(e) {
            // Don't prevent default submission, just add loading state
            userLoginBtn.classList.add('loading');
            userLoginBtn.disabled = true;
            userLoginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
        });
    }
});
</script>

<style>
.input-group {
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    background-color: #FFF9EA;
}

.input-group-text {
    border: none !important;
}

.form-control {
    border: none !important;
    box-shadow: none !important;
}

.input-group:focus-within {
    box-shadow: 0 0 0 2px rgba(221, 221, 221, 0.2);
}

.modal-close-btn {
    position: absolute;
    top: 20px;
    right: 20px;
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

.modal-close-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

/* Login button animations */
#userLoginBtn {
    transition: all 0.3s ease;
}

#userLoginBtn:hover {
    background-color: #F791A9 !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(249, 188, 196, 0.3);
}

#userLoginBtn:active {
    transform: translateY(0);
}

/* Loading state for button */
#userLoginBtn.loading {
    background-color: #F791A9 !important;
    cursor: not-allowed;    
    pointer-events: none;
    transform: none;
}

#userLoginBtn.loading:hover {
    transform: none;
}
</style>