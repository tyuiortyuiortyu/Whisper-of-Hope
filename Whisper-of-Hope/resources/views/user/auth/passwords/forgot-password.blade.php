<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15); width: 400px;">
            <div class="modal-body p-0">
                <div style="background-color: #F9BCC4; padding: 40px; position: relative;">
                    <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 20px; right: 20px;"></button>
                    <div class="text-center mb-4">
                        <h2 class="fw-bold" id="forgotPasswordModalLabel" style="color: #000;">FORGOT PASSWORD</h5>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="forgotPasswordEmail" class="form-label fw-medium">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="forgotPasswordEmail" name="email" value="{{ old('email') }}"
                                   required autocomplete="email" autofocus
                                   style="border-radius: 10px;">
                            @error('email')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        <div class="alert alert-info mb-4" style="border-radius: 10px;">
                            We'll send a password reset link to your email.
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn fw-bold text-white"
                                    style="background-color: #F78DA7; border-radius: 10px;">SEND RESET LINK</button>
                        </div>
                        <div class="text-center" style="font-size: 0.9rem;">
                            Remember your password?
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal"
                               style="color: #F78DA7; font-weight: 500;">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>