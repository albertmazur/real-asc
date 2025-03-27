<div class="card">
    <div class="card-header">{{ __('settings.change_email') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.change.email') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('settings.current_email') }}</label>
                <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('settings.new_email') }}</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('settings.confirm_password') }}</label>
                <input type="password" class="form-control" name="current_password" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('settings.update_email') }}</button>
        </form>
    </div>
</div>