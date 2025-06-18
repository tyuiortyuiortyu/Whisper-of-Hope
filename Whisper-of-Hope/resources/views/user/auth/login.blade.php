<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15); width: 400px; margin: 0 auto;">
            <div class="modal-body p-0">
                <div style="background-color: #F9BCC4; padding: 40px; position: relative;">
                    <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 20px; right: 20px;"></button>
                    <div class="text-center mb-5">
                        <h2 class="fw-bold" style="color: #000;">LOGIN</h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA; border-right: 1px solid #ddd;">
                                    <img src="{{ asset('images/admin/login/email.png') }}" alt="Email" style="width: 16px; height: 16px;">
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="Enter your email" style="background-color: #FFF9EA; border: none;">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA; border-right: 1px solid #ddd;">
                                    <img src="{{ asset('images/admin/login/password.png') }}" alt="Password" style="width: 16px; height: 16px;">
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="loginPassword" name="password" required autocomplete="current-password"
                                       placeholder="Enter your password" style="background-color: #FFF9EA; border: none;">
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
                                <label class="form-check-label for="remember">Remember me</label>
                            </div>
                            <div>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal"
                                   style="color: #000; font-size: 14px;">Forgot password?</a>
                            </div>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn fw-bold"
                                    style="background-color: #FFF9EA; color: #333; border-radius: 10px;">
                                LOGIN
                            </button>
                        </div>
                        <div class="text-center" style="font-size: 14px;">
                            Don't have any account?
                            <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal"
                               style="color: #000; font-weight: 700;">Register</a>
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
</style>