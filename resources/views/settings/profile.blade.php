<div class="card">
    <p class="card-header">{{ __('settings.personal_info') }}</p>
    <div class="card-body">
        <form method="POST" action="{{ route('user.update.profile') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('app.first_name') }}</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ auth()->user()->first_name }}">
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('app.last_name') }}</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ auth()->user()->last_name }}">
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('app.tel') }}</label>
                <input type="tel" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ auth()->user()->tel }}">
                @error('tel')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('settings.select_language') }}</label>
                @use('App\Enums\Language')
                <select class="form-select @error('language') is-invalid @enderror" name="language">
                    <option value="{{ Language::PL->value }}" {{ auth()->user()->language == Language::PL->value ? 'selected' : '' }}>{{ __('app.lang.pl') }}</option>
                    <option value="{{ Language::EN->value }}" {{ auth()->user()->language == Language::EN->value ? 'selected' : '' }}>{{ __('app.lang.en') }}</option>
                </select>
                @error('language')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('settings.save_changes') }}</button>
        </form>
    </div>
</div>