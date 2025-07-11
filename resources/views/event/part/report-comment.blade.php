<div class="modal fade" id="registrationCommentModal" tabindex="-1" aria-labelledby="registrationCommentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationCommentLabel">{{ __('app.submission_comment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('app.close') }}"></button>
            </div>
            <form method="POST" action="{{ route('submission.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reasonSelect" class="form-label">{{ __('dashboard.choose_topic') }}</label>
                        <select class="form-select @error('reason') is-invalid @enderror" id="reasonSelect" name="reason" required>
                            @foreach($reasons as $reason)
                                <option value="{{ $reason->value }}" {{ old('reason') == $reason->value ? 'selected' : '' }}>{{ __('dashboard.comment.' . strtolower($reason->name)) }}</option>
                            @endforeach
                        </select>
                        @error('reason')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('comment') is-invalid @enderror" id="description" name="description" placeholder="{{ __('app.description') }}" style="height: 120px;">{{ old('comment') }}</textarea>
                        <label for="description">{{ __('app.description') }}</label>
                    </div>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="hidden" id="comment_id" name="comment_id" value="{{ old('comment_id') }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('app.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>