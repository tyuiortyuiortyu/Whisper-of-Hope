<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15); width: 400px; margin: 0 auto;">
            <div class="modal-body p-0">
                <div style="background-color: #F9BCC4; padding: 40px; position: relative;">
                    <img src="{{ asset('images/admin/user_admin/close.png') }}" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close" alt="Close">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold" style="color: #000;">REGISTER</h2>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA;">
                                    <img src="{{ asset('images/user/register/name.png') }}" alt="Name" style="width: 16px; height: 16px;">
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
                                    <img src="{{ asset('images/user/register/email.png') }}" alt="Email" style="width: 16px; height: 16px;">
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
                                    <img src="{{ asset('images/user/register/password.png') }}" alt="Password" style="width: 16px; height: 16px;">
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="registerPassword" name="password" required autocomplete="new-password"
                                       placeholder="Create password" style="background-color: #FFF9EA;">
                                <span class="input-group-text toggle-password" style="background-color: #FFF9EA; cursor: pointer;">
                                    <img id="registerEyeIcon" src="{{ asset('images/user/register/eye_close.png') }}" alt="Toggle Password" style="width: 16px; height: 16px;">
                                </span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                            <div id="passwordCriteria" class="mt-3 row row-cols-2 g-2" style="font-size: 13px;">
                                <div class="col">
                                    <div class="criteria-item">
                                        <img src="{{ asset('images/user/register/check.png') }}" class="criteria-icon unchecked" alt="Check" style="width: 15px; height: 15px;">
                                        <img src="{{ asset('images/user/register/done.png') }}" class="criteria-icon checked" alt="Check Success" style="width: 15px; height: 15px; display: none;">
                                        <span class="criteria-text">Min. 8 Characters</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="criteria-item">
                                        <img src="{{ asset('images/user/register/check.png') }}" class="criteria-icon unchecked" alt="Check" style="width: 15px; height: 15px;">
                                        <img src="{{ asset('images/user/register/done.png') }}" class="criteria-icon checked" alt="Check Success" style="width: 15px; height: 15px; display: none;">
                                        <span class="criteria-text">Lowercase Letter</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="criteria-item">
                                        <img src="{{ asset('images/user/register/check.png') }}" class="criteria-icon unchecked" alt="Check" style="width: 15px; height: 15px;">
                                        <img src="{{ asset('images/user/register/done.png') }}" class="criteria-icon checked" alt="Check Success" style="width: 15px; height: 15px; display: none;">
                                        <span class="criteria-text">Uppercase Letter</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="criteria-item">
                                        <img src="{{ asset('images/user/register/check.png') }}" class="criteria-icon unchecked" alt="Check" style="width: 15px; height: 15px;">
                                        <img src="{{ asset('images/user/register/done.png') }}" class="criteria-icon checked" alt="Check Success" style="width: 15px; height: 15px; display: none;">
                                        <span class="criteria-text">Number</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA;">
                                    <img src="{{ asset('images/user/register/password.png') }}" alt="Confirm Password" style="width: 16px; height: 16px;">
                                </span>
                                <input type="password" class="form-control"
                                       id="registerPasswordConfirm" name="password_confirmation" required autocomplete="new-password"
                                       placeholder="Confirm password" style="background-color: #FFF9EA;">
                                <span class="input-group-text toggle-password-confirm" style="background-color: #FFF9EA; cursor: pointer;">
                                    <img id="registerConfirmEyeIcon" src="{{ asset('images/user/register/eye_close.png') }}" alt="Toggle Password" style="width: 16px; height: 16px;">
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
    const togglePassword = document.querySelector('#registerModal .toggle-password');
    const password = document.getElementById('registerPassword');
    const registerEyeIcon = document.getElementById('registerEyeIcon');
    
    if(togglePassword && password && registerEyeIcon) {
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            if (type === 'password') {
                registerEyeIcon.src = '{{ asset("images/user/register/eye_close.png") }}';
                registerEyeIcon.alt = 'Show Password';
            } else {
                registerEyeIcon.src = '{{ asset("images/user/register/eye.png") }}';
                registerEyeIcon.alt = 'Hide Password';
            }
        });
    }
    
    // Eye toggle for password confirmation
    const togglePasswordConfirm = document.querySelector('#registerModal .toggle-password-confirm');
    const passwordConfirm = document.getElementById('registerPasswordConfirm');
    const registerConfirmEyeIcon = document.getElementById('registerConfirmEyeIcon');
    
    if(togglePasswordConfirm && passwordConfirm && registerConfirmEyeIcon) {
        togglePasswordConfirm.addEventListener('click', function() {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            
            if (type === 'password') {
                registerConfirmEyeIcon.src = '{{ asset("images/user/register/eye_close.png") }}';
                registerConfirmEyeIcon.alt = 'Show Password';
            } else {
                registerConfirmEyeIcon.src = '{{ asset("images/user/register/eye.png") }}';
                registerConfirmEyeIcon.alt = 'Hide Password';
            }
        });
    }
    
    // Password criteria validation
    const criteria = document.getElementById('passwordCriteria');
    if(password && criteria) {
        password.addEventListener('input', function() {
            const val = password.value;
            const criteriaItems = criteria.querySelectorAll('.criteria-item');
            
            // Min 8 characters
            const minLength = val.length >= 8;
            updateCriteriaIcon(criteriaItems[0], minLength);
            
            // Lowercase letter
            const hasLowercase = /[a-z]/.test(val);
            updateCriteriaIcon(criteriaItems[1], hasLowercase);
            
            // Uppercase letter
            const hasUppercase = /[A-Z]/.test(val);
            updateCriteriaIcon(criteriaItems[2], hasUppercase);
            
            // Number
            const hasNumber = /\d/.test(val);
            updateCriteriaIcon(criteriaItems[3], hasNumber);
        });
    }
    
    function updateCriteriaIcon(criteriaItem, isValid) {
        const uncheckedIcon = criteriaItem.querySelector('.unchecked');
        const checkedIcon = criteriaItem.querySelector('.checked');
        const text = criteriaItem.querySelector('.criteria-text');
        
        if (isValid) {
            uncheckedIcon.style.display = 'none';
            checkedIcon.style.display = 'inline-block';
            text.style.color = '#328525'; // Green color for valid
        } else {
            uncheckedIcon.style.display = 'inline-block';
            checkedIcon.style.display = 'none';
            text.style.color = 'black'; // Black color for invalid
        }
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
    box-shadow: 0 0 0 2px rgba(233, 30, 99, 0.2);
}

.criteria-item {
    display: flex;
    align-items: center;
    margin-bottom: 4px;
    padding-left: 10px;
}

.criteria-icon {
    margin-right: 8px;
    flex-shrink: 0;
}

.criteria-text {
    font-size: 13px;
    color: black;
    transition: color 0.3s ease;
    margin-left: 0;
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
</style>