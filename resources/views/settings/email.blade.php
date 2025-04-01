<div class="card">
    <p class="card-header">{{ __('settings.change_email') }}</p>
    <div class="card-body">
        <form method="POST" action="{{ route('user.change.email') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('settings.current_email') }}</label>
                <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('settings.new_email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('settings.confirm_password') }}</label>
                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('settings.update_email') }}</button>
        </form>
    </div>
</div>