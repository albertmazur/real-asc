<div class="card border-danger">
    <p class="card-header bg-danger text-white">{{ __('settings.delete_account') }}</p>
    <div class="card-body">
        <p class="text-danger">{{ __('settings.delete_account_warning') }}</p>
        <form method="POST" action="{{ route('user.delete.account') }}">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <label class="form-label ">{{ __('settings.confirm_password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input @error('confirm_delete') is-invalid @enderror" type="checkbox" name="confirm_delete" required>
                <label class="form-check-label text-danger">
                    {{ __('settings.confirm_delete_text') }}
                </label>
                @error('confirm_delete')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-danger">{{ __('settings.permanently_delete_account') }}</button>
        </form>
    </div>
</div>