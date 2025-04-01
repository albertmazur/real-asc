<div class="card">
    <p class="card-header">{{ __('settings.change_password') }}</p>
    <div class="card-body">
        <form method="POST" action="{{ route('user.change.password') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('settings.current_password') }}</label>
                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('settings.new_password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('settings.confirm_new_password') }}</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('settings.update_password') }}</button>
        </form>
    </div>
</div>