<div class="card mb-3">
    <h5 class="card-header">{{ __('app.submission') }}</h5>
    <div class="card-body">
        <h5 class="card-title">{{ $submission->forWhat }}</h5>
        <p class="card-text">{{ $submission->content }}</p>
        <form method="POST" action="{{ route('submission.remove') }}">
            @method('delete')
            @csrf
            <input type="hidden" name="id" value="{{ $submission->id }}">
            <input type="submit" class="btn btn-danger" value="{{ __('dashboard.comment.delete_comments_submission') }}">
        </form>

    </div>
</div>
