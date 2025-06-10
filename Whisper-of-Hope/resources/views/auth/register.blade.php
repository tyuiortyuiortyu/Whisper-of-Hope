<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15); width: 400px;">
            <div class="modal-body p-0">
                <div style="background-color: #F9BCC4; padding: 40px; position: relative;">
                    <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 20px; right: 20px;"></button>
                    <div class="text-center mb-5">
                        <h2 class="fw-bold" style="color: #000;">REGISTER</h2>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA;">
                                    <i class="bi bi-person" style="color: #888;"></i>
                                </span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                       placeholder="Enter your name" style="background-color: #FFF9EA;">
                            </div>
                            @error('name')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA;">
                                    <i class="bi bi-envelope" style="color: #888;"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                       placeholder="Enter your email" style="background-color: #FFF9EA;">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA;">
                                    <i class="bi bi-lock" style="color: #888;"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="registerPassword" name="password" required autocomplete="new-password"
                                       placeholder="Create password" style="background-color: #FFF9EA;">
                                <span class="input-group-text toggle-password" style="background-color: #FFF9EA; cursor: pointer;">
                                    <i class="bi bi-eye-slash" style="color: #888;"></i>
                                </span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                            <div id="passwordCriteria" class="mt-3 row row-cols-2 g-2" style="font-size: 13px;">
                                <div class="col"><i class="bi bi-check-circle-fill text-secondary me-1"></i> Min. 8 karakter</div>
                                <div class="col"><i class="bi bi-check-circle-fill text-secondary me-1"></i> Huruf kecil</div>
                                <div class="col"><i class="bi bi-check-circle-fill text-secondary me-1"></i> Huruf kapital</div>
                                <div class="col"><i class="bi bi-check-circle-fill text-secondary me-1"></i> Angka</div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA;">
                                    <i class="bi bi-lock" style="color: #888;"></i>
                                </span>
                                <input type="password" class="form-control"
                                       id="registerPasswordConfirm" name="password_confirmation" required autocomplete="new-password"
                                       placeholder="Confirm password" style="background-color: #FFF9EA;">
                                <span class="input-group-text toggle-password-confirm" style="background-color: #FFF9EA; cursor: pointer;">
                                    <i class="bi bi-eye-slash" style="color: #888;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn fw-bold"
                                    style="background-color: #FFF9EA; color: #333; border-radius: 10px;">
                                REGISTER
                            </button>
                        </div>
                        <div class="text-center" style="font-size: 14px;">
                            Already have an account?
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal"
                               style="color: #000; font-weight: 700;">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Eye toggle for password
    const togglePassword = document.querySelector('.toggle-password');
    const password = document.getElementById('registerPassword');
    if(togglePassword && password) {
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    }
    // Eye toggle for password confirmation
    const togglePasswordConfirm = document.querySelector('.toggle-password-confirm');
    const passwordConfirm = document.getElementById('registerPasswordConfirm');
    if(togglePasswordConfirm && passwordConfirm) {
        togglePasswordConfirm.addEventListener('click', function() {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    }
    // Password criteria validation
    const criteria = document.getElementById('passwordCriteria');
    if(password && criteria) {
        password.addEventListener('input', function() {
            const val = password.value;
            criteria.children[0].children[0].className = val.length >= 8 ? 'bi bi-check-circle-fill text-success me-1' : 'bi bi-check-circle-fill text-secondary me-1';
            criteria.children[1].children[0].className = /[a-z]/.test(val) ? 'bi bi-check-circle-fill text-success me-1' : 'bi bi-check-circle-fill text-secondary me-1';
            criteria.children[2].children[0].className = /[A-Z]/.test(val) ? 'bi bi-check-circle-fill text-success me-1' : 'bi bi-check-circle-fill text-secondary me-1';
            criteria.children[3].children[0].className = /\d/.test(val) ? 'bi bi-check-circle-fill text-success me-1' : 'bi bi-check-circle-fill text-secondary me-1';
        });
    }
});
</script>