<div class="card">
    <div class="card-header">{{ __('settings.language_settings') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.change.language') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('settings.select_language') }}</label>
                <select class="form-select" name="language">
                    <option value="pl" {{ auth()->user()->language == 'pl' ? 'selected' : '' }}>{{ __('app.lang.pl') }}</option>
                    <option value="en" {{ auth()->user()->language == 'en' ? 'selected' : '' }}>{{ __('app.lang.en') }}</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('settings.save_language') }}</button>
        </form>
    </div>
</div>