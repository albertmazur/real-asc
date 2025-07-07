@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>{{ __('setting.change_password') }}</h2>

    <form method="POST" action="{{ route('password.change.update') }}">
        @csrf

        <div class="mb-3">
            <label for="new_password" class="form-label">{{ __('setting.new_password') }}</label>
            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                   name="new_password" id="new_password" required>
            @error('new_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">{{ __('app.confirm_password') }}</label>
            <input type="password" class="form-control"
                   name="new_password_confirmation" id="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
    </form>
</div>
@endsection
