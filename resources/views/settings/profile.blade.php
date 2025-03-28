<div class="card">
    <p class="card-header">{{ __('settings.personal_info') }}</p>
    <div class="card-body">
        <form method="POST" action="{{ route('user.update.profile') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('settings.name') }}</label>
                <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('settings.save_changes') }}</button>
        </form>
    </div>
</div>