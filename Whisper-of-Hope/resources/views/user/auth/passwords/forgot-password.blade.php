<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15); width: 400px; margin: 0 auto;">
            <div class="modal-body p-0">
                <div style="background-color: #F9BCC4; padding: 40px; position: relative;">
                    <img src="{{ asset('images/admin/user_admin/close.png') }}" class="modal-close-btn" data-bs-dismiss="modal" aria-label="{{ __('general.close') }}" alt="Close">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold" id="forgotPasswordModalLabel" style="color: #000;">{{ __('auth.forgot_password_title') }}</h2>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #FFF9EA;">
                                    <img src="{{ asset('images/user/register/email.png') }}" alt="{{ __('auth.email') }}" style="width: 16px; height: 16px;">
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="forgotPasswordEmail" name="email" value="{{ old('email') }}"
                                       required autocomplete="email" autofocus
                                       placeholder="{{ __('auth.enter_your_email') }}" style="background-color: #FFF9EA;">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        
                        @if (session('status'))
                            <div class="alert alert-success mb-4" style="border-radius: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px;">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <div class="alert alert-info mb-4" style="border-radius: 10px; background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; padding: 12px;">
                            {{ __('auth.reset_link_info') }}
                        </div>
                        
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn fw-bold"
                                    style="background-color: #FFF9EA; color: #333; border-radius: 10px;">
                                {{ __('auth.send_reset_link') }}
                            </button>
                        </div>
                        
                        <div class="text-center" style="font-size: 14px;">
                            {{ __('auth.remember_password') }}
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal"
                               style="color: #000; font-weight: 700;">{{ __('auth.login') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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