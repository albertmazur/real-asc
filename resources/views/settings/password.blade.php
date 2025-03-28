<div class="card">
    <p class="card-header">{{ __('settings.change_password') }}</p>
    <div class="card-body">
        <form method="POST" action="{{ route('user.change.password') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('settings.current_password') }}</label>
                <input type="password" class="form-control" name="current_password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('settings.new_password') }}</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('settings.confirm_new_password') }}</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('settings.update_password') }}</button>
        </form>
    </div>
</div>