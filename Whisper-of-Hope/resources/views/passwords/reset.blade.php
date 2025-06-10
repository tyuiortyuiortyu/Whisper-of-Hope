<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <div>
        <label>New Password</label>
        <input type="password" name="password" required>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Reset Password</button>
</form>