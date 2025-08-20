@extends('layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ __('settings.change_password') }}</h2>

    <form method="POST" action="{{ route('password.change.update') }}">
        @csrf
        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('settings.current_password') }}</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password" required>
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('settings.new_password') }}</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">{{ __('settings.confirm_password') }}</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
    </form>
</div>
@endsection
